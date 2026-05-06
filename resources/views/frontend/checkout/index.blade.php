@extends('layouts.app')

@section('title', 'Checkout - Kiana Furniture')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-8">
        Checkout
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- FORM -->
        <div class="lg:col-span-2">

            <div class="bg-white shadow rounded p-6">

                <form id="checkoutForm">

                    @csrf

                    <!-- FULLNAME -->
                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="fullname"
                            required
                            class="w-full border rounded px-4 py-2"
                        >

                    </div>

                    <!-- PHONE -->
                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Nomor WhatsApp
                        </label>

                        <input
                            type="text"
                            name="phone"
                            required
                            class="w-full border rounded px-4 py-2"
                        >

                    </div>

                    <!-- ADDRESS -->
                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Alamat
                        </label>

                        <textarea
                            name="address"
                            required
                            class="w-full border rounded px-4 py-2"
                        ></textarea>

                    </div>

                    <!-- CITY -->
                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Kota
                        </label>

                        <input
                            type="text"
                            name="city"
                            required
                            class="w-full border rounded px-4 py-2"
                        >

                    </div>

                    <!-- POSTAL -->
                    <div class="mb-4">

                        <label class="block mb-2 font-semibold">
                            Kode Pos
                        </label>

                        <input
                            type="text"
                            name="postal_code"
                            required
                            class="w-full border rounded px-4 py-2"
                        >

                    </div>

                    <!-- COURIER -->
                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Kurir
                        </label>

                        <select
                            name="courier"
                            required
                            class="w-full border rounded px-4 py-2"
                        >

                            <option value="">
                                Pilih Kurir
                            </option>

                            <option value="JNE">
                                JNE
                            </option>

                            <option value="J&T">
                                J&T
                            </option>

                            <option value="SiCepat">
                                SiCepat
                            </option>

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-black text-white py-3 rounded hover:bg-gray-800 transition"
                    >
                        Proses ke WhatsApp
                    </button>

                </form>

            </div>

        </div>

        <!-- CART -->
        <div>

            <div class="bg-white shadow rounded p-6">

                <h2 class="text-xl font-bold mb-4">
                    Cart
                </h2>

                <div id="cart-items"></div>

                <hr class="my-4">

                <div class="flex justify-between font-bold text-lg">

                    <span>Total</span>

                    <span id="grand-total">
                        Rp 0
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

let cart = JSON.parse(localStorage.getItem('cart')) || [];

function renderCart() {

    const cartContainer =
        document.getElementById('cart-items');

    const grandTotal =
        document.getElementById('grand-total');

    if(!cartContainer) return;

    if(cart.length < 1){

        cartContainer.innerHTML = `
            <p class="text-gray-500">
                Cart kosong
            </p>
        `;

        grandTotal.innerHTML = 'Rp 0';

        return;
    }

    let html = '';

    let total = 0;

    cart.forEach(item => {

        let subtotal =
            item.price * item.quantity;

        total += subtotal;

        html += `

            <div class="flex gap-4 mb-4 border-b pb-4">

                <img
                    src="${item.image}"
                    class="w-20 h-20 object-cover rounded"
                >

                <div class="flex-1">

                    <h3 class="font-bold">
                        ${item.name}
                    </h3>

                    <p>
                        Qty: ${item.quantity}
                    </p>

                    <p class="font-semibold">
                        Rp ${subtotal.toLocaleString('id-ID')}
                    </p>

                </div>

            </div>
        `;
    });

    cartContainer.innerHTML = html;

    grandTotal.innerHTML =
        'Rp ' + total.toLocaleString('id-ID');
}

document.addEventListener(
    'DOMContentLoaded',
    function () {

    console.log('Checkout loaded');

    renderCart();

    const form =
        document.getElementById('checkoutForm');

    form.addEventListener(
        'submit',
        async function(e){

        e.preventDefault();

        if(cart.length < 1){

            alert('Cart kosong');

            return;
        }

        const formData = {

            fullname:
                form.fullname.value,

            phone:
                form.phone.value,

            address:
                form.address.value,

            city:
                form.city.value,

            postal_code:
                form.postal_code.value,

            courier:
                form.courier.value,

            cart: cart
        };

        console.log(
            'KIRIM DATA:',
            formData
        );

        try {

            const response =
                await fetch('/checkout', {

                method: 'POST',

                headers: {

                    'Content-Type':
                        'application/json',

                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content
                },

                body:
                    JSON.stringify(formData)
            });

            const result =
                await response.json();

            console.log(
                'RESPON:',
                result
            );

            if(result.success){

                // FORMAT PESAN WA
                let message =
`Halo Admin Kiana Furniture

Saya ingin order furniture:

`;

                cart.forEach(item => {

                    message +=
`${item.name}
Qty: ${item.quantity}

`;
                });

                message += `
Total:
Rp ${result.total}

Nama:
${formData.fullname}

Alamat:
${formData.address}

Kota:
${formData.city}

Kurir:
${formData.courier}
`;

                // HAPUS CART
                localStorage.removeItem('cart');

                // REDIRECT WA
                window.location.href =
`https://wa.me/6281234567890?text=${encodeURIComponent(message)}`;

            } else {

                alert(result.message);
            }

        } catch(error){

            console.log(error);

            alert('Checkout gagal');
        }
    });
});

</script>

@endsection