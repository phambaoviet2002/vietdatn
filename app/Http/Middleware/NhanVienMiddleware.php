<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class NhanVienMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $check = Auth::guard('tai_khoan')->check();
        if ($check) {
            $user = Auth::guard('tai_khoan')->user();
            // tài khoản nhân viên bán hàng là : 2
            if ($user->loai_tai_khoan <= 1 && $user->loai_tai_khoan === 3) {
                toastr()->error('Tài khoản của bạn không đủ quyền truy cập!');
                return redirect('./admin/dang-nhap');
            }
            return $next($request);
        } else {
            toastr()->warning('Chức năng này yêu cầu phải đăng nhập!');
            return redirect('./admin/dang-nhap');
        }

    }
}
