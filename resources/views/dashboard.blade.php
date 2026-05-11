@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="bg-white rounded-3xl shadow-lg p-8 border border-gray-100">

        <div class="flex items-center justify-between flex-wrap gap-4">

            <div>
                <h1 class="text-4xl font-bold text-gray-800">
                    Welcome,
                    <span class="text-brown-600">
                        {{ auth()->user()->name }}
                    </span>
                </h1>

                <p class="text-gray-500 mt-2">
                    Dashboard Kiana Furniture
                </p>
            </div>

            <div class="flex gap-3">

                <a href="{{ url('/') }}"
                   class="px-5 py-3 bg-brown-600 text-white rounded-2xl hover:bg-brown-700 transition">
                    Home
                </a>

                <a href="{{ route('my.orders') }}"
                   class="px-5 py-3 border border-gray-300 rounded-2xl hover:bg-gray-100 transition">
                    My Orders
                </a>

            </div>

        </div>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

        <!-- CARD -->
        <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">
                        Total Orders
                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ \App\Models\Order::where('user_id', auth()->id())->count() }}
                    </h2>
                </div>

                <div class="w-14 h-14 bg-brown-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-box text-brown-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- CARD -->
        <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">
                        Pending Orders
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-500 mt-2">
                        {{ \App\Models\Order::where('user_id', auth()->id())->where('status','pending')->count() }}
                    </h2>
                </div>

                <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- CARD -->
        <div class="bg-white p-6 rounded-3xl shadow border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">
                        Completed Orders
                    </p>

                    <h2 class="text-3xl font-bold text-green-500 mt-2">
                        {{ \App\Models\Order::where('user_id', auth()->id())->where('status','completed')->count() }}
                    </h2>
                </div>

                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection