@extends('layouts.core-app')

@section('site-title', config('app.name', 'Laravel') . ' - Reset Password')

@section('content')
<div class="form-card">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <div class="form-logo">
            <img src="{{ asset('public/includes/images/loran-logo-colored.svg') }}" alt="HypeForm CMS Logo">
        </div>
    <form method="POST" action="{{ route('password.email') }}">
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
            <button type="submit" class="button button-primary">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>

        <div class="formcontroll">
            <div class="back-to-home">
                <a href="{{ route('login') }}">Login</a><br>
                <a href="{{ route('register') }}">Register</a>
                <br>
                <br>
                <a href="{{ asset('/') }}">Back to home page</a>
            </div>
        </div>
    </form>
</div>
@endsection
