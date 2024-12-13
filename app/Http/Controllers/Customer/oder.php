<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\driver;
use App\Models\vehicle;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class oder extends Controller
{
    public function viewResult(Request $request)
    {

        // Lấy các tham số từ URL
        $vnp_Amount = $request->query('vnp_Amount');
        $vnp_BankCode = $request->query('vnp_BankCode');
        $vnp_BankTranNo = $request->query('vnp_BankTranNo');
        $vnp_OrderInfo = $request->query('vnp_OrderInfo');
        $vnp_PayDate = $request->query('vnp_PayDate');
        $vnp_ResponseCode = $request->query('vnp_ResponseCode');
        $vnp_TmnCode = $request->query('vnp_TmnCode');
        $vnp_TransactionNo = $request->query('vnp_TransactionNo');
        $vnp_TransactionStatus = $request->query('vnp_TransactionStatus');
        $vnp_TxnRef = $request->query('vnp_TxnRef');
        $inputData = [
            'vnp_Amount' => $vnp_Amount,
            'vnp_BankCode' => $vnp_BankCode,
            'vnp_BankTranNo' => $vnp_BankTranNo,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_PayDate' => $vnp_PayDate,
            'vnp_ResponseCode' => $vnp_ResponseCode,
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_TransactionNo' => $vnp_TransactionNo,
            'vnp_TransactionStatus' => $vnp_TransactionStatus,
            'vnp_TxnRef' => $vnp_TxnRef
        ];

        // Sắp xếp tham số theo thứ tự
        ksort($inputData);
        $hashData = http_build_query($inputData);
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $hashDataReceived = $_GET; // hoặc từ POST, tùy theo cách bạn nhận dữ liệu

        // Tạo lại chuỗi dữ liệu hash từ các tham số đã nhận (trừ vnp_SecureHash)
        unset($hashDataReceived['vnp_SecureHash']);  // Loại bỏ vnp_SecureHash khỏi danh sách tham số
        ksort($hashDataReceived);  // Sắp xếp các tham số theo thứ tự từ điển
        $hashData = http_build_query($hashDataReceived);  // Tạo lại chuỗi dữ liệu để hash

        // Tạo lại hash với khóa bảo mật
        $secureHashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN"; // Thay bằng SECRET_KEY của bạn
        $secureHashData = $hashData . '&vnp_SecureHashSecret=' . $secureHashSecret;
        $secureHashCalculated = hash_hmac('sha512', $hashData, $secureHashSecret);  // Tạo lại mã hash


        // dd($vnp_SecureHash,$secureHashCalculated);
        // Kiểm tra xem hash có khớp không
        if ($secureHashCalculated == $vnp_SecureHash) {
            if ($vnp_ResponseCode == '00') {



                $params = session('order_params');

                if ($params) {
                    // Lấy các giá trị từ session
                    $userId = $params['user_id'];
                    $weight = $params['weight'];
                    $dimensions = $params['dimensions'];
                    $totalPrice = $params['total_price'];
                    $fromLocation = $params['from_location'];
                    $toLocation = $params['to_location'];
                    $recipientName = $params['recipient_name'];
                    $recipientPhone = $params['recipient_phone'];
                    $createdAt = $params['created_at'];
                    $deliveryDate = $params['delivery_date'];
                    $vehicleId = $params['vehicle_id'];
                    $driverId = $params['driver_id'];
                    $imageNames = $params['images'];


                    $package = new \App\Models\Package();
                    $package->customer_id = Auth::id();
                    $package->description = 'Gói hàng tiêu chuẩn';
                    $package->weight = $weight;
                    $package->size = $dimensions;
                    $package->value = $totalPrice;
                    $package->status = 'Đang chờ xử lý';
                    $package->product_image = $imageNames;
                    $package->save();
                    $order = new \App\Models\Order();
                    $order->package_id = $package->package_id;
                    $order->sender_address = $fromLocation;
                    $order->receiver_name = $recipientName;
                    $order->receiver_phone = $recipientPhone;
                    $order->receiver_address = $toLocation;
                    $order->order_date = now();
                    $order->delivery_date = now()->addDays(3);
                    $order->vehicle_id = $vehicleId;
                    $order->driver_id = $driverId;
                    $order->shipping_fee = $totalPrice;
                    $order->status = 'Đã đặt';
                    $order->save();

                    $driver = Driver::where('driver_id', $driverId)->first();
                    $driver->status = 'Đang giao hàng';
                    $driver->save();

                    $payment_id = intval(str_replace('.', '', uniqid(time(), true)));
                    $payment = new Payment();
                    $payment->payment_id = $payment_id;
                    $payment->order_id = $order->order_id; // Đảm bảo orderId là giá trị bạn muốn
                    $payment->payment_method = 'Chuyển khoản'; // Ví dụ phương thức thanh toán
                    $payment->amount = $totalPrice; // Số tiền thanh toán
                    $payment->status = 'Đã thanh toán'; // Trạng thái thanh toán


                    // Lưu đối tượng Payment vào cơ sở dữ liệu
                    $payment->save();
                } else {
                    return redirect()->route('error.page')->with('error', 'Không có thông tin thanh toán');
                }
            } else {
                // Giao dịch thất bại
                // Xử lý giao dịch thất bại nếu cần thiết
            }
        } else {
            // Hash không hợp lệ
            // Xử lý lỗi nếu cần thiết, log lỗi hoặc thông báo
        }

        // Trả về kết quả cho người dùng
        return view('layoutMain.userPage.result', [
            'vnp_Amount' => $vnp_Amount,
            'vnp_ResponseCode' => $vnp_ResponseCode
        ]);
    }
    public function validate_infor($request, $error)
    {
        $errors = [];

        $address = $request->input('from');
        $province = $this->getProvince($address);
        if ($error === 1) {
            $errors['thongbaohetxe'] = 'Địa điểm giao hàng hiện tại không còn xe !';
        }
        if ($error === 2) {
            $errors['thongbaohetxe'] = 'Địa điểm giao hàng hiện tại không còn xe !';
        }
        if ($province === Null) {
            $errors['thongbaongoaiphamvi'] = 'Phạm vi địa chỉ ngoại quốc !';
        }
        if (is_null($request->input('from'))) {
            $errors['thongbaoloidiachi'] = 'Bạn hãy điền đầy đủ địa chỉ gửi!';
        }
        if (is_null($request->input('to'))) {
            $errors['thongbaoloidiachi'] = 'Bạn hãy điền đầy đủ địa chỉ nhận!';
        }
        if (empty($request->input('quantity')) || $request->input('quantity') <= 0) {
            $errors['thongbaosoluong'] = 'Bạn hãy nhập số lượng gói hàng hợp lệ!';
        }
        if (empty($request->input('weight')) || $request->input('weight') <= 0) {
            $errors['thongbaotrongluong'] = 'Bạn hãy nhập trọng lượng hợp lệ cho gói hàng!';
        }
        if (
            empty($request->input('length')) || $request->input('length') <= 0 ||
            empty($request->input('width')) || $request->input('width') <= 0 ||
            empty($request->input('height')) || $request->input('height') <= 0
        ) {
            $errors['thongbaokichthuoc'] = 'Bạn hãy nhập kích thước hợp lệ cho gói hàng!';
        }
        if (empty($request->input('shipping_date'))) {
            $errors['thongbaongay_gui'] = 'Bạn hãy chọn ngày gửi hàng!';
        }
        if (empty($request->input('recipien_name'))) {
            $errors['thongbaoten'] = 'Bạn hãy nhập tên người nhận!';
        }
        if (empty($request->input('recipient_phone_number')) || !is_numeric($request->input('recipient_phone_number'))) {
            $errors['thongbaosdt'] = 'Bạn hãy nhập số điện thoại hợp lệ cho người nhận!';
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }
        return true;
    }

    public function checkProvince(Request $request)
    {




        $validationResult = $this->validate_infor($request, 0);

        if ($validationResult !== true) {
            return $validationResult;
        }

        // if ($province) {
        $address = $request->input('from');
        $province = $this->getProvince($address);
        $provinceString = implode(', ', $province);
        $licenseCodes = config("province_license.$provinceString");

        if ($licenseCodes) {

            $vehicle = DB::table('vehicles')
                ->join('drivers', 'vehicles.vehicle_id', '=', 'drivers.vehicle_id')
                ->where('drivers.status', 'Sẵn sàng')
                ->where(function ($query) use ($licenseCodes) {
                    foreach ($licenseCodes as $value) {

                        $query->orWhere('vehicles.license_plate', 'like', $value . '%');
                    }
                });
            $driver_vehicle = $vehicle->select('vehicles.*', 'drivers.*')

                ->first();

            if (is_null($driver_vehicle)) {
                $validationResult = $this->validate_infor($request, 1);
                if ($validationResult !== true) {
                    return $validationResult;
                }
            }
            $imageNames = [];  // Mảng lưu trữ các đường dẫn ảnh

            if ($request->hasFile('package_image')) {
                if (is_array($request->file('package_image'))) {
                    // Xử lý nhiều ảnh
                    foreach ($request->file('package_image') as $image) {
                        if ($image->isValid()) {
                            // Đặt đường dẫn thư mục lưu ảnh
                            $destinationPath = public_path('Uploads/Admin');
                            // Đặt tên ảnh, có thể là thời gian và tên gốc của ảnh
                            $imageName = time() . '_' . $image->getClientOriginalName();
                            // Dùng move() để di chuyển ảnh vào thư mục đích
                            $imagePath = $image->move($destinationPath, $imageName);
                            // Thêm đường dẫn vào mảng
                            $imageNames[] = $imagePath;  // Lưu đường dẫn ảnh vào mảng
                        } else {
                            return redirect()->back()->with('thongbaoanh', 'Có lỗi khi tải ảnh lên!');
                        }
                    }
                } else {
                    // Xử lý nếu chỉ có một ảnh
                    $image = $request->file('package_image');
                    if ($image->isValid()) {
                        // Đặt tên ảnh và đường dẫn lưu trữ
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $imagePath = $image->move(public_path('Uploads/Admin'), $imageName);
                        // Thêm đường dẫn vào mảng
                        $imageNames[] = $imagePath;
                    } else {
                        return redirect()->back()->with('thongbaoanh', 'Có lỗi khi tải ảnh lên!');
                    }
                }

                // Kiểm tra nếu có ảnh
                if (!empty($imageNames)) {
                    // Lấy tên ảnh thay vì đường dẫn đầy đủ
                    $imageNames = array_map(function ($imagePath) {
                        return basename($imagePath); // Lấy tên ảnh thay vì đường dẫn đầy đủ
                    }, $imageNames);

                    // Chuyển mảng $imageNames thành chuỗi, sử dụng dấu phẩy để phân cách
                    $imagePathsString = implode(',', $imageNames);

                } else {
                    return redirect()->back()->with('thongbaoanh', 'Không có ảnh nào được tải lên!');
                }
            } else {
                return redirect()->back()->with('thongbaoanh', 'Không có ảnh nào được tải lên!');
            }

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $data = $request->all();
            $tongtien = str_replace('.', '', $data['tongtien']);

            if (isset($_POST['redirect'])) {
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://127.0.0.1:8000/thanks";
                $params = [
                    'user_id' => Auth::id(),
                    'weight' => $data['weight'],
                    'dimensions' => $data['length'] . 'x' . $data['width'] . 'x' . $data['height'],
                    'total_price' => $tongtien,
                    'images' => implode(',', $imageNames),
                    'from_location' => $data['from'],
                    'to_location' => $data['to'],
                    'recipient_name' => $data['recipien_name'],
                    'recipient_phone' => $data['recipient_phone_number'],
                    'created_at' => now(),
                    'delivery_date' => now()->addDays(3),
                    'vehicle_id' => $driver_vehicle->vehicle_id,
                    'driver_id' => $driver_vehicle->driver_id,
                ];

                session(['order_params' => $params]);


                session()->save(); // Đảm bảo session được lưu trước khi chuyển hướng
                $vnp_TmnCode = "CGXZLS0Z"; //Mã website tại VNPAY
                $vnp_HashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN"; //Chuỗi bí mật

                $vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã nàysang VNPAY
                $vnp_OrderInfo = "Noi dung thanh toan";
                $vnp_OrderType = "billpayment";
                $vnp_Amount = $tongtien * 100;
                $vnp_Locale = "vn";
                $vnp_BankCode = "NCB";
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                );
                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }

                $returnData = array(
                    'code' => '00',
                    'message' => 'success',
                    'data' => $vnp_Url
                );
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {

                    $tongtien = str_replace('.', '', $data['tongtien']);
                    $package = new \App\Models\Package();
                    $package->customer_id = Auth::id();
                    $package->description = 'Gói hàng tiêu chuẩn';
                    $package->weight = $data['weight'];
                    $package->size = $data['length'] . 'x' . $data['width'] . 'x' . $data['height'];
                    $package->value = $tongtien;
                    $package->status = 'Đang chờ xử lý';
                    //    $package->product_image = implode(',', $imageNames);
                    $package->save();
                    $order = new \App\Models\Order();
                    $order->package_id = $package->package_id;
                    $order->sender_address = $data['from'];
                    $order->receiver_name = $data['recipien_name'];
                    $order->receiver_phone = $data['recipient_phone_number'];
                    $order->receiver_address = $data['to'];
                    $order->order_date = now();
                    $order->delivery_date = now()->addDays(3);
                    $order->vehicle_id = $driver_vehicle->vehicle_id;
                    $order->driver_id = $driver_vehicle->driver_id;
                    $order->shipping_fee = $tongtien;
                    $order->status = 'Đã đặt';
                    $order->save();
                    return ("Lưu Thành Công :)");
                    echo json_encode($returnData);
                }
            }
        } else {
            $validationResult = $this->validate_infor($request, 2);
            if ($validationResult !== true) {
                return $validationResult;
            }
        }
        // }
        // return redirect()->back()->with('thongbaoloidiachi', 'Phạm vi địa chỉ ngoại quốc !');
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
        if (preg_match('/(?:Thành phố|Tỉnh|Province)\s*([A-Za-zÀ-ỹ\s]+)/i', $address, $matches)) {
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
        if (preg_match('/(?:District|Huyện|Quận),?\s*([A-Za-zÀ-ỹ\s]+)\s*Province/i', $address, $matches)) {
            $name = trim($matches[1] ?? '');
            return [
                'name' => $name,
            ];
        }
        return null;
    }
}
