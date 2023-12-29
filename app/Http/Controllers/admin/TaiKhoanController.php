<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapNhatHoSoRQ;
use App\Http\Requests\DangNhapQuanTri;
use App\Http\Requests\DoiMatKhauHoSoRQ;
use App\Http\Requests\QuenMatKhauHoSoRQ;
use App\Jobs\GuiMailQuenMatKhauHoSo;
use App\Models\PhanquyenModel;
use App\Models\TaiKhoanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TaiKhoanController extends Controller
{
    public function DangNhap()
    {
        return view('AdminRocker.page.TaiKhoan.DangNhap');
    }

    public function KichHoatDangNhap(DangNhapQuanTri $request)
    {
        $du_lieu['email'] = $request->email;
        $du_lieu['password'] = $request->password;

        // dd($du_lieu);
        $kiem_tra = Auth::guard('tai_khoan')->attempt($du_lieu);
        // dd($kiem_tra);
        if ($kiem_tra) {
            return response()->json([
                'status' => true,
                'message' => 'Đăng nhập thành công',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản hoặc mật khẩu không đúng',
            ]);
        }
    }

    public function DangXuat()
    {
        Auth::guard('tai_khoan')->logout();  //nếu đăng nhập mới đăng xuất đc
        toastr()->success('Đăng Xuất Thành Công');
        return redirect('/admin/dang-nhap');
    }

    public function HoSo()
    {
        return view('AdminRocker.page.TaiKhoan.HoSo');
    }

    public function DuLieuHoSo()
    {
        $tai_khoan = Auth::guard('tai_khoan')->user();
        $data_phanquyen = PhanquyenModel::get();
        $compact = compact('tai_khoan', 'data_phanquyen');

        return response()->json($compact);
    }

    public function CapNhatHoSo(CapNhatHoSoRQ $request)
    {
        $du_lieu = $request->all();
        // dd($du_lieu);
        $id = Auth::guard('tai_khoan')->user()->id;
        $tai_khoan = TaiKhoanModel::find($id);
        $tai_khoan->update($du_lieu);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật hồ sơ thành công!',
        ]);
    }

    public function DoiMatKhau()
    {
        return view('AdminRocker.page.TaiKhoan.DoiMatKhau');
    }

    public function DoiMatKhauHoSo(DoiMatKhauHoSoRQ $request)
    {
        $id = Auth::guard('tai_khoan')->user()->id;
        $tai_khoan = TaiKhoanModel::find($id);
        $tai_khoan->password = bcrypt($request->password_new);
        $tai_khoan->save();

        return response()->json([
            'status' => true,
            'message' => 'Đã đổi mật khẩu hồ sơ thành công!',
        ]);
    }

    public function QuenMatKhau()
    {
        return view('AdminRocker.page.TaiKhoan.QuenMatKhau');
    }

    public function QuenMatKhauHoSo(QuenMatKhauHoSoRQ $request)
    {
        $khach_hang = TaiKhoanModel::where('email', $request->email)->first();
        $ma_bam     = Str::uuid();

        $khach_hang->ma_bam_quen_mat_khau = $ma_bam;
        $khach_hang->save();

        // Phân cụm này qua JOB
        $du_lieu_Mail['ho_va_ten'] = $khach_hang->ten_tai_khoan;
        $du_lieu_Mail['ma_bam_quen_mat_khau'] = $ma_bam;
        $du_lieu_Mail['email']     = $khach_hang->email;
        // dd($du_lieu_Mail);
        GuiMailQuenMatKhauHoSo::dispatch($du_lieu_Mail);

        //  SendMailDoiMatKhau::dispatch($du_lieu_Mail);
        // End Phân JOB
        return response()->json([
            'status' => true,
            'message' => 'Vui Lòng Kiểm Tra Mail',
        ]);    
    }

    
    public function KichHoatMailDoiMatKhau($ma_bam_quen_mat_khau)
    {
        $khach_hang = TaiKhoanModel::where('ma_bam_quen_mat_khau', $ma_bam_quen_mat_khau)->first();

        if ($khach_hang) {
            return view('AdminRocker.page.TaiKhoan.CapNhatQuenMatKhau', compact('ma_bam_quen_mat_khau'));
        } else {
            toastr()->error('Liên kết không tồn tại!');
            return redirect('/');
        }
    }
    public function KichHoatDoiMatKhau(Request $request)
    {
        $khach_hang = TaiKhoanModel::where('ma_bam_quen_mat_khau', $request->ma_bam_quen_mat_khau)->first();
        $khach_hang->ma_bam_quen_mat_khau = '';
        $khach_hang->password = bcrypt($request->password_new);
        $khach_hang->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập Nhật Mật Khẩu Thành Công',
        ]);
    }

}
