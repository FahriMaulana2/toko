console.log('cart.js mulai dijalankan');

function addToCart(id, name, price, image, quantity) {
    console.log('addToCart DIPANGGIL! ID:', id, 'Nama:', name, 'Harga:', price);
    
    // Ambil cart yang sudah ada
    let cart = localStorage.getItem('kiana_cart');
    if (cart) {
        cart = JSON.parse(cart);
    } else {
        cart = [];
    }
    
    // Cek apakah produk sudah ada
    let found = false;
    for (let i = 0; i < cart.length; i++) {
        if (cart[i].id == id) {
            cart[i].quantity += 1;
            found = true;
            break;
        }
    }
    
    // Jika belum ada, tambahkan
    if (!found) {
        cart.push({
            id: id,
            name: name,
            price: price,
            image: image || '',
            quantity: 1
        });
    }
    
    // Simpan ke localStorage
    localStorage.setItem('kiana_cart', JSON.stringify(cart));
    
    // Notifikasi
    alert(name + ' berhasil ditambahkan ke keranjang!');
    
    // Update badge
    updateCartBadge();
    
    console.log('Cart setelah ditambah:', cart);
}

function updateCartBadge() {
    let cart = localStorage.getItem('kiana_cart');
    let count = 0;
    
    if (cart) {
        cart = JSON.parse(cart);
        for (let i = 0; i < cart.length; i++) {
            count += cart[i].quantity;
        }
    }
    
    console.log('Update badge, jumlah item:', count);
    
    let badge = document.getElementById('cart-badge');
    if (badge) {
        if (count > 0) {
            badge.textContent = count;
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }
    }
}

window.addToCart = addToCart;
window.updateCartBadge = updateCartBadge;

console.log('cart.js selesai dijalankan');