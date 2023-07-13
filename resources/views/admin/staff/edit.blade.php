<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Staff Details</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    @vite('resources/sass/app.scss')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/js/app.js')

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @include('admin.layouts.navbar')

    <main id="main" class="main">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Staff Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.staff.update', $user->id) }}" method="POST" class="mt-6">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input id="name" name="name" type="text" class="form-control"
                            value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input id="email" name="email" type="email" class="form-control"
                            value="{{ $user->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role:</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="User" {{ $user->role === 'User' ? 'selected' : '' }}>User</option>
                            <option value="Supervisor" {{ $user->role === 'Supervisor' ? 'selected' : '' }}>Supervisor
                            </option>
                            <option value="Driver" {{ $user->role === 'Driver' ? 'selected' : '' }}>Driver</option>
                            <option value="Sorter" {{ $user->role === 'Sorter' ? 'selected' : '' }}>Sorter</option>
                            <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- Add other staff attributes as needed -->

                    <a href="{{ route('admin.staff.index') }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>
    </main>
</body>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>
