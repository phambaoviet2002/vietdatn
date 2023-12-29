<?php

namespace App\Http\Controllers\khachhang;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\CapNhatQuenMatKhau;
use App\Http\Requests\CapNhatThongTin;
use App\Http\Requests\DangKy;
use App\Http\Requests\DangNhap;
use App\Http\Requests\QuenMatKhau;
use App\Jobs\GuiMailQuenMatKhau;
use App\Jobs\GuiMailTaiKhoang;
use App\Models\KhachHangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhachHangController extends Controller
{
    public function DangNhap()
    {
        return view('Trang-Khach-Hang.page.DangNhap');
    }
    public function DangKy()
    {
        return view('Trang-Khach-Hang.page.DangKy');
    }

    public function KichHoatDangKy(DangKy $request)
    {
        $du_lieu = $request->all();
        $ma_bam = Str::uuid(); // tạo ra 1 biến tên ma_bam kiểu string có 36 ký tự không trùng với nhau
        $du_lieu['ma_bam_email'] = $ma_bam;
        $du_lieu['password']  = bcrypt($du_lieu['password']);
        KhachHangModel::create($du_lieu);

        // Phân cụm này qua JOB
        $du_lieu_Mail['ho_va_ten'] = $request->ho_va_ten;
        $du_lieu_Mail['email']     = $request->email;
        $du_lieu_Mail['ma_bam_email'] = $ma_bam;
        GuiMailTaiKhoang::dispatch($du_lieu_Mail);

        // SendMailJob::dispatch($du_lieu_Mail);
        // End Phân JOB
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đăng Ký thành công'
        ]);
    }

    public function KichHoatMailTaiKhoang($ma_bam)
    {
        $tai_khoang = KhachHangModel::where('ma_bam_email', $ma_bam)->first();
        if ($tai_khoang && $tai_khoang->loai_tai_khoan == 0) {
            $tai_khoang->loai_tai_khoan = 1;
            $tai_khoang->ma_bam_email = '';
            $tai_khoang->save();
            Toastr()->success('Đã kích hoạt tài khoản thành công!');
        } else {
            toastr()->error('Thông tin không chính xác!');
        }
        return redirect('/dang-nhap');
    }

    public function KichHoatDangNhap(DangNhap $request)
    {
        $du_lieu['email']      = $request->email;
        $du_lieu['password']   = $request->password;

        $kiem_tra = Auth::guard('khach_hang')->attempt($du_lieu);

        if ($kiem_tra) {
            $khach_hang = Auth::guard('khach_hang')->user();
            if ($khach_hang->loai_tai_khoan == -1) {
                Auth::guard('khach_hang')->logout();
                return response()->json([
                    'status' => false,
                    'message' => 'Tài khoản đã bị khóa',
                ]);
            } else if ($khach_hang->loai_tai_khoan == 0) {
                Auth::guard('khach_hang')->logout();
                return response()->json([
                    'status' => false,
                    'message' => 'Tài khoản chưa được kích hoạt, hãy vào Gmail kích hoạt',
                ]);
            }
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


    // quen mat khau
    public function QuenMatKhau()
    {
        return view('Trang-Khach-Hang.page.QuenMatKhau');
    }

    public function KichHoatQuenMatKhau(QuenMatKhau $request)
    {
        $khach_hang = KhachHangModel::where('email', $request->email)->first();
        $ma_bam     = Str::uuid();

        $khach_hang->ma_bam_quen_mat_khau = $ma_bam;
        $khach_hang->save();

        // Phân cụm này qua JOB
        $du_lieu_Mail['ho_va_ten'] = $request->ho_va_ten;
        $du_lieu_Mail['ma_bam_quen_mat_khau'] = $ma_bam;
        $du_lieu_Mail['email']     = $request->email;
        GuiMailQuenMatKhau::dispatch($du_lieu_Mail);

        //  SendMailDoiMatKhau::dispatch($du_lieu_Mail);
        // End Phân JOB
        return response()->json([
            'status' => true,
            'message' => 'Vui Lòng Kiểm Tra Mail',
        ]);
    }

    
    public function KichHoatMailDoiMatKhau($ma_bam_quen_mat_khau)
    {
        $khach_hang = KhachHangModel::where('ma_bam_quen_mat_khau', $ma_bam_quen_mat_khau)->first();

        if ($khach_hang) {
            return view('trang-khach-hang.page.CapNhatQuenMatKhau', compact('ma_bam_quen_mat_khau'));
        } else {
            toastr()->error('Liên kết không tồn tại!');
            return redirect('/');
        }
    }
    public function KichHoatDoiMatKhau(CapNhatQuenMatKhau $request)
    {
        $khach_hang = KhachHangModel::where('ma_bam_quen_mat_khau', $request->ma_bam_quen_mat_khau)->first();
        $khach_hang->ma_bam_quen_mat_khau = '';
        $khach_hang->password = bcrypt($request->password);
        
        $khach_hang->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập Nhật Mật Khẩu Thành Công',
        ]);
    }
// hồ sơ khách hàng 
    public function HoSo(){
        return view('Trang-Khach-Hang.page.HoSo');
    }
    public function ThongTinKhachHang()
    {
        $id = Auth::guard('khach_hang')->user()->id;
        $khach_hang = KhachHangModel::find($id);

        return response()->json([
            'khach_hang'  => $khach_hang
        ]);
    }
    public function KichHoatCapNhapThongTin(CapNhatThongTin $request)
    {
        // Dòng đầu tiên: Lấy "id" của người dùng đã xác thực từ guard "customer" (giả định là khách hàng) và gán vào biến $id.
        // Dòng thứ hai: Sử dụng giá trị $id để tìm thông tin khách hàng tương ứng trong cơ sở dữ liệu và gán vào biến $user.
        $du_lieu = $request->all();
        $id = Auth::guard('khach_hang')->user()->id;
        $khach_hang = KhachHangModel::find($id);
        $khach_hang->update($du_lieu);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật thông tin thành công!',
        ]);
    }

    public function CapNhapMatKhau(){
        return view('Trang-Khach-Hang.page.CapNhatMatKhau');
    }
    public function KichHoatCapNhapMatKhau( CapNhatQuenMatKhau $request)
    {
        $id = Auth::guard('khach_hang')->user()->id;
        $khach_hang = KhachHangModel::find($id);
        $khach_hang->password = bcrypt($request->password);
        $khach_hang->save();

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật mật khẩu thành công!',
        ]);
    }


    // logout
    public function DangXuat()
    {
        Auth::guard('khach_hang')->logout();  //nếu đăng nhập mới đăng xuất đc
        toastr()->success('Đăng Xuất Thành Công');
        return redirect('/');
    }
}
