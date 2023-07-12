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

<body>
    @include('staff.layouts.navbar')

    <main id="main" class="main">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Parcel</h5>
                <form method="POST" action="{{ route('staff.parcels.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="sender_name" class="col-sm-2 col-form-label">Sender Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sender_name" name="sender_name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sender_address" class="col-sm-2 col-form-label">Sender Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sender_address" name="sender_address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sender_phone_number" class="col-sm-2 col-form-label">Sender Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sender_phone_number"
                                name="sender_phone_number">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="receiver_name" class="col-sm-2 col-form-label">Receiver Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="receiver_name" name="receiver_name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="receiver_address" class="col-sm-2 col-form-label">Receiver Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="receiver_address" name="receiver_address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="receiver_phone_number" class="col-sm-2 col-form-label">Receiver Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="receiver_phone_number"
                                name="receiver_phone_number">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="weight" class="col-sm-2 col-form-label">Weight (kg)</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" class="form-control" id="weight" name="weight">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tracking_number" class="col-sm-2 col-form-label">Tracking Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tracking_number" name="tracking_number"
                                value="{{ $trackingNumber }}" readonly>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
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
