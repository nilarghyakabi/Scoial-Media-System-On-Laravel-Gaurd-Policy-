<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Create a New Post</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Upload -->
                        <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" name="image" id="image" class="form-control-file">
        <small class="form-text text-muted">Optional. Supported formats: jpeg, png, jpg, gif, svg.</small>
        @error('image')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
                        
                        <!-- Caption Input -->
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <textarea name="caption" id="caption" class="form-control" rows="3" placeholder="What's on your mind?" required>{{ old('caption') }}</textarea>
                            @error('caption')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        

                        

                        <!-- Submit Button -->
                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript for Bootstrap (if using local copy of Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
