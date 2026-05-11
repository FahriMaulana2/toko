@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<section class="min-h-screen bg-[#F8F5F1] py-16">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- HEADER -->
        <div class="mb-10">

            <span class="uppercase tracking-[4px] text-sm text-[#8B5E3C] font-semibold">
                Dashboard
            </span>

            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mt-3 font-playfair">
                Welcome Back,
                <span class="text-[#8B5E3C]">
                    {{ auth()->user()->name }}
                </span>
            </h1>

            <p class="text-gray-600 mt-4 text-lg">
                Kelola akun dan pesanan furniture Anda di sini.
            </p>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">

                <div class="w-14 h-14 rounded-2xl bg-[#8B5E3C]/10 flex items-center justify-center mb-5">
                    <i class="fas fa-user text-[#8B5E3C] text-2xl"></i>
                </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    Profile
                </h3>

                <p class="text-gray-600 mb-6">
                    Edit informasi akun dan password Anda.
                </p>

                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center gap-2 bg-[#8B5E3C] hover:bg-[#734C30] text-white px-5 py-3 rounded-xl transition">

                    Edit Profile
                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center mb-5">
                    <i class="fas fa-box text-green-600 text-2xl"></i>
                </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    My Orders
                </h3>

                <p class="text-gray-600 mb-6">
                    Lihat riwayat dan status pesanan Anda.
                </p>

                <a href="{{ route('my.orders') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl transition">

                    View Orders
                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center mb-5">
                    <i class="fas fa-home text-yellow-600 text-2xl"></i>
                </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    Back to Home
                </h3>

                <p class="text-gray-600 mb-6">
                    Kembali ke halaman utama website.
                </p>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-3 rounded-xl transition">

                    Home
                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>

        </div>

    </div>

</section>

@endsection