<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginUserController extends Controller
{
    /**
     * Hiển thị form đăng nhập
     */
    public function index()
    {
        return view("Login.User.Userlogin");
    }

    /**
     * Xử lý đăng nhập người dùng
     */
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        // Thực hiện đăng nhập
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra nếu người dùng là khách hàng
            if ($user->customer) {
                // Kiểm tra thông tin khách hàng
                if (empty($user->customer->phone) || empty($user->customer->address)) {
                    // Nếu thiếu thông tin, chuyển đến trang khai báo thông tin
                    return redirect()->route('complete-profile');
                }
                
                // Nếu có đầy đủ thông tin, chuyển đến trang chủ
                return redirect('/');
            }

            // Chuyển hướng đến trang admin hoặc trang chủ
            $urlRedirect = $user->is_admin ? "/admin" : "/";
            return redirect($urlRedirect);
        }

        // Trả về lỗi nếu đăng nhập thất bại
        return back()->with('msg', 'Email hoặc mật khẩu không chính xác');
    }

    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập tên đăng nhập',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ]);

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Đăng nhập người dùng mới sau khi đăng ký
        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('home')->with('message', 'Đăng ký thành công');
    }
    public function logout(Request $request)
{
    Auth::logout(); // Đăng xuất người dùng

    // Xóa dữ liệu session của người dùng để phiên đăng nhập bị xóa hoàn toàn
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Chuyển hướng về trang đăng nhập
    return redirect()->route('login')->with('message', 'Đã đăng xuất thành công');
}

}
