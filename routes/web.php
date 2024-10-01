<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\Backend\DriverController;
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\Backend\CustomerController;   
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PakagesController;


//Backend
Route::get('/admin',[AdminController::class,'index'])->name('admin');

// Khách hàng 

Route::get('/backend/khachang', [CustomerController::class, 'khachang'])->name('backend.customer');

// Đơn hàng 
Route::get('/backend/donhang', [OrderController::class, 'order'])->name('backend.order');

//gói hàng 
Route::get('/backend/goihang', [PakagesController::class, 'goihang'])->name('backend.packages');
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
// Thêm nhân viên
Route::get('/Them-nv', [DriverController::class,'addnv'])->name('themnv');
Route::post('/Them-nv', [DriverController::class,'store'])->name('storenv');

//Sửa nhân viên
Route::get('/sua-nv/{driver_id}', [DriverController::class, 'edit'])->name('suanv');
Route::post('/update-nv/{driver_id}', [DriverController::class, 'update'])->name('updatenv');
// Xóa
Route::get('/delete-nv/{driver_id}', [DriverController::class,'delete'])->name('xoanv');



// Frontend Home 
Route::get('/',[HomeController::class,'layoutHome'])->name('home');
Route::get('/infor',[HomeController::class,'layoutInfor'])->name('infor');

// Route::get('/', function () {
//     // layouts.user.header
//     return view('layouts.layoutMain.userPage.home');
// });
// Route::get('/info', function () {
//     // layouts.user.header
//     return view('layouts.layoutMain.userPage.customerInformation');
// });
Route::post('/calculate-shipping-cost', [HomeController::class, 'calculate'])->name('calculateShippingCost');
