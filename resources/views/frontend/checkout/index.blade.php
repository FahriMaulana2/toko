@extends('layouts.app')

@section('title', 'Checkout - Kiana Furniture')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-12">

    <h1 class="text-3xl font-bold mb-8">
        Checkout
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        <!-- FORM -->
        <div class="bg-white shadow rounded p-6">

            <form id="checkoutForm">

                @csrf

                <!-- FULLNAME -->
                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="fullname"
                        class="w-full border rounded px-4 py-2"
                        required
                    >

                </div>

                <!-- PHONE -->
                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        id="phone"
                        class="w-full border rounded px-4 py-2"
                        required
                    >

                </div>

                <!-- ADDRESS -->
                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Alamat
                    </label>

                    <textarea
                        id="address"
                        rows="4"
                        class="w-full border rounded px-4 py-2"
                        required
                    ></textarea>

                </div>

                <!-- CITY -->
                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Kota
                    </label>

                    <input
                        type="text"
                        id="city"
                        class="w-full border rounded px-4 py-2"
                        required
                    >

                </div>

                <!-- POSTAL -->
                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Kode Pos
                    </label>

                    <input
                        type="text"
                        id="postal_code"
                        class="w-full border rounded px-4 py-2"
                        required
                    >

                </div>

                <!-- COURIER -->
                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Courier
                    </label>

                    <select
                        id="courier"
                        class="w-full border rounded px-4 py-2"
                        required
                    >
                        <option value="JNE">JNE</option>
                        <option value="J&T">J&T</option>
                        <option value="SiCepat">SiCepat</option>
                    </select>

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-black text-white py-3 rounded hover:bg-gray-800 transition"
                >
                    Checkout via WhatsApp
                </button>

            </form>

        </div>

        <!-- CART -->
        <div class="bg-white shadow rounded p-6">

            <h2 class="text-2xl font-bold mb-6">
                Order Summary
            </h2>

            <!-- CART ITEMS -->
            <div id="cart-items"></div>

            <!-- TOTAL -->
            <div class="mt-6 border-t pt-4">

                <div class="flex justify-between mb-3">

                    <span>
                        Subtotal
                    </span>

                    <span id="subtotal">
                        Rp 0
                    </span>

                </div>

                <div class="flex justify-between mb-3">

                    <span>
                        Shipping
                    </span>

                    <span>
                        Rp 20.000
                    </span>

                </div>

                <div class="flex justify-between text-xl font-bold">

                    <span>
                        Total
                    </span>

                    <span id="grandtotal">
                        Rp 0
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>

function formatRupiah(number) {

    return new Intl.NumberFormat('id-ID')
        .format(number);
}

// =========================
// RENDER CART
// =========================

function renderCart() {

    let cart =
        JSON.parse(localStorage.getItem('cart')) || [];

    const cartItems =
        document.getElementById('cart-items');

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

        subtotal +=
            item.price * item.quantity;

        cartItems.innerHTML += `

            <div class="flex gap-4 items-center mb-4 border-b pb-4">

                <img
                    src="${item.image}"
                    class="w-20 h-20 object-cover rounded"
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
                    Rp ${formatRupiah(
                        item.price * item.quantity
                    )}
                </div>

            </div>
        `;
    });

    const shipping = 20000;

    const grandTotal =
        subtotal + shipping;

    document.getElementById('subtotal')
        .innerText =
        'Rp ' + formatRupiah(subtotal);

    document.getElementById('grandtotal')
        .innerText =
        'Rp ' + formatRupiah(grandTotal);
}

// =========================
// LOAD
// =========================

document.addEventListener(
    'DOMContentLoaded',
    function () {

    console.log('Checkout loaded');

    renderCart();

    const checkoutForm =
        document.getElementById('checkoutForm');

    checkoutForm.addEventListener(
        'submit',
        async function(e) {

        e.preventDefault();

        console.log('Submit checkout');

        let cart =
            JSON.parse(
                localStorage.getItem('cart')
            ) || [];

        console.log('Cart:', cart);

        if(cart.length === 0){

            alert('Cart kosong');

            return;
        }

        const formData = {

            fullname:
                document.getElementById('fullname').value,

            phone:
                document.getElementById('phone').value,

            address:
                document.getElementById('address').value,

            city:
                document.getElementById('city').value,

            postal_code:
                document.getElementById('postal_code').value,

            courier:
                document.getElementById('courier').value,

            cart: cart
        };

        console.log('FormData:', formData);

        try {

            const response =
                await fetch('/checkout', {

                method: 'POST',

                headers: {

                    'Content-Type':
                        'application/json',

                    'X-CSRF-TOKEN':
                        '{{ csrf_token() }}',

                    'Accept':
                        'application/json'
                },

                body:
                    JSON.stringify(formData)
            });

            const result =
                await response.json();

            console.log('Result:', result);

            if(result.success){

                alert(
                    'Order berhasil disimpan!'
                );

                // HAPUS CART
                localStorage.removeItem('cart');

                // PESAN WA
                const waMessage =
`Halo Admin, saya ingin order furniture.

No Order: ${result.order_number}

Total: Rp ${result.total}`;

                // GANTI NOMOR ADMIN
                const waUrl =
`https://wa.me/6281234567890?text=${encodeURIComponent(waMessage)}`;

                // BUKA WA
                window.open(
                    waUrl,
                    '_blank'
                );

                // REDIRECT
                setTimeout(() => {

                    window.location.href = '/';

                }, 1000);

            } else {

                console.log(result);

                alert(
                    result.error ||
                    result.message ||
                    'Checkout gagal'
                );
            }

        } catch(error){

            console.error(error);

            alert(
                'Terjadi error checkout'
            );
        }

    });

});

</script>

@endsection