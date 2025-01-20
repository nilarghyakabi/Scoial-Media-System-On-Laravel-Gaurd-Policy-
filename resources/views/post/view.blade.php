<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .post-container {
            border-bottom: 1px solid #e0e0e0;
            padding: 15px;
            margin-bottom: 15px;
        }

        .post-image {
            max-width: 100%;      
            height: auto;         
            max-height: 400px;    
            object-fit: cover;    
            margin-bottom: 15px;  
        }

        .post-actions {
            font-size: 14px;
        }

        .card-body {
            padding: 15px;
        }

        .btn-sm {
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">All Posts</h2>

    <!-- Success and Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- List of Posts -->
    @foreach($posts as $post)
        @can('view', $post)    <!--POlicy -->
        <div class="post-container">
            <!-- User Info Section -->
            <div class="d-flex align-items-center mb-3">
            @if($post->user)
                <h6 class="mb-0">Posted by: <a href="{{route('profile.view',['id' => $post->user->id])}}">{{ $post->user->name ?? 'Unknown User' }}</a></h6>
                @else
            Unknown User
        @endif
            </div>
            <div>
                <small>Posted on: {{ $post->created_at->format('F j, Y, g:i a') }}</small>
                @if ($post->updated_at != $post->created_at)
                    <small>Edited on: {{$post->updated_at->format('F j,Y,g:i a')  }}</small>
                @endif
            </div>

            <!-- Post Content -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->caption }}</h5>
                    
                    <!-- Post Image -->
                    @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" class="post-image mb-3" alt="Post Image">
                    @endif
                        
                    <div class="d-flex justify-content-between post-actions">
                    @can('edit', $post)   
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                    @can('delete', $post)
                        <form action="{{ route('post.delete', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endcan
                    </div>
                </div>
            </div>
        </div>
        @endcan
    @endforeach
</div>

<!-- Optional JavaScript for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-app-layout>
