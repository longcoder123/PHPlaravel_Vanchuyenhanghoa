<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class InforCustomerController extends Controller
{
    public function showProfileForm()
    {
        return view('layoutMain.Info.complete-profile');
    }

    public function storeProfile(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'tennv' => 'required|string|max:255',
            'sodienthoai' => 'required|string|max:20',
            'diachi' => 'required|string|max:255',
            'ngaysinh' => 'nullable|date',
            'cccd' => 'nullable|string|max:20',
            'trangthai' => 'nullable|in:Nam,Nữ,Khác',
        ]);
    
        // Lấy thông tin user đã đăng nhập
        $user = Auth::user();
    
        // Kiểm tra xem người dùng đã có thông tin trong bảng customers chưa
        $customer = $user->customer;
    
        // Nếu chưa có thông tin, tạo mới
        if (!$customer) {
            $customer = new Customer();
            $customer->user_id = $user->id; // Liên kết với user
        }
    
        // Cập nhật thông tin vào bảng customers
        $customer->name = $request->tennv;
        $customer->phone = $request->sodienthoai;
        $customer->address = $request->diachi;
        $customer->dob = $request->ngaysinh;
        $customer->identity_number = $request->cccd;
        $customer->gender = $request->trangthai;
        $customer->save(); // Lưu vào cơ sở dữ liệu
    
        // Sau khi lưu, chuyển hướng về trang chủ
        return redirect()->route('home')->with('message', 'Thông tin của bạn đã được cập nhật');
    }
}    

