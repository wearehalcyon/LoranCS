@extends('layouts.core-app')

@section('site-title', config('app.name', 'Laravel') . ' - Login')

@section('content')
    <div class="form-card">
        <div class="form-logo">
            <img src="{{ asset('public/includes/images/loran-logo-colored.svg') }}" alt="HypeForm CMS Logo">
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="formcontroll">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="formcontroll">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="formcontroll">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div class="formcontroll">
                <button type="submit" class="button button-primary">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <div class="back-to-home">
                    <br>
                    <a href="{{ route('register') }}">I don't have account</a><br>
                    <a href="{{ asset('/') }}">Back to home page</a>
                </div>
            </div>
        </form>
    </div>
@endsection
