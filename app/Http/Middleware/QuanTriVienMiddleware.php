<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class QuanTriVienMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        $check = Auth::guard('tai_khoan')->check();
        if($check) {
            $user = Auth::guard('tai_khoan')->user();
            if($user->loai_tai_khoan <= 4) {
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
