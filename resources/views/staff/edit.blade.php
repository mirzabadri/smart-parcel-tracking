<!DOCTYPE html>
<html>
<head>
    <title>Update Parcel</title>
</head>
<body>
    <h1>Update Parcel {{ $parcel->id }}</h1>
    <form method="POST" action="{{ route('staff.parcels.update', $parcel) }}">
        @csrf
        @method('PATCH')
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="pending">Pending</option>
            <option value="in_transit">In Transit</option>
            <option value="delivered">Delivered</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
