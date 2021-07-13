@extends('layouts.core-app')

@section('site-title', config('app.name', 'Laravel') . ' - Reset Password')

@section('content')
<div class="form-card">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="formcontroll">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('Email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="formcontroll">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="{{ __('Password') }}" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="formcontroll">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
        </div>

        <div class="formcontroll">
            <button type="submit" class="button button-primary">
                {{ __('Reset Password') }}
            </button>
        </div>

        <div class="formcontroll">
            <div class="back-to-home">
                <a href="{{ asset('/') }}">Back to home page</a>
            </div>
        </div>
    </form>
</div>
@endsection
