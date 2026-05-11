@extends('layouts.app')

@section('title', 'Kiana Furniture')

@section('content')

<!-- HERO -->
<section class="relative bg-[#F8F5F1] min-h-screen flex items-center overflow-hidden">

    <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            <!-- LEFT -->
            <div>

                <span class="uppercase tracking-[4px] text-sm text-[#8B5E3C] font-semibold">
                    Premium Furniture
                </span>

                <h1 class="text-5xl lg:text-7xl font-bold text-[#8B5E3C] leading-tight mt-5">
                    Scandinavian
                    Furniture
                </h1>

                <p class="text-gray-600 text-lg mt-6 leading-relaxed max-w-xl">
                    Modern Scandinavian Furniture untuk rumah impian Anda
                    dengan kualitas premium dan desain elegan.
                </p>

                <div class="mt-10 flex flex-wrap gap-4">

                    <a href="#products"
                       class="bg-[#8B5E3C] hover:bg-[#6f4a2f] text-white px-8 py-4 rounded-full font-semibold transition shadow-lg">

                        Shop Now
                    </a>

                    <a href="#company"
                       class="border-2 border-[#8B5E3C] text-[#8B5E3C] px-8 py-4 rounded-full font-semibold hover:bg-[#8B5E3C] hover:text-white transition">

                        Company
                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative">

                <div class="absolute -top-8 -left-8 w-40 h-40 bg-[#8B5E3C]/10 rounded-full blur-3xl"></div>

                <img
                    src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=900"
                    class="relative z-10 rounded-[30px] shadow-2xl w-full object-cover"
                    alt="Furniture">

            </div>

        </div>

    </div>

</section>

<!-- PRODUCTS -->
<section id="products" class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-16">

            <span class="uppercase tracking-[4px] text-sm text-[#8B5E3C] font-semibold">
                Collection
            </span>

            <h2 class="text-4xl font-bold text-gray-800 mt-4">
                Featured Products
            </h2>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- PRODUCT -->
            <div class="bg-[#F8F5F1] rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition">

                <img
                    src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=500"
                    class="w-full h-64 object-cover">

                <div class="p-6">

                    <h3 class="text-xl font-bold text-gray-800">
                        Modern Chair
                    </h3>

                    <p class="text-[#8B5E3C] font-semibold mt-2">
                        Rp 2.500.000
                    </p>

                </div>

            </div>

            <!-- PRODUCT -->
            <div class="bg-[#F8F5F1] rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition">

                <img
                    src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=500"
                    class="w-full h-64 object-cover">

                <div class="p-6">

                    <h3 class="text-xl font-bold text-gray-800">
                        Scandinavian Sofa
                    </h3>

                    <p class="text-[#8B5E3C] font-semibold mt-2">
                        Rp 5.800.000
                    </p>

                </div>

            </div>

            <!-- PRODUCT -->
            <div class="bg-[#F8F5F1] rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition">

                <img
                    src="https://images.unsplash.com/photo-1538688525198-9b88f6f53126?w=500"
                    class="w-full h-64 object-cover">

                <div class="p-6">

                    <h3 class="text-xl font-bold text-gray-800">
                        Wooden Table
                    </h3>

                    <p class="text-[#8B5E3C] font-semibold mt-2">
                        Rp 3.200.000
                    </p>

                </div>

            </div>

            <!-- PRODUCT -->
            <div class="bg-[#F8F5F1] rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition">

                <img
                    src="https://images.unsplash.com/photo-1519710164239-da123dc03ef4?w=500"
                    class="w-full h-64 object-cover">

                <div class="p-6">

                    <h3 class="text-xl font-bold text-gray-800">
                        Premium Lamp
                    </h3>

                    <p class="text-[#8B5E3C] font-semibold mt-2">
                        Rp 850.000
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- COMPANY -->
<section id="company" class="py-24 bg-[#F8F5F1]">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <!-- LEFT -->
            <div>

                <span class="uppercase tracking-[4px] text-sm text-[#8B5E3C] font-semibold">
                    Company
                </span>

                <h2 class="text-5xl font-bold text-gray-800 mt-5 leading-tight">
                    KianaFurniture
                </h2>

                <p class="text-gray-600 mt-6 leading-relaxed text-lg">
                    KianaFurniture adalah perusahaan furniture modern
                    yang menghadirkan produk premium dengan desain elegan,
                    minimalis, dan berkualitas tinggi.
                </p>

            </div>

            <!-- RIGHT -->
            <div>

                <iframe
                    src="https://www.google.com/maps?q=-6.502801900516626,110.7165587251846&z=17&output=embed"
                    width="100%"
                    height="450"
                    style="border:0;"
                    loading="lazy"
                    class="rounded-[30px] shadow-xl">
                </iframe>

            </div>

        </div>

    </div>

</section>

@endsection