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

    .tracking-body {
        border-radius: 30px;
        color: #32baa5 !important;
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
        margin-right: 55px;
    }

    .tracking-status {
        color: #ffd859;
        margin-left: 70px;
    }

    .swiper-wrapper {
        display: inline-flex;
        flex-direction: row;
        overflow-y: auto;
        justify-content: center;
    }

    .swiper-slide {
        text-align: center;
        font-size: 12px;
        width: 150px;
        height: 100%;
        position: relative;
    }

    .timeline-line {
        border: none;
        border-top: 3px solid #d9d9d9;
        margin-top: 5px;
    }

    .timeline-circle {
        width: 10px;
        height: 10px;
        background-color: #d9d9d9;
        border-radius: 50%;
        position: absolute;
        left: 50%;
        transform: translate(-50%, -50%);
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
                                    <div style="margin-bottom: 15px;">
                                        <span class="tracking-number">{{ $tracking->tracking_number }}</span>
                                        <span class="tracking-status">{{ ucfirst($tracking->status) }}</span>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="card card-body tracking-body">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div id="sender-side" style="margin-top: 10px;">
                                                        <span id="sender-name" class="label" style="color: #32baa5;">{{ $tracking->sender_name }}</span>
                                                    </div>
                                                    <div class="timeline-line">
                                                        <div class="timeline-circle"></div>
                                                    </div>
                                                    <div id="sender-address" style="margin-top: 10px;">
                                                        <span class="label" style="color: #32baa5;">{{ $tracking->sender_address }}</span>
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div id="receiver-side" style="margin-top: 10px;">
                                                        <span id="receiver-name" class="label" style="color: #32baa5;">{{ $tracking->receiver_name }}</span>
                                                    </div>
                                                    <div class="timeline-line">
                                                        <div class="timeline-circle"></div>
                                                    </div>
                                                    <div id="receiver-address" style="margin-top: 10px;">
                                                        <span class="label" style="color: #32baa5;">{{ $tracking->receiver_address }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="status-time" style="color:#d9d9d9">Updated at {{ $tracking->updated_at->format('d/m/Y H:i A') }}</div>
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
