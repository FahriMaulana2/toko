@extends('layouts.app')

@section('title', 'Kiana Furniture')

@section('content')

<!-- HERO SECTION -->
<section class="min-h-screen bg-[#F8F5F1] flex items-center justify-center px-6">

    <div class="text-center">

        <!-- SMALL TEXT -->
        <span class="uppercase tracking-[4px] text-sm text-[#8B5E3C] font-semibold">
            Premium Furniture
        </span>

        <!-- TITLE -->
        <h1 class="text-5xl md:text-7xl font-bold text-[#8B5E3C] mt-5 mb-6">
            KianaFurniture
        </h1>

        <!-- DESCRIPTION -->
        <p class="text-gray-600 text-lg md:text-2xl max-w-2xl mx-auto leading-relaxed">
            Website furniture berhasil kembali 🚀 <br>
            Modern Scandinavian Furniture untuk rumah impian Anda.
        </p>

        <!-- BUTTON -->
        <div class="mt-10">
            <a href="#products"
               class="inline-flex items-center gap-3 bg-[#8B5E3C] hover:bg-[#6f4a2f] text-white px-8 py-4 rounded-full text-lg font-semibold transition duration-300 shadow-lg">

                Explore Furniture
                <i class="fas fa-arrow-right"></i>

            </a>
        </div>

    </div>

</section>

@endsection