@extends('layouts.app')

@section('content')
<div class="auth-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mb-5">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <i class="fa-solid fa-hotel fa-3x text-primary"></i>
                        <span class="ms-2 fs-2 d-block mt-2">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                
                <div class="card border-0 shadow-lg p-4">
                    <div class="card-body">
                        <h3 class="fw-bold mb-3">{{ __('Verify Your Email Address') }}</h3>

                        @if (session('resent'))
                            <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p class="text-muted mb-4">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                        </p>

                        <form class="d-grid" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg">{{ __('Click here to request another') }}</button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('logout') }}" class="text-muted small text-decoration-none"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
