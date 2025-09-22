<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('dark') ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $rumor->title }} - SportsGarden</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 antialiased transition-colors duration-300">

    {{-- Navigācija --}}
    @include('layouts.navbar')

    <div class="max-w-3xl mx-auto mt-10 px-4">

        {{-- Rumora kartiņa --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition duration-300 mb-8">
            @if($rumor->image)
                <img src="{{ asset('storage/' . $rumor->image) }}" alt="{{ $rumor->title }}"
                    class="w-full h-64 object-cover">
            @endif
            <div class="p-8 flex flex-col">
                <h1 class="text-4xl font-extrabold mb-4">{{ $rumor->title }}</h1>
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    👤 Posted by: <span class="font-semibold">{{ $rumor->user->name ?? 'Unknown' }}</span>
                    • {{ $rumor->created_at->format('M d, Y H:i') }}
                </div>
                <p class="text-lg leading-relaxed mb-6">{{ $rumor->description }}</p>

                <div class="flex gap-3">
                    @if(Auth::user()?->is_admin)
                        <form action="{{ route('rumors.destroy', $rumor) }}" method="POST" class="ml-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-800 text-sm shadow-sm hover:shadow-md transform hover:scale-105 transition"
                                onclick="return confirm('Are you sure you want to delete this rumor?');">
                                🗑️ Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Komentāri --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8 transition duration-300">
            <h2 class="text-2xl font-bold mb-4">💬 Comments ({{ $rumor->comments->count() }})</h2>

            {{-- Komentāru saraksts --}}
            @forelse($rumor->comments as $comment)
                <div class="mb-4 border-b border-gray-200 dark:border-gray-600 pb-4">
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                        👤 <span class="font-semibold">{{ $comment->user->name ?? 'Unknown' }}</span>
                        • {{ $comment->created_at->format('M d, Y H:i') }}
                    </div>
                    <p class="text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No comments yet.</p>
            @endforelse

            {{-- Komentāru forma --}}
            @auth
                <form action="{{ route('comments.store', $rumor) }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    <textarea name="content" rows="3" required
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                        placeholder="Write a comment..."></textarea>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition">
                        Post Comment
                    </button>
                </form>
            @else
                <p class="mt-4 text-gray-500 dark:text-gray-400">
                    Please <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> to comment.
                </p>
            @endauth
        </div>

        {{-- Atpakaļ poga --}}
        <a href="{{ route('rumors.index') }}"
            class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            ← Back to Rumors
        </a>
    </div>

</body>

</html>