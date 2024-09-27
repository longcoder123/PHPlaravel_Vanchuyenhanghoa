<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\driver;

class DriverController extends Controller
{
   public function qlnv(){
    $drive = driver::all();
    return view("Backend.quanlinv" , compact("drive"));
   }
}
