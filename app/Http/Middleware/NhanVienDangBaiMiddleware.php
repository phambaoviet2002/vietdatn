<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class NhanVienDangBaiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check = Auth::guard('tai_khoan')->check();
        if ($check) {
            $user = Auth::guard('tai_khoan')->user();
            // tài khoản nhân viên đăng bài là : 3
            if ($user->loai_tai_khoan <= 2) {
                toastr()->error('Tài khoản của bạn không đủ quyền truy cập!');
                return back()->withInput();
            }
            return $next($request);
        } else {
            toastr()->warning('Chức năng này yêu cầu phải đăng nhập!');
            return redirect('./admin/dang-nhap');
        }
    }
}
