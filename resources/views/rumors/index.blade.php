<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SportsGarden - Rumors</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

<!-- Navbar -->
<nav class="bg-blue-700 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('Sport.png') }}" alt="Logo" class="h-10 w-10">
                <span class="text-2xl font-bold text-white">SportsGarden</span>
            </a>
            <div class="flex space-x-4 items-center">
                <a href="{{ route('home') }}" class="text-white hover:text-yellow-300">Home</a>
                <a href="{{ route('rumors.index') }}" class="text-white hover:text-yellow-300 font-semibold">Rumors</a>
                <a href="{{ route('dashboard') }}" class="text-white hover:text-yellow-300">Dashboard</a>
            </div>
        </div>
    </div>
</nav>

<div class="max-w-4xl mx-auto mt-8 px-4">

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg shadow">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Rumor Form -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <h2 class="text-2xl font-bold mb-4">Post a New Rumor</h2>
        <form action="{{ route('rumors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium mb-1" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block font-medium mb-1" for="description">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block font-medium mb-1" for="image">Image (optional)</label>
                <input type="file" name="image" id="image"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded-lg hover:bg-blue-800">Post Rumor</button>
        </form>
    </div>

    <!-- List of Rumors -->
    <h2 class="text-2xl font-bold mb-4">Latest Rumors</h2>
    <div class="space-y-6">
        @forelse($rumors as $rumor)
            <div class="bg-white rounded-xl shadow overflow-hidden">
                @if($rumor->image)
                    <img src="{{ asset('storage/' . $rumor->image) }}" alt="{{ $rumor->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-5">
                    <h3 class="text-xl font-semibold mb-2">{{ $rumor->title }}</h3>
                    <p class="text-gray-700 mb-2">{{ $rumor->description }}</p>
                    <div class="text-sm text-gray-500">
                        Posted by: {{ $rumor->user->name ?? 'Unknown' }} | {{ $rumor->created_at->format('M d, Y H:i') }}
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600">No rumors have been posted yet.</p>
        @endforelse
    </div>
</div>

</body>
</html>
