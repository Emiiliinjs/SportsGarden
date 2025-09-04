<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sport News</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <!-- Navbar -->
    <nav class="bg-blue-700 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-white">SportNews</a>

                <div class="hidden md:flex space-x-6">
                    <a href="" class="text-white hover:text-yellow-300">Home</a>
                    <a href="/football" class="text-white hover:text-yellow-300">Football</a>
                    <a href="#" class="text-white hover:text-yellow-300">Basketball</a>
                    <a href="#" class="text-white hover:text-yellow-300">Tennis</a>
                </div>

                <div class="flex items-center space-x-4">
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
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative bg-cover bg-center h-[65vh]" style="background-image: url('https://source.unsplash.com/1600x600/?sports,stadium')">
        <div class="absolute inset-0 bg-black/60 flex flex-col justify-center items-center text-center px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white">Latest Sports News</h1>
            <p class="text-lg text-gray-200 mt-3">Stay updated with the hottest news from around the sports world</p>
            <a href="#" class="mt-6 px-6 py-3 bg-yellow-400 text-gray-900 font-semibold rounded-lg shadow hover:bg-yellow-500">Read More</a>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-10">Top Headlines</h2>
            <div class="grid gap-8 md:grid-cols-3">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://source.unsplash.com/400x250/?football" alt="Football" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">Big Football Match Tonight</h3>
                        <p class="text-gray-600 mb-4">Exciting clash between two giants is set to light up the stadium.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Read More</a>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://source.unsplash.com/400x250/?basketball" alt="Basketball" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">NBA Finals Heat Up</h3>
                        <p class="text-gray-600 mb-4">Tensions rise as teams battle for the championship title.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Read More</a>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://source.unsplash.com/400x250/?tennis" alt="Tennis" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">Grand Slam Updates</h3>
                        <p class="text-gray-600 mb-4">Top players compete in one of the most anticipated tournaments.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-700 text-white py-6">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} SportNews. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
