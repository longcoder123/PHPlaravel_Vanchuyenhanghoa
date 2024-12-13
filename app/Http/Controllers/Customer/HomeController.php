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
        // session(['hi' => 'hahaha']);
        // dd(session('hi'));
        // Session::put('order_params', $params);
        session()->save(); // Đảm bảo session được lưu trước khi chuyển hướng

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



}
