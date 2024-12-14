<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\Backend\DriverController;
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PakagesController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Customer\DetailPackagesController;
use App\Http\Controllers\Customer\oder;
use App\Http\Controllers\Login\LoginUserController;
use App\Http\Controllers\Customer\InfroUser\InforUserController;
use App\Http\Controllers\InforCustomerController;
use App\Http\Controllers\Backend\UserController;


// Phân quyền admin
Route::group(['middleware' => 'auth.admin'], function () {
    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Quản lý khách hàng
    Route::get('/backend/khachang', [CustomerController::class, 'khachang'])->name('backend.customer');

    // Quản lý đơn hàng
    Route::get('/khachhang/{customer_id}/orders', [OrderController::class, 'order'])->name('backend.orders');
    // Duyệt đơn hàng
    Route::get('/order/approve/{order_id}', [OrderController::class, 'approveOrder'])->name('backend.order.approve');
    // Từ chối đơn hàng
    Route::get('/order/reject/{order_id}', [OrderController::class, 'rejectOrder'])->name('backend.order.reject');
    Route::get('/order/delete/{order_id}',[OrderController::class,'delete'])->name('xoadonhang');


    // Chi tiết gói hàng
    Route::get('/backend/goihang/{order_id}', [PakagesController::class, 'orderDetails'])->name('backend.package.details');
    
    // Quản lý xe
    Route::get('/qlixe', [VehicleController::class, 'qlxe'])->name('qlixe');
    Route::get('/Them-xe', [VehicleController::class, 'addxe'])->name('themxe');
    Route::post('/Them-xe', [VehicleController::class, 'store'])->name('storexe');
    Route::get('/sua-xe/{vehicle_id}', [VehicleController::class, 'edit'])->name('suaxe');
    Route::post('/update-xe/{vehicle_id}', [VehicleController::class, 'update'])->name('updatexe');
    Route::get('/delete-xe/{vehicle_id}', [VehicleController::class, 'delete'])->name('xoaxe');

    // Quản lý nhân viên
    Route::get('/qlynv', [DriverController::class, 'qlnv'])->name('qlynv');
    Route::get('/Them-nv', [DriverController::class, 'addnv'])->name('themnv');
    Route::post('/Them-nv', [DriverController::class, 'store'])->name('storenv');
    Route::get('/available-vehicles', [DriverController::class, 'getAvailableVehicles'])->name('available.vehicles');
    Route::get('/sua-nv/{driver_id}', [DriverController::class, 'edit'])->name('suanv');
    Route::post('/update-nv/{driver_id}', [DriverController::class, 'update'])->name('updatenv');
    Route::get('/delete-nv/{driver_id}', [DriverController::class, 'delete'])->name('xoanv');

    // Quản lý tài khoản
    Route::get('/qltk',[UserController::class, 'User'])->name('qltk');
    Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->name('user.delete');


    //Quản lý thanh toán 
    Route::get('qltt',[PaymentController::class,'thanhtoan'])-> name('thanhtoan');
    Route::post('/payment/refund/{id}', [PaymentController::class, 'refund'])->name('payment.refund');


    
});

// Login Routes
Route::get('/login', [LoginUserController::class, 'index'])->name('login');
Route::post('/login', [LoginUserController::class, 'login'])->name('userlogin');
Route::post('/register', [LoginUserController::class, 'register'])->name('register.process');
Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');

// InfoUser
Route::get('/infouser', [InforUserController::class, 'index'])->name('infouser');
Route::post('/infouser', [InforUserController::class, 'update'])->name('updateInfouser');

// Frontend Routes
Route::get('/', [HomeController::class, 'layoutHome'])->name('home');
Route::get('/infor', [HomeController::class, 'layoutInfor'])->name('infor');

// Calculate Shipping Cost
Route::post('/calculate-shipping-cost', [HomeController::class, 'calculate'])->name('calculateShippingCost');

// Save Data (example for order - yêu cầu đăng nhập)
// Route::middleware('auth')->post('/save-data', [oder::class, 'checkProvince'])->name('saveData');


// Detail Package Route
Route::get('/detail-package', [DetailPackagesController::class, 'ViewDetailOfUser'])->name('detailpackage');
Route::post('/orders/{id}/cancel', [DetailPackagesController::class, 'cancel'])->name('orders.cancel');


// TEST
Route::get('/complete-profile', [InforCustomerController::class, 'showProfileForm'])->name('complete-profile-form');
Route::post('/complete-profile', [InforCustomerController::class, 'storeProfile'])->name('complete-profile');

Route::get('/thanks', [oder::class, 'viewResult'])->name('thanks');

Route::middleware(['auth', 'check.customer.profile'])->group(function () {
    // Ví dụ các route cần đăng nhập
    Route::get('/infouser', [InforUserController::class, 'index'])->name('infouser');
    Route::post('/save-data', [oder::class, 'checkProvince'])->name('saveData');
});
