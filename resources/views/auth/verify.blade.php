@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mx-auto">
            <div class="border shadow my-5 p-3">
                <h3 class="text-muted">{{ __('Email Verification') }}</h3>

                <div class="w-100 mt-3">
                    @if (session('verify') == 'verified' )
                        <div class="alert alert-info" role="alert">
                            {{ __(session('message')) }}
                        </div>
                    @endif

                    @if (session('verify') == 'needtoverify' )
                        <div class="alert alert-warning" role="alert">
                            {{ __(session('message')) }}
                        </div>
                    @endif

                    @if (session('verify') == 'success' )
                        <div class="alert alert-success" role="alert">
                            {{ __(session('message')) }}
                        </div>
                    @endif

                    @if(session('verify') == 'resent')
                        <div class="alert alert-light" role="alert">
                            {{ __('Please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }}, <br><a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
