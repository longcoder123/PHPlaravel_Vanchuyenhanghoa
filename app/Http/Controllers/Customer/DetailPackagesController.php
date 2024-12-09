<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DetailPackagesController extends Controller
{
    public function ViewDetailOfUser(){
        // $orders = Order::with('packages')->get();
        $orders = Order::join('packages', 'orders.package_id', '=', 'packages.package_id')
    ->select(
        'orders.order_id',
        'orders.status as order_status',
        'packages.status as package_status',
        'orders.receiver_name',
        'orders.sender_address',
        'orders.receiver_address',
        'orders.delivery_date',
        'orders.shipping_fee',
        'orders.order_date as order_date'
    )
    ->where('packages.customer_id', '=', Auth::id())
    ->get();

    foreach ($orders as $order) {
        // Tính toán thời gian và phần trăm cho mỗi đơn hàng
        $orderDate = Carbon::parse($order->order_date);
        $deliveryDate = Carbon::parse($order->delivery_date);
        $now = Carbon::now();

        // Tổng thời gian từ `order_date` đến `delivery_date`
        $totalDuration = $deliveryDate->diffInSeconds($orderDate);

        // Thời gian từ `order_date` đến hiện tại
        $currentDuration = $now->diffInSeconds($orderDate);

        // Tính phần trăm
        $percentage = ($currentDuration / $totalDuration) * 100;

        // Đảm bảo phần trăm không vượt quá 100
        $percentage = $percentage > 100 ? 100 : $percentage;

        // Thêm phần trăm vào từng đơn hàng
        $order->percentage = round($percentage, 2); // Làm tròn đến 2 chữ số
    }

        return view("layoutMain.userPage.detailPackage" , compact("orders"));
   }
}
