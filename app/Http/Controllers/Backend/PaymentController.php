<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PaymentController extends Controller
{
    public function thanhtoan(){
        $payment = Payment::all();
        Return view('Backend.Payment.payment',compact('payment'));
    }
    public function refund($id)
    {
    $payment = Payment::find($id);
    
    if ($payment) {
        $payment->status = 'Đang chờ xử lý'; 
        $payment->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Hoàn tiền thành công!',
            'new_status' => 'Đang chờ xử lý',
        ]);
    }
    
    return response()->json([
        'success' => false,
        'message' => 'Không tìm thấy giao dịch!',
    ]);
    }

}
