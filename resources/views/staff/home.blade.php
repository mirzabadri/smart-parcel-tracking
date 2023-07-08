@extends('staff.layouts.app')

@section('content')
<style>
  .icon-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: inherit;
    margin-right: 10px;
  }

  .icon {
    width: 24px;
    height: 24px;
    margin-bottom: 4px;
  }

  .icon-name {
    font-size: 12px;
    text-align: center;
  }

  .icons-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 10px;
  }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    
                    <div class="icons-wrapper">
                        <a href="{{ route('staff.parcels.index') }}" class="icon-container">
                          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10h-4.586l-1.71-3.419A2 2 0 0 0 12.894 4H11V2H9v2H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V12a2 2 0 0 0-2-2zm-3 0H6v10h12V10zm-6 3v2m0 0v2m0-2h2m-2 0H9"/>
                          </svg>
                          <span class="icon-name">Parcel</span>
                        </a>
                        
                        <a href="{{ route('staff.complaints.index') }}" class="icon-container">
                          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 13l-2 2m0 0l-4-4m4 4H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6zM3 3h18v12H3V3z" />
                          </svg>
                          <span class="icon-name">Complaint</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
