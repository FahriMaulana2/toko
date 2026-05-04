@extends('layouts.app')

@section('title', 'Order Success')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-20 text-center">
    <div class="bg-green-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
        <i class="fas fa-check text-green-600 text-4xl"></i>
    </div>
    
    <h1 class="text-3xl font-playfair font-bold text-gray-800 mb-4">Order Successful!</h1>
    <p class="text-gray-600 mb-2">Thank you for your purchase.</p>
    <p class="text-gray-500 mb-8">Order Number: <strong>{{ $orderNumber }}</strong></p>
    
    <p class="text-gray-500 mb-8">We will verify your payment within 1x24 hours.</p>
    
    <div class="flex gap-4 justify-center">
        <a href="{{ url('/') }}" class="bg-brown-600 text-white px-6 py-3 rounded-lg hover:bg-brown-700 transition">
            Continue Shopping
        </a>
    </div>
</div>
@endsection