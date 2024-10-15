<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\driver;
use App\Models\vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class oder extends Controller
{
    public function checkProvince(Request $request)
    {
        $address = $request->input('from');

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
                    return redirect()->back()->with('message', 'Địa điểm giao hàng hiện tại không còn xe');
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
                return response()->json([
                    'message' => "Không tìm thấy thông tin biển số cho tỉnh $province",
                ]);
            }
        }

        return response()->json([
            'message' => 'Không xác định được tên tỉnh từ địa chỉ',
        ]);
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
