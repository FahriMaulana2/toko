@extends('layouts.app')

@section('title', 'Checkout - Kiana Furniture')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-16">
    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-8">Checkout</h1>
    
    <form id="checkout-form" method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Shipping Information -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Full Name *</label>
                    <input type="text" name="recipient_name" required class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:border-brown-600">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Phone Number *</label>
                    <input type="tel" name="phone" required class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:border-brown-600">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Address *</label>
                    <textarea name="address" rows="3" required class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:border-brown-600"></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">City *</label>
                        <input type="text" name="city" required class="w-full border rounded-lg px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Postal Code *</label>
                        <input type="text" name="postal_code" required class="w-full border rounded-lg px-4 py-2">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Courier *</label>
                    <select name="courier" required class="w-full border rounded-lg px-4 py-2">
                        <option value="jne">JNE (Rp 20,000)</option>
                        <option value="jnt">J&T Express (Rp 18,000)</option>
                        <option value="sicepat">SiCepat (Rp 15,000)</option>
                    </select>
                </div>
            </div>
            
            <!-- Payment & Order Summary -->
            <div>
                <!-- Order Summary -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div id="order-summary">
                        <div class="text-center py-4">Loading cart data...</div>
                    </div>
                </div>
                
                <!-- Payment Information -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Payment Information</h2>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Bank Transfer *</label>
                        <select name="bank_name" required class="w-full border rounded-lg px-4 py-2">
                            <option value="bca">BCA - 1234567890 a.n Kiana Furniture</option>
                            <option value="bri">BRI - 9876543210 a.n Kiana Furniture</option>
                            <option value="mandiri">Mandiri - 5555555555 a.n Kiana Furniture</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Account Name *</label>
                        <input type="text" name="account_name" required class="w-full border rounded-lg px-4 py-2" placeholder="Nama pemilik rekening">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Upload Payment Proof *</label>
                        <input type="file" name="payment_proof" accept="image/*" required class="w-full border rounded-lg px-4 py-2">
                        <p class="text-xs text-gray-500 mt-1">Upload screenshot bukti transfer (max 2MB)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8 flex justify-between">
            <a href="{{ route('cart.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                ← Back to Cart
            </a>
            <button type="submit" class="bg-brown-600 text-white px-8 py-3 rounded-lg hover:bg-brown-700 transition">
                Place Order
            </button>
        </div>
    </form>
</div>

<script>
function loadOrderSummary() {
    const cart = JSON.parse(localStorage.getItem('kiana_cart') || '[]');
    const container = document.getElementById('order-summary');
    
    if (cart.length === 0) {
        container.innerHTML = '<div class="text-center py-4 text-red-500">Your cart is empty! Please add products first.</div>';
        return;
    }
    
    let subtotal = 0;
    let html = '<div class="space-y-3">';
    
    for (let i = 0; i < cart.length; i++) {
        const item = cart[i];
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        html += `
            <div class="flex justify-between text-sm">
                <span>${item.name} x ${item.quantity}</span>
                <span>Rp ${itemTotal.toLocaleString('id-ID')}</span>
            </div>
        `;
    }
    
    const shipping = 20000;
    const total = subtotal + shipping;
    
    html += `
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
    `;
    
    container.innerHTML = html;
}

document.addEventListener('DOMContentLoaded', function() {
    loadOrderSummary();
});
</script>
@endsection