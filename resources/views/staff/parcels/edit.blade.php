<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Parcel</title>

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
                <h2 class="card-title">Edit Parcel</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('staff.parcels.update', $parcel->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="sender_name" class="form-label">Sender Name</label>
                        <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{ $parcel->sender_name }}" required>
                        @error('sender_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Add other parcel information fields -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="pending" {{ $parcel->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_transit" {{ $parcel->status === 'in_transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="delivered" {{ $parcel->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </main>

    @include('staff.layouts.footer')
</body>
</html>
