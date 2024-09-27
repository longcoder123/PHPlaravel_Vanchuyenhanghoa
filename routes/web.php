<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\Backend\DriverController;

Route::get('/', function () {
    return view('welcome');
});

//Backend
Route::get('/admin',[AdminController::class,'index'])->name('admin');

//quanlixe 
Route::get('/qlixe', [VehicleController::class, 'qlxe'])->name('qlixe');
//thêm xe 
Route::get('/Them-xe', [VehicleController::class,'addxe'])->name('themxe');
Route::post('/Them-xe', [VehicleController::class,'store'])->name('storexe');

// Sửa thông tin xe 
Route::get('/sua-xe/{vehicle_id}', [VehicleController::class, 'edit'])->name('suaxe');
Route::post('/update-xe/{vehicle_id}', [VehicleController::class, 'update'])->name('updatexe');
// Xóa xe
Route::get('/delete-xe/{vehicle_id}', [VehicleController::class,'delete'])->name('xoaxe');


//quản lý nhân viên
Route::get('/qlynv', [DriverController::class, 'qlnv'])->name('qlynv');