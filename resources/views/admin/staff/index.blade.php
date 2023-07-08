@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>List of Staff</h1>

                @foreach ($user as $staffMember)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $staffMember->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $staffMember->email }}</h6>
                            <a href="{{ route('admin.staff.edit', $staffMember->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.staff.destroy', $staffMember->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
