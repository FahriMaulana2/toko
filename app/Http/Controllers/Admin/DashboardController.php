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
        // Hitung semua data
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('is_admin', false)->count();
        $totalRevenue = Order::where('status', 'completed')->sum('grand_total');
        
        $pendingOrders = Order::where('status', 'pending')->count();
        $processedOrders = Order::where('status', 'processed')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        
        $recentOrders = Order::latest()->take(5)->get();
        $lowStockProducts = Product::where('stock', '<', 5)->where('stock', '>', 0)->take(5)->get();
        $outOfStockProducts = Product::where('stock', 0)->take(5)->get();
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('grand_total');
        
        // DEBUG: Cek apakah data terhitung (akan muncul di log Laravel)
        \Log::info('=== DASHBOARD DATA ===');
        \Log::info('Total Products: ' . $totalProducts);
        \Log::info('Total Orders: ' . $totalOrders);
        \Log::info('Shipped Orders: ' . $shippedOrders);
        \Log::info('======================');
        
        // Kirim ke view dengan compact
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