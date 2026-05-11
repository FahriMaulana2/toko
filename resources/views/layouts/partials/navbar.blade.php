<nav x-data="{ mobileMenuOpen: false, searchOpen: false }" class="fixed top-0 left-0 w-full bg-white/98 backdrop-blur-md shadow-md z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-brown-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition">
                    <i class="fas fa-chair text-white text-xl"></i>
                </div>
                <span class="text-2xl font-playfair font-bold text-gray-800">Kiana<span class="text-brown-600">Furniture</span></span>
            </a>
            
            <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center space-x-1">
             <a href="{{ url('/') }}"
              class="px-4 py-2 text-gray-700 hover:text-brown-600 hover:bg-brown-50 rounded-lg transition font-medium">
              Home
            </a>

            <a href="{{ route('products.index') }}"
              class="px-4 py-2 text-gray-700 hover:text-brown-600 hover:bg-brown-50 rounded-lg transition font-medium">
              Products
            </a>

           <a href="{{ url('/#company-history') }}"
               class="px-4 py-2 text-gray-700 hover:text-brown-600 hover:bg-brown-50 rounded-lg transition font-medium">
               Company History
            </a>
             <a href="{{ url('/#contact') }}"
               class="px-4 py-2 text-gray-700 hover:text-brown-600 hover:bg-brown-50 rounded-lg transition font-medium">
               Contact
            </a>
        </div>
            <!-- Search Bar (Desktop) -->
            <div class="hidden lg:flex flex-1 max-w-md mx-8">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="search-input-desktop" placeholder="Search furniture..." class="w-full pl-11 pr-4 py-2.5 border border-gray-200 rounded-full focus:outline-none focus:border-brown-600 focus:ring-2 focus:ring-brown-100 transition bg-gray-50">
                </div>
            </div>
            
            <!-- Right Icons (TANPA DUPLIKASI) -->
            <div class="flex items-center space-x-3">
                <!-- Search Button Mobile -->
                <button @click="searchOpen = !searchOpen" class="lg:hidden p-2 text-gray-600 hover:text-brown-600 rounded-full hover:bg-gray-100 transition">
                    <i class="fas fa-search text-xl"></i>
                </button>
                
                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-brown-600 rounded-full hover:bg-gray-100 transition">
                    <i class="fas fa-shopping-bag text-xl"></i>
                    <span id="cart-badge" class="absolute -top-1 -right-1 bg-brown-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold hidden">0</span>
                </a>
                
                <!-- User Menu -->
                @auth
                <div class="relative group">
                    <button class="p-2 text-gray-600 hover:text-brown-600 rounded-full hover:bg-gray-100 transition">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </button>
                    <div class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 overflow-hidden">
                        <div class="p-4 border-b bg-gray-50">
                            <p class="font-medium text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('my.orders') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-brown-50 hover:text-brown-600 transition">
                                <i class="fas fa-box w-5"></i> My Orders
                            </a>
                            
                            <!-- Menu Admin (hanya untuk user dengan is_admin = true) -->
                            @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-brown-50 hover:text-brown-600 transition">
                                <i class="fas fa-tachometer-alt w-5"></i> Admin Dashboard
                            </a>
                            <hr class="my-1">
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 px-4 py-2.5 w-full text-left text-red-600 hover:bg-red-50 transition">
                                    <i class="fas fa-sign-out-alt w-5"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="px-5 py-2 bg-brown-600 text-white rounded-full hover:bg-brown-700 transition text-sm font-medium shadow-md">
                    <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                </a>
                @endauth
                
                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-600 hover:text-brown-600 rounded-full hover:bg-gray-100 transition">
                    <i x-show="!mobileMenuOpen" class="fas fa-bars text-xl"></i>
                    <i x-show="mobileMenuOpen" class="fas fa-times text-xl" style="display: none;"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Search Drawer -->
        <div x-show="searchOpen" x-cloak class="lg:hidden py-4 border-t border-gray-100" style="display: none;">
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="search-input-mobile" placeholder="Search furniture..." class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-brown-600 focus:ring-2 focus:ring-brown-100 transition">
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak class="lg:hidden py-4 border-t border-gray-100" style="display: none;">
        <div class="flex flex-col space-y-2">

        <a href="{{ url('/') }}"
           class="px-4 py-3 text-gray-700 hover:bg-brown-50 hover:text-brown-600 rounded-xl transition">
            Home
        </a>

        <a href="{{ route('products.index') }}"
           class="px-4 py-3 text-gray-700 hover:bg-brown-50 hover:text-brown-600 rounded-xl transition">
            Products
        </a>

        <a href="{{ url('/#company-history') }}"
           class="px-4 py-3 text-gray-700 hover:bg-brown-50 hover:text-brown-600 rounded-xl transition">
            Company History
        </a>

        <a href="{{ url('/#contact') }}"
           class="px-4 py-3 text-gray-700 hover:bg-brown-50 hover:text-brown-600 rounded-xl transition">
            Contact
        </a>
                
                <!-- Admin Menu di Mobile (jika login sebagai admin) -->
                @auth
                    @if(auth()->user()->is_admin)
                    <div class="border-t border-gray-100 pt-2 mt-2">
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-3 text-brown-600 hover:bg-brown-50 rounded-xl transition flex items-center gap-2">
                            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                        </a>
                    </div>
                    @endif
                @endauth
                
                <hr class="my-2">
                @guest
                <a href="{{ route('login') }}" class="px-4 py-3 bg-brown-600 text-white text-center rounded-xl">Sign In</a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Spacer -->
<div class="h-20"></div>

<style>
    [x-cloak] { display: none !important; }
</style>

<script>
    // Search functionality
    function performSearch() {
        const query = document.getElementById('search-input-desktop')?.value || document.getElementById('search-input-mobile')?.value;
        if (query && query.length > 0) {
            window.location.href = '{{ route("products.index") }}?search=' + encodeURIComponent(query);
        }
    }
    
    document.getElementById('search-input-desktop')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') performSearch();
    });
    document.getElementById('search-input-mobile')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') performSearch();
    });
</script>