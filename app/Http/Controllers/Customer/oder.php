<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\driver;
use App\Models\vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class oder extends Controller
{
    public function validate_infor($request){
        $addressFrom = $request->input('from');
        $addressTo = $request->input('to');
        $packaging = $request->input('packaging');
        $quantity = $request->input('quantity');
        $weight = $request->input('weight');
        $weightUnit = $request->input('weight_unit');
        $length = $request->input('length');
        $width = $request->input('width');
        $height = $request->input('height');
        $dimensionUnit = $request->input('dimension_unit');
        $shippingDate = $request->input('shipping_date');
        $recipientName = $request->input('recipien_name');
        $recipientPhoneNumber = $request->input('recipient_phone_number');
        // dd($recipientName);
        if (is_null($addressFrom)) {
            return redirect()->back()->with('thongbaoloidiachi', 'Bạn hãy điền đầy đủ địa chỉ gửi!');
        }
        if (is_null($addressTo)) {
            return redirect()->back()->with('thongbaoloidiachi', 'Bạn hãy điền đầy đủ địa chỉ nhận!');
        }
        if (empty($packaging)) {
            return redirect()->back()->with('thongbaobao_bi', 'Bạn hãy chọn bao bì cho gói hàng!');
        }

        if (empty($quantity) || $quantity <= 0) {
            return redirect()->back()->with('thongbaosoluong', 'Bạn hãy nhập số lượng gói hàng hợp lệ!');
        }

        if (empty($weight) || $weight <= 0) {
            return redirect()->back()->with('thongbaotrongluong', 'Bạn hãy nhập trọng lượng hợp lệ cho gói hàng!');
        }

        if (empty($length) || $length <= 0 || empty($width) || $width <= 0 || empty($height) || $height <= 0) {
            return redirect()->back()->with('thongbaokichthuoc', 'Bạn hãy nhập kích thước hợp lệ cho gói hàng!');
        }

        if (empty($shippingDate)) {
            return redirect()->back()->with('thongbaongay_gui', 'Bạn hãy chọn ngày gửi hàng!');
        }

        if (empty($recipientName)) {
            return redirect()->back()->with('thongbaoten', 'Bạn hãy nhập tên người nhận!');
        }
        if (empty($recipientPhoneNumber) || !is_numeric($recipientPhoneNumber)) {
            return redirect()->back()->with('thongbaosdt', 'Bạn hãy nhập số điện thoại hợp lệ cho người nhận!');
        }
        }
    public function checkProvince(Request $request)
    {
        $validationResult = $this->validate_infor($request);
        if ($validationResult !== true) {
            return $validationResult; // Trả về redirect nếu có lỗi
        }
        $address = $request->input('from');
        if(is_null($address)){
            return redirect()->back()->with('thongbaoloidiachi', 'Bạn hãy điền đầy đủ địa chỉ !');
        }
        $province = $this->getProvince($address);
        // dd($province);
        if ($province) {
            $provinceString = implode(', ', $province);
            $licenseCodes = config("province_license.$provinceString");

            if ($licenseCodes) {
                // $vehicle = vehicle::where([['license_plate', 'LIKE', '89' . '%'],['status','=','Có sẵn']])
                //         ->get()->first();

                $vehicle = DB::table('vehicles')
                    ->join('drivers', 'vehicles.vehicle_id', '=', 'drivers.vehicle_id')
                    ->where('drivers.status', 'Có sẵn')
                    ->where(function ($query) use ($licenseCodes) {
                        // Gộp tất cả các điều kiện LIKE trong một closure
                        foreach ($licenseCodes as $value) {

                            $query->orWhere('vehicles.license_plate', 'like', $value . '%');
                        }
                    });
                $driver_vehicle = $vehicle->select('vehicles.*', 'drivers.*')
                    ->first();

                if (is_null($driver_vehicle)) {
                    // Nếu không có dữ liệu, hiển thị thông báo
                    // return response()->json([
                    //     'message' => 'Địa điểm giao hàng hiện tại không còn xe',
                    // ]);
                    return redirect()->back()->with('thongbaohetxe', 'Địa điểm giao hàng hiện tại không còn xe');
                }

                $data = $request->all();

                $package = new \App\Models\Package();

                $package->customer_id = 1;
                $package->description = 'Gói hàng tiêu chuẩn';
                $package->weight = $data['weight'];
                $package->size = $data['length'] . 'x' . $data['width'] . 'x' . $data['height'];
                $package->value = $data['tongtien'];
                $package->status = 'Đang chờ xử lý';
                $package->save();

                // Tạo một đơn hàng mới
                $order = new \App\Models\Order();
                $order->package_id = $package->package_id;
                $order->sender_address = $data['from'];
                $order->receiver_name = $data['recipien_name'];
                $order->receiver_phone = $data['recipient_phone_number'];
                $order->receiver_address = $data['to'];
                $order->order_date = now();
                $order->delivery_date = now()->addDays(3);

                $order->vehicle_id = $driver_vehicle->vehicle_id;
                $order->driver_id = $driver_vehicle->driver_id ;
                $order->shipping_fee = $data['tongtien'];
                $order->status = 'Đã đặt';
                $order->save();

                return dd("Lưu Thành Công :)");
            } else {
                // return response()->json([
                //     'message' => "Không tìm thấy thông tin biển số cho tỉnh $province",
                // ]);
                return redirect()->back()->with('thongbaoloidiachi', 'Không tìm thấy thông tin biển số cho tỉnh $province.');
            }
        }

        return redirect()->back()->with('thongbaoloidiachi', 'Phạm vi địa chỉ ngoại quốc !');
    }
    private function getProvince($address)
    {
        if (preg_match('/Hà Nội,\s*Việt Nam$/i', $address)) {
            return [
                'name' => 'Hà Nội',
            ];
        }
        if (preg_match('/Thừa Thiên Huế,\s*Việt Nam$/i', $address)) {
            return [
                'name' => 'Huế',
            ];
        }
        if (preg_match('/(?:Thành phố|Tỉnh)\s*([A-Za-zÀ-ỹ\s]+)/i', $address, $matches)) {
            $name = trim($matches[1] ?? '');

            $knownCities = ['Hà Nội', 'Thành phố Hồ Chí Minh', 'Đà Nẵng', 'Cần Thơ', 'Hải Phòng'];

            if (in_array($name, $knownCities)) {
                if (stripos($address, 'Thành phố Hồ Chí Minh') !== false) {
                    return [
                        'name' => 'Hồ Chí Minh',
                    ];
                }
                return [
                    'name' => $name,
                ];
            }
            return [
                'name' => $name,
            ];
        }
        return null;
    }
}
