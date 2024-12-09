<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;  // Thêm dòng này để import model User

class CustomerController extends Controller
{
    public function khachang(){
        $users = User::with('customer')->get();  // Lấy thông tin người dùng và thông tin khách hàng
        $khachang= Customer::all();
        return view("Backend.Customer.khachang", compact('users','khachang')); 
    }
}
