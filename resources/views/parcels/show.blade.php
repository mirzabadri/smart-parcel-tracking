<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Parcel</title>

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

    <!-- Custom CSS for timeline -->
    <style>
        .timeline {
            position: relative;
            padding: 20px 0;
        }

        .timeline::before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            /* Changed from left: 50% */
            width: 2px;
            background-color: #32baa5;
            /* Point color */
        }

        .timeline-event {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-event::before {
            content: "";
            position: absolute;
            top: 5px;
            left: -10px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #32baa5;
            /* Point color */
            background-color: #32baa5;
            /* Point color */
        }

        .timeline-event:nth-child(n+2)::before,
        .timeline-event:nth-child(n+2)::after {
            /* Line color from previous point */
            border-color: #32baa5;
            /* Point color */
        }

        /* Add more color styles for additional timeline events */

        .timeline-event .event-date {
            margin-bottom: 8px;
            font-weight: 600;
            position: relative;
            /* Added */
            left: 30px;
            /* Added */
        }

        .timeline-event .event-description {
            padding-left: 34px;
        }
    </style>


</head>

<body>
    @include('layouts.navbar')

    <main id="main" class="main">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Parcel Details</h5>
                <p><strong>Parcel ID:</strong> {{ $parcel->id }}</p>
                <p><strong>Sender Name:</strong> {{ $parcel->sender_name }}</p>
                <p><strong>Sender Address:</strong> {{ $parcel->sender_address }}</p>
                <p><strong>Sender Phone Number:</strong> {{ $parcel->sender_phone_number }}</p>
                <p><strong>Receiver Name:</strong> {{ $parcel->receiver_name }}</p>
                <p><strong>Receiver Address:</strong> {{ $parcel->receiver_address }}</p>
                <p><strong>Receiver Phone Number:</strong> {{ $parcel->receiver_phone_number }}</p>
                <p><strong>Weight:</strong> {{ $parcel->weight }}</p>
                <p><strong>Description:</strong> {{ $parcel->description }}</p>
                <p><strong>Tracking Number:</strong> {{ $parcel->tracking_number }}</p>
                <button id="show-qr-code" class="btn btn-primary mb-2" data-bs-toggle="modal"
                    data-bs-target="#qrModal">Show QR Code</button>
                <!-- Button to show the QR code -->
                <button id="show-tracking-history" class="btn btn-primary mb-2">Show Tracking History</button>
                <!-- Button to show the tracking history -->
            </div>
            <div class="card-footer">
                <a href="{{ route('parcels.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('parcels.edit', $parcel) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </main>

    @include('layouts.footer')

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
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.getElementById('show-qr-code').addEventListener('click', function() {
            const qrCodeImage = document.getElementById('qr-code-image');

            qrCodeImage.src =
                `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ $parcel->tracking_number }}`;
        });

        document.getElementById('show-tracking-history').addEventListener('click', function() {
            fetch(`/parcels/{{ $parcel->id }}/tracking-history`)
                .then(response => response.json())
                .then(data => {
                    const trackingList = document.getElementById('tracking-list');
                    trackingList.innerHTML = '';

                    let prevColor = null;

                    data.forEach((tracking, index) => {
                        const event = document.createElement('div');
                        event.classList.add('timeline-event');
                        event.style.setProperty('--prev-color', prevColor);

                        const date = document.createElement('div');
                        date.classList.add('event-date');
                        date.textContent = tracking.updated_at || 'N/A';
                        event.appendChild(date);

                        const description = document.createElement('div');
                        description.classList.add('event-description');
                        description.textContent = tracking.status;
                        event.appendChild(description);

                        trackingList.appendChild(event);

                        if (index === 0) {
                            prevColor = getComputedStyle(event).getPropertyValue('background-color');
                        } else {
                            prevColor = getComputedStyle(event.previousSibling).getPropertyValue(
                                'background-color');
                        }
                    });

                    const trackingModal = new bootstrap.Modal(document.getElementById('trackingModal'));
                    trackingModal.show();
                })
                .catch(error => {
                    console.error('Error fetching tracking history:', error);
                });
        });
    </script>

    <!-- Modals... -->
    <!-- QR Code Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="qr-code-image" src="" alt="QR Code" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Tracking History Modal -->
    <div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackingModalLabel">Parcel Movement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="timeline">
                        <div id="tracking-list"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
