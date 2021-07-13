<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('site-title')</title>
    {{ Core::styles() }}
</head>
<body{{ Core::bodyClass() }}>
    <div class="wrapp">
        @yield('content')
    </div>
    {{ Core::scripts() }}
    @yield('footer-scripts')
</body>
</html>
