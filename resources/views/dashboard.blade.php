<x-app-layout>
<head>
        <!-- Bootstrap 4 CDN CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <a href="{{ route('post.form') }}" class="btn btn-primary btn-sm p-6">Create New Post</a>
            <br>
            <br>
            <a href="{{route('post.view') }}" class="btn btn-primary btn-sm p-6">News Feed</a>
            <br>
            <br>
            <a href="{{route('profile.userList')}}" class="btn btn-primary btn-sm p-6">All Users </a>
        </div>
    </div>
</x-app-layout>
