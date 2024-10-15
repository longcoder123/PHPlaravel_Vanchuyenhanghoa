<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vehicle;
use Illuminate\Support\Facades\File;
use Psy\Readline\Hoa\Console;

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

    // Kiểm tra sự tồn tại của license_plate trong bảng Vehicles
    $request->validate([
        'biensoxe' => 'required|unique:vehicles,license_plate',
        'loaixe' => 'required',
        'trongluong' => 'required|numeric',
        'trangthai' => 'required'
    ], [
        'biensoxe.unique' => 'Biển số xe đã tồn tại!',
    ]);

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
       // Kiểm tra sự tồn tại của license_plate trong bảng Vehicles
        $request->validate([
            'biensoxe' => 'required|unique:vehicles,license_plate',
            'loaixe' => 'required',
            'trongluong' => 'required|numeric',
            'trangthai' => 'required'
        ], [
            'biensoxe.unique' => 'Biển số xe đã tồn tại!',
        ]);

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

        return redirect()->back()->with('editxe', 'Sửa thông tin thành công');
    }


    // xóa xe
// Xóa xe
public function delete($vehicle_id) {
    $vh = vehicle::find($vehicle_id);
    
    // Kiểm tra nếu xe tồn tại
    if ($vh) {
        if (File::exists(public_path('Uploads/admin/'.$vh->vehicle_image))) {
            File::delete(public_path('Uploads/admin/'.$vh->vehicle_image)); // Xóa ảnh của xe nếu có
        }
        $vh->delete(); // Xóa xe khỏi database
        return redirect()->back()->with('delete', 'Xóa xe thành công');
    }
    
    return redirect()->back()->with('delete', 'Xe không tồn tại');
}

}
