<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kiana Furniture') - Premium Scandinavian Furniture</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brown': { 500: '#8B5E3C', 600: '#7a5235' },
                        'gold': { 400: '#C6A43F' }
                    },
                    fontFamily: {
                        'playfair': ['Playfair Display', 'serif'],
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    @stack('styles')
</head>

<body class="font-inter antialiased bg-white">
    
    <div id="app">
        @include('layouts.partials.navbar')
        
        <main class="min-h-screen">
            @yield('content')
        </main>
        
        @include('layouts.partials.footer')
        
        <button id="back-to-top" class="fixed bottom-8 right-8 bg-brown-600 text-white w-12 h-12 rounded-full shadow-lg hover:bg-brown-700 transition-all duration-300 opacity-0 invisible z-40">
            <i class="fas fa-arrow-up"></i>
        </button>
        
        <div id="toast-container" class="fixed top-20 right-4 z-50 space-y-2"></div>
    </div>
    
    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- ✅ INI YANG BENAR - memanggil cart.js dari folder js -->
    <script src="{{ asset('js/cart.js') }}"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        AOS.init({ duration: 800, once: true });
        
        const backToTop = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.remove('opacity-0', 'invisible');
                backToTop.classList.add('opacity-100', 'visible');
            } else {
                backToTop.classList.add('opacity-0', 'invisible');
                backToTop.classList.remove('opacity-100', 'visible');
            }
        });
        
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded');
            if (typeof addToCart === 'function') {
                console.log('✅ addToCart function is ready');
            } else {
                console.error('❌ addToCart function NOT found!');
            }
            if (typeof updateCartBadge === 'function') {
                updateCartBadge();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>