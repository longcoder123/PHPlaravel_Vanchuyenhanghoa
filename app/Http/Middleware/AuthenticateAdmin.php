<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Kiểm tra người dùng đã đăng nhập chưa và có phải admin không
        if (!$user || !$user->is_admin) {
            // Trả về lỗi 403 nếu người dùng không phải là admin
            abort(403, 'Access denied. Admins only.');
        }

        return $next($request);
    }
}
