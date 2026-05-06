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

            <div class="flex gap-4 items-center mb-4">

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
// PAGE LOAD
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

            // =========================
            // REQUEST CHECKOUT
            // =========================

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

            console.log('Response:', response);

            const result =
                await response.json();

            console.log('Result:', result);

            // =========================
            // SUCCESS
            // =========================

            if(result.success){

                alert(
                    'Order berhasil disimpan!'
                );

                console.log(
                    'ORDER SUCCESS'
                );

                // HAPUS CART
                localStorage.removeItem('cart');

                // =========================
                // DEBUG DULU
                // =========================

                // NONAKTIFKAN SEMENTARA
                // AGAR ERROR TIDAK HILANG

                /*
                const waMessage =
`Halo Admin, saya ingin order furniture.

No Order: ${result.order_number}

Total: Rp ${result.total}`;

                const waUrl =
`https://wa.me/6281234567890?text=${encodeURIComponent(waMessage)}`;

                window.open(waUrl, '_blank');

                window.location.href = '/';
                */

            } else {

                console.log(
                    'ORDER FAILED',
                    result
                );

                alert(
                    result.message ||
                    result.error ||
                    'Checkout gagal'
                );
            }

        } catch(error){

            console.error(
                'CHECKOUT ERROR:',
                error
            );

            alert(
                'Terjadi error checkout'
            );
        }

    });

});

</script>