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
                <p><strong>Status:</strong>
                    @if ($parcel->status === 'created')
                        Order Created
                    @elseif ($parcel->status === 'picked_up')
                        Parcel has been picked up
                    @elseif ($parcel->status === 'departed')
                        Parcel has departed from the sorting facility
                    @elseif ($parcel->status === 'out_for_delivery')
                        Parcel is out for delivery
                    @elseif ($parcel->status === 'delivered')
                        Parcel has been delivered
                    @else
                        Unknown
                    @endif
                </p>
                <button id="show-qr-code" class="btn btn-primary mb-2">Show QR Code</button>
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

    <script>
        document.getElementById('show-qr-code').addEventListener('click', function() {
            const qrCodeSvg = `{!! QrCode::size(300)->format('svg')->generate($parcel->tracking_number) !!}`;
            const qrModalBody = document.createElement('div');
            qrModalBody.innerHTML = qrCodeSvg;

            const qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
            qrModalBody.classList.add('text-center', 'mx-auto');
            qrModalBody.style.maxWidth = '90vw';
            qrModalBody.style.width = '90%';

            const modalContent = document.querySelector('#qrModal .modal-content');
            modalContent.innerHTML = '';
            modalContent.appendChild(qrModalBody);

            qrModal.show();
        });

        document.getElementById('show-tracking-history').addEventListener('click', function() {
            // Fetch tracking history data
            console.log('Fetching tracking history...');
            fetch(`/parcels/{{ $parcel->id }}/tracking-history`)
                .then(response => response.json())
                .then(data => {
                    console.log('Received tracking history data:', data);

                    const trackingList = document.getElementById('tracking-list');
                    trackingList.innerHTML = '';

                    // Display tracking history
                    data.forEach(tracking => {
                        const row = document.createElement('tr');
                        const timestampCell = document.createElement('td');
                        const statusCell = document.createElement('td');

                        let formattedDate = 'N/A'; // Default value if updated_at is undefined

                        if (tracking.updated_at) {
                            const updatedDate = new Date(tracking.updated_at.replace(' ',
                                'T')); // Convert to ISO 8601 format
                            formattedDate = updatedDate
                                .toLocaleString(); // Change the date format if needed
                        }

                        timestampCell.textContent = formattedDate;
                        statusCell.textContent = tracking.status;

                        row.appendChild(timestampCell);
                        row.appendChild(statusCell);
                        trackingList.appendChild(row);
                    });

                    // Show the tracking history modal
                    const trackingModal = new bootstrap.Modal(document.getElementById('trackingModal'));
                    trackingModal.show();
                })
                .catch(error => {
                    console.error('Error fetching tracking history:', error);
                });
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <!-- Tracking History Modal -->
    <div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackingModalLabel">Tracking History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tracking-list"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
