<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User; 

class CustomerController extends Controller
{
    public function khachang(){
        $users = User::with('customer.orders')->get();  // Lấy thông tin người dùng và thông tin đơn hàng liên quan
        $khachang = Customer::has('orders')->get();  // Chỉ lấy khách hàng đã có đơn hàng
        return view("Backend.Customer.khachang", compact('users', 'khachang')); 
    }
}
