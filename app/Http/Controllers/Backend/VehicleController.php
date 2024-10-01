<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vehicle;
use Illuminate\Support\Facades\File;

class VehicleController extends Controller
{
    public function qlxe(){
        $vh = vehicle::all(); 
        return view("Backend.quanlixe", compact("vh"));
    }

    // xử lí thêm xe 
    public function addxe(){
        return view("Backend.Addxe");
    }
    public function store(Request $request){
        $vh = new vehicle;
        $vh -> vehicle_id = $request->vehicle_id;
        $vh -> license_plate = $request -> input('biensoxe');
        $vh -> vehicle_type = $request -> input('loaixe');
        $vh -> capacity = $request -> input('trongluong');
        $vh -> status = $request -> input('trangthai'); 
        // $vh -> driver_id = $request -> input('taixe');
        
        if($request -> hasFile('anhdaidien')){
            $file = $request -> file('anhdaidien');
            $extention = $file -> getClientOriginalExtension(); 
            $fillname =time().'.'.$extention;
            $file -> move('Uploads/admin', $fillname);
            $vh -> vehicle_image = $fillname;
    }
    $vh -> save();
    return redirect()->back()->with('status','Thêm xe thành công');
}

// Sửa thông tin xe 
    public function edit($vehicle_id){
        $vh = vehicle::find($vehicle_id);
        return view('Backend.Editxe', compact('vh'));
    }
    public function update(Request $request, $vehicle_id) {
        // Tìm xe theo vehicle_id
        $vh = Vehicle::find($vehicle_id);
        if (!$vh) {
            return redirect()->back()->with('error', 'Xe không tồn tại');
        }
    
        // Cập nhật các trường
        $vh->license_plate = $request->input('biensoxe');
        $vh->vehicle_type = $request->input('loaixe');
        $vh->capacity = $request->input('trongluong');
        $vh->status = $request->input('trangthai');
    
        // Xử lý ảnh
        if ($request->hasFile('anhdaidien')) {
            // Xóa ảnh cũ nếu có
            $anhcu = 'Uploads/admin/' . $vh->vehicle_image; // Sửa tên biến từ anhdaidien thành vehicle_image
            if (File::exists($anhcu)) {
                File::delete($anhcu);
            }
    
            // Lưu ảnh mới
            $file = $request->file('anhdaidien');
            $extention = $file->getClientOriginalExtension();
            $fillname = time() . '.' . $extention;
            $file->move('Uploads/admin', $fillname);
            $vh->vehicle_image = $fillname; // Cập nhật tên ảnh
        }
    
        // Lưu thông tin đã cập nhật
        $vh->save(); // Sử dụng save() thay vì update()
        
        return redirect()->back()->with('status', 'Sửa thông tin thành công');
    }
    

    // xóa xe 
    public function delete($vehicle_id){
        $vh = vehicle::find($vehicle_id);
        if (File::exists($vh)){
            File::exists($vh);
    }
    $vh -> delete();
    return redirect()->back()->with('status','Xóa thành công');
}
  
}