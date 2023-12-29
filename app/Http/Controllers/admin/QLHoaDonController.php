<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaoHoaDonRequest;
use App\Jobs\GuiMailDatHang;
use App\Jobs\GuiMailHoanTat;
use App\Jobs\GuiMailHuyDon;
use App\Models\HoadonchitietModel;
use App\Models\HoadonModel;
use App\Models\KhachHangModel;
use App\Models\SanphamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class QLHoaDonController extends Controller
{
    //
    public function index()
    {
        return view('AdminRocker.page.HoaDon.QuanLyHoaDon');
    }

    public function DuLieuHoaDon()
    {
        $now = Carbon::now();
        $date = $now->toDateString(); 
        $time = $now->toTimeString();
        $dateWithoutSpecialChars = str_replace(['-', ':'], '', $date);
        $timeWithoutSpecialChars = str_replace(['-', ':'], '', $time);

        $hoa_don_moi_nhat = HoadonModel::orderBy('id', 'desc')->first();
        $hoa_don_moi_nhat->ma_hoa_don = "TQ$dateWithoutSpecialChars$timeWithoutSpecialChars";

        $data_hoadon = HoadonModel::orderBy('id', 'desc')->get();
        $tai_khoan_dang_nhap = Auth::guard('tai_khoan')->user();
        $data_khachhang = KhachHangModel::all();
        $data_hdct = HoadonchitietModel::join('san_pham', 'hoa_don_chi_tiet.ma_san_pham', '=', 'san_pham.id')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->select(
                'hoa_don_chi_tiet.id',
                'hoa_don_chi_tiet.ma_hoa_don',
                'hoa_don_chi_tiet.ma_san_pham',
                'hoa_don_chi_tiet.tong_so_luong',
                'san_pham.ten_san_pham',
                'san_pham.gia_san_pham',
                'san_pham.giam_gia_san_pham',
                'san_pham.phan_tram_giam_gia',
                'hinh_anh.hinh_anh',
            )
            ->get();
        $data_sanpham = SanphamModel::join('hinh_anh', function ($join) {
            $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
        })
            ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
            ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
            ->select('san_pham.*', 'loai_san_pham.ten_loai', 'danh_muc.ten_danh_muc', 'hinh_anh.hinh_anh')
            ->get();

        $compact = compact('data_hoadon', 'data_khachhang', 'tai_khoan_dang_nhap', 'data_hdct', 'data_sanpham', 'hoa_don_moi_nhat');

        return response()->json($compact);
    }

    public function HoaDonChiTiet($id)
    {
        $data_hoadon = HoadonModel::where('id', $id)->first();

        $data_hdct = HoadonchitietModel::where('ma_hoa_don', $id)
            ->join('san_pham', 'hoa_don_chi_tiet.ma_san_pham', '=', 'san_pham.id')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->select(
                'hoa_don_chi_tiet.id',
                'hoa_don_chi_tiet.ma_hoa_don',
                'hoa_don_chi_tiet.ma_san_pham',
                'hoa_don_chi_tiet.tong_so_luong',
                'san_pham.ten_san_pham',
                'san_pham.gia_san_pham',
                'san_pham.giam_gia_san_pham',
                'san_pham.phan_tram_giam_gia',
                'hinh_anh.hinh_anh',
            )
            ->get();


        $data_sanpham = SanphamModel::join('hinh_anh', function ($join) {
            $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
        })
            ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
            ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
            ->select('san_pham.*', 'loai_san_pham.ten_loai', 'danh_muc.ten_danh_muc', 'hinh_anh.hinh_anh')
            ->get();
        

        return view('AdminRocker.page.HoaDon.QuanLyHDCT', compact('data_hdct', 'data_hoadon', 'data_sanpham'));
    }
   
    public function TrangTaoHoaDon()
    {
        return view('AdminRocker.page.HoaDon.TaoHoaDon');
    }

    public function TaoHoaDon(Request $request)
    {
        $themHoaDon = $request->input('them_hoa_don');
        $SanPham = $request->input('SanPham');
        $now = Carbon::now();
        $date = $now->toDateString(); 
        $time = $now->toTimeString();
        $dateWithoutSpecialChars = str_replace(['-', ':'], '', $date);
        $timeWithoutSpecialChars = str_replace(['-', ':'], '', $time);
        $hoaDon = HoadonModel::create([
            'trang_thai_thanh_toan' => $themHoaDon['trang_thai_thanh_toan'],
            'trang_thai_don' => $themHoaDon['trang_thai_don'],
            'ma_don_hang' => "TQ$dateWithoutSpecialChars$timeWithoutSpecialChars",
            'ma_khach_hang' => $themHoaDon['ma_khach_hang'],
            'ho_va_ten' => $themHoaDon['ho_va_ten'],
            'dia_chi' => $themHoaDon['dia_chi'],
            'so_dien_thoai' => $themHoaDon['so_dien_thoai'],
            'tong_tien_tat_ca' => 0,
        ]);
        $tong_tien_tat_ca = 0;

        foreach ($SanPham as $san_pham) {
            $SanphamModel = SanphamModel::find($san_pham['id_SP']);

            $tongtien = $san_pham['tong_so_luong'] * $SanphamModel->giam_gia_san_pham ;
            $tong_tien_tat_ca += $tongtien;

            HoadonchitietModel::create([
                'ma_hoa_don' => $hoaDon->id,
                'ma_san_pham' => $san_pham['id_SP'],
                'tong_so_luong' => $san_pham['tong_so_luong'],
                'tong_tien' => $tongtien ,
            ]);
        }
        $hoaDon->update(['tong_tien_tat_ca' => $tong_tien_tat_ca]);

        // gửi mail
        $khachhang = KhachHangModel::where('id', $hoaDon->ma_khach_hang)->first();
        $hoa_don_chi_tiet = HoadonchitietModel::where('ma_hoa_don', $hoaDon->id)
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
                'san_pham.phan_tram_giam_gia',
            )
            ->get();

        if ($themHoaDon['trang_thai_don'] == 0) {
            $du_lieu_Mail['ho_va_ten'] = $hoaDon->ho_va_ten;
            $du_lieu_Mail['email'] = $khachhang->email;
            $du_lieu_Mail['hoa_don_chi_tiet'] = $hoa_don_chi_tiet;
            $du_lieu_Mail['hoa_don_moi'] = $hoaDon;

            GuiMailDatHang::dispatch($du_lieu_Mail);
        }

        if ($themHoaDon['trang_thai_don'] == 2) {
            $du_lieu_Mail['ho_va_ten'] = $hoaDon->ho_va_ten;
            $du_lieu_Mail['email'] = $khachhang->email;
            $du_lieu_Mail['hoa_don_chi_tiet'] = $hoa_don_chi_tiet;
            $du_lieu_Mail['hoa_don_moi'] = $hoaDon;

            GuiMailHoanTat::dispatch($du_lieu_Mail);
        }


        return response()->json([
            'status' => true,
            'message' => 'Thêm Hoá Đơn thành công'
        ]);
    }

    // public function ThemHoaDon(TaoHoaDonRequest $request)
    // {
    //     $data = $request->all();
    //     $data['tong_tien_tat_ca'] = 0;
    //     $data['trang_thai_don'] = 0;
    //     $data['trang_thai_thanh_toan'] = 0;
    //     $data['ma_don_hang'] = Str::uuid();
    //     HoadonModel::create($data);
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Thêm Hoá Đơn thành công'
    //     ]);
    // }. khong xoa

    public function CapNhatTTDonHang(Request $request)
    {
        $data = $request->all();
        $donHang = HoadonModel::find($data['donHangId']);
        $hoa_don_chi_tiet = HoadonchitietModel::where('ma_hoa_don', $donHang->id)
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
                'san_pham.phan_tram_giam_gia',
            )
            ->get();

        $khachhang = KhachHangModel::where('id', $donHang->ma_khach_hang)->first();

        if ($donHang) {
            // gởi mail đã nhận hàng
            if ($data['TTMoi'] === 2) {
                $du_lieu_Mail['ho_va_ten'] = $donHang->ho_va_ten;
                $du_lieu_Mail['email'] = $khachhang->email;
                $du_lieu_Mail['hoa_don_chi_tiet'] = $hoa_don_chi_tiet;
                $du_lieu_Mail['hoa_don_moi'] = $donHang;
                GuiMailHoanTat::dispatch($du_lieu_Mail);
            }
            // gởi mail huỷ đơn hàng
            if ($data['TTMoi'] === -1) {
                $du_lieu_Mail['ho_va_ten'] = $donHang->ho_va_ten;
                $du_lieu_Mail['email'] = $khachhang->email;
                $du_lieu_Mail['hoa_don_chi_tiet'] = $hoa_don_chi_tiet;
                $du_lieu_Mail['hoa_don_moi'] = $donHang;
                GuiMailHuyDon::dispatch($du_lieu_Mail);
            }
            $donHang->update([
                'trang_thai_don' => $data['TTMoi'],
            ]);

            // Phản hồi về frontend nếu cần
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật trạng thái đơn hàng thành công'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng'
            ]);
        }
    }

    public function CapNhatTTTT(Request $request)
    {
        $data = $request->all();
        $donHang = HoadonModel::find($data['id_hoa_don']);

        if ($donHang) {
            $donHang->update([
                'trang_thai_thanh_toan' => $data['TTTT_moi'],
            ]);

            // Phản hồi về frontend nếu cần
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật trạng thái thanh toan thành công'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng'
            ]);
        }
    }


    public function ThemHoaDonChiTiet(Request $request)
    {
        $data = $request->all();
        $tong_tien = $data['tong_so_luong'] * $data['giam_gia_san_pham'];
        
        $data['tong_tien'] = $tong_tien;
        $tong_tien_tat_ca = $data['tong_tien_tat_ca'] + $tong_tien;
        // dd($data);
        HoadonchitietModel::create($data);
        HoadonModel::where('id', $request->ma_hoa_don)->update(
            [
                'tong_tien_tat_ca' => $tong_tien_tat_ca
            ]
        );
        toastr()->success('Sản phẩm đã được thêm thành công.');
        return redirect("admin/hoa-don/hoa-don-chi-tiet/{$request->ma_hoa_don}");
    }

    public function XoaHoaDonChiTiet()
    {
        $id = $_GET['idsp'];
        $hoadonchitiet = HoadonchitietModel::find($id);
        $data_sanpham = SanphamModel::where('id', $hoadonchitiet->ma_san_pham)->first();
        $data_hoadon = HoadonModel::where('id', $hoadonchitiet->ma_hoa_don)->first();

        $tong_tien = $data_sanpham->giam_gia_san_pham * $hoadonchitiet->tong_so_luong;

        $tong_tien_tat_ca = $data_hoadon->tong_tien_tat_ca - $tong_tien;

        HoadonModel::where('id', $hoadonchitiet->ma_hoa_don)->update(
            [
                'tong_tien_tat_ca' => $tong_tien_tat_ca,
            ]
        );
        $hoadonchitiet->delete();
    }
}
