<nav class="bg-blue-700 dark:bg-gray-900 shadow relative" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">

        <!-- Logo + Site Name -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('Sport.png') }}" alt="SportsGarden Logo" class="h-10 w-10 object-contain">
            <span class="text-2xl font-bold text-white dark:text-gray-200">SportsGarden</span>
        </a>

        <!-- Desktop Links -->
        <div class="hidden md:flex space-x-6">
            <a href="{{ route('home') }}" class="text-white dark:text-gray-200 hover:text-yellow-300 dark:hover:text-yellow-400">Home</a>
            <a href="{{ route('category', 'soccer') }}" class="text-white dark:text-gray-200 hover:text-yellow-300 dark:hover:text-yellow-400">Soccer</a>
            <a href="{{ route('category', 'basketball') }}" class="text-white dark:text-gray-200 hover:text-yellow-300 dark:hover:text-yellow-400">Basketball</a>
            <a href="{{ route('category', 'tennis') }}" class="text-white dark:text-gray-200 hover:text-yellow-300 dark:hover:text-yellow-400">Tennis</a>
            <a href="{{ route('rumors.index') }}" class="text-white dark:text-gray-200 hover:text-yellow-300 dark:hover:text-yellow-400">Rumors</a>
        </div>

        <!-- Dark Mode Toggle Button -->
        <div class="hidden md:flex items-center space-x-4">
<button id="dark-toggle" class="px-3 py-1 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-700">
    Toggle Dark
</button>


            <!-- Auth Links (Desktop) -->
            @auth
                <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-yellow-400 dark:bg-yellow-500 text-gray-900 dark:text-gray-900 rounded-lg shadow hover:bg-yellow-500 dark:hover:bg-yellow-600">Dashboard</a>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="px-4 py-2 rounded-lg text-white dark:text-gray-200 hover:text-yellow-300 dark:hover:text-yellow-400 focus:outline-none">
                        {{ Auth::user()->name }}
                        <svg class="inline h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">
                        <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-white dark:text-gray-200 hover:text-yellow-300 dark:hover:text-yellow-400">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-yellow-400 dark:bg-yellow-500 text-gray-900 dark:text-gray-900 rounded-lg shadow hover:bg-yellow-500 dark:hover:bg-yellow-600">Register</a>
                @endif
            @endauth
        </div>

        <!-- Mobile Hamburger -->
        <div class="md:hidden flex items-center space-x-2">
            <button id="mobile-dark-toggle" class="px-2 py-1 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-700">🌓</button>
            <button @click="mobileOpen = true" class="text-white dark:text-gray-200 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileOpen" x-cloak class="md:hidden fixed top-0 left-0 w-full h-full bg-blue-700 dark:bg-gray-900 bg-opacity-95 dark:bg-opacity-95 transform transition-transform duration-300 ease-in-out z-50">
        <div class="flex justify-between items-center p-4 border-b border-blue-500 dark:border-gray-700">
            <span class="text-2xl font-bold text-white dark:text-gray-200">SportsGarden</span>
            <button @click="mobileOpen = false" class="text-white dark:text-gray-200 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="flex flex-col mt-8 space-y-4 px-6 text-white dark:text-gray-200 text-lg">
            <a href="{{ route('home') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Home</a>
            <a href="{{ route('category', 'soccer') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Soccer</a>
            <a href="{{ route('category', 'basketball') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Basketball</a>
            <a href="{{ route('category', 'tennis') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Tennis</a>
            <a href="{{ route('rumors.index') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Rumors</a>
            <hr class="border-blue-500 dark:border-gray-700">
            @auth
                <a href="{{ url('/dashboard') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="hover:text-yellow-300 dark:hover:text-yellow-400">Register</a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>

<!-- Dark Mode Toggle JS -->
<script>
    const darkToggle = document.getElementById('dark-toggle');
    const mobileDarkToggle = document.getElementById('mobile-dark-toggle');
    const html = document.documentElement;

    // Apply saved preference or system preference
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.classList.add('dark');
    }

    function toggleDarkMode() {
        html.classList.toggle('dark');
        localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
    }

    darkToggle.addEventListener('click', toggleDarkMode);
    mobileDarkToggle.addEventListener('click', toggleDarkMode);
</script>
