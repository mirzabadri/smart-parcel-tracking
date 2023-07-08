@extends('staff.layouts.app')

@section('title', 'Update Complaint')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Update Complaint {{ $complaint->id }}</h2>
            </div>
            <div class="card-body">
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
                            <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
