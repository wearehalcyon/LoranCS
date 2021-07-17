@extends('layouts.core-app')

@section('site-title', config('app.name', 'Laravel') . ' - Install :: Installation Finished')

@section('content')
    <div class="form-card">
        <div class="form-logo">
            <img src="{{ asset('public/includes/images/loran-logo-colored.svg') }}" alt="HypeForm CMS Logo">
        </div>
        <h1>Installation - Success!</h1>
        <p class="desc">Great! Installation finished.</p>
        <div class="finished-installation">
            <p>Now you can login to your Administrator account - <a href="{{ route('login') }}">here</a>.</p>
            <p>Or visit Home Page - <a href="{{ route('home') }}">here</a>.</p>
        </div>
        <div class="copyright">Copyright by INTAKE Digital &copy {{ date('Y') }}<br>Version: 1.0.2</div>
        <div class="preloader">
            <div class="preloader-animation">
                <img src="{{ asset('public/includes/images/ghost.gif') }}" alt="Preloader">
                <p><strong>Wait please. Ghost making some actions.</strong></p>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        setTimeout(function() {
            $('.preloader').addClass('hide');
        }, 5000);
    </script>
@endsection
