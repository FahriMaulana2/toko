@extends('layouts.app')

@section('title', 'Home - Premium Scandinavian Furniture')

@section('content')

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gray-50 via-white to-gray-50 pt-16 pb-24 overflow-hidden">
    <div class="absolute top-20 right-0 w-96 h-96 bg-brown-100 rounded-full opacity-20 blur-3xl"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2 text-center lg:text-left" data-aos="fade-right">
                <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider bg-brown-50 px-4 py-2 rounded-full inline-block mb-6">Elevate Your Living Space</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-playfair font-bold text-gray-800 leading-tight mb-6">
                    Premium <span class="text-brown-600">Scandinavian</span> Furniture
                </h1>
                <p class="text-gray-600 text-lg mb-8 max-w-xl mx-auto lg:mx-0">Designed for modern living. Quality craftsmanship with timeless elegance for your comfortable home.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('products.index') }}" class="bg-brown-600 text-white px-8 py-3 rounded-full hover:bg-brown-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                        Shop Now <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#collections" class="border-2 border-brown-600 text-brown-600 px-8 py-3 rounded-full hover:bg-brown-50 transition inline-flex items-center justify-center gap-2">
                        Learn More <i class="fas fa-play"></i>
                    </a>
                </div>
            </div>
            <div class="lg:w-1/2" data-aos="fade-left">
                <div class="relative">
                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-brown-200 rounded-full opacity-50"></div>
                    <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&h=500&fit=crop" 
                         alt="Modern Scandinavian Sofa"
                         class="relative z-10 rounded-2xl shadow-2xl w-full object-cover"
                         onerror="this.src='https://placehold.co/600x500/8B5E3C/white?text=Kiana+Furniture'">
                    <div class="absolute -bottom-6 -right-6 w-40 h-40 bg-gold-400 rounded-full opacity-40"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-20 bg-gray-50" id="featured">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider">Collection</span>
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-gray-800 mt-2 mb-4">Featured Products</h2>
            <div class="w-20 h-1 bg-brown-600 mx-auto rounded-full"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Discover our handpicked selection of premium furniture pieces</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $featuredProducts = [
                    ['id' => 1, 'name' => 'Elegant Armchair', 'slug' => 'elegant-armchair', 'price' => 2450000, 'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=300&h=300&fit=crop', 'badge' => 'Best Seller', 'rating' => 4.8],
                    ['id' => 2, 'name' => 'Scandinavian Sofa', 'slug' => 'scandinavian-sofa', 'price' => 5800000, 'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=300&h=300&fit=crop', 'badge' => 'New', 'rating' => 4.9],
                    ['id' => 3, 'name' => 'Wooden Coffee Table', 'slug' => 'wooden-coffee-table', 'price' => 1200000, 'image' => 'https://images.unsplash.com/photo-1532372320572-cda25653a26d?w=300&h=300&fit=crop', 'badge' => null, 'rating' => 4.7],
                    ['id' => 4, 'name' => 'Minimalist Lamp', 'slug' => 'minimalist-lamp', 'price' => 450000, 'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=300&h=300&fit=crop', 'badge' => 'Sale', 'rating' => 4.6],
                ];
            @endphp
            
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 group" data-aos="fade-up">
                <a href="{{ url('/products/' . $product['slug']) }}" class="block">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $product['image'] }}" 
                             alt="{{ $product['name'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                             onerror="this.src='https://placehold.co/300x300/8B5E3C/white?text={{ urlencode($product['name']) }}'">
                        @if($product['badge'])
                        <span class="absolute top-4 left-4 {{ $product['badge'] == 'Sale' ? 'bg-red-500' : ($product['badge'] == 'New' ? 'bg-green-500' : 'bg-yellow-500') }} text-white text-xs px-3 py-1 rounded-full font-semibold">
                            {{ $product['badge'] }}
                        </span>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-1 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($product['rating']))
                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                @elseif($i - 0.5 <= $product['rating'])
                                    <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                                @else
                                    <i class="far fa-star text-yellow-400 text-sm"></i>
                                @endif
                            @endfor
                            <span class="text-gray-500 text-xs ml-2">({{ rand(20, 200) }} reviews)</span>
                        </div>
                        <h3 class="font-semibold text-gray-800 text-lg mb-1">{{ $product['name'] }}</h3>
                        <p class="text-brown-600 font-bold text-xl">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                    </div>
                </a>
                <div class="px-4 pb-4">
                    <button onclick="addToCart({{ $product['id'] }}, '{{ addslashes($product['name']) }}', {{ $product['price'] }}, '{{ $product['image'] }}', 1)" 
                            class="w-full bg-gray-800 text-white py-2 rounded-xl hover:bg-brown-600 transition flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-brown-600 font-semibold hover:gap-3 transition-all">
                View All Products <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider">Why Choose Us</span>
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-gray-800 mt-2">Our Services</h2>
            <div class="w-20 h-1 bg-brown-600 mx-auto rounded-full mt-4"></div>
            <p class="text-gray-600 mt-4">We offer more than just furniture - we provide complete solutions for your dream home</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 rounded-2xl hover:shadow-lg transition" data-aos="fade-up">
                <div class="w-16 h-16 bg-brown-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-medal text-brown-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Quality Guaranteed</h3>
                <p class="text-gray-600">All our furniture is crafted with premium materials for lasting durability.</p>
            </div>
            <div class="text-center p-6 rounded-2xl hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-brown-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-truck text-brown-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Free Shipping</h3>
                <p class="text-gray-600">Free delivery on orders above Rp 500.000 within Java island.</p>
            </div>
            <div class="text-center p-6 rounded-2xl hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-brown-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-undo-alt text-brown-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Easy Returns</h3>
                <p class="text-gray-600">30-day return policy if you're not satisfied with your purchase.</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6" data-aos="fade-up">
                <i class="fas fa-couch text-brown-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Modern Furniture</h3>
                <p class="text-gray-600">Premium quality materials crafted with precision for lasting comfort and elegance in every piece.</p>
            </div>
            <div class="text-center p-6" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-seedling text-brown-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Decor Accents</h3>
                <p class="text-gray-600">Handcrafted decoration pieces that bring character and warmth to any space in your home.</p>
            </div>
            <div class="text-center p-6" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-home text-brown-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Inspired Living</h3>
                <p class="text-gray-600">Expert design consultation to help you create the perfect atmosphere for your lifestyle.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Collections -->
<section class="py-16 bg-white" id="collections">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider">Browse</span>
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-gray-800 mt-2">Featured Collections</h2>
            <div class="w-20 h-1 bg-brown-600 mx-auto rounded-full mt-4"></div>
            <p class="text-gray-600 mt-4">Explore our curated collections designed for different spaces</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $collections = [
                    ['name' => 'Living Room', 'slug' => 'living-room', 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=300&h=350&fit=crop', 'count' => 'Sofas, chairs & more'],
                    ['name' => 'Home Office', 'slug' => 'office', 'image' => 'https://images.unsplash.com/photo-1593642532842-1dd4be2c6ba6?w=300&h=350&fit=crop', 'count' => 'Desks & office chairs'],
                    ['name' => 'Bedroom', 'slug' => 'bedroom', 'image' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=300&h=350&fit=crop', 'count' => 'Beds & nightstands'],
                    ['name' => 'Decor Accessories', 'slug' => 'decor', 'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=300&h=350&fit=crop', 'count' => 'Vases & ornaments'],
                ];
            @endphp
            
            @foreach($collections as $collection)
            <a href="{{ route('products.index', ['category' => $collection['slug']]) }}" class="group relative h-80 rounded-2xl overflow-hidden shadow-md block" data-aos="fade-up">
                <img src="{{ $collection['image'] }}" 
                     alt="{{ $collection['name'] }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                     onerror="this.src='https://placehold.co/300x350/8B5E3C/white?text={{ urlencode($collection['name']) }}'">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                    <h3 class="text-xl font-bold mb-1">{{ $collection['name'] }}</h3>
                    <p class="text-gray-200 text-sm">{{ $collection['count'] }}</p>
                    <span class="inline-flex items-center gap-2 mt-3 text-brown-400 hover:text-brown-300 transition">
                        Shop Now <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest Arrivals -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider">Fresh designs</span>
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-gray-800 mt-2">Latest Arrivals</h2>
            <div class="w-20 h-1 bg-brown-600 mx-auto rounded-full mt-4"></div>
            <p class="text-gray-600 mt-4">Just added to our collection</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $latest = [
                    ['id' => 5, 'name' => 'Elegant Armchair', 'slug' => 'elegant-armchair', 'price' => 2450000, 'desc' => 'Premium velvet armchair with golden legs - perfect for modern living rooms', 'image' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=400&h=300&fit=crop'],
                    ['id' => 6, 'name' => 'Ceramic Vases Set', 'slug' => 'ceramic-vases-set', 'price' => 350000, 'desc' => 'Handcrafted ceramic vases - set of 3 beautiful pieces', 'image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=400&h=300&fit=crop'],
                    ['id' => 7, 'name' => 'Bookshelf Cabinet', 'slug' => 'bookshelf-cabinet', 'price' => 1850000, 'desc' => 'Modern wooden bookshelf with storage - perfect for home office', 'image' => 'https://images.unsplash.com/photo-1594620302204-9a762235a723?w=400&h=300&fit=crop'],
                ];
            @endphp
            
            @foreach($latest as $item)
            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition group" data-aos="fade-up">
                <a href="{{ url('/products/' . $item['slug']) }}" class="block">
                    <div class="h-56 overflow-hidden">
                        <img src="{{ $item['image'] }}" 
                             alt="{{ $item['name'] }}"
                             class="w-full h-full object-cover hover:scale-105 transition duration-500"
                             onerror="this.src='https://placehold.co/400x300/8B5E3C/white?text={{ urlencode($item['name']) }}'">
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 text-lg">{{ $item['name'] }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $item['desc'] }}</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-brown-600 font-bold text-xl">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                </a>
                <div class="px-5 pb-5">
                    <button onclick="addToCart({{ $item['id'] }}, '{{ addslashes($item['name']) }}', {{ $item['price'] }}, '{{ $item['image'] }}', 1)" 
                            class="w-full bg-gray-800 text-white px-4 py-2 rounded-xl hover:bg-brown-600 transition text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-brown-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Subscribe to Our Newsletter</h2>
        <p class="text-brown-100 mb-8">Get exclusive deals and updates on new arrivals</p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
            <input type="email" placeholder="Your email address" class="flex-1 px-5 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
            <button type="submit" class="bg-white text-brown-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Subscribe</button>
        </form>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="text-brown-600 font-semibold text-sm uppercase tracking-wider">Get In Touch</span>
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-gray-800 mt-2">Contact Us</h2>
            <div class="w-20 h-1 bg-brown-600 mx-auto rounded-full mt-4"></div>
            <p class="text-gray-600 mt-4">We'd love to hear from you</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div data-aos="fade-right">
                <div class="space-y-6">
                    <!-- Alamat -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-brown-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Visit Us</h3>
                            <p class="text-gray-600">
                                Jl. Raya Jepara KM 2, No. 88<br>
                                Desa Mlonggo, Kecamatan Mlonggo<br>
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
                            <h3 class="text-lg font-semibold text-gray-800">WhatsApp</h3>
                            <p class="text-gray-600">
                                <a href="https://wa.me/6283831520933" target="_blank" class="text-green-600 hover:underline">
                                    +62 838 3152 0933
                                </a>
                                <br><span class="text-sm text-gray-500">Klik untuk chat langsung</span>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Telepon -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-brown-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Call Us</h3>
                            <p class="text-gray-600">
                                +62 838 3152 0933 (Admin)<br>
                                +62 831 3875 6049 (Owner)
                            </p>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-brown-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Email Us</h3>
                            <p class="text-gray-600">
                                kianafurniture@gmail.com<br>
                                cs@kianafurniture.com
                            </p>
                        </div>
                    </div>
                    
                    <!-- Jam Operasional -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-brown-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-brown-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Business Hours</h3>
                            <p class="text-gray-600">
                                Senin - Sabtu: 08.00 - 17.00<br>
                                Minggu & Hari Besar: Tutup
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Follow Us</h3>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center hover:bg-brown-600 hover:text-white transition text-brown-600"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center hover:bg-brown-600 hover:text-white transition text-brown-600"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center hover:bg-brown-600 hover:text-white transition text-brown-600"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#" class="w-10 h-10 bg-brown-100 rounded-full flex items-center justify-center hover:bg-brown-600 hover:text-white transition text-brown-600"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div data-aos="fade-left">
                <form action="#" method="POST" class="bg-gray-50 rounded-2xl p-6 shadow-md">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                            <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-brown-600">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" name="subject" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                        <textarea name="message" rows="5" required class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-brown-600 text-white py-3 rounded-lg font-semibold hover:bg-brown-700 transition">
                        Send Message <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection