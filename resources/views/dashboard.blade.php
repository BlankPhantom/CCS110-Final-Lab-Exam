<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Flash Message -->
                @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 bg-green-200 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Search Form -->
                <form action="{{ route('news.search') }}" method="GET" class="mb-8">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Search News</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="headline" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Search by Headline:</label>
                            <input type="text" name="headline" id="headline" 
                                   class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-blue-500" 
                                   placeholder="Headline">
                        </div>
                        <div>
                            <label for="author" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Search by Author:</label>
                            <input type="text" name="author" id="author" 
                                   class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-blue-500" 
                                   placeholder="Author">
                        </div>
                        <div>
                            <label for="date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Search by Date:</label>
                            <input type="date" name="date" id="date" 
                                   class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200">
                            Search
                        </button>
                    </div>
                </form>

                <!-- Form to Create News Post -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Create a New Post</h3>
                    <form action="{{ route('store-news') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="author" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Author:</label>
                            <input type="text" id="author" name="author" 
                                   class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-blue-500" 
                                   placeholder="Enter the news author" 
                                   required>
                            @error('author')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="headline" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Headline:</label>
                            <input type="text" id="headline" name="headline" 
                                   class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-blue-500" 
                                   placeholder="Enter the news headline" 
                                   required>
                            @error('headline')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="content" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Content:</label>
                            <textarea id="content" name="content" rows="6" 
                                      class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-blue-500" 
                                      placeholder="Write the news content here" 
                                      required></textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="date_published" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Date Published:</label>
                            <input type="date" id="date_published" name="date_published" 
                                   class="w-full px-4 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-blue-500" 
                                   required>
                            @error('date_published')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-right">
                            <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

                <!-- List of News Posts -->
                <div>
                    <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-200">All News Posts</h3>
                    <div class="space-y-6">
                        @foreach($news as $new)
                        <div class="p-6 bg-gray-100 dark:bg-gray-700 rounded-lg shadow hover:shadow-lg transition duration-200">
                            <h4 class="font-semibold text-lg text-gray-800 dark:text-gray-100 mb-2">{{ $new->headline }}</h4>
                            <!-- Ensure content wraps inside the card -->
                            <p class="text-sm text-gray-700 dark:text-gray-300 break-words">{{ $new->content }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                                Published by {{ $new->user->name ?? 'Unknown' }} on {{ $new->date_published }}
                            </p>
                            <div class="flex justify-end space-x-4 mt-4">
                                <!-- Edit Button -->
                                <a href="{{ route('news.edit', $new->id) }}" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 text-sm">
                                    Edit
                                </a>
                                <!-- Delete Button -->
                                <form action="{{ route('news.destroy', $new->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200 text-sm"
                                            onclick="return confirm('Are you sure you want to delete this news post?');">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
