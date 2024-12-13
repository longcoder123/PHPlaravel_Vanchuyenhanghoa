<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer; 
use App\Models\Package;
use Illuminate\Support\Facades\Auth; // Sửa đúng namespace
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $orderCount = Order::count();
        $customerCount = Order::distinct('customer_id')->count('customer_id'); 
        $packagesCount = Package::sum('value');

        // Truy vấn tổng doanh thu theo tháng
        $revenues = DB::table('packages') 
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(value) as total_revenue'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get();

        // Lấy dữ liệu mỗi tháng, nếu không có mặc định bằng 0
        $monthlyRevenue = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenue = $revenues->firstWhere('month', $i);
            $monthlyRevenue[$i] = $revenue ? $revenue->total_revenue : 0;
        }

        // Lấy thông báo chưa đọc
        $notifications = Auth::user()->unreadNotifications;

        return view('Backend.index', compact('orderCount', 'customerCount', 'packagesCount', 'monthlyRevenue', 'notifications'));
    }
}

