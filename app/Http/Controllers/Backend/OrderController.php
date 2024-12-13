<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        $orders = Order::where('customer_id', $customer_id)->get();

        return view('Backend.Customer.Order', compact('orders', 'customer'));
    }

    // Phương thức duyệt đơn hàng
    public function approveOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->status = 'Đang vận chuyển';
        $order->save();
        return redirect()->route('backend.orders', ['customer_id' => $order->customer_id])
                         ->with('success', 'Đơn hàng đã được duyệt.');
    }

    // Phương thức từ chối đơn hàng
    public function rejectOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
        
        // Cập nhật trạng thái đơn hàng thành "Đã hủy"
        $order->status = 'Đã hủy';
        $order->save();
        return redirect()->route('backend.orders', ['customer_id' => $order->customer_id])
                         ->with('error', 'Đơn hàng đã bị từ chối.');
    }
    
    // Phương thức xóa đơn hàng
    public function delete($order_id){
        $orderdelete = Order::find($order_id);
        $orderdelete->delete();
        return redirect()->back()->with('orderdelete','Xóa đơn hàng thành công');

    }
}
