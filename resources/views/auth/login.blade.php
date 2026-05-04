@extends('layouts.app')

@section('title', 'Login - Kiana Furniture')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 flex items-center justify-center py-20 px-4">
    <div class="max-w-md w-full">
        <!-- Logo / Brand -->
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="text-3xl font-playfair font-bold text-brown-600">
                Kiana<span class="text-gray-800">Furniture</span>
            </a>
            <p class="text-gray-500 mt-2">Sign in to your account</p>
        </div>
        
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8">
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-brown-600"></i> Email Address
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-brown-600 focus:ring-2 focus:ring-brown-200 transition @error('email') border-red-500 @enderror"
                               placeholder="your@email.com">
                    </div>
                    
                    <!-- Password Field -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-brown-600"></i> Password
                        </label>
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-brown-600 focus:ring-2 focus:ring-brown-200 transition @error('password') border-red-500 @enderror"
                               placeholder="Enter your password">
                    </div>
                    
                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-brown-600 border-gray-300 rounded focus:ring-brown-500">
                            <span class="ml-2 text-sm text-gray-600">Remember Me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-brown-600 hover:text-brown-700 hover:underline">
                                Forgot Password?
                            </a>
                        @endif
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-brown-600 text-white py-3 rounded-xl font-semibold hover:bg-brown-700 transition duration-300 transform hover:scale-[1.02] shadow-md">
                        <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-3 bg-white text-gray-500">New Customer?</span>
                    </div>
                </div>
                
                <!-- Register Link -->
                <div class="text-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-brown-600 font-medium hover:text-brown-700 transition">
                        Create New Account <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-brown-600 text-sm transition">
                <i class="fas fa-arrow-left mr-1"></i> Back to Home
            </a>
        </div>
    </div>
</div>
@endsection