<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\Backend\DriverController;
use App\Http\Controllers\customer\HomeController;



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

Route::get('/',[HomeController::class,'layoutHome'])->name('home');
Route::get('/infor',[HomeController::class,'layoutInfor'])->name('infor');
//quản lý nhân viên
// Route::get('/qlynv', [DriverController::class, 'qlnv'])->name('qlynv');Route::get('/', function () {
//     // layouts.user.header
//     return view('layouts.layoutMain.userPage.home');
// });
// Route::get('/info', function () {
//     // layouts.user.header
//     return view('layouts.layoutMain.userPage.customerInformation');
// });
Route::post('/calculate-shipping-cost', [HomeController::class, 'calculate'])->name('calculateShippingCost');
