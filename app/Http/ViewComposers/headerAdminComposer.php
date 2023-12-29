<?php
// Trong thư mục app/Http/ViewComposers
namespace App\Http\ViewComposers;

use App\Models\LienheModel;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;



class headerAdminComposer
{
    public function compose(View $view)
    {

        $LIENHE = LienheModel::where('xu_ly', 0)->get();
        $LIENHE_xu_ly = LienheModel::where('xu_ly', 0)->count();

        $TaiKhoanDangNhap = Auth::guard('tai_khoan')->user();

        // quản trị viên
        // if ($TaiKhoanDangNhap && $TaiKhoanDangNhap->loai_tai_khoan == 5) {
        //     $isAdmin = true;
        // } else {
        //     $isAdmin = false;
        // }

        // Quản lý nhân viên
        if ($TaiKhoanDangNhap && $TaiKhoanDangNhap->loai_tai_khoan == 4) {
            $QuanLy = true;
        } else {
            $QuanLy = false;
        }

        // nhân viên đăng bài
        if ($TaiKhoanDangNhap && $TaiKhoanDangNhap->loai_tai_khoan == 3) {
            $DangBai = true;
        } else {
            $DangBai = false;
        }

        // nhân viên báng hàng
        if ($TaiKhoanDangNhap && $TaiKhoanDangNhap->loai_tai_khoan == 2) {
            $BanHang = true;
        } else {
            $BanHang = false;
        }


        // $view->with('isAdmin', $isAdmin);
        $view->with('QuanLy', $QuanLy);
        $view->with('DangBai', $DangBai);
        $view->with('BanHang', $BanHang);
        $view->with('TaiKhoanDangNhap', $TaiKhoanDangNhap);
        $view->with('LIENHE', $LIENHE);
        $view->with('LIENHE_xu_ly', $LIENHE_xu_ly);
    }
}