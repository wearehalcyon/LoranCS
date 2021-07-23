<?php
    $screenshot_file = file_exists(public_path('themes/' . $theme_curr . '/screenshot.png'));
    $screenshot = asset('public/themes/' . $theme_curr . '/screenshot.png');
    $name = $theme_info['name'];
    $version = __('Version: ') . $theme_info['version'];
    $author = __('Athor: ') . '<a href="' . $theme_info['author_url'] . '" target="_blank">' . $theme_info['author'] . '</a>';
    $description = $theme_info['description'];
    $theme_url = $theme_info['theme_url'];
?>

@extends('admin.main')

@section('head-title', 'Dashboard - Themes - ' . Core::getOption('sitename'))

@section('title', 'Themes')

@section('content')
    <div class="upload_new_theme">
        <form action="{{ route('my-admin-upload-theme') }}" method="POST" enctype="multipart/form-data" class="upload_new_theme">
            <div class="upload_theme_btn">
                <a href="#" class="button is-small">{{ __('Upload Theme') }}</a>
                <button class="button is-small is-primary action_upload" type="submit">{!! __('<i class="icofont-upload"></i> Upload') !!}</button>
            </div>
            <div class="theme_uploader">
                @csrf
                <div class="file has-name is-fullwidth">
                    <label class="file-label">
                        <input class="file-input" type="file" name="theme_file" accept=".zip">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                {{ __('Select Theme Installation ZIP') }}
                            </span>
                        </span>
                        <span class="file-name">theme.zip</span>
                    </label>
                </div>
            </div>
        </form>
    </div>
    @if(Session::has('theme-action-message'))
        <div class="message autohide_message @if(session('error')) is-danger @else is-primary @endif">
            <button class="delete"></button>
            <div class="message-body">
                {!! Session::get('theme-action-message') !!}
            </div>
        </div>
    @endif
    <div class="dash_themes_list">
        <div class="current_theme">
            <div class="curr_theme_col curr_theme_thumb">
                @if ($screenshot_file)
                    <img src="{{ $screenshot }}" alt="{{ $name }}">
                @else
                    <span class="no_screenshot">
                        {{ __('Screenshot Not Found') }}
                    </span>
                @endif
            </div>
            <div class="curr_theme_col curr_theme_desc">
                <h2>{{ $name }}</h2>
                <span>{{ $version }}</span>
                <p>{!! $author !!}</p>
                <p>{{ $description }}</p>
                <div class="curr_theme_actions">
                    <a href="{!! $theme_url !!}" target="_blank" class="button">{{ __('Go to theme page') }}</a>
                </div>
            </div>
        </div>
        <h3>{{ __('Installed Themes') }}<span></span></h3>
        <div class="installed_themes">
            @foreach($themes_res as $theme)
                @if(!is_dir($theme) && $theme != $theme_curr && $theme != '.DS_Store')
                    <?php
                        $screenshot_file = file_exists(public_path('themes/' . $theme . '/screenshot.png'));
                        $screenshot = asset('public/themes/' . $theme . '/screenshot.png');
                        $themeinfo = file_get_contents(resource_path('views/themes/' . $theme . '/themeinfo.json'));
                        $themeinfo = json_decode($themeinfo, true);
                    ?>
                    <div class="installed_theme_item">
                        <div class="theme_ite_container">
                            <div class="theme_preview">
                                @if($screenshot_file)
                                    <img src="{{ $screenshot }}" alt="{{ ucfirst($theme) }}">
                                @else
                                    <span class="no_screenshot">
                                    {{ __('Screenshot Not Found') }}
                                </span>
                                @endif
                            </div>
                            <h4>{{ $themeinfo['name'] }}</h4>
                            <span class="version">
                                {{ $themeinfo['version'] }}
                            </span>
                            <div class="apply_theme">
                                <a href="{{ route('my-admin-apply-theme', [$theme]) }}" class="button is-small is-fullwidth is-info is-outlined apply_theme_button">{{ __('Apply Theme') }}</a>
                            </div>
                            <div class="remove_theme">
                                <a href="{{ route('my-admin-remove-theme', [$theme]) }}" class="button is-small is-fullwidth is-danger is-outlined remove_theme_button">{{ __('Remove Theme') }}</a>
                            </div>
                            @if(file_exists(public_path('themes/' . $theme)))
                                <div class="theme_validated">
                                    {{ __('Theme is validated and will work correct.') }}
                                </div>
                            @else
                                <div class="theme_not_validated">
                                    {{ __('This theme is broken. Check public folder please.') }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        // Confirm deletion
        $('.remove_theme_button').on('click', function(e){
            if (confirm('Are you sure you want delete this theme?')) {
                return true;
            } else {
                e.preventDefault();
            }
        });
        // Upload theme
        $('.upload_theme_btn a').on('click', function(e){
            e.preventDefault();
            $(this).toggleClass('is-info');
            $('.theme_uploader').toggleClass('open');
            if ($('.action_upload').hasClass('open')) {
                $('.action_upload').removeClass('open');
                $('span.file-name').text('theme.zip');
            }
        });
        $('form.upload_new_theme').on('change', function(){
            var filename = $('input[type=file]').val().split('\\').pop();
            $('span.file-name').text(filename);
            $('.action_upload').toggleClass('open');
        });
        // Zero themes
        if ($('.installed_theme_item').length == ''){
            $('.installed_themes').text('{{ __('Only one theme installed and activated at the moment.') }}');
        }
        // Count themes
        $(function(){
            var allElems = $('.installed_theme_item');
            var count = 0;
            for (var i = 0; i < allElems.length; i++){
                var thisElem = allElems[i];
                if (thisElem.length != '') count++;
            }
            $('.dash_themes_list h3 span').text(': ' + (count + 1));
        });
    </script>
@endsection
