<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $rumor->title }} - SportsGarden</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <!-- Navbar -->
    @include('layouts.navbar')

    <div class="max-w-5xl mx-auto mt-10 px-4">

        <!-- Rumor Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-12">
            @if($rumor->image)
                <img src="{{ asset('storage/' . $rumor->image) }}" alt="{{ $rumor->title }}" class="w-full h-72 object-cover">
            @endif
            <div class="p-6">
                <h1 class="text-3xl font-extrabold mb-4 text-gray-900">{{ $rumor->title }}</h1>
                <p class="text-gray-700 mb-6 leading-relaxed">{{ $rumor->description }}</p>

                <div class="text-sm text-gray-500 mb-4">
                    👤 Posted by: <span class="font-semibold">{{ $rumor->user->name ?? 'Unknown' }}</span>
                    • {{ $rumor->created_at->format('M d, Y H:i') }}
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('rumors.index') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        ← Back to Rumors
                    </a>

                    @if(Auth::user()->is_admin)
                        <form action="{{ route('rumors.destroy', $rumor) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                                    onclick="return confirm('Are you sure you want to delete this rumor?');">
                                🗑️ Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>

</body>
</html>
