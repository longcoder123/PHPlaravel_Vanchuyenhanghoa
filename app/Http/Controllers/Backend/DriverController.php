<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\driver;

class DriverController extends Controller
{
   public function qlnv(){
    $driver = driver::with('vehicle')->get();
    return view("Backend.quanlinv" , compact("driver"));
   }

   // Thêm nhân viên
   public function addnv(){
      return view("Backend.Addnv");
  }
  
  public function store(Request $request)
  {
      // Kiểm tra tồn tại xe
      $vehicleExist = \App\Models\Vehicle::where('vehicle_id', $request->input('maxe'))->exists();
      if (!$vehicleExist) {
          return redirect()->back()->with('error', 'Xe không tồn tại. Vui lòng kiểm tra lại.')->withInput();
      }
  
      // Kiểm tra trùng ID xe
      $existingDriver = driver::where('vehicle_id', $request->input('maxe'))->exists();
      if ($existingDriver) {
          return redirect()->back()->with('error', 'Xe đã có tài xế. Vui lòng chọn lại.')->withInput();
      }
      
  
      // Kiểm tra trùng căn cước công dân (license_number)
      $existingLicense = driver::where('license_number', $request->input('cccd'))->exists();
      if ($existingLicense) {
          return redirect()->back()->with('error', 'Mã căn cước công dân bị trùng. Vui lòng kiểm tra lại.')->withInput();
      }
       // Kiểm tra trùng email
       $existingEmail = driver::where('email', $request->input('email'))->exists();
       if ($existingEmail) {
           return redirect()->back()->with('error', 'Email đã tồn tại. Vui lòng chọn lại.')->withInput();
       }
  
      // Kiểm tra trùng số điện thoại (phone)
      $existingPhone = driver::where('phone', $request->input('sodienthoai'))->exists();
      if ($existingPhone) {
          return redirect()->back()->with('error', 'Số điện thoại đã được sử dụng. Vui lòng kiểm tra lại.')->withInput();
      }
  
      // Tiến hành thêm mới tài xế
      $driver = new driver();
      $driver->driver_id = $request->driver_id;
      $driver->name = $request->input('tennv');
      $driver->phone = $request->input('sodienthoai');
      $driver->email = $request->input('email');
      $driver->license_number = $request->input('cccd');
      $driver->status = $request->input('trangthai');
      $driver->vehicle_id = $request->input('maxe');
  
      // Xử lý upload ảnh cho tài xế
      if ($request->hasFile('anhdaidien')) {
          $file = $request->file('anhdaidien');
          $extention = $file->getClientOriginalExtension(); 
          $fileName = time() . '.' . $extention;
          $file->move('Uploads/admin', $fileName);
          $driver->driver_image = $fileName;
      }
  
      // Lưu tài xế vào cơ sở dữ liệu
      $driver->save();
      // Cập nhật trạng thái xe thành đã được đăng ký
     \App\Models\Vehicle::where('vehicle_id', $request->input('maxe'))->update(['is_registered' => true]);
  
      // Redirect lại với thông báo thành công
      return redirect()->back()->with('status', 'Thêm nhân viên thành công');
  }

  public function getAvailableVehicles()
{
    // Lấy danh sách xe chưa được đăng ký 
    $availableVehicles = \App\Models\Vehicle::where('is_registered', false)->get(['vehicle_id', 'license_plate']);
    return response()->json($availableVehicles);
}
  
  

// sửa thông tin nhân viên
public function edit($driver_id) {
      $driver = driver::find($driver_id); // Lấy thông tin tài xế theo driver_id
      return view('Backend.Editnv', compact('driver')); // Truyền biến driver vào view
  }
public function update(Request $request, $driver_id) {
  $driver = Driver::find($driver_id); // Lấy tài xế hiện tại

  // Kiểm tra tồn tại tài xế
  if (!$driver) {
      return redirect()->back()->with('error', 'Tài xế không tồn tại.');
  }

  // Kiểm tra nếu xe tồn tại
  $vehicleExist = \App\Models\Vehicle::where('vehicle_id', $request->input('maxe'))->exists();
  if (!$vehicleExist) {
      return redirect()->back()->with('error', 'Xe không tồn tại.');
  }

  // Cập nhật các trường dữ liệu
  $driver->name = $request->input("tennv");
  $driver->phone = $request->input("sodienthoai");
  $driver->email = $request->input("email");
  $driver->license_number = $request->input("cccd");
  $driver->status = $request->input("trangthai");
  $driver->vehicle_id = $request->input("maxe");

  // Xử lý hình ảnh tài xế
  if ($request->hasFile('anhdaidien')) {
      $anhcu = 'Uploads/admin/' . $driver->driver_image;
      if (File::exists($anhcu)) {
          File::delete($anhcu);
      }
      $file = $request->file('anhdaidien');
      $extention = $file->getClientOriginalExtension();
      $fillname = time() . '.' . $extention;
      $file->move('Uploads/admin', $fillname);
      $driver->driver_image = $fillname; 
  }

  // Lưu thay đổi
  $driver->save();

  // Thông báo thành công
  return redirect()->back()->with('editnv', 'Sửa thành công');
}



// Xóa
public function delete($driver_id)
{
    // Tìm tài xế theo ID
    $driver = driver::find($driver_id);

    if ($driver) {
        // Xóa ảnh đại diện nếu tồn tại
        $imagePath = 'Uploads/admin/' . $driver->driver_image;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Xóa tài xế khỏi cơ sở dữ liệu
        $driver->delete();

        return redirect()->back()->with('deletenv', 'Xóa nhân viên thành công');
    }

    return redirect()->back()->with('error', 'Không tìm thấy nhân viên');
}
}
