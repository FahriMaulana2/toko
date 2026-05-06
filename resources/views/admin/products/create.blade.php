@extends('admin.layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Product</h1>
    
    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Product Name *</label>
            <input type="text" name="name" required class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Category</label>
            <select name="category" class="w-full border rounded px-3 py-2">
                <option value="living-room">Living Room</option>
                <option value="bedroom">Bedroom</option>
                <option value="office">Home Office</option>
                <option value="decor">Decor</option>
            </select>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Price *</label>
                <input type="number" name="price" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stock *</label>
                <input type="number" name="stock" required class="w-full border rounded px-3 py-2">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Brand *</label>
            <select name="brand_id" required class="w-full border rounded px-3 py-2">
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Description *</label>
            <textarea name="description" rows="4" required class="w-full border rounded px-3 py-2"></textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Product Image</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
            <p class="text-xs text-gray-500 mt-1">Supported: JPG, PNG. Max 2MB.</p>
        </div>
        
        <div class="flex gap-4 mb-6">
            <label>
                <input type="checkbox" name="is_featured" value="1"> Featured Product
            </label>
            <label>
                <input type="checkbox" name="is_active" value="1" checked> Active
            </label>
        </div>
        
        <!-- ✅ BUTTON FIX (PASTI KELIHATAN) -->
        <div class="flex gap-3 pt-4 border-t mt-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save"></i> Save Product
            </button>

            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection