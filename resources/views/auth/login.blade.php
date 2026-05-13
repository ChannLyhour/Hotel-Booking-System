@extends('admin.layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Left Side: Form -->
            <div class="col-lg-6 d-flex align-items-center">
                <div class="auth-content">
                    <div class="mb-5">
                        <a href="{{ url('/') }}" class="navbar-brand mb-4">
                            <svg width="40" height="40" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="32" height="32" rx="8" fill="#4F46E5"/>
                                <path d="M10 16L14 20L22 12" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="ms-2 fs-3">{{ config('app.name', 'Laravel') }}</span>
                        </a>
                        <h2 class="fw-bold mt-4">Welcome Back</h2>
                        <p class="text-muted">Enter your email and password to access your account.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@company.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label fw-medium">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small fw-semibold text-primary" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted small" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Log In') }}
                            </button>
                        </div>
                    </form>

                    <div class="divider">Or Login With</div>

                    <x-social-login />

                    <p class="text-center mt-5 text-muted small">
                        Don't Have An Account? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Register Now.</a>
                    </p>
                </div>
            </div>

            <!-- Right Side: Image/Branding -->
            <div class="col-lg-6 d-none d-lg-flex auth-image-side">
                <div class="px-5">
                    <h1 class="display-4 fw-bold mb-4">Effortlessly manage your hotel and operations.</h1>
                    <p class="lead mb-5 opacity-75">Log in to access your booking dashboard and manage your guests seamlessly.</p>
                    
                    <div class="illustration-wrapper">
                        <img src="{{ asset('images/dashboard-preview.png') }}" alt="Dashboard Preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
