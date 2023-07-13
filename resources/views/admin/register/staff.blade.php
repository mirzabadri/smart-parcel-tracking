@extends('admin.layouts.app')

@section('title', 'Register Staff')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Register Staff</h5>

            <!-- Horizontal Form -->
            <form method="POST" action="{{ route('admin.store.staff') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Staff Role</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="staff_role" id="gridRadios1" value="admin" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Admin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="staff_role" id="gridRadios2" value="supervisor">
                            <label class="form-check-label" for="gridRadios2">
                                Supervisor
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="staff_role" id="gridRadios3" value="driver">
                            <label class="form-check-label" for="gridRadios3">
                                Driver
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="staff_role" id="gridRadios4" value="sorter">
                            <label class="form-check-label" for="gridRadios4">
                                Sorter
                            </label>
                        </div>
                        @error('staff_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End Horizontal Form -->
        </div>
    </div>
@endsection
