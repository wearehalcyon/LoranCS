@extends('admin.main')

@section('head-title', 'Dashboard - General Settings - ' . Core::getOption('sitename'))

@section('title', 'General Settings')

@section('content')
    <form action="{{ route('my-admin-gsettings-update') }}" method="post">
        @csrf
        <div class="gsettingcontrol">
            <h5>{{ __('Site Name') }}</h5>
            <input class="input gsetting" type="text" name="sitename" placeholder="{{ __('My Site') }}" value="{{ Core::getOption('sitename') }}">
        </div>
        <div class="gsettingcontrol">
            <h5>{{ __('Site Description') }}</h5>
            <input class="input gsetting" type="text" name="sitename" placeholder="{{ __('This is my first site') }}" value="{{ Core::getOption('sitedesc') }}">
        </div>
        <div class="gsettingcontrol">
            <h5>{{ __('Site URL') }}</h5>
            <span>{{ __('Without slash in end') }}</span>
            <input class="input gsetting" type="text" name="sitename" placeholder="{{ __('https://mysite.com') }}" value="{{ Core::getOption('siteurl') }}">
        </div>
        <div class="gsettingcontrol">
            <h5>{{ __('Registration on the site') }}</h5>
            <div class="select is-normal">
                <select>
                    <option value="opened" @if(Core::getOption('registration') == 'opened'){{ 'selected' }}@endif>{{ __('Opened') }}</option>
                    <option value="closed" @if(Core::getOption('registration') == 'closed'){{ 'selected' }}@endif>{{ __('Closed') }}</option>
                </select>
            </div>
        </div>
        <div class="gsettingcontrol">
            <h5>{{ __('Discourage search engines from indexing this site') }}</h5>
            <div class="select is-normal">
                <select>
                    <option value="opened" @if(Core::getOption('indexing') == 'off'){{ 'selected' }}@endif>{{ __('Yes') }}</option>
                    <option value="closed" @if(Core::getOption('indexing') == 'on'){{ 'selected' }}@endif>{{ __('No') }}</option>
                </select>
            </div>
            <h6>{{ __('Preview robots.txt') }}</h6>
            <div class="robots_preview">
                @while(!feof($robots))
                    {!! htmlentities(fgets($robots)) . '<br>' !!}
                @endwhile
            </div>
        </div>
    </form>
@endsection
