<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Kiana Furniture')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css"
          rel="stylesheet">

    <!-- Alpine JS -->
    <script defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 overflow-x-hidden">

    <!-- CUSTOM NAVBAR -->
    <nav class="fixed top-0 left-0 w-full bg-white/90 backdrop-blur-lg shadow-sm z-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between h-20">

                <!-- LOGO -->
                <a href="{{ route('home') }}"
                   class="text-2xl font-bold text-[#8B5E3C]">
                    KianaFurniture
                </a>

                <!-- MENU -->
                <div class="hidden md:flex items-center gap-8">

                    <a href="{{ route('home') }}"
                       class="text-gray-700 hover:text-[#8B5E3C] transition font-medium">
                        Home
                    </a>

                    <a href="#featured"
                       class="text-gray-700 hover:text-[#8B5E3C] transition font-medium">
                        Collection
                    </a>

                    <a href="#tentang"
                       class="text-gray-700 hover:text-[#8B5E3C] transition font-medium">
                        Company
                    </a>

                    <a href="#contact"
                       class="text-gray-700 hover:text-[#8B5E3C] transition font-medium">
                        Contact
                    </a>

                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">

                    @auth

                        <span class="hidden md:block text-sm text-gray-600">
                            {{ Auth::user()->name }}
                        </span>

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="bg-[#8B5E3C] hover:bg-[#734C30] text-white px-5 py-2 rounded-full transition">
                                Logout
                            </button>

                        </form>

                    @else

                        <a href="{{ route('login') }}"
                           class="text-gray-700 hover:text-[#8B5E3C] transition font-medium">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="bg-[#8B5E3C] hover:bg-[#734C30] text-white px-5 py-2 rounded-full transition">
                            Register
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>

    <!-- CONTENT -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

</body>
</html>