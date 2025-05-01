<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Snackbar Notification --}}
            @if (session('success') || session('danger'))
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform translate-y-2"
                     x-init="setTimeout(() => show = false, 5000)"
                     class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50 flex items-center p-4 rounded-md shadow-lg {{ session('success') ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                    <div class="flex items-center">
                        @if(session('success'))
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                        <span class="font-medium">{{ session('success') ?? session('danger') }}</span>
                    </div>
                    <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Create Button --}}
            <div class="flex justify-end">
                <x-create-button href="{{ route('todo.create') }}" />
            </div>

            {{-- Todo Table --}}
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Title</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $data)
                                <tr class="border-b dark:border-gray-700 odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800">
                                    <td class="px-6 py-4 font-medium">
                                        <a href="{{ route('todo.edit', $data) }}" class="hover:underline">
                                            {{ $data->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if (!$data->is_done)
                                            <span class="inline-flex items-center bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 text-sm font-semibold px-3 py-0.5 rounded-full">
                                                On Going
                                            </span>
                                        @else
                                            <span class="inline-flex items-center bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 text-sm font-semibold px-3 py-0.5 rounded-full">
                                                Complete
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2 flex-wrap">
                                            @if (!$data->is_done)
                                                <form action="{{ route('todo.complete', $data) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit"
                                                        class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1 rounded-md">
                                                        Done
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('todo.uncomplete', $data) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <button type="submit"
                                                        class="bg-yellow-600 hover:bg-yellow-700 text-white text-xs px-3 py-1 rounded-md">
                                                        Uncomplete
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('todo.destroy', $data) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-xs text-red-600 hover:underline">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($todosCompleted > 1)
                    <div class="p-6 border-t dark:border-gray-700">
                        <form action="{{ route('todo.deleteallcompleted') }}" method="POST">
                            @csrf @method('DELETE')
                            <x-primary-button>
                                Delete All Completed Tasks
                            </x-primary-button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>