<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit News Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Edit News</h3>
                    <form action="{{ route('news.update', $news->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="headline" class="block font-medium text-sm">Headline:</label>
                            <input type="text" id="headline" name="headline" 
                                   class="form-input w-full mt-1" 
                                   value="{{ $news->headline }}" 
                                   required>
                            @error('headline')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block font-medium text-sm">Content:</label>
                            <textarea id="content" name="content" rows="6" 
                                      class="form-input w-full mt-1" 
                                      required>{{ $news->content }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="date_published" class="block font-medium text-sm">Date Published:</label>
                            <input type="date" id="date_published" name="date_published" 
                                   class="form-input w-full mt-1" 
                                   value="{{ $news->date_published }}" 
                                   required>
                            @error('date_published')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" 
                                class="px-4 py-2 bg-blue-500 text-black rounded-lg">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
