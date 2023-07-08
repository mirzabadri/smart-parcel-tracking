@extends('layouts.unauthorized.app')

@section('content')
    <div class="container">
        <div class="alert alert-danger" role="alert">
            You are not authorized to access this page as a staff member.
        </div>
    </div>
@endsection
