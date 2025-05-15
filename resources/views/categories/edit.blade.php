<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <form action="{{ route('categories.update', $category) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-200 mb-2">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $category->title) }}"
                    required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                />
                @error('title')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('categories.index') }}" class="mr-4 text-gray-500 hover:underline">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>