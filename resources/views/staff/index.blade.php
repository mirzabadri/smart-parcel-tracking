<!DOCTYPE html>
<html>
<head>
    <title>Manage Parcels</title>
</head>
<body>
    <h1>Manage Parcels</h1>
    <ul>
    @foreach ($parcels as $parcel)
        <li>
            {{ $parcel->sender_name }} to {{ $parcel->receiver_name }} - {{ $parcel->status }}
            <a href="{{ route('staff.parcels.edit', $parcel) }}">Update</a>
        </li>
    @endforeach
    </ul>
</body>
</html>
