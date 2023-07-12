@extends('staff.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('You are logged in as staff!') }}
                <br>

                <div class="icons-wrapper"
                    style="display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
                    <a href="{{ route('staff.parcels.index') }}"
                        style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit; margin-bottom: 20px;">
                        <i class="bi bi-box-seam" style="font-size: 28px; margin-bottom: 4px;"></i>
                        <span style="font-size: 14px; text-align: center;">Parcel</span>
                    </a>

                    <a href="{{ route('staff.complaints.index') }}"
                        style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit; margin-bottom: 20px;">
                        <i class="bi bi-chat-left-text" style="font-size: 28px; margin-bottom: 4px;"></i>
                        <span style="font-size: 14px; text-align: center;">Complaint</span>
                    </a>

                    <a href="{{ route('staff.scan.parcel') }}"
                        style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit; margin-bottom: 20px;">
                        <i class="bi bi-upc-scan" style="font-size: 28px; margin-bottom: 4px;"></i>
                        <span style="font-size: 14px; text-align: center;">Scan Parcel</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
