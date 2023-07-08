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
    @include('layouts.navbar')

    <main class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Edit Parcel</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('parcels.update', $parcel) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="sender_name" class="form-label">Sender Name</label>
                        <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{ $parcel->sender_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sender_address" class="form-label">Sender Address</label>
                        <input type="text" class="form-control" id="sender_address" name="sender_address" value="{{ $parcel->sender_address }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sender_phone_number" class="form-label">Sender Phone Number</label>
                        <input type="text" class="form-control" id="sender_phone_number" name="sender_phone_number" value="{{ $parcel->sender_phone_number }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="receiver_name" class="form-label">Receiver Name</label>
                        <input type="text" class="form-control" id="receiver_name" name="receiver_name" value="{{ $parcel->receiver_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="receiver_address" class="form-label">Receiver Address</label>
                        <input type="text" class="form-control" id="receiver_address" name="receiver_address" value="{{ $parcel->receiver_address }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="receiver_phone_number" class="form-label">Receiver Phone Number</label>
                        <input type="text" class="form-control" id="receiver_phone_number" name="receiver_phone_number" value="{{ $parcel->receiver_phone_number }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" class="form-control" id="weight" name="weight" step="0.01" value="{{ $parcel->weight }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $parcel->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tracking_number" class="form-label">Tracking Number</label>
                        <input type="text" class="form-control" id="tracking_number" name="tracking_number" value="{{ $parcel->tracking_number }}" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>
