<?php

namespace App\Http\Controllers\customer;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function layoutHome(){

        return view("layoutMain.userPage.home");
    }
    public function layoutInfor(){
         return view("layoutMain.userPage.customerInformation");
        //return view("layoutMain.userPage.detailPackage");
    }
    public function calculate(Request $request)
    {
        $distance = $request->input('quangduong');

        $data = $request->all();
        // dd($request);

        $quantity =$data['quantity'];
        $length = $data['length'];
        $width = $data['width'];
        $height = $data['height'];
        $dimensionUnit = $data['dimension_unit'];
        $weight = $data['weight'];
        $weightUnit = $data['weight_unit'];

        // Chuyển đổi kích thước sang cm nếu đơn vị là inch
        if ($dimensionUnit === 'in') {
            $length = $length * 2.54;
            $width = $width * 2.54;
            $height = $height * 2.54;
        }

        // Tính thể tích
        $volume = $length * $width * $height;

        // Xác định loại kích thước
        if ($volume < 100) {
            $sizeCategory = 'S';
        } elseif ($volume < 500) {
            $sizeCategory = 'M';
        } else {
            $sizeCategory = 'L';
        }

        // Chuyển đổi trọng lượng sang kg nếu đơn vị là lb
        if ($weightUnit === 'lb') {
            $weight = $weight * 0.453592;
        }

        // Xác định loại trọng lượng
        if ($weight <= 2) {
            $weightCategory = 'S';
        } elseif ($weight <= 5) {
            $weightCategory = 'M';
        } else {
            $weightCategory = 'L';
        }

        // Kiểm tra sự phù hợp giữa kích thước và trọng lượng
        if ($sizeCategory !== $weightCategory) {
            return response()->json([
                'success' => false,
                'error' => 'Kích thước và trọng lượng không phù hợp.'
            ]);
        }
        // Nếu phù hợp, tính toán chi phí vận chuyển
            $distanceCost = $distance * 5000;
            $baseCost = 50000; // Phí cơ bản
            $additionalCost = ($weight * 10000); // Giả sử 10,000 VND cho mỗi kg
            $cost = ($baseCost + $additionalCost+$distanceCost)*$quantity;

        return response()->json([
            'success' => true,
            'cost' => $cost,
            'costFormatted' => number_format($cost, 0, ',', '.')
        ]);

    }






    public function store(Request $request)
{
    // Lấy dữ liệu đầu vào từ form
    $data = $request->all();

    // Tạo một đối tượng gói hàng mới
    $package = new \App\Models\Package();
    //$package->customer_id = auth()->user()->customer_id; // Giả sử user đã đăng nhập và có customer_id
    $package->customer_id = 1;
    $package->description = 'Gói hàng tiêu chuẩn';
    $package->weight = $data['weight'];
    $package->size = $data['length'] . 'x' . $data['width'] . 'x' . $data['height'];
    $package->value = 100000; // Ví dụ, gán giá trị mặc định
    $package->status = 'Đang chờ xử lý';
    $package->save();

    // Tạo một đơn hàng mới
    $order = new \App\Models\Order();
    $order->package_id = $package->package_id;  // Gán gói hàng vừa tạo
    $order->sender_address = $data['from'];
    $order->receiver_name = $data['receiver_name'];
    $order->receiver_phone = $data['receiver_phone'];
    $order->receiver_address = $data['to'];
    $order->order_date = now();
    $order->delivery_date = now()->addDays(3); // Ví dụ thêm 3 ngày cho ngày giao hàng
    $order->vehicle_id = 1;  // Gán giá trị mặc định
    $order->driver_id = 1;   // Gán giá trị mặc định
    $order->shipping_fee = $data['cost'];
    $order->status = 'Đã đặt';
    $order->save();

    return redirect()->route('order.success')->with('success', 'Đơn hàng của bạn đã được lưu thành công!');
}

}
