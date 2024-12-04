<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        $User = User::all();  // Sửa từ `user` thành `users` để phù hợp với tên biến
        $currentUser = Auth::user();
        return view('Backend.User.Taikhoan', compact('User', 'currentUser'));
    }

    public function showDetail($id)
    {
        // Sử dụng findOrFail để tự động chuyển hướng nếu không tìm thấy người dùng
        $user = User::findOrFail($id);

        return view('Backend.User.ChiTietTaikhoan', compact('user'));
    }
}
