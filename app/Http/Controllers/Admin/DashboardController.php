<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Products
        $totalProducts = Product::count();
        
        // Total Orders
        $totalOrders = Order::count();
        
        // Total Customers (users with is_admin = false)
        $totalCustomers = User::where('is_admin', false)->count();
        
        // Total Revenue (from completed orders)
        $totalRevenue = Order::where('status', 'completed')->sum('grand_total');
        
        // Order status counts
        $pendingOrders = Order::where('status', 'pending')->count();
        $processedOrders = Order::where('status', 'processed')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        
        // Recent Orders (last 5)
        $recentOrders = Order::with(['user', 'payment'])->latest()->take(5)->get();
        
        // Low stock products (stock < 5 and > 0)
        $lowStockProducts = Product::where('stock', '<', 5)->where('stock', '>', 0)->take(5)->get();
        
        // Out of stock products (stock = 0)
        $outOfStockProducts = Product::where('stock', 0)->take(5)->get();
        
        // Monthly revenue
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('grand_total');
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'pendingOrders',
            'processedOrders',
            'shippedOrders',
            'completedOrders',
            'recentOrders',
            'lowStockProducts',
            'outOfStockProducts',
            'monthlyRevenue'
        ));
    }
}