<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        $User = User::all(); 
        $currentUser = Auth::user();
        return view('Backend.User.Taikhoan', compact('User', 'currentUser'));
    }

    public function showDetail($id)
    {
        $user = User::findOrFail($id);
        return view('Backend.User.ChiTietTaikhoan', compact('user'));
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_admin == 1) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa tài khoản quản trị viên.',
            ]);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Tài khoản đã được xóa thành công.',
        ]);
    }
}
