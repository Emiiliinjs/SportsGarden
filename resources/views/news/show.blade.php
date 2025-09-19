<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $news->title }} - SportsGarden</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased min-h-screen flex flex-col">

@include('layouts.navbar')

<!-- Galvenais saturs -->
<div class="max-w-3xl mx-auto mt-10 px-4 bg-white rounded-xl shadow-md p-6 flex-grow">
    <h1 class="text-3xl font-extrabold mb-4">{{ $news->title }}</h1>
    @if($news->image)
        <img src="{{ $news->image }}" alt="{{ $news->title }}" class="w-full h-64 object-cover mb-4">
    @endif
    <p class="text-gray-700 mb-4">{{ $news->description }}</p>
    <p class="text-gray-500 text-sm mb-4">Source: {{ $news->source ?? 'Unknown' }}</p>
    <p class="text-gray-500 text-sm mb-4">Published: {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('M d, Y H:i') : 'N/A' }}</p>
    
    <div class="flex flex-col space-y-2">
    <a href="{{ $news->url }}" target="_blank" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-blue-700 text-center">
        Original Article
    </a>
    <a href="{{ url('/') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-gray-700 text-center inline-flex items-center justify-center">
        ← Back to Home
    </a>
</div>

</div>


@include('layouts.footer')

</body>
</html>
