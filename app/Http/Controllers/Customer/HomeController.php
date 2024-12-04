<?php

namespace App\Http\Controllers\customer;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\vehicle;

class HomeController extends Controller
{
    protected $cost;
    public function layoutHome(){

        return view("layoutMain.userPage.home");
    }
    public function layoutInfor(){
         return view("layoutMain.userPage.customerInformation");
        //return view("layoutMain.userPage.detailPackage");
    }

    public function calculate(Request $request)
    {
        // $this->validate_infor($request);
        // $hanhdong=$this->checkProvince($request);
        // if($hanhdong){
        $distance = $request->input('quangduong');
        $data = $request->all();
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
            $this->cost = ($baseCost + $additionalCost+$distanceCost)*$quantity;
        return response()->json([
            'success' => true,
            'cost' => $this->cost,
            'costFormatted' => number_format($this->cost, 0, ',', '.')
        ]);
    // }
    }






//     public function store(Request $request)
//     {


//     // Lấy dữ liệu đầu vào từ form
//     $data = $request->all();

//     // Tạo một đối tượng gói hàng mới
//     $package = new \App\Models\Package();
//     //$package->customer_id = auth()->user()->customer_id; // Giả sử user đã đăng nhập và có customer_id
//     $package->customer_id = 1;
//     $package->description = 'Gói hàng tiêu chuẩn';
//     $package->weight = $data['weight'];
//     $package->size = $data['length'] . 'x' . $data['width'] . 'x' . $data['height'];
//     $package->value = $this->cost; // Ví dụ, gán giá trị mặc định
//     $package->status = 'Đang chờ xử lý';
//     $package->save();

//     // Tạo một đơn hàng mới
//     $order = new \App\Models\Order();
//     $order->package_id = $package->package_id;
//     $order->sender_address = $data['from'];
//     // $order->receiver_name = $data['receiver_name'];
//     // $order->receiver_phone = $data['receiver_phone'];
//      $order->receiver_name = "Tên Người Nhận";
//      $order->receiver_phone =123456678;
//     $order->receiver_address = $data['to'];
//     $order->order_date = now();
//     $order->delivery_date = now()->addDays(3);
//     $order->vehicle_id = 1;
//     $order->driver_id = 1;
//     $order->shipping_fee =$this->cost;
//     $order->status = 'Đã đặt';
//     $order->save();

//     return redirect()->route('order.success')->with('success', 'Đơn hàng của bạn đã được lưu thành công!');
// }








// public function checkProvince($request)
//     {
//         // Lấy chuỗi địa chỉ từ request
//         $address = $request;

//         // Tách tên tỉnh từ địa chỉ
//         $province = $this->getProvince($address);

//         if ($province) {
//             // Lấy danh sách biển số từ file config
//             $licenseCodes = config("province_license.$province");

//             if ($licenseCodes) {
//                 return

//                 response()->json([

//                     'province' => $province,
//                     'license_codes' => $licenseCodes,
//                 ]);
//             } else {
//                 return response()->json([
//                     'message' => "Không tìm thấy thông tin biển số cho tỉnh $province",
//                 ]);
//             }
//         }

//         return response()->json([
//             'message' => 'Không xác định được tên tỉnh từ địa chỉ',
//         ]);
//     }


//     private function getProvince($address)
//     {
//         // Ví dụ dùng regex để tìm tên tỉnh từ chuỗi input
//         if (preg_match('/Tỉnh\s+([A-Za-zÀ-ỹ\s]+)/', $address, $matches)) {
//             return trim($matches[1]);
//         }
//         return null;
//     }
}
