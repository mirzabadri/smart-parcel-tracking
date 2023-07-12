@extends('staff.layouts.app')

@section('title', 'Update Complaint')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update Complaint {{ $complaint->id }}</h5>

                <div class="mb-3">
                    <label for="details" class="form-label">Complaint Details:</label>
                    <textarea class="form-control" id="details" rows="4" readonly>{{ $complaint->complaint_details }}</textarea>
                </div>

                <form method="POST" action="{{ route('staff.complaints.update', $complaint) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-select" id="status" name="status">
                            <option value="open" {{ $complaint->status === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved
                            </option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
