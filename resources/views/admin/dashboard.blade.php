@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Products</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalProducts ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-box text-brown-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalOrders ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Customers</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalCustomers ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Revenue</p>
                    <p class="text-3xl font-bold text-brown-600">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Status -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-yellow-50 rounded-xl p-4 border border-yellow-200">
            <p class="text-yellow-600 text-sm">Pending</p>
            <p class="text-2xl font-bold text-yellow-700">{{ $pendingOrders ?? 0 }}</p>
        </div>
        <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
            <p class="text-blue-600 text-sm">Processed</p>
            <p class="text-2xl font-bold text-blue-700">{{ $processedOrders ?? 0 }}</p>
        </div>
        <div class="bg-purple-50 rounded-xl p-4 border border-purple-200">
            <p class="text-purple-600 text-sm">Shipped</p>
            <p class="text-2xl font-bold text-purple-700">{{ $shippedOrders ?? 0 }}</p>
        </div>
        <div class="bg-green-50 rounded-xl p-4 border border-green-200">
            <p class="text-green-600 text-sm">Completed</p>
            <p class="text-2xl font-bold text-green-700">{{ $completedOrders ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection