<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Staff Details</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    @vite('resources/sass/app.scss')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100">
    @include('admin.layouts.navbar')

    <main class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Edit Staff Details</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.staff.update', $user->id) }}" method="POST" class="mt-6">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <!-- Add other staff attributes as needed -->
                    
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                    
                </form>
            </div>
        </div>
    </main>
</body>
</html>
