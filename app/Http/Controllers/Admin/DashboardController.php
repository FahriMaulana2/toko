<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Products
        $totalProducts = Product::count();
        
        // Total Orders (SEMUA order)
        $totalOrders = Order::count();
        
        // Total Customers
        $totalCustomers = User::where('is_admin', false)->count();
        
        // Total Revenue (dari order completed)
        $totalRevenue = Order::where('status', 'completed')->sum('grand_total');
        
        // Order status counts - PASTIKAN INI BEKERJA
        $pendingOrders = Order::where('status', 'pending')->count();
        $processedOrders = Order::where('status', 'processed')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        
        // Recent Orders (last 5)
        $recentOrders = Order::latest()->take(5)->get();
        
        // Low stock products
        $lowStockProducts = Product::where('stock', '<', 5)->where('stock', '>', 0)->take(5)->get();
        
        // Out of stock products
        $outOfStockProducts = Product::where('stock', 0)->take(5)->get();
        
        // Monthly revenue
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('grand_total');
        
        // Kirim ke view
        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'totalRevenue' => $totalRevenue,
            'pendingOrders' => $pendingOrders,
            'processedOrders' => $processedOrders,
            'shippedOrders' => $shippedOrders,
            'completedOrders' => $completedOrders,
            'recentOrders' => $recentOrders,
            'lowStockProducts' => $lowStockProducts,
            'outOfStockProducts' => $outOfStockProducts,
            'monthlyRevenue' => $monthlyRevenue,
        ]);
    }
}