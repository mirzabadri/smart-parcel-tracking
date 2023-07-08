@extends('admin.layouts.app')

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

                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    {{ __('You are logged in as admin!') }}
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
