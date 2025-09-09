<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SportsGarden</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative bg-gray-100 text-gray-800 antialiased">

    <!-- Blurred Sports Background -->
    <div class="fixed inset-0 -z-10">
        <img src="https://cdn.wallpapersafari.com/38/50/vI1cZ2.jpg" 
             class="w-full h-full object-cover filter blur-sm brightness-75" 
             alt="Sports Background">
    </div>

    <div class="relative z-10">

        <!-- Navbar -->
        <nav class="bg-blue-700 shadow relative">
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
                    </div>

                    <!-- Auth Links (desktop) -->
                    <div class="hidden md:flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-white hover:text-yellow-300">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <!-- Mobile Hamburger -->
                    <div class="md:hidden flex items-center">
                        <button id="burgerOpen" class="text-white focus:outline-none">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="md:hidden fixed top-0 left-0 w-full h-full bg-blue-700 bg-opacity-95 transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
                <div class="flex justify-between items-center p-4 border-b border-blue-500">
                    <span class="text-2xl font-bold text-white">SportsGarden</span>
                    <button id="burgerClose" class="text-white focus:outline-none">
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
                    <hr class="border-blue-500">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="hover:text-yellow-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-yellow-300">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hover:text-yellow-300">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Mobile Menu Script -->
        <script>
            const burgerOpen = document.getElementById('burgerOpen');
            const burgerClose = document.getElementById('burgerClose');
            const mobileMenu = document.getElementById('mobileMenu');

            burgerOpen.addEventListener('click', () => {
                mobileMenu.classList.remove('-translate-x-full');
                mobileMenu.classList.add('translate-x-0');
            });

            burgerClose.addEventListener('click', () => {
                mobileMenu.classList.remove('translate-x-0');
                mobileMenu.classList.add('-translate-x-full');
            });
        </script>

        <!-- Hero Section -->
        <section class="relative h-[65vh] flex items-center justify-center">
            <div class="bg-white/90 backdrop-blur-md rounded-xl p-8 text-center max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">Latest Sports News</h1>
                <p class="text-lg text-gray-700 mt-3">Stay updated with the hottest news from around the sports world</p>
            </div>
        </section>

        <!-- Top Headlines Section -->
        <section class="py-12">
            <div class="grid gap-3 bg-white/90 max-w-7xl rounded-xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-16">Top Headlines</h2>
                <div class="grid gap-8 md:grid-cols-3">
                    @forelse($news as $item)
                        <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden flex flex-col">
                            <img src="{{ $item['urlToImage'] ?? 'https://source.unsplash.com/400x250/?sports' }}" alt="{{ $item['title'] }}" class="w-full h-48 object-cover">
                            <div class="p-5 flex-1 flex flex-col">
                                <h3 class="text-xl font-semibold mb-2">{{ $item['title'] }}</h3>
                                <p class="text-gray-600 mb-2 flex-1">{{ $item['description'] ?? 'No description available.' }}</p>
                                <div class="text-sm text-gray-500 mb-2">
                                    Source: {{ $item['source']['name'] ?? 'Unknown' }}<br>
                                    Published: {{ isset($item['publishedAt']) ? \Carbon\Carbon::parse($item['publishedAt'])->format('M d, Y H:i') : 'N/A' }}
                                </div>
                                <a href="{{ $item['url'] ?? '#' }}" target="_blank" class="mt-auto inline-block px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Read More</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-600 col-span-3">No news available at the moment.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-blue-700 text-white py-6">
            <div class="max-w-7xl mx-auto text-center">
                <p>&copy; {{ date('Y') }} SportsGarden. All rights reserved.</p>
            </div>
        </footer>

    </div> <!-- End main content -->

</body>
</html>
