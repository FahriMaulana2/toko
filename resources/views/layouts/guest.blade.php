<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mebelku') }} - @yield('title', 'Login')</title>

        <!-- Fonts - Poppins -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #C08B5C;
                --primary-dark: #A07A4C;
                --secondary: #F5F1EB;
                --dark: #1F2937;
                --text: #4B5563;
                --text-light: #6B7280;
                --border: #E5E7EB;
                --background: #FAFAF9;
            }
            
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Background with gradient -->
        <div class="min-h-screen flex flex-col sm:flex-row">
            <!-- Left Panel - Branding -->
            <div class="hidden sm:flex sm:w-1/2 bg-dark relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute inset-0">
                    <div class="absolute top-20 left-20 opacity-10">
                        <svg class="w-40 h-40 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z"/>
                        </svg>
                    </div>
                    <div class="absolute bottom-20 right-20 opacity-10">
                        <svg class="w-32 h-32 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 18v3h3a3 3 0 100-6H4v3zm0-6h3a3 3 0 110 6H4v-6zm10 6v-3h-3a3 3 0 110-6h3v6zm0-6h-3a3 3 0 100 6h3v-3z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 flex flex-col justify-center items-center w-full px-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-16 h-16 bg-primary rounded-2xl flex items-center justify-center shadow-premium">
                            <i class="fas fa-couch text-white text-2xl"></i>
                        </div>
                        <span class="text-3xl font-bold text-white">Mebelku</span>
                    </div>
                    <h1 class="text-4xl font-bold text-white text-center mb-4">Premium Scandinavian Furniture</h1>
                    <p class="text-gray-400 text-center text-lg">Elevate your living space with elegant, modern designs</p>
                </div>
            </div>

            <!-- Right Panel - Form -->
            <div class="w-full sm:w-1/2 flex items-center justify-center p-8 bg-background">
                <div class="w-full max-w-md">
                    <!-- Logo (mobile) -->
                    <div class="flex items-center gap-3 mb-8 sm:hidden">
                        <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center">
                            <i class="fas fa-couch text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-dark">Mebelku</span>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
