<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #f0f9f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin-top: 40px;
        }

        .navbar {
            background-color: #4CAF50; 
        }

        .navbar-brand, .navbar-text, .btn-outline-danger {
            color: white;
        }

        .navbar-brand:hover, .btn-outline-danger:hover {
            color: #f0f9f4; 
        }

        h2 {
            font-size: 2.5rem; 
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .card {
            background-color: #ffffff; 
            border-radius: 12px; 
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); 
            border: none;
            padding: 30px;
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 2rem; 
            font-weight: 600;
            color: #333;
        }

        .card-text {
            font-size: 1.3rem;
            color: #555;
            line-height: 1.8;
        }

        .card-footer {
            background-color: transparent;
            border-top: none;
            padding: 0;
        }

        .btn-outline-danger {
            font-size: 1.3rem;
        }

        .alert {
            font-size: 1.3rem;
            text-align: center;
            padding: 20px;
            border-radius: 12px;
        }

        .card-body p {
            margin-bottom: 20px;
        }

        
        @media (max-width: 992px) {
            .container {
                max-width: 95%;
            }

            .card {
                padding: 25px;
            }

            h2 {
                font-size: 2rem;
            }

            .card-title {
                font-size: 1.8rem;
            }

            .card-text {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <div class="d-flex">
                @if(session('name'))
                    <span class="navbar-text me-3">Welcome, {{ session('name') }}!</span>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

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
            <form action="{{ route('store-blogpost') }}" method="POST">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
