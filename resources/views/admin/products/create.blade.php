@extends('admin.layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Product</h1>
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-md p-6">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
            <input type="text" name="name" required class="w-full border rounded-lg px-4 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category" class="w-full border rounded-lg px-4 py-2">
                <option value="living-room">Living Room</option>
                <option value="bedroom">Bedroom</option>
                <option value="office">Home Office</option>
                <option value="decor">Decor</option>
            </select>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Price *</label>
                <input type="number" name="price" required class="w-full border rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stock *</label>
                <input type="number" name="stock" required class="w-full border rounded-lg px-4 py-2">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Brand</label>
            <select name="brand_id" class="w-full border rounded-lg px-4 py-2">
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-2"></textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Product Image</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-4 py-2">
        </div>
        
        <div class="flex gap-4 mb-6">
            <label><input type="checkbox" name="is_featured" value="1"> Featured Product</label>
            <label><input type="checkbox" name="is_active" value="1" checked> Active</label>
        </div>
        
        <!-- ========== TOMBOL SAVE DAN CANCEL ========== -->
        <div style="display: flex; gap: 12px; margin-top: 24px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
            <button type="submit" style="background-color: #8B5E3C; color: white; padding: 10px 24px; border-radius: 8px; border: none; cursor: pointer; font-weight: 500;">
                <i class="fas fa-save"></i> Save Product
            </button>
            <a href="{{ route('admin.products.index') }}" style="background-color: #9ca3af; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500;">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection