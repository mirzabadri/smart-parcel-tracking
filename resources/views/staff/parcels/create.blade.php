<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Parcel</title>

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
                <h2 class="card-title">Create Parcel</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('staff.parcels.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="sender_name" class="form-label">Sender Name:</label>
                        <input id="sender_name" name="sender_name" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="sender_address" class="form-label">Sender Address:</label>
                        <input id="sender_address" name="sender_address" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="sender_phone_number" class="form-label">Sender Phone Number:</label>
                        <input id="sender_phone_number" name="sender_phone_number" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="receiver_name" class="form-label">Receiver Name:</label>
                        <input id="receiver_name" name="receiver_name" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="receiver_address" class="form-label">Receiver Address:</label>
                        <input id="receiver_address" name="receiver_address" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="receiver_phone_number" class="form-label">Receiver Phone Number:</label>
                        <input id="receiver_phone_number" name="receiver_phone_number" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight (kg):</label>
                        <input id="weight" name="weight" type="number" step="0.01" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tracking_number" class="form-label">Tracking Number:</label>
                        <input id="tracking_number" name="tracking_number" type="text" class="form-control" value="{{ $trackingNumber }}" readonly>
                    </div>
                    
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
                @if (session('message'))
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            document.querySelector('.alert-success').style.display = 'none';
                        }, 3000);
                    </script>
                @endif

            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>
