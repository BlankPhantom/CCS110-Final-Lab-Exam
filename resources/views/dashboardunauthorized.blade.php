<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('News Dashboard') }}
            </h2>
            <!-- Login Button -->
            <a href="{{ route('login') }}" 
               class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200">
                Login
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- List of News Posts -->
                <div>
                    <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-200">All News Posts</h3>
                    <div class="space-y-6">
                        @foreach($news as $new)
                            <div class="p-6 bg-gray-100 dark:bg-gray-700 rounded-lg shadow hover:shadow-lg transition duration-200">
                                <h4 class="font-semibold text-lg text-gray-800 dark:text-gray-100 mb-2">{{ $new->headline }}</h4>
                                <p class="text-sm text-gray-700 dark:text-gray-300 break-words">{{ $new->content }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                                    Published on {{ $new->date_published }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
