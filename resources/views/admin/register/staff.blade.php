@extends('admin.layouts.app')

@section('title', 'Register Staff')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title">Register Staff</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.store.staff') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="staff_role" class="form-label">Staff Role:</label>
                    <select class="form-control @error('staff_role') is-invalid @enderror" id="staff_role" name="staff_role" required>
                        <option value="admin">Admin</option>
                        <option value="supervisor">Supervisor</option>
                        <option value="driver">Driver</option>
                        <option value="sorter">Sorter</option>
                    </select>
                    @error('staff_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
