<!DOCTYPE html>
<html>
<head>
    <title>TEST FORM</title>
</head>
<body>
    <h1>TEST FORM - Tambah Produk</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <p>Nama Produk: <input type="text" name="name" required></p>
        <p>Harga: <input type="number" name="price" required></p>
        <p>Stok: <input type="number" name="stock" required></p>
        <p>Deskripsi: <textarea name="description"></textarea></p>
        
        <button type="submit" style="background: green; color: white; padding: 10px 20px;">SAVE PRODUCT</button>
    </form>
</body>
</html>