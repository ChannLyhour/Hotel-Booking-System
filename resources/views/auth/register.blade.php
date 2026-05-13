@extends('admin.layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Left Side: Form -->
            <div class="col-lg-6 d-flex align-items-center">
                <div class="auth-content">
                    <div class="mb-5">
                        <a href="{{ url('/') }}" class="navbar-brand">
                            <i class="fa-solid fa-hotel fa-3x text-primary"></i>
                            <span class="ms-2 fs-2 d-block mt-2">{{ config('app.name', 'Laravel') }}</span>
                        </a>
                        <h2 class="fw-bold mt-4">Create Account</h2>
                        <p class="text-muted">Join us today! Please enter your details.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@company.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-medium">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Sign Up') }}
                            </button>
                        </div>
                    </form>

                    <p class="text-center mt-5 text-muted small">
                        Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log In.</a>
                    </p>
                </div>
            </div>

            <!-- Right Side: Image/Branding -->
            <div class="col-lg-6 d-none d-lg-flex auth-image-side">
                <div class="px-5">
                    <h1 class="display-4 fw-bold mb-4">Start your journey with us today.</h1>
                    <p class="lead mb-5 opacity-75">Register now to get full access to our hotel booking system and exclusive features.</p>
                    
                    <div class="illustration-wrapper">
                        <img src="{{ asset('images/dashboard-preview.png') }}" alt="Dashboard Preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
