@extends('layouts.app')

@section('title', 'Checkout - Kiana Furniture')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-8">Checkout</h1>
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Shipping Information -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Full Name *</label>
                <input type="text" id="fullname" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:border-brown-600">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Phone Number *</label>
                <input type="tel" id="phone" class="w-full border rounded-lg px-4 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Address *</label>
                <textarea id="address" rows="3" class="w-full border rounded-lg px-4 py-2"></textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1">City *</label>
                    <input type="text" id="city" class="w-full border rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Postal Code *</label>
                    <input type="text" id="postal_code" class="w-full border rounded-lg px-4 py-2">
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Courier *</label>
                <select id="courier" class="w-full border rounded-lg px-4 py-2">
                    <option value="JNE">JNE (Rp 20,000)</option>
                    <option value="J&T">J&T Express (Rp 18,000)</option>
                    <option value="SiCepat">SiCepat (Rp 15,000)</option>
                </select>
            </div>
        </div>
        
        <!-- Order Summary & Payment -->
        <div>
            <!-- Order Summary -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div id="order-summary">
                    <div class="text-center py-4">Loading cart data...</div>
                </div>
            </div>
            
            <!-- WhatsApp Checkout Button -->
            <div class="bg-green-50 rounded-xl shadow-md p-6 border border-green-200">
                <div class="text-center mb-4">
                    <i class="fab fa-whatsapp text-5xl text-green-500 mb-2"></i>
                    <h2 class="text-xl font-semibold text-gray-800">Konfirmasi via WhatsApp</h2>
                    <p class="text-gray-500 text-sm mt-1">Kirim pesanan Anda melalui WhatsApp untuk konfirmasi</p>
                </div>
                
                <button id="whatsapp-checkout" class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition flex items-center justify-center gap-2">
                    <i class="fab fa-whatsapp text-xl"></i> Kirim ke WhatsApp
                </button>
                
                <p class="text-xs text-gray-400 text-center mt-3">
                    Pesanan akan dikirim ke nomor admin untuk diproses
                </p>
            </div>
        </div>
    </div>
    
    <div class="mt-8">
        <a href="{{ route('cart.index') }}" class="text-brown-600 hover:underline">
            ← Back to Cart
        </a>
    </div>
</div>

<script>
const ADMIN_PHONE = '6281234567890';

document.getElementById('whatsapp-checkout').addEventListener('click', async function() {

    const fullname = document.getElementById('fullname').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const city = document.getElementById('city').value.trim();
    const postalCode = document.getElementById('postal_code').value.trim();
    const courier = document.getElementById('courier').value;

    if (!fullname || !phone || !address || !city || !postalCode) {
        alert('Harap lengkapi semua data!');
        return;
    }

    const cart = JSON.parse(localStorage.getItem('kiana_cart') || '[]');
    if (cart.length === 0) {
        alert('Keranjang kosong!');
        return;
    }

    // 🔥 KIRIM KE DATABASE
    const response = await fetch('/checkout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            fullname,
            phone,
            address,
            city,
            postal_code: postalCode,
            courier,
            cart
        })
    });

    const result = await response.json();

    // 🔥 BUAT PESAN WA
    let message = '*ORDER BARU*%0A%0A';
    message += `Nama: ${fullname}%0A`;
    message += `HP: ${phone}%0A`;
    message += `Alamat: ${address}%0A%0A`;

    cart.forEach((item, i) => {
        message += `${i+1}. ${item.name} x ${item.quantity}%0A`;
    });

    message += `%0ATotal: Rp ${result.total}`;

    // 🔥 KIRIM WA
    window.open(`https://wa.me/${ADMIN_PHONE}?text=${message}`, '_blank');

    // 🔥 CLEAR CART
    localStorage.removeItem('kiana_cart');

    window.location.href = '/';
});
</script>
@endsection
  