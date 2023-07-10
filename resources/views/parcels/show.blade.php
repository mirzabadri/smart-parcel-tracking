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
</head>
<body>
    @include('layouts.navbar')

    <main class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Parcel Details</h2>
            </div>
            <div class="card-body">
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
                    @if ($parcel->status === 'pending')
                        Pending
                    @elseif ($parcel->status === 'in_transit')
                        In Transit
                    @elseif ($parcel->status === 'delivered')
                        Delivered
                    @else
                        Unknown
                    @endif
                </p>
                <button id="show-qr-code" class="btn btn-primary">Show QR Code</button> <!-- Button to show the QR code -->
                <button id="show-tracking-history" class="btn btn-primary">Show Tracking History</button> <!-- Button to show the tracking history -->
            </div>
            <div class="card-footer">
                <a href="{{ route('parcels.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('parcels.edit', $parcel) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>

    </main>

    @include('layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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
                            const updatedDate = new Date(tracking.updated_at.replace(' ', 'T')); // Convert to ISO 8601 format
                            formattedDate = updatedDate.toLocaleString(); // Change the date format if needed
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
