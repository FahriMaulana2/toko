<nav class="bg-white shadow-md border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-20">

            <!-- LOGO -->
            <a href="{{ route('home') }}"
               class="flex items-center gap-3">

                <div class="w-10 h-10 bg-brown-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chair text-white"></i>
                </div>

                <span class="text-2xl font-bold text-gray-800">
                    Kiana<span class="text-brown-600">Furniture</span>
                </span>

            </a>

            <!-- MENU -->
            <div class="flex items-center gap-6">

                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-brown-600 transition">
                    Home
                </a>

                <a href="{{ route('dashboard') }}"
                   class="text-gray-700 hover:text-brown-600 transition">
                    Dashboard
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="text-gray-700 hover:text-brown-600 transition">
                    Profile
                </a>

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>