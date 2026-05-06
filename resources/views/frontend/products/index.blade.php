@extends('layouts.app')

@section('title', 'Checkout - Kiana Furniture')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-12">

    <h1 class="text-3xl font-bold mb-8">
        Checkout
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- FORM -->
        <div class="lg:col-span-2">

            <form id="checkoutForm" class="bg-white shadow rounded p-6 space-y-5">

                <!-- FULLNAME -->
                <div>
                    <label class="block mb-2 font-semibold">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="fullname"
                        name="fullname"
                        class="w-full border rounded px-4 py-3"
                        required
                    >
                </div>

                <!-- PHONE -->
                <div>
                    <label class="block mb-2 font-semibold">
                        Phone
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="w-full border rounded px-4 py-3"
                        required
                    >
                </div>

                <!-- ADDRESS -->
                <div>
                    <label class="block mb-2 font-semibold">
                        Address
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        class="w-full border rounded px-4 py-3"
                        required
                    ></textarea>
                </div>

                <!-- CITY -->
                <div>
                    <label class="block mb-2 font-semibold">
                        City
                    </label>

                    <input
                        type="text"
                        id="city"
                        name="city"
                        class="w-full border rounded px-4 py-3"
                        required
                    >
                </div>

                <!-- POSTAL -->
                <div>
                    <label class="block mb-2 font-semibold">
                        Postal Code
                    </label>

                    <input
                        type="text"
                        id="postal_code"
                        name="postal_code"
                        class="w-full border rounded px-4 py-3"
                        required
                    >
                </div>

                <!-- COURIER -->
                <div>
                    <label class="block mb-2 font-semibold">
                        Courier
                    </label>

                    <select
                        id="courier"
                        name="courier"
                        class="w-full border rounded px-4 py-3"
                        required
                    >
                        <option value="">Choose Courier</option>
                        <option value="JNE">JNE</option>
                        <option value="J&T">J&T</option>
                        <option value="SiCepat">SiCepat</option>
                        <option value="AnterAja">AnterAja</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-black text-white py-4 rounded hover:bg-gray-800 transition"
                >
                    Checkout via WhatsApp
                </button>

            </form>

        </div>

        <!-- ORDER SUMMARY -->
        <div>

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-xl font-bold mb-6">
                    Order Summary
                </h2>

                <div id="cart-items" class="space-y-4 mb-6"></div>

                <hr class="mb-4">

                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span id="subtotal">Rp 0</span>
                </div>

                <div class="flex justify-between mb-2">
                    <span>Shipping</span>
                    <span id="shipping">Rp 20.000</span>
                </div>

                <div class="flex justify-between text-lg font-bold">
                    <span>Total</span>
                    <span id="grandtotal">Rp 0</span>
                </div>

            </div>

        </div>

    </div>

</div>

<script>

function formatRupiah(number) {

    return new Intl.NumberFormat('id-ID').format(number);
}

function renderCart() {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    console.log('Cart loaded:', cart);

    const cartItems = document.getElementById('cart-items');

    let subtotal = 0;

    cartItems.innerHTML = '';

    if(cart.length === 0){

        cartItems.innerHTML = `
            <p class="text-gray-500">
                Cart kosong
            </p>
        `;

        return;
    }

    cart.forEach(item => {

        subtotal += item.price * item.quantity;

        cartItems.innerHTML += `
            <div class="flex gap-4 items-center">

                <img
                    src="${item.image}"
                    class="w-16 h-16 object-cover rounded"
                >

                <div class="flex-1">
                    <h4 class="font-semibold">
                        ${item.name}
                    </h4>

                    <p class="text-sm text-gray-500">
                        Qty: ${item.quantity}
                    </p>
                </div>

                <div class="font-bold">
                    Rp ${formatRupiah(item.price * item.quantity)}
                </div>

            </div>
        `;
    });

    const shipping = 20000;

    const grandTotal = subtotal + shipping;

    document.getElementById('subtotal').innerText =
        'Rp ' + formatRupiah(subtotal);

    document.getElementById('grandtotal').innerText =
        'Rp ' + formatRupiah(grandTotal);
}

document.addEventListener('DOMContentLoaded', function () {

    renderCart();

    const checkoutForm = document.getElementById('checkoutForm');

    checkoutForm.addEventListener('submit', async function(e) {

        e.preventDefault();

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        console.log('Cart checkout:', cart);

        if(cart.length === 0){

            alert('Cart kosong');

            return;
        }

        const formData = {

            fullname: document.getElementById('fullname').value,

            phone: document.getElementById('phone').value,

            address: document.getElementById('address').value,

            city: document.getElementById('city').value,

            postal_code: document.getElementById('postal_code').value,

            courier: document.getElementById('courier').value,

            cart: cart
        };

        console.log('Data dikirim:', formData);

        try {

            const response = await fetch('/checkout', {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },

                body: JSON.stringify(formData)
            });

            const result = await response.json();

            console.log('Response Laravel:', result);

            if(result.success){

                alert('Order berhasil disimpan!');

                localStorage.removeItem('cart');

                // WhatsApp message
                const waText =
                    `Halo Admin, saya ingin order furniture.%0A%0A` +
                    `No Order: ${result.order_number}%0A` +
                    `Total: Rp ${result.total}`;

                // GANTI nomor admin di bawah
                window.open(
                    `https://wa.me/6281234567890?text=${waText}`,
                    '_blank'
                );

                window.location.href = '/';

            } else {

                alert(result.message || 'Order gagal');
            }

        } catch(error){

            console.error(error);

            alert('Terjadi kesalahan checkout');
        }

    });

});

</script>

@endsection