<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-header {
            margin-bottom: 30px;
            text-align: center;
        }
        .followUnfollow {
            text-align:center;
        }

        .profile-image {
            max-width: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            display: block;        
            margin-left: auto;     
            margin-right: auto;
        }

        .post-container {
            border-bottom: 1px solid #e0e0e0;
            padding: 15px;
            margin-bottom: 15px;
        }

        .post-image {
            max-width: 100%;      
            height: auto;         
            max-height: 300px;    
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

        .follow-btn {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    
    <div class="profile-header">
   
        @if ($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="profile-image">
        @else
            <img src="https://via.placeholder.com/150" alt="Profile Image" class="profile-image">
        @endif
        
        <!-- User Info -->
        <h2>{{ $user->name }}</h2>
        <p>{{ $user->email }}</p>
        

        
    </div>

    <!-- User's Posts -->
    <h3 class="text-center mb-4">Posts by {{ $user->name }}</h3>

            <!-- Follow/Unfollow Button -->
            @if(auth()->check() && auth()->user() instanceof App\Models\User && auth()->user()->id !== $user->id)
    <div class="mt-3">
        <div class="followUnfollow">
        @if(auth()->user()->isFollowing($user))
            <form action="{{ route('unfollow', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger follow-btn">Unfollow</button>
            </form>
        @else
            <form action="{{ route('follow', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary follow-btn">Follow</button>
            </form>
        @endif
        </div>
    </div>
@endif

    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Posts -->
    @foreach($user->posts as $post)
    @can('view', $post)    <!--POlicy -->
        <div class="post-container">
            <!-- User info section -->
            <div class="d-flex align-items-center mb-3">
                <h6 class="mb-0">Posted by: {{ $post->user->name ?? 'Unknown User' }}</h6>
            </div>
            <div>
                <small>Posted on: {{ $post->created_at->format('F j, Y, g:i a') }}</small>
                @if ($post->updated_at != $post->created_at)
                    <small>Edited on: {{$post->updated_at->format('F j,Y,g:i a')  }}</small>
                @endif
            </div>
            
            <!-- Post content -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->caption }}</h5>
                    
                    <!-- Post image -->
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

<!-- JavaScript for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-app-layout>
