<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Flash Message -->
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 bg-green-200 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form to Create News Post -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Create a New Post</h3>
                    <form action="{{ route('store-news') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="author" class="block font-medium text-sm">Author:</label>
                            <input type="text" id="author" name="author" 
                                   class="form-input w-full mt-1" 
                                   placeholder="Enter the news author" 
                                   required>
                            @error('headauthorline')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="headline" class="block font-medium text-sm">Headline:</label>
                            <input type="text" id="headline" name="headline" 
                                   class="form-input w-full mt-1" 
                                   placeholder="Enter the news headline" 
                                   required>
                            @error('headline')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block font-medium text-sm">Content:</label>
                            <textarea id="content" name="content" rows="6" 
                                      class="form-input w-full mt-1" 
                                      placeholder="Write the news content here" 
                                      required></textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="date_published" class="block font-medium text-sm">Date Published:</label>
                            <input type="date" id="date_published" name="date_published" 
                                   class="form-input w-full mt-1" 
                                   required>
                            @error('date_published')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit">
                            submit
                        </button>
                        
                    </form>
                </div>

                <!-- List of News Posts -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">All News Posts</h3>
                    <div class="space-y-4">
                        @foreach($news as $new)
                            <div class="p-4 bg-gray-100 rounded-lg">
                                <h4 class="font-semibold">{{ $new->headline }}</h4>
                                <p>{{ $new->content }}</p>
                                <p class="text-sm text-gray-600">
                                    Published by {{ $new->user->name }} on {{ $new->date_published }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
