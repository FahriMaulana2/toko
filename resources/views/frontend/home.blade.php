@extends('layouts.app')

@section('title', 'Home - Premium Scandinavian Furniture')

@section('content')

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gray-50 via-white to-gray-50 pt-16 pb-24 overflow-hidden">
    <div class="absolute top-20 right-0 w-96 h-96 bg-brown-100 rounded-full opacity-20 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="flex flex-col lg:flex-row items-center gap-12">

            <!-- LEFT -->
            <div class="lg:w-1/2 text-center lg:text-left" data-aos="fade-right">

                <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider bg-brown-50 px-4 py-2 rounded-full inline-block mb-6">
                    Elevate Your Living Space
                </span>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-playfair font-bold text-gray-800 leading-tight mb-6">
                    Premium
                    <span class="text-brown-600">Scandinavian</span>
                    Furniture
                </h1>

                <p class="text-gray-600 text-lg mb-8 max-w-xl mx-auto lg:mx-0">
                    Designed for modern living. Quality craftsmanship with timeless elegance
                    for your comfortable home.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">

                    <a href="{{ route('products.index') }}"
                       class="bg-brown-600 text-white px-8 py-3 rounded-full hover:bg-brown-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">

                        Shop Now
                        <i class="fas fa-arrow-right"></i>

                    </a>

                    <a href="#collections"
                       class="border-2 border-brown-600 text-brown-600 px-8 py-3 rounded-full hover:bg-brown-50 transition inline-flex items-center justify-center gap-2">

                        Learn More
                        <i class="fas fa-play"></i>

                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="lg:w-1/2" data-aos="fade-left">

                <div class="relative">

                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-brown-200 rounded-full opacity-50"></div>

                    <img
                        src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&h=500&fit=crop"
                        alt="Modern Scandinavian Sofa"
                        class="relative z-10 rounded-2xl shadow-2xl w-full object-cover">

                    <div class="absolute -bottom-6 -right-6 w-40 h-40 bg-yellow-300 rounded-full opacity-40"></div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="py-20 bg-gray-50" id="featured">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12" data-aos="fade-up">

            <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider">
                Collection
            </span>

            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-gray-800 mt-2 mb-4">
                Featured Products
            </h2>

            <div class="w-20 h-1 bg-brown-600 mx-auto rounded-full"></div>

            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                Discover our handpicked selection of premium furniture pieces
            </p>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @php
                $featuredProducts = [
                    [
                        'id' => 1,
                        'name' => 'Elegant Armchair',
                        'slug' => 'elegant-armchair',
                        'price' => 2450000,
                        'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=300&h=300&fit=crop',
                    ],
                    [
                        'id' => 2,
                        'name' => 'Scandinavian Sofa',
                        'slug' => 'scandinavian-sofa',
                        'price' => 5800000,
                        'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=300&h=300&fit=crop',
                    ],
                    [
                        'id' => 3,
                        'name' => 'Wooden Coffee Table',
                        'slug' => 'wooden-coffee-table',
                        'price' => 1200000,
                        'image' => 'https://images.unsplash.com/photo-1532372320572-cda25653a26d?w=300&h=300&fit=crop',
                    ],
                    [
                        'id' => 4,
                        'name' => 'Minimalist Lamp',
                        'slug' => 'minimalist-lamp',
                        'price' => 450000,
                        'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=300&h=300&fit=crop',
                    ],
                ];
            @endphp

            @foreach($featuredProducts as $product)

            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">

                <a href="{{ url('/products/' . $product['slug']) }}">

                    <div class="h-64 overflow-hidden">

                        <img
                            src="{{ $product['image'] }}"
                            alt="{{ $product['name'] }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-500">

                    </div>

                    <div class="p-5">

                        <h3 class="font-semibold text-gray-800 text-lg mb-2">
                            {{ $product['name'] }}
                        </h3>

                        <p class="text-brown-600 font-bold text-xl">
                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                        </p>

                    </div>

                </a>

            </div>

            @endforeach

        </div>

    </div>

</section>

<!-- COMPANY HISTORY -->
<section class="bg-[#8B5E3C] text-white py-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- LEFT CONTENT -->
            <div data-aos="fade-right">

                <span class="uppercase tracking-[4px] text-sm text-[#EADBC8]">
                    Tentang Perusahaan
                </span>

                <h2 class="text-4xl md:text-5xl font-bold mt-4 leading-tight">
                    Sejarah Berdirinya KianaFurniture
                </h2>

                <p class="mt-6 text-[#F5EDE5] leading-relaxed text-lg">
                    KianaFurniture berdiri sejak tahun 2015 sebagai usaha furniture lokal
                    yang berfokus pada desain interior modern, kualitas premium, dan
                    kenyamanan pelanggan.
                </p>

                <p class="mt-5 text-[#F5EDE5] leading-relaxed">
                    Berawal dari workshop kecil bersama pengrajin lokal Jepara,
                    kini KianaFurniture berkembang menjadi penyedia furniture terpercaya
                    untuk kebutuhan rumah, kantor, cafe, dan interior modern.
                </p>

                <p class="mt-5 text-[#F5EDE5] leading-relaxed">
                    Kami bekerja sama dengan mitra pengrajin terbaik untuk menghasilkan
                    produk furniture berkualitas tinggi dengan sentuhan craftsmanship
                    khas Indonesia.
                </p>

                <!-- STATS -->
                <div class="grid grid-cols-2 gap-6 mt-10">

                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 shadow-lg">

                        <h3 class="text-4xl font-bold">10+</h3>

                        <p class="text-[#EADBC8] mt-2">
                            Tahun Pengalaman
                        </p>

                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 shadow-lg">

                        <h3 class="text-4xl font-bold">50+</h3>

                        <p class="text-[#EADBC8] mt-2">
                            Mitra Furniture
                        </p>

                    </div>

                </div>

            </div>

            <!-- RIGHT CONTENT -->
            <div data-aos="fade-left">

                <div class="bg-white rounded-3xl overflow-hidden shadow-2xl">

                    <!-- MAP -->
                    <iframe 
                      src="https://maps.google.com/maps?q=-6.502801900516626,110.7165587251846&t=k&z=18&ie=UTF8&iwloc=&output=embed"
                      width="100%"
                      height="350"
                      style="border:0;"
                      allowfullscreen=""
                      loading="lazy">
                    </iframe>

                    <!-- INFO -->
                    <div class="p-8 text-gray-800">

                        <span class="text-sm uppercase tracking-[3px] text-[#8B5E3C] font-semibold">
                            Lokasi Mitra Produksi
                        </span>

                        <h3 class="text-3xl font-bold text-[#4B3A2F] mt-3">
                            Jepara, Jawa Tengah
                        </h3>

                        <p class="mt-5 text-gray-600 leading-relaxed">
                            Mitra produksi utama KianaFurniture berlokasi di Jepara,
                            pusat industri furniture dan ukiran kayu terkenal di Indonesia.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Contact Section -->
<section id="contact" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Heading -->
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider">
                Get In Touch
            </span>

            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-gray-800 mt-2">
                Contact Us
            </h2>

            <div class="w-20 h-1 bg-brown-600 mx-auto rounded-full mt-4"></div>

            <p class="text-gray-600 mt-4">
                We'd love to hear from you
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- LEFT SIDE -->
            <div data-aos="fade-right">

                <!-- Contact Info -->
                <div class="space-y-6">

                    <!-- Address -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-brown-600 text-xl"></i>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Visit Us
                            </h3>

                            <p class="text-gray-600 leading-relaxed">
                                Jl. Raya Jepara KM 2, No. 88 <br>
                                Kecamatan Mlonggo, Desa Karanggondang <br>
                                Dukuh Ngipek, RT 05/RW 04 <br>
                                Kabupaten Jepara, Jawa Tengah 59352
                            </p>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fab fa-whatsapp text-green-600 text-xl"></i>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                WhatsApp
                            </h3>

                            <a href="https://wa.me/6283831520933"
                               target="_blank"
                               class="text-green-600 hover:underline">
                                +62 838 3152 0933
                            </a>

                            <p class="text-sm text-gray-500 mt-1">
                                Klik untuk chat langsung
                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-brown-600 text-xl"></i>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Call Us
                            </h3>

                            <p class="text-gray-600">
                                +62 838 3152 0933 (Admin) <br>
                                +62 895 3380 74209 (Owner)
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-brown-600 text-xl"></i>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Email Us
                            </h3>

                            <p class="text-gray-600">
                                kianafurniture@gmail.com <br>
                                cs@kianafurniture.com
                            </p>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-brown-600 text-xl"></i>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Business Hours
                            </h3>

                            <p class="text-gray-600">
                                Senin - Sabtu: 08.00 - 17.00 <br>
                                Minggu & Hari Besar: Tutup
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Social Media -->
                <div class="mt-8 pt-6 border-t border-gray-200">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Follow Us
                    </h3>

                    <div class="flex gap-4">

                        <a href="#"
                           class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center hover:bg-brown-600 hover:text-white transition text-brown-600">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="#"
                           class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center hover:bg-brown-600 hover:text-white transition text-brown-600">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="#"
                           class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center hover:bg-brown-600 hover:text-white transition text-brown-600">
                            <i class="fab fa-pinterest-p"></i>
                        </a>

                        <a href="#"
                           class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center hover:bg-brown-600 hover:text-white transition text-brown-600">
                            <i class="fab fa-tiktok"></i>
                        </a>

                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div data-aos="fade-left">

                <!-- Contact Form -->
                <form id="contactForm"
                      class="bg-gray-50 rounded-2xl p-6 shadow-md mb-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Name *
                            </label>

                            <input type="text"
                                   id="name"
                                   required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brown-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email *
                            </label>

                            <input type="email"
                                   id="email"
                                   required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brown-600">
                        </div>

                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Subject
                        </label>

                        <input type="text"
                               id="subject"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brown-600">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Message *
                        </label>

                        <textarea id="message"
                                  rows="5"
                                  required
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-brown-600"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-brown-600 text-white py-3 rounded-lg font-semibold hover:bg-brown-700 transition">
                        Send Message
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>

            </div>

        </div>
    </div>
</section>

<!-- WhatsApp Script -->
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {

    e.preventDefault();

    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let subject = document.getElementById('subject').value;
    let message = document.getElementById('message').value;

    let phoneNumber = '6283831520933';

    let text =
`Halo Admin Kiana Furniture,

Nama: ${name}
Email: ${email}
Subject: ${subject}

Pesan:
${message}`;

    let whatsappURL =
`https://wa.me/${phoneNumber}?text=${encodeURIComponent(text)}`;

    window.open(whatsappURL, '_blank');

});
</script>


@endsection