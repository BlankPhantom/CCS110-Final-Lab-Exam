<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Search Results</h3>
                    @if($news->isEmpty())
                        <p>No news posts found.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($news as $new)
                                <div class="p-4 bg-gray-100 rounded-lg">
                                    <h4 class="font-semibold">{{ $new->headline }}</h4>
                                    <p>{{ $new->content }}</p>
                                    <p class="text-sm text-gray-600">
                                        Published by {{ $new->author }} on {{ $new->date_published }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
