<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>@yield('head-title')</title>
        <link rel="icon" type="image/svg" href="{{ asset('public/includes/images/favicon.svg') }}">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Product+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('public/includes/front/css/admin-bar.css') }}">
        <link rel="stylesheet" href="{{ asset('public/includes/admin/css/icofont.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/includes/admin/css/bulma.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/includes/admin/css/admin.css') }}">
    </head>
    <body class="admin-area">
        <div class="wrapp">
            <aside class="sidebar">
                @include('admin.partials.sidebar')
            </aside>
            <main class="content">
                <div class="content_wrapp">
                    <h1 class="title">@yield('title')</h1>
                    @yield('content')
                </div>
                @include('admin.partials.footer')
            </main>
        </div>
        <?php require_once resource_path('views/core/front/admin-bar.blade.php'); ?>
        <script type="text/javascript" src="{{ asset('public/includes/js/core/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/includes/admin/js/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/includes/front/js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/includes/admin/js/admin.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/includes/admin/js/editor.js') }}"></script>
        @yield('footer-scripts')
    </body>
</html>
