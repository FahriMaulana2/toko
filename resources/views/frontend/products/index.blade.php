@extends('layouts.app')

@section('title', 'Products - Kiana Furniture')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold mb-8">Our Products</h1>

    <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    </div>
</div>

<script>
const productsData = @json($products ?? []);

function getImageUrl(p) {
    // ✅ kalau dari unsplash / url langsung
    if (p.image && p.image.startsWith('http')) {
        return p.image;
    }

    // ✅ kalau dari upload laravel
    if (p.image) {
        return '/storage/' + p.image;
    }

    // ✅ fallback
    return 'https://placehold.co/300x300?text=No+Image';
}

function displayProducts(products) {
    const grid = document.getElementById('products-grid');

    if (!products || products.length === 0) {
        grid.innerHTML = '<p>Tidak ada produk</p>';
        return;
    }

    let html = '';

    products.forEach(p => {

        const imageUrl = getImageUrl(p);

        html += `
        <div class="bg-white shadow rounded overflow-hidden">
            <a href="/products/${p.slug}">
                <img src="${imageUrl}" 
                     class="w-full h-60 object-cover"
                     onerror="this.src='https://placehold.co/300x300?text=Error'">
            </a>

            <div class="p-4">
                <h3 class="font-bold text-lg">${p.name}</h3>
                <p class="text-brown-600 font-bold">
                    Rp ${Number(p.price).toLocaleString('id-ID')}
                </p>
            </div>
        </div>
        `;
    });

    grid.innerHTML = html;
}

// 🚨 WAJIB biar tidak blank
document.addEventListener('DOMContentLoaded', function () {
    displayProducts(productsData);
});
</script>
@endsection