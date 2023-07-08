<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Complaint</title>

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
                <h2 class="card-title">View Complaint Detail</h2>
            </div>
            <div class="card-body">
                <p><strong>Complaint ID:</strong> {{ $complaint->id }}</p>
                <p><strong>Customer Name:</strong> {{ $complaint->customer_name }}</p>
                <p><strong>Parcel ID:</strong> {{ $complaint->parcel_id }}</p>
                <p><strong>Complaint Details:</strong> {{ $complaint->complaint_details }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('complaints.index') }}" class="btn btn-primary">Back</a>
                <a href="{{ route('complaints.edit', $complaint) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>
