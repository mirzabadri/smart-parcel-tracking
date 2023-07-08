<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Complaints</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/sass/app.scss')

    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>
<body>
    @include('layouts.navbar')

    <main class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Complaints</h2>
            </div>
            <div class="card-body">
                @if ($complaints->isEmpty())
                    <p>No complaints found.</p>
                @else
                    <ul class="list-group">
                        @foreach ($complaints as $complaint)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('complaints.show', $complaint) }}">
                                    Complaint ID: {{ $complaint->id }}
                                </a>
                                <div class="d-flex">
                                    <a href="{{ route('complaints.edit', $complaint) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                                    <form action="{{ route('complaints.destroy', $complaint) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this complaint?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>
