@extends('layouts.app')

<style>
    .timeline {
        display: flex;
        overflow-x: auto;
        padding-bottom: 20px;
    }

    .timeline-item {
        flex: 0 0 auto;
        margin-right: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    .timeline-date {
        margin-bottom: 5px;
    }

    .tracking-body {
        border-radius: 10px;
        color: #32baa5 !important;
    }

    .sender-receiver {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .sender-info,
    .receiver-info {
        display: flex;
        gap: 2px;
    }

    .label {
        font-weight: bold;
        text-transform: capitalize;
    }

    .value {
        margin-left: 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tracking-number {
        color: #32baa5;
        white-space: nowrap;
        overflow: hidden;
        margin-right: 10px;
    }

    .tracking-status {
        color: #ffd859;
        margin-left: 20px;
        text-align: right !important;
    }
</style>

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

                <div class="container-fluid py-2">
                    <h2 class="font-weight-light" style="margin-bottom: 20px;">Your Shipment</h2>
                    <div class="timeline">
                        @foreach ($parcelData->sortByDesc('created_at') as $index => $tracking)
                            <div class="timeline-item">
                                <a href="{{ route('parcels.show', $tracking->id) }}" class="card-link">
                                    <div class="one-line" style="margin-bottom: 15px;">
                                        <span class="tracking-number">{{ $tracking->tracking_number }}</span>
                                        <span class="tracking-status">{{ ucfirst($tracking->status) }}</span>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="card card-body tracking-body">
                                            <div class="sender-receiver-container">
                                                <div class="sender-info" style="margin-top: 10px;">
                                                    <span class="label">Sender:</span>
                                                    <span class="value">{{ $tracking->sender_name }}</span>
                                                </div>
                                                <div class="sender-info">
                                                    <span class="label">From:</span>
                                                    <span class="value">{{ $tracking->sender_address }}</span>
                                                </div>
                                                <div class="receiver-info">
                                                    <span class="label">Receiver:</span>
                                                    <span class="value">{{ $tracking->receiver_name }}</span>
                                                </div>
                                                <div class="receiver-info">
                                                    <span class="label">To:</span>
                                                    <span class="value">{{ $tracking->receiver_address }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
