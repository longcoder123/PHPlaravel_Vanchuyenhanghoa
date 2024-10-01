<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function layoutHome(){
        return view("layoutMain.userPage.home");
    }
    public function layoutInfor(){
        return view("layoutMain.userPage.customerInformation");
    }
    public function calculate(Request $request)
    {
        // Lấy dữ liệu từ form
        $data = $request->all();

        // Xử lý dữ liệu hoặc tính toán chi phí vận chuyển dựa trên dữ liệu đã nhập
        $from = $data['from'];
        $to = $data['to'];
        $packaging = $data['packaging'];
        $insurance = isset($data['insurance']) ? true : false;
        $quantity = $data['quantity'];
        $weight = $data['weight'];
        $weightUnit = $data['weight_unit'];
        $length = $data['length'];
        $width = $data['width'];
        $height = $data['height'];
        $dimensionUnit = $data['dimension_unit'];
        $shippingDate = $data['shipping_date'];

        // Bạn có thể thêm logic để tính toán phí vận chuyển tại đây
        // Ví dụ: Tính phí cơ bản dựa trên loại bao bì và khối lượng
        $baseCost = 50000; // Phí cơ bản

        if ($weightUnit === 'kg') {
            $weightInKg = $weight;
        } else {
            // Chuyển đổi lb sang kg
            $weightInKg = $weight * 0.453592;
        }

        // Ví dụ tính phí dựa trên khối lượng
        $cost = $baseCost + ($weightInKg * 10000); // Giả sử 10,000 VND cho mỗi kg

        // Trả về kết quả tính toán
        return view('layoutMain.userPage.result', ['cost' => $cost]);
       
        
    }
}
