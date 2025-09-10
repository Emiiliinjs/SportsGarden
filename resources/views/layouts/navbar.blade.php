<nav class="bg-blue-700 shadow relative" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo + Site Name -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('Sport.png') }}" alt="SportsGarden Logo" class="h-10 w-10 object-contain">
                <span class="text-2xl font-bold text-white">SportsGarden</span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="text-white hover:text-yellow-300">Home</a>
                <a href="{{ route('category', 'soccer') }}" class="text-white hover:text-yellow-300">Soccer</a>
                <a href="{{ route('category', 'basketball') }}" class="text-white hover:text-yellow-300">Basketball</a>
                <a href="{{ route('category', 'tennis') }}" class="text-white hover:text-yellow-300">Tennis</a>
                <a href="{{ route('rumors.index') }}" class="text-white hover:text-yellow-300">Rumors</a>
            </div>

            <!-- Auth Links (Desktop) -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <!-- Dashboard -->
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500">Dashboard</a>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="px-4 py-2 rounded-lg text-white hover:text-yellow-300 focus:outline-none">
                            {{ Auth::user()->name }}
                            <svg class="inline h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                            <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-300">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500">Register</a>
                    @endif
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="md:hidden flex items-center">
                <button @click="mobileOpen = true" class="text-white focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileOpen" x-cloak class="md:hidden fixed top-0 left-0 w-full h-full bg-blue-700 bg-opacity-95 transform transition-transform duration-300 ease-in-out z-50">
        <div class="flex justify-between items-center p-4 border-b border-blue-500">
            <span class="text-2xl font-bold text-white">SportsGarden</span>
            <button @click="mobileOpen = false" class="text-white focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="flex flex-col mt-8 space-y-4 px-6 text-white text-lg">
            <a href="{{ route('home') }}" class="hover:text-yellow-300">Home</a>
            <a href="{{ route('category', 'soccer') }}" class="hover:text-yellow-300">Soccer</a>
            <a href="{{ route('category', 'basketball') }}" class="hover:text-yellow-300">Basketball</a>
            <a href="{{ route('category', 'tennis') }}" class="hover:text-yellow-300">Tennis</a>
            <a href="{{ route('rumors.index') }}" class="hover:text-yellow-300">Rumors</a>
            <hr class="border-blue-500">
            @auth
                <a href="{{ url('/dashboard') }}" class="hover:text-yellow-300">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-yellow-300">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="hover:text-yellow-300" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-yellow-300">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hover:text-yellow-300">Register</a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>
