<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Complaint</title>

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
                <h2 class="card-title">Edit Complaint</h2>
            </div>
            <div class="card-body">
        <form method="POST" action="{{ route('complaints.update', $complaint) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="customer_name" class="form-label">Your Name:</label>
                <input id="customer_name" name="customer_name" type="text" class="form-control" value="{{ $complaint->customer_name }}" required>
            </div>

            <div class="mb-3">
                <label for="parcel_id" class="form-label">Parcel ID:</label>
                <input id="parcel_id" name="parcel_id" type="number" class="form-control" value="{{ $complaint->parcel_id }}" required>
            </div>

            <div class="mb-3">
                <label for="complaint_details" class="form-label">Complaint Details:</label>
                <textarea id="complaint_details" name="complaint_details" class="form-control" required>{{ $complaint->complaint_details }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
</main>

        @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif

    @include('layouts.footer')
</body>
</html>
