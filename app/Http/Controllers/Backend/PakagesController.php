<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PakagesController extends Controller
{
    public function goihang(){
        return view("Backend/Customer/packages");
    }
}
