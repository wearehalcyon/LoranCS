@extends('admin.main')

@section('head-title', 'Dashboard - Core Updates - ' . Core::getOption('sitename'))

@section('title', 'Core Updates')

@section('content')
    <div class="deashboard_index">
        <?php //dump($api); ?>
        <h4>{{ __('Available next system updates:') }}</h4>
        @if($api['version'] > $app['ver'])
            <img src="{{ $api['banner'] }}" alt="{{ __('Update Banner') }}" class="updates_banner">
            @if($api['type'] == 'system')
                    <span class="tag is-warning is-light update-type">{{ ucfirst($api['type']) }}</span>
            @else
                <span class="tag is-info is-light update-type">{{ ucfirst($api['type']) }}</span>
            @endif
            <ul class="updates_list">
                <li>
                    @if($api['kernel'] > $app['kernel'])
                        {!! __('<strong>Kernel Version: </strong>' . $api['kernel']) !!}
                        <br>
                    @endif
                    {!! __('<strong>LoranCS Version: </strong>' . $api['version']) !!}
                    <div class="view_details">
                        <a href="#" class="is-link show_update_description">{{ __('View details') }}</a>
                        <div class="details_text">
                            <ol>
                                @foreach($api['description'] as $detail)
                                    <li>{{ $detail }}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="download_update">
                <a href="" class="button is-small is-link">
                    {!! __('Update LoranCS to <strong>' . $api['version'] . '</strong> version now') !!}
                </a>
                <a href="{{ $api['source'] }}" class="button is-small" download>{{ __('Download This Update') }}</a>
            </div>
        @else
            <p>{{ __('There no available updates. You are using latest version of LoranCS with Themes and Plugins.') }}</p>
        @endif
    </div>
@endsection
