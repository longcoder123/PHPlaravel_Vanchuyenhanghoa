<?php

namespace App\Http\Controllers\Customer\InfroUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class InforUserController extends Controller
{
    public function index()
    {
        // Lấy thông tin customer liên kết với user đã đăng nhập
        $customer = Auth::user()->customer;

        return view('layoutmain.info.infouser', compact('customer'));
    }

    public function update(Request $request)
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

        // Lấy thông tin customer liên kết với user
        $customer = Auth::user()->customer;

        // Cập nhật thông tin
        $customer->name = $request->tennv;
        $customer->phone = $request->sodienthoai;
        $customer->address = $request->diachi;
        $customer->dob = $request->ngaysinh;
        $customer->identity_number = $request->cccd;
        $customer->gender = $request->trangthai;
        $customer->save();

        return redirect()->route('infouser')->with('success', 'Cập nhật thông tin thành công');
    }
}
