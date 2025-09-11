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
    @include('layouts.navbar')

    <div class="max-w-5xl mx-auto mt-10 px-4">

        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 shadow flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-800 shadow">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Rumor Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-extrabold mb-6 text-gray-900">💬 Post a New Rumor</h2>
            <form action="{{ route('rumors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block font-semibold mb-2 text-gray-700" for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
                </div>
                <div>
                    <label class="block font-semibold mb-2 text-gray-700" for="description">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="block font-semibold mb-2 text-gray-700" for="image">Image (optional)</label>
                    <input type="file" name="image" id="image"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
                </div>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow-md hover:shadow-lg transform hover:scale-105 transition">
                    🚀 Post Rumor
                </button>
            </form>
        </div>

        <!-- Rumors List -->
        <h2 class="text-3xl font-extrabold mb-6 text-gray-900">🔥 Latest Rumors</h2>
        <div class="grid gap-8 md:grid-cols-2">
            @forelse($rumors as $rumor)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden flex flex-col">
                    @if($rumor->image)
                        <img src="{{ asset('storage/' . $rumor->image) }}" alt="{{ $rumor->title }}" 
                             class="w-full h-56 object-cover hover:scale-105 transition duration-500">
                    @endif
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold mb-3 text-gray-900">{{ $rumor->title }}</h3>
                        <p class="text-gray-700 mb-4 leading-relaxed">{{ $rumor->description }}</p>
                        
                        <div class="text-sm text-gray-500 mb-4">
                            👤 Posted by: <span class="font-semibold">{{ $rumor->user->name ?? 'Unknown' }}</span> 
                            • {{ $rumor->created_at->format('M d, Y H:i') }}
                        </div>

                        <div class="mt-auto flex gap-3">
                            <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm transition">💬 Comment</a>
                            
                            @if(Auth::user()->is_admin)
                                <form action="{{ route('rumors.destroy', $rumor) }}" method="POST" class="ml-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm shadow-sm hover:shadow-md transform hover:scale-105 transition"
                                            onclick="return confirm('Are you sure you want to delete this rumor?');">
                                        🗑️ Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-lg">😢 No rumors have been posted yet.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
