@extends('layouts.core-app')

@section('site-title', config('app.name', 'Laravel') . ' - Registration')

@section('content')
<div class="form-card">
    <div class="form-logo">
        <img src="{{ asset('public/includes/images/loran-logo-colored.svg') }}" alt="HypeForm CMS Logo">
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="formcontroll">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="formcontroll">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="formcontroll">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="formcontroll">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
        </div>

        <div class="formcontroll">
            <button type="submit" class="button button-primary">
                {{ __('Register') }}
            </button>
        </div>

        <div class="formcontroll">
            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
            <div class="back-to-home">
                <br>
                <a href="{{ route('login') }}">I already have account</a><br>
                <a href="{{ asset('/') }}">Back to home page</a>
            </div>
        </div>
    </form>
</div>
@endsection
