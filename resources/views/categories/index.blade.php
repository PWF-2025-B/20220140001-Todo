<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo Category') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
            <div class="flex justify-between mb-4">
                <div class="flex items-center justify-between">
    <x-create-button href="{{ route('categories.create') }}" class="text-white" />
</div>


                @if (session('success'))
                    <p class="text-green-600 dark:text-green-400">{{ session('success') }}</p>
                @endif
                @if (session('danger'))
                    <p class="text-red-600 dark:text-red-400">{{ session('danger') }}</p>
                @endif
            </div>

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Todos</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="bg-white dark:bg-gray-800">
                            <td class="px-6 py-4">
                                <a href="{{ route('categories.edit', $category) }}" class="hover:underline">{{ $category->title }}</a>
                            </td>
                            <td class="px-6 py-4">{{ $category->todos->count() }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center py-4">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>