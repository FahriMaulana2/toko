<script>
const productsData = @json($products);

function displayProducts(products) {
    const grid = document.getElementById('products-grid');
    let html = '';

    products.forEach(p => {

        // ✅ FIX GAMBAR FINAL
        let imageUrl = '';

        if (p.image) {
            if (p.image.startsWith('http')) {
                imageUrl = p.image;
            } else {
                imageUrl = `/storage/${p.image}`;
            }
        } else {
            imageUrl = `https://placehold.co/300x300/8B5E3C/white?text=${encodeURIComponent(p.name)}`;
        }

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