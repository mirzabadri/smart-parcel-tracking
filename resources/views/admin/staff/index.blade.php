@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>List of Account</h1>

                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table table-hover" id="accountMembersTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accountMembers as $index => $accountMember)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $accountMember->name }}</td>
                                    <td>{{ $accountMember->email }}</td>
                                    <td>{{ ucfirst($accountMember->role) }}</td>
                                    <td>
                                        <a href="{{ route('admin.staff.edit', $accountMember->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('admin.staff.destroy', $accountMember->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
