<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-xl font-bold mb-4">Edit Rumor</h2>

        <form action="{{ route('rumors.update', $rumor) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $rumor->title) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $rumor->description) }}</textarea>
                @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" class="w-full">
                @if($rumor->image)
                    <p class="text-sm mt-2">Current image:</p>
                    <img src="{{ asset('storage/' . $rumor->image) }}" class="w-32 rounded">
                @endif
                @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Update Rumor
                </button>
            </div>
        </form>
    </div>
</x-app-layout>