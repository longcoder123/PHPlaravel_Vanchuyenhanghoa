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
  
   public function store(Request $request){
      $driver = new driver();
      $driver->driver_id = $request->driver_id;
      $driver->name = $request->input("tennv");
      $driver->phone = $request->input("sodienthoai");
      $driver->email = $request->input("email");
      $driver->license_number = $request->input("cccd");
      $driver->status = $request->input("trangthai");
      $driver->vehicle_id = $request->input("maxe");
      if($request -> hasFile('anhdaidien')){
         $file = $request -> file('anhdaidien');
         $extention = $file -> getClientOriginalExtension(); 
         $fillname =time().'.'.$extention;
         $file -> move('Uploads/admin', $fillname);
         $driver-> driver_image = $fillname;
 }
 $driver->save();
 return redirect()->back()->with('status','Thêm nhân viên thành công');
   }

   // sửa thông tin nhân viên
   public function edit($driver_id) {
      $driver = driver::find($driver_id); // Lấy thông tin tài xế theo driver_id
      return view('Backend.Editnv', compact('driver')); // Truyền biến driver vào view
  }
  public function update(Request $request, $driver_id) {
   $driver = Driver::find($driver_id); // Lấy tài xế hiện tại

   // Cập nhật các trường dữ liệu
   $driver->name = $request->input("tennv");
   $driver->phone = $request->input("sodienthoai");
   $driver->email = $request->input("email");
   $driver->license_number = $request->input("cccd");
   $driver->status = $request->input("trangthai");
   $driver->vehicle_id = $request->input("maxe");

   if ($request->hasFile('anhdaidien')) {
       $anhcu = 'Uploads/admin/' . $driver->driver_image;
       if (File::exists($anhcu)) {
           File::delete($anhcu);
       }
       $file = $request->file('anhdaidien');
       $extention = $file->getClientOriginalExtension(); 
       $fillname = time() . '.' . $extention;
       $file->move('Uploads/admin', $fillname);
       $driver->driver_image = $fillname; // Sửa lại tên biến từ vehicle_image thành driver_image
   }

   $driver->save(); // Lưu thay đổi
   return redirect()->back()->with('status', 'Sửa thành công');
}

// Xóa
public function delete($driver_id){
   $driver = driver::find($driver_id);
   if (File::exists($driver)){
       File::exists($driver);
}
$driver-> delete();
return redirect()->back()->with('status','Xóa thành công');
}
}
