@extends('layouts.app')

@section('title', 'Products - Kiana Furniture')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-8">Our Products</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <h3 class="text-lg font-semibold mb-4">Filters</h3>
                
                <input type="text" id="search-input" placeholder="Search..." class="w-full border px-3 py-2 mb-4">
                
                <select id="category-select" class="w-full border px-3 py-2 mb-4">
                    <option value="all">All</option>
                    <option value="living-room">Living Room</option>
                    <option value="bedroom">Bedroom</option>
                    <option value="office">Office</option>
                </select>
            </div>
        </div>
        
        <!-- Products -->
        <div class="lg:col-span-3">
            <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
        </div>
    </div>
</div>

<script>
const productsData = @json($products);

function displayProducts(products) {
    const grid = document.getElementById('products-grid');

    let html = '';

    products.forEach(p => {

        // ✅ FIX GAMBAR (INI YANG PENTING)
        let imageUrl = p.image 
            ? `/storage/${p.image}` 
            : `https://placehold.co/300x300/8B5E3C/white?text=${encodeURIComponent(p.name)}`;

        html += `
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <a href="/products/${p.slug}">
                <img src="${imageUrl}" 
                     class="w-full h-60 object-cover"
                     onerror="this.src='https://placehold.co/300x300/8B5E3C/white?text=${encodeURIComponent(p.name)}'">
            </a>
            <div class="p-4">
                <h3 class="font-bold">${p.name}</h3>
                <p class="text-brown-600 font-bold">
                    Rp ${Number(p.price).toLocaleString('id-ID')}
                </p>
            </div>
        </div>
        `;
    });

    grid.innerHTML = html;
}

document.addEventListener('DOMContentLoaded', function() {
    displayProducts(productsData);
});
</script>
@endsection