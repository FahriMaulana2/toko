<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center gap-4">

                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-brown-600 transition">
                    Home
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="text-gray-700 hover:text-brown-600 transition">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="text-red-600 hover:text-red-700 transition">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>
</nav>