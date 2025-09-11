<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-init="
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SportsGarden</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="transition-colors duration-300 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased">

    <!-- Blurred Background -->
    <div class="fixed inset-0 -z-10">
        <img src="https://cdn.wallpapersafari.com/38/50/vI1cZ2.jpg" 
             class="w-full h-full object-cover filter blur-sm brightness-75 dark:brightness-50" 
             alt="Sports Background">
    </div>

    <div class="relative z-10">

        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Hero Section -->
        <section class="relative h-[65vh] flex flex-col items-center justify-center">
            <div class="bg-white bg-opacity-90 dark:bg-gray-900 dark:bg-opacity-90 backdrop-blur-md rounded-xl p-8 text-center max-w-3xl shadow-md dark:shadow-gray-900">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white dark:drop-shadow-lg">Latest Sports News</h1>
                <p class="text-lg text-gray-700 dark:text-gray-300 mt-3">Stay updated with the hottest news from around the sports world</p>

                <!-- Search Form -->
                <form action="{{ route('home') }}" method="GET" class="mt-6 flex justify-center">
                    <input type="text" name="query" placeholder="Search news..." 
                           class="px-4 py-2 rounded-l-lg border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200" 
                           value="{{ request('query') }}">
                    <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-r-lg hover:bg-blue-800 dark:bg-blue-500 dark:hover:bg-blue-600">Search</button>
                </form>
            </div>
        </section>

        <!-- Optional Search Term -->
        @if(request('query'))
        <div class="max-w-3xl mx-auto mt-6 p-4 bg-white bg-opacity-90 dark:bg-gray-900 dark:bg-opacity-90 backdrop-blur-md rounded-xl shadow-md dark:shadow-gray-900 text-center">
            <p class="text-gray-900 dark:text-white font-semibold text-lg">
                Showing results for: <span class="text-blue-700 dark:text-blue-400">{{ request('query') }}</span>
            </p>
        </div>
        @endif

        <!-- Top Headlines Section -->
        <section class="py-12">
            <div class="grid gap-3 bg-white bg-opacity-90 dark:bg-gray-900 dark:bg-opacity-90 text-gray-900 dark:text-gray-200 max-w-7xl rounded-xl mx-auto px-4 sm:px-6 lg:px-8 shadow-md dark:shadow-gray-900">
                <h2 class="text-3xl font-bold text-center mb-16 text-gray-900 dark:text-white">Top Headlines</h2>
                <div class="grid gap-8 md:grid-cols-3">
                    @forelse($news as $item)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg dark:shadow-gray-900 overflow-hidden flex flex-col transition duration-300">
                            <img src="{{ $item['urlToImage'] ?? 'https://source.unsplash.com/400x250/?sports' }}" alt="{{ $item['title'] }}" class="w-full h-48 object-cover">
                            <div class="p-5 flex-1 flex flex-col">
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">{{ $item['title'] }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-2 flex-1">{{ $item['description'] ?? 'No description available.' }}</p>
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    Source: {{ $item['source']['name'] ?? 'Unknown' }}<br>
                                    Published: {{ isset($item['publishedAt']) ? \Carbon\Carbon::parse($item['publishedAt'])->format('M d, Y H:i') : 'N/A' }}
                                </div>
                                <a href="{{ $item['url'] ?? '#' }}" target="_blank" class="mt-auto inline-block px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 dark:bg-blue-500 dark:hover:bg-blue-600">Read More</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-600 dark:text-gray-400 col-span-3">No news available at the moment.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include('layouts.footer')

    </div>

</body>
</html>
