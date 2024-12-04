<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomerProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        
        // Kiểm tra xem người dùng đã có thông tin trong bảng customers chưa
        if (!$user->customer) {
            // Nếu chưa có thông tin, chuyển hướng người dùng tới trang điền thông tin
            return redirect()->route('complete-profile-form');
        }

        // Nếu đã có thông tin, cho phép tiếp tục request
        return $next($request);
    }
}


