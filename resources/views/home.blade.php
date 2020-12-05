@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row  justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
