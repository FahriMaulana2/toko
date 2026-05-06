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
// Nomor WhatsApp Admin (GANTI DENGAN NOMOR ANDA)
const ADMIN_PHONE = '6283831520933'; // Contoh: 6281234567890 (tanpa +62, pakai 62)

function loadOrderSummary() {
    const cart = JSON.parse(localStorage.getItem('kiana_cart') || '[]');
    const container = document.getElementById('order-summary');
    
    if (cart.length === 0) {
        container.innerHTML = '<div class="text-center py-4 text-red-500">Your cart is empty! Please add products first.</div>';
        return;
    }
    
    let subtotal = 0;
    let itemsList = '';
    
    for (let i = 0; i < cart.length; i++) {
        const item = cart[i];
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        itemsList += `- ${item.name} x ${item.quantity} = Rp ${itemTotal.toLocaleString('id-ID')}\n`;
    }
    
    const shipping = 20000;
    const total = subtotal + shipping;
    
    let html = `
        <div class="space-y-3">
            ${cart.map(item => `
                <div class="flex justify-between text-sm">
                    <span>${item.name} x ${item.quantity}</span>
                    <span>Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                </div>
            `).join('')}
            <div class="border-t pt-3 mt-3">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                </div>
                <div class="flex justify-between mt-2">
                    <span>Shipping</span>
                    <span>Rp ${shipping.toLocaleString('id-ID')}</span>
                </div>
                <div class="border-t mt-3 pt-3">
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span class="text-brown-600">Rp ${total.toLocaleString('id-ID')}</span>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.innerHTML = html;
    
    // Simpan data untuk WhatsApp
    window.checkoutData = {
        items: cart,
        subtotal: subtotal,
        shipping: shipping,
        total: total,
        itemsList: itemsList
    };
}

document.getElementById('whatsapp-checkout').addEventListener('click', function() {
    // Ambil data dari form
    const fullname = document.getElementById('fullname').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const city = document.getElementById('city').value.trim();
    const postalCode = document.getElementById('postal_code').value.trim();
    const courier = document.getElementById('courier').value;
    
    // Validasi
    if (!fullname) {
        alert('Silakan isi Nama Lengkap');
        document.getElementById('fullname').focus();
        return;
    }
    if (!phone) {
        alert('Silakan isi Nomor Telepon');
        document.getElementById('phone').focus();
        return;
    }
    if (!address) {
        alert('Silakan isi Alamat');
        document.getElementById('address').focus();
        return;
    }
    if (!city) {
        alert('Silakan isi Kota');
        document.getElementById('city').focus();
        return;
    }
    if (!postalCode) {
        alert('Silakan isi Kode Pos');
        document.getElementById('postal_code').focus();
        return;
    }
    
    const cart = JSON.parse(localStorage.getItem('kiana_cart') || '[]');
    if (cart.length === 0) {
        alert('Keranjang belanja kosong!');
        return;
    }
    
    // Buat pesan WhatsApp
    let message = '*🛍️ ORDER BARU DARI KIANA FURNITURE*%0A%0A';
    message += '*📋 DETAIL PEMESAN:*%0A';
    message += `Nama: ${fullname}%0A`;
    message += `No. HP: ${phone}%0A`;
    message += `Alamat: ${address}%0A`;
    message += `Kota: ${city}%0A`;
    message += `Kode Pos: ${postalCode}%0A`;
    message += `Kurir: ${courier}%0A%0A`;
    
    message += '*🛒 PRODUK YANG DIPESAN:*%0A';
    for (let i = 0; i < cart.length; i++) {
        const item = cart[i];
        message += `${i+1}. ${item.name} - ${item.quantity} x Rp ${item.price.toLocaleString('id-ID')} = Rp ${(item.price * item.quantity).toLocaleString('id-ID')}%0A`;
    }
    
    message += '%0A*💰 RINCIAN PEMBAYARAN:*%0A';
    message += `Subtotal: Rp ${window.checkoutData.subtotal.toLocaleString('id-ID')}%0A`;
    message += `Ongkos Kirim: Rp ${window.checkoutData.shipping.toLocaleString('id-ID')}%0A`;
    message += `Total: Rp ${window.checkoutData.total.toLocaleString('id-ID')}%0A%0A`;
    
    message += '*📝 CATATAN:*%0A';
    message += 'Mohon segera diproses. Terima kasih.%0A%0A';
    message += '_Pesan ini dikirim dari website Kiana Furniture_';
    
    // Buat URL WhatsApp
    const whatsappUrl = `https://wa.me/${ADMIN_PHONE}?text=${message}`;
    
    // Buka WhatsApp
    window.open(whatsappUrl, '_blank');
    
    // Optional: Clear cart setelah order
    if (confirm('Pesanan sudah dikirim? Keranjang akan dikosongkan.')) {
        localStorage.removeItem('kiana_cart');
        updateCartBadge();
        setTimeout(() => {
            window.location.href = '/';
        }, 1000);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    loadOrderSummary();
    updateCartBadge();
});

function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('kiana_cart') || '[]');
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    const badge = document.getElementById('cart-badge');
    if (badge) {
        if (count > 0) {
            badge.textContent = count;
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }
    }
}
</script>
@endsection