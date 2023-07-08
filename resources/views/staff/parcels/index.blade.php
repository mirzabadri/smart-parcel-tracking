<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parcels</title>

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
    @include('staff.layouts.navbar')

    <main class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Parcels</h2>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <a href="{{ route('staff.parcels.create') }}" class="btn btn-primary mb-3">Create Parcel</a>
                <ul class="list-group">
                    @foreach ($parcels as $parcel)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('staff.parcels.show', $parcel) }}">
                                {{ $parcel->sender_name }} to {{ $parcel->receiver_name }}
                            </a>
                            <div class="d-flex">
                                <a href="{{ route('staff.parcels.edit', $parcel) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                                <form action="{{ route('staff.parcels.destroy', $parcel) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this parcel?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </main>

    @include('staff.layouts.footer')
</body>
</html>
