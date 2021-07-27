@extends('admin.main')

@section('head-title', 'Dashboard - ' . Core::getOption('sitename'))

@section('title', 'Dashboard')

@section('content')
    <div class="deashboard_index">
        @if($version > Core::App()['ver'])
            <div class="notification is-warning is-light">
                {!! __('Available new version of LoranCS. Current version is <strong>' . Core::App()['ver'] . '</strong> and fresh version is <strong>' . $version . '</strong>. Please update your site.') !!}
            </div>
        @endif
    </div>
@endsection
