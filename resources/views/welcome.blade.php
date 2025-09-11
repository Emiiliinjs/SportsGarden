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
<!-- Top Headlines Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white bg-opacity-90 dark:bg-gray-900 dark:bg-opacity-90 rounded-xl shadow-md dark:shadow-gray-900">
        <h2 class="text-4xl font-extrabold text-center mb-12 text-gray-900 dark:text-white">
            📰 Top Headlines
        </h2>
        
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            @forelse($news as $item)
                <div class="group bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-xl transition duration-300 overflow-hidden flex flex-col">
                    
                    <!-- Image -->
                    <div class="relative">
                        <img src="{{ $item['urlToImage'] ?? 'https://source.unsplash.com/600x400/?sports' }}" 
                             alt="{{ $item['title'] }}" 
                             class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                            {{ $item['source']['name'] ?? 'Unknown' }}
                        </span>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 flex flex-col p-6">
                        <h3 class="text-lg font-bold mb-3 text-gray-900 dark:text-white group-hover:text-blue-600 transition">
                            {{ $item['title'] }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm flex-1 leading-relaxed">
                            {{ Str::limit($item['description'] ?? 'No description available.', 120) }}
                        </p>
                        
                        <!-- Meta -->
                        <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                            📅 {{ isset($item['publishedAt']) ? \Carbon\Carbon::parse($item['publishedAt'])->format('M d, Y H:i') : 'N/A' }}
                        </div>
                        
                        <!-- Button -->
                        <a href="{{ $item['url'] ?? '#' }}" target="_blank"
                           class="mt-6 inline-flex items-center justify-center px-5 py-2 text-sm font-semibold rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow-sm hover:shadow-md transform hover:scale-105 transition">
                            Read More →
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 dark:text-gray-400 col-span-3">
                    No news available at the moment.
                </p>
            @endforelse
        </div>
    </div>
</section>



        <!-- Footer -->
        @include('layouts.footer')

    </div>

</body>
</html>
