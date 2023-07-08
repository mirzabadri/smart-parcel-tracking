<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Complaints</title>

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
        <h1>Manage Complaints</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Complaint Details</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaints as $complaint)
                    <tr>
                        <td>{{ $complaint->customer_name }}</td>
                        <td>{{ $complaint->complaint_details }}</td>
                        <td>
                            @if ($complaint->status === 'resolved')
                                Resolved
                            @else
                                Open
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('staff.complaints.edit', $complaint) }}">Update</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    @include('staff.layouts.footer')
</body>
</html>
