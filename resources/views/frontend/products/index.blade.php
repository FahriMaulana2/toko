@extends('layouts.app')

@section('title', 'Products - Kiana Furniture')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-8">Our Products</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filter -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h3 class="text-lg font-semibold mb-4">Filters</h3>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Search</label>
                    <input type="text" id="search-input" placeholder="Search products..." class="w-full border rounded-lg px-4 py-2">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Category</label>
                    <select id="category-select" class="w-full border rounded-lg px-4 py-2">
                        <option value="all">All Products</option>
                        <option value="living-room">Living Room</option>
                        <option value="bedroom">Bedroom</option>
                        <option value="office">Home Office</option>
                        <option value="decor">Decor</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Price Range</label>
                    <select id="price-select" class="w-full border rounded-lg px-4 py-2">
                        <option value="all">All Prices</option>
                        <option value="0-500000">Under Rp 500k</option>
                        <option value="500000-1000000">Rp 500k - 1jt</option>
                        <option value="1000000-3000000">Rp 1jt - 3jt</option>
                        <option value="3000000+">Above Rp 3jt</option>
                    </select>
                </div>
                
                <button onclick="resetFilters()" class="w-full bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 transition">
                    Reset Filters
                </button>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="lg:col-span-3">
            <div class="flex justify-between items-center mb-6">
                <p id="product-count" class="text-gray-500">Loading products...</p>
                <select id="sort-select" class="border rounded-lg px-4 py-2">
                    <option value="latest">Newest First</option>
                    <option value="price_low">Price: Low to High</option>
                    <option value="price_high">Price: High to Low</option>
                </select>
            </div>
            
            <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Products will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Data produk dari database (di-passing dari controller)
const productsData = @json($products);

function displayProducts(products) {
    const grid = document.getElementById('products-grid');
    const count = document.getElementById('product-count');
    
    if (products.length === 0) {
        grid.innerHTML = '<div class="col-span-3 text-center py-12">No products found</div>';
        count.innerHTML = 'Showing 0 of 0 products';
        return;
    }
    
    count.innerHTML = `Showing ${products.length} of ${products.length} products`;
    
    let html = '';
    for (let i = 0; i < products.length; i++) {
        const p = products[i];
        const rating = (Math.random() * 1.5 + 3.5).toFixed(1);
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 >= 0.5;
        
        // Tentukan URL gambar
        let imageUrl = p.image;
        if (imageUrl && !imageUrl.startsWith('http') && !imageUrl.startsWith('/')) {
            imageUrl = '/storage/' + imageUrl;
        }
        if (!imageUrl) {
            imageUrl = 'https://placehold.co/300x300/8B5E3C/white?text=' + encodeURIComponent(p.name);
        }
        
        html += `
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                <a href="/products/${p.slug}" class="block">
                    <div class="relative h-64 overflow-hidden">
                        <img src="${imageUrl}" alt="${p.name}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.src='https://placehold.co/300x300/8B5E3C/white?text=${encodeURIComponent(p.name)}'">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-1 mb-2">
                            ${generateStars(rating)}
                            <span class="text-gray-500 text-xs ml-2">(${Math.floor(Math.random() * 100) + 20} reviews)</span>
                        </div>
                        <h3 class="font-semibold text-gray-800 text-lg mb-1">${p.name}</h3>
                        <p class="text-brown-600 font-bold text-xl">Rp ${p.price.toLocaleString('id-ID')}</p>
                    </div>
                </a>
                <div class="px-4 pb-4">
                    <button onclick="addToCart(${p.id}, '${p.name.replace(/'/g, "\\'")}', ${p.price}, '${imageUrl}', 1)" 
                            class="w-full bg-gray-800 text-white py-2 rounded-xl hover:bg-brown-600 transition flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
        `;
    }
    
    grid.innerHTML = html;
}

function generateStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= Math.floor(rating)) {
            stars += '<i class="fas fa-star text-yellow-400 text-sm"></i>';
        } else if (i - 0.5 <= rating) {
            stars += '<i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>';
        } else {
            stars += '<i class="far fa-star text-yellow-400 text-sm"></i>';
        }
    }
    return stars;
}

function filterProducts() {
    const search = document.getElementById('search-input').value.toLowerCase();
    const category = document.getElementById('category-select').value;
    const priceRange = document.getElementById('price-select').value;
    const sort = document.getElementById('sort-select').value;
    
    let filtered = [...productsData];
    
    if (search) {
        filtered = filtered.filter(p => p.name.toLowerCase().includes(search));
    }
    
    if (category !== 'all') {
        filtered = filtered.filter(p => p.category === category);
    }
    
    if (priceRange !== 'all') {
        if (priceRange === '0-500000') {
            filtered = filtered.filter(p => p.price < 500000);
        } else if (priceRange === '500000-1000000') {
            filtered = filtered.filter(p => p.price >= 500000 && p.price <= 1000000);
        } else if (priceRange === '1000000-3000000') {
            filtered = filtered.filter(p => p.price >= 1000000 && p.price <= 3000000);
        } else if (priceRange === '3000000+') {
            filtered = filtered.filter(p => p.price > 3000000);
        }
    }
    
    if (sort === 'price_low') {
        filtered.sort((a, b) => a.price - b.price);
    } else if (sort === 'price_high') {
        filtered.sort((a, b) => b.price - a.price);
    }
    
    displayProducts(filtered);
}

function resetFilters() {
    document.getElementById('search-input').value = '';
    document.getElementById('category-select').value = 'all';
    document.getElementById('price-select').value = 'all';
    document.getElementById('sort-select').value = 'latest';
    filterProducts();
}

// Event listeners
document.getElementById('search-input').addEventListener('input', filterProducts);
document.getElementById('category-select').addEventListener('change', filterProducts);
document.getElementById('price-select').addEventListener('change', filterProducts);
document.getElementById('sort-select').addEventListener('change', filterProducts);

// Initial load
document.addEventListener('DOMContentLoaded', function() {
    filterProducts();
});
</script>
@endsection