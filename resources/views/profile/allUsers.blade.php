<x-app-layout>
    <head>
        <!-- Bootstrap 4 CDN -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0v8Fq0XtA4K3gJbD4oFg6HkR5OLf6EdzHgVS5E0dMGw4xd/4" crossorigin="anonymous">

        <!-- Bootstrap 4 CDN CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <div class="container mt-5">
        <h2 class="text-center mb-4">User List</h2>

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

        <!-- Table of Users -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Sl/No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('profile.view', ['id' => $user->id]) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy1dFPx1xA0Me8h0V0T1L03/1p/SkRm5K7KbF/hQ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8Fq0XtA4K3gJbD4oFg6HkR5OLf6EdzHgVS5E0dMGw4xd/4" crossorigin="anonymous"></script>
</x-app-layout>