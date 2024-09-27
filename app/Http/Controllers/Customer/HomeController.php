<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function layoutHome(){
        return view("layoutMain.userPage.home");
    }
    public function layoutInfor(){
        return view("layoutMain.userPage.customerInformation");
    }
}
