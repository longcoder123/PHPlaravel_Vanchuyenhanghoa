<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\driver;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DetailPackagesController extends Controller
{
    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Đã hủy';
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
    }

    public function ViewDetailOfUser()
    {
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
            // ->where('orders.status','=','Đã đặt')
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

            // Kiểm tra nếu phần trăm đã đạt 100% và cập nhật trạng thái
            if ($order->percentage == 100) {

            }
        }
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

            // Kiểm tra nếu phần trăm đã đạt 100% và trạng thái đơn hàng là "Đang vận chuyển"
            if ($order->percentage == 100 && $order->status == 'Đang vận chuyển') {
                // Cập nhật trạng thái đơn hàng thành "Đã giao"
                $order->status = 'Đã giao';
                $order->save(); // Lưu thay đổi trạng thái của đơn hàng

                $driver = Driver::find($order->driver_id);
                if ($driver) {
                    $driver->status = 'Sẵn sàng';
                    $driver->save();
                }
            }
        }
        return view("layoutMain.userPage.detailPackage", compact("orders"));
    }
}
