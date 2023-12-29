<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class KhachHangDangNhap
{
    public function handle(Request $request, Closure $next): Response
    {
        $check = Auth::guard('khach_hang')->check();
        if($check) {
            $user = Auth::guard('khach_hang')->user();
            if($user->loai_tai_khoan <= 0) {
                toastr()->error('Tài khoản của bạn không đủ quyền truy cập!');
                return redirect('/dang-nhap');
            }
            return $next($request);
        } else {
            toastr()->warning('Chức năng này yêu cầu phải đăng nhập!');
            return redirect('/dang-nhap');
        }
    }
}
