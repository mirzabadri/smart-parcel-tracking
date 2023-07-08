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
    @include('layouts.navbar')

    <main class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Parcels</h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($parcels as $parcel)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {!! QrCode::size(100)->generate($parcel->tracking_number) !!}
                            </div>
                            <div>
                                <a href="{{ route('parcels.show', $parcel) }}">
                                    {{ $parcel->sender_name }} to {{ $parcel->receiver_name }}
                                </a>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('parcels.edit', $parcel) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                                <form action="{{ route('parcels.destroy', $parcel) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this parcel?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>
