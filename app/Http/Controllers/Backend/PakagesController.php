<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PakagesController extends Controller
{

    public function orderDetails($order_id)
    {
        // Lấy thông tin đơn hàng
        $order = Order::with('packages')->findOrFail($order_id);
        $pakages = $order->packages;
        return view('Backend.Customer.Packages', compact('order', 'pakages'));
    }
    
}

