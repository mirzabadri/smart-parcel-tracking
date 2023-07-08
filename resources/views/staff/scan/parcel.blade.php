<!DOCTYPE html>
<html>

<head>
    <title>QR Scanner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html,
        body {
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div id="scanner-container"></div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function onScanSuccess(qrCodeMessage) {
            var url = "{{ route('staff.parcels.edit', ['parcel' => ':parcel']) }}";
            url = url.replace(':parcel', qrCodeMessage);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    console.log(response.message);
                    // alert(qrCodeMessage);
                    // Perform any additional actions or redirection if needed
                    window.location.href = url;
                }
            });
        }



        var html5QrcodeScanner = new Html5QrcodeScanner(
            "scanner-container", {
                fps: 10,
                qrbox: 500
            },
            /* verbose= */
            false
        );
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>

</html>
