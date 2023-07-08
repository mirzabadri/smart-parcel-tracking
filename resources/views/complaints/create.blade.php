<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Submit Complaint</title>

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
                <h2 class="card-title">Submit Complaint</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('complaints.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="customer_name" class="form-label">Your Name:</label>
                        <input id="customer_name" name="customer_name" type="text" class="form-control @error('customer_name') is-invalid @enderror" required>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="parcel_id" class="form-label">Parcel ID:</label>
                        <input id="parcel_id" name="parcel_id" type="number" class="form-control @error('parcel_id') is-invalid @enderror" required>
                        @error('parcel_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="complaint_details" class="form-label">Complaint Details:</label>
                        <textarea id="complaint_details" name="complaint_details" class="form-control @error('complaint_details') is-invalid @enderror" rows="5" required></textarea>
                        @error('complaint_details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @if (session('message'))
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </main>
    @include('layouts.footer')
</body>
</html>
