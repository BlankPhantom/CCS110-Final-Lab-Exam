<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Blog Post Form -->
    <div class="container mt-4">
        <div class="card p-4">
            <h3>Create New Blog Post</h3>
            <form action="{{ route('store-news') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Blog Title:</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Blog Content:</label>
                    <textarea name="content" class="form-control" id="content" rows="6" required></textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Create Post</button>
            </form>
        </div>
    </div>

    <!-- Display All Blogs -->
    <div class="container blog-posts mt-5">
        <h2>All Blog Posts</h2>
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ $blog->content }}</p>
                            <p class="card-text"><small class="text-muted">By: {{ $blog->user->name }}</small></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Posted on {{ $blog->created_at->format('F j, Y') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
