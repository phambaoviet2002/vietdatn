<?php

namespace App\Http\Controllers\khachhang;

use App\Http\Controllers\Controller;
use App\Jobs\GuiMailDatHang;
use App\Jobs\GuiMailHuyDon;
use App\Models\GiohangModel;
use App\Models\HoadonchitietModel;
use App\Models\HoadonModel;
use App\Models\SanphamModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ThanhToanControllerr extends Controller
{

    public function ThanhToan(Request $request)
    {
        $now = Carbon::now();
        $date = $now->toDateString(); 
        $time = $now->toTimeString();
        $dateWithoutSpecialChars = str_replace(['-', ':'], '', $date);
        $timeWithoutSpecialChars = str_replace(['-', ':'], '', $time);
        $ma_don_hang = "DH$dateWithoutSpecialChars$timeWithoutSpecialChars";

        $trang_thai_thanh_toan = $request->input('trang_thai_thanh_toan');
        $user = Auth::guard('khach_hang')->user();
        $user_id = $user->id;
        $ho_va_ten = $request->ho_va_ten;
        $so_dien_thoai = $request->so_dien_thoai;
        $dia_chi = $request->dia_chi;

        $tinh_tong_tong_tien = ceil($request->tong_tien_tat_ca);
        // dd( $tinh_tong_tong_tien);
        // $ma_don_hang = Str::uuid();
        $vnp_OrderInfo = "cam on quy khach da dat hang";
        if ($trang_thai_thanh_toan == 1) {

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/khach-hang/thanh-toan-thanh-cong";
            $vnp_TmnCode = "3J0W4BYL"; //Mã website tại VNPAY
            $vnp_HashSecret = "SXSKZJKWQWYXHKTRWYJFQYUUIBXNABMO"; //Chuỗi bí mật

            $vnp_TxnRef = $ma_don_hang; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = $vnp_OrderInfo;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $tinh_tong_tong_tien * 100;
            $vnp_Locale = 'vn';

            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {

                HoadonModel::create([
                    'id'   => $ma_don_hang,
                    'ma_khach_hang' => $user_id,
                    'ho_va_ten' =>  $ho_va_ten,
                    'so_dien_thoai' => $so_dien_thoai,
                    'dia_chi' => $dia_chi,
                    'tong_tien_tat_ca' => $tinh_tong_tong_tien,
                    'trang_thai_don' => 3,
                    'trang_thai_thanh_toan' => 0
                ]);
                header('Location: ' . $vnp_Url);
                die();
            } else {
                return response()->json($returnData);
            }
        } else {
            HoadonModel::create([
                'id'   => $ma_don_hang,
                'ma_khach_hang' => $user_id,
                'ho_va_ten' =>  $ho_va_ten,
                'so_dien_thoai' => $so_dien_thoai,
                'dia_chi' => $dia_chi,
                'tong_tien_tat_ca' => $tinh_tong_tong_tien,
                'trang_thai_don' => 0,
                'trang_thai_thanh_toan' => 0
            ]);

       
            $hoa_don_moi = HoadonModel::where('id', $ma_don_hang)->first();
            $gio_hang = GiohangModel::where('ma_khach_hang', $user_id)->get();
            foreach ($gio_hang as $item) {
                HoadonchitietModel::create([
                    'ma_hoa_don' => $hoa_don_moi->id,
                    'ma_san_pham' => $item->ma_san_pham,
                    'tong_so_luong' => $item->tong_so_luong,
                    'tong_tien' => $item->tong_tien
                ]);
                // Trừ số lượng sản phẩm đã bán từ bảng sản phẩm
                $san_pham = SanphamModel::find($item->ma_san_pham);
                $san_pham->so_luong -= $item->tong_so_luong;
                $san_pham->save();
            }
            GioHangModel::where('ma_khach_hang', $user_id)->delete();

            $hoa_don_chi_tiet = HoadonchitietModel::where('ma_hoa_don', $hoa_don_moi->id)
                ->join('san_pham', 'hoa_don_chi_tiet.ma_san_pham', '=', 'san_pham.id')
                ->join('hinh_anh', function ($join) {
                    $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                        ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
                })
                ->select(
                    'hoa_don_chi_tiet.id',
                    'hoa_don_chi_tiet.tong_so_luong',
                    'hoa_don_chi_tiet.tong_tien',
                    'hoa_don_chi_tiet.ma_hoa_don',
                    'hoa_don_chi_tiet.created_at',
                    'san_pham.ten_san_pham',
                    'san_pham.gia_san_pham',
                    'san_pham.giam_gia_san_pham',
                    'hinh_anh.hinh_anh',
                )
                ->get();
            // dd($hoa_don_chi_tiet);
            $du_lieu_Mail['ho_va_ten'] = $user->ho_va_ten;
            $du_lieu_Mail['email'] = $user->email;
            $du_lieu_Mail['hoa_don_chi_tiet'] = $hoa_don_chi_tiet;
            $du_lieu_Mail['hoa_don_moi'] = $hoa_don_moi;
            GuiMailDatHang::dispatch($du_lieu_Mail);
            toastr()->success("Đặt Hàng thành công!");
            return view('Trang-Khach-Hang.page.HoaDon', compact('hoa_don_moi', 'hoa_don_chi_tiet'));
        }
    }

    public function ThanhToanThanhCong(Request $request)
    {
        $user = Auth::guard('khach_hang')->user();
        $user_id = $user->id;
        $TransactionStatus = $request->vnp_TransactionStatus;
        $vnp_TxnRef = $request->vnp_TxnRef;

        if ($TransactionStatus === '00') {
            HoadonModel::where('id', $vnp_TxnRef)->update([
                'trang_thai_don' => 0,
                'trang_thai_thanh_toan' => 1,
            ]);
            $hoa_don_moi = HoadonModel::where('id', $vnp_TxnRef)->first();

            $gio_hang = GiohangModel::where('ma_khach_hang', $user_id)->get();

            foreach ($gio_hang as $item) {
                HoadonchitietModel::create([
                    'ma_hoa_don' => $hoa_don_moi->id,
                    'ma_san_pham' => $item->ma_san_pham,
                    'tong_so_luong' => $item->tong_so_luong,
                    'tong_tien' => $item->tong_tien
                ]);
                // Trừ số lượng sản phẩm đã bán từ bảng sản phẩm
                $san_pham = SanphamModel::find($item->ma_san_pham);
                $san_pham->so_luong -= $item->tong_so_luong;
                $san_pham->save();
            }
            GioHangModel::where('ma_khach_hang', $user_id)->delete();
            $hoa_don_chi_tiet = HoadonchitietModel::where('ma_hoa_don', $hoa_don_moi->id)
                ->join('san_pham', 'hoa_don_chi_tiet.ma_san_pham', '=', 'san_pham.id')
                ->join('hinh_anh', function ($join) {
                    $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                        ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
                })
                ->select(
                    'hoa_don_chi_tiet.id',
                    'hoa_don_chi_tiet.tong_so_luong',
                    'hoa_don_chi_tiet.tong_tien',
                    'hoa_don_chi_tiet.ma_hoa_don',
                    'hoa_don_chi_tiet.created_at',
                    'san_pham.ten_san_pham',
                    'san_pham.gia_san_pham',
                    'san_pham.giam_gia_san_pham',
                    'hinh_anh.hinh_anh',
                )
                ->get();
            // dd($hoa_don_chi_tiet);
            $du_lieu_Mail['ho_va_ten'] = $user->ho_va_ten;
            $du_lieu_Mail['email'] = $user->email;
            $du_lieu_Mail['hoa_don_chi_tiet'] = $hoa_don_chi_tiet;
            $du_lieu_Mail['hoa_don_moi'] = $hoa_don_moi;
            GuiMailDatHang::dispatch($du_lieu_Mail);

            toastr()->success("Đặt hàng thành công ");
            return view('Trang-Khach-Hang.page.HoaDon', compact('hoa_don_moi', 'hoa_don_chi_tiet'));
        } elseif ($TransactionStatus === '02') {
            HoadonModel::where('id', $vnp_TxnRef)->update([
                'trang_thai_don' => -1,
                'trang_thai_thanh_toan' => 0,
            ]);
            $hoa_don_moi = HoadonModel::where('id', $vnp_TxnRef)->first();

            $gio_hang = GiohangModel::where('ma_khach_hang', $user_id)->get();

            foreach ($gio_hang as $item) {
                HoadonchitietModel::create([
                    'ma_hoa_don' => $hoa_don_moi->id,
                    'ma_san_pham' => $item->ma_san_pham,
                    'tong_so_luong' => $item->tong_so_luong,
                    'tong_tien' => $item->tong_tien
                ]);
                // Trừ số lượng sản phẩm đã bán từ bảng sản phẩm
                $san_pham = SanphamModel::find($item->ma_san_pham);
                $san_pham->so_luong -= $item->tong_so_luong;
                $san_pham->save();
            }
            GioHangModel::where('ma_khach_hang', $user_id)->delete();
            $hoa_don_chi_tiet = HoadonchitietModel::where('ma_hoa_don', $hoa_don_moi->id)
            ->join('san_pham', 'hoa_don_chi_tiet.ma_san_pham', '=', 'san_pham.id')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->select(
                'hoa_don_chi_tiet.id',
                'hoa_don_chi_tiet.tong_so_luong',
                'hoa_don_chi_tiet.tong_tien',
                'hoa_don_chi_tiet.ma_hoa_don',
                'hoa_don_chi_tiet.created_at',
                'san_pham.ten_san_pham',
                'san_pham.gia_san_pham',
                'san_pham.giam_gia_san_pham',
                'hinh_anh.hinh_anh',
            )
            ->get();
            toastr()->warning("Đặt Hàng không thành công ");
            return view('Trang-Khach-Hang.page.HoaDon', compact('hoa_don_moi','hoa_don_chi_tiet'));
        }
    }

    public function DsLichSuMuaHang()
    {
        $user = Auth::guard('khach_hang')->user();
        $user_id = $user->id;
        $ds_hoa_don = HoadonModel::where('ma_khach_hang', $user_id)->get();

        foreach ($ds_hoa_don as $hoa_don) {
            $hoa_don_chi_tiet = HoadonchitietModel::where('ma_hoa_don', $hoa_don->id)
                ->join('san_pham', 'hoa_don_chi_tiet.ma_san_pham', '=', 'san_pham.id')
                ->join('hinh_anh', function ($join) {
                    $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                        ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
                })
                ->select(
                    'hoa_don_chi_tiet.id',
                    'hoa_don_chi_tiet.tong_so_luong',
                    'hoa_don_chi_tiet.tong_tien',
                    'hoa_don_chi_tiet.ma_hoa_don',
                    'hoa_don_chi_tiet.created_at',
                    'san_pham.ten_san_pham',
                    'san_pham.gia_san_pham',
                    'san_pham.giam_gia_san_pham',
                    'hinh_anh.hinh_anh',
                )
                ->get();
            // Gán dữ liệu chi tiết vào trường mới trong mỗi phần tử hóa đơn
            $hoa_don->ds_hoa_don_chi_tiet = $hoa_don_chi_tiet;
        }
        // dd($ds_hoa_don);
        return response()->json([
            'status'            => true,
            'message'           => 'lấy dữ liệu Thành Công',
            'du_lieu'           => $ds_hoa_don,
        ]);
    }


    public function LichSuMuaHang()
    {
        return view('Trang-Khach-Hang.page.LichSuMuaHang');
    }

    public function HuyDon($id)
    {
        $user = Auth::guard('khach_hang')->user();
        HoadonModel::where('id', $id)->update([
            'trang_thai_don' => -1,
        ]);
        $hoa_don_moi = HoadonModel::where('id', $id)->first();
        $hoa_don_chi_tiet = HoadonchitietModel::where('ma_hoa_don', $hoa_don_moi->id)
            ->join('san_pham', 'hoa_don_chi_tiet.ma_san_pham', '=', 'san_pham.id')
            ->select(
                'hoa_don_chi_tiet.id',
                'hoa_don_chi_tiet.tong_so_luong',
                'hoa_don_chi_tiet.tong_tien',
                'hoa_don_chi_tiet.ma_hoa_don',
                'hoa_don_chi_tiet.created_at',
                'san_pham.ten_san_pham',
                'san_pham.gia_san_pham',
                'san_pham.giam_gia_san_pham',
            )
            ->get();
        //   dd($hoa_don_chi_tiet);
        $du_lieu_Mail['ho_va_ten'] = $user->ho_va_ten;
        $du_lieu_Mail['email'] = $user->email;
        $du_lieu_Mail['hoa_don_chi_tiet'] = $hoa_don_chi_tiet;
        $du_lieu_Mail['hoa_don_moi'] = $hoa_don_moi;
        GuiMailHuyDon::dispatch($du_lieu_Mail);
        return response()->json([
            'status' => true,
        ]);
    }
}
