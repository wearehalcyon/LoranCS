@extends('admin.main')

@section('head-title', 'Dashboard - 404 Page not found - ' . Core::getOption('sitename'))

@section('content')
    <div class="restriction_alert">
        <div class="notification">
            {{ __('You cannot view this page. Most likely, it was removed, or access rights were limited. Check your access level, or contact your administrator for help.') }}
        </div>
    </div>
@endsection
