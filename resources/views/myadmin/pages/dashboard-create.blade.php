@extends('myadmin.main')

@section('head-title', 'Dashboard - New Post - ' . Core::getOption('sitename'))

@section('title', 'New Post')

@section('content')
    @if(Session::has('removed'))
        <div class="notification is-primary">
            <button class="delete"></button>
            {!! Session::get('created') !!}
        </div>
    @endif
    <form action="{{ route('my-admin-create-post-submit') }}" method="POST" class="editor_form">
        <div class="editor editor_cards">
            @csrf
            <div class="left_side">
                <div class="form_control">
                    <input type="text" name="title" class="input is-medium title" placeholder="{{ __('Title') }}">
                </div>
                <div class="form_control permalink">
                    <strong>
                        {{ __('Permalink: ') }}
                        <a href="{{ Core::getOption('siteurl') . '/' }}">{{ Core::getOption('siteurl') . '/' }}</a>
                    </strong>
                    <input type="text" name="slug" value="" class="input is-small permalink_input">
                </div>
                <div class="form_control add_media">
                    <a href="#" class="button is_small">
                        <i class="icofont-multimedia"></i>
                        {{ __('Add Media') }}
                    </a>
                </div>
                <div class="form_control content_editor">
                    <textarea class="textarea has-fixed-size field_editor"></textarea>
                </div>
            </div>
            <div class="right_side">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card_title">{{ __('Publish') }}</h4>
                        <div class="form_control">
                            <h6 class="card_action_title">{{ __('Status') }}</h6>
                            <div class="select is_fullwidth">
                                <select name="status" class="is_fullwidth">
                                    <option value="published">{{ __('Published') }}</option>
                                    <option value="draft">{{ __('Draft') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form_control">
                            <h6 class="card_action_title">{{ __('Date') }}</h6>
                            <ul class="date_listing">
                                <li>
                                    <div class="select is-small">
                                        <select name="month">
                                            <option value="01">{{ __('01-Jan') }}</option>
                                            <option value="02">{{ __('02-Feb') }}</option>
                                            <option value="03">{{ __('03-Mar') }}</option>
                                            <option value="04">{{ __('04-Apr') }}</option>
                                            <option value="05">{{ __('05-May') }}</option>
                                            <option value="06">{{ __('06-Jun') }}</option>
                                            <option value="07">{{ __('07-Jul') }}</option>
                                            <option value="08">{{ __('08-Aug') }}</option>
                                            <option value="09">{{ __('09-Sep') }}</option>
                                            <option value="10">{{ __('10-Oct') }}</option>
                                            <option value="11">{{ __('11-Nov') }}</option>
                                            <option value="12">{{ __('12-Dec') }}</option>
                                        </select>
                                    </div>
                                </li>
                                <li class="day">
                                    <input class="input is-small" name="day" type="text" placeholder="{{ __('01') }}">
                                </li>
                                <li class="year">
                                    <input class="input is-small" name="year" type="text" placeholder="{{ __('2021') }}">
                                </li>
                                <li class="at">
                                    {{ __('at') }}
                                </li>
                                <li class="time">
                                    <input class="input is-small" name="hours" type="text" placeholder="{{ __('12') }}">
                                </li>
                                <li class="dot">
                                    :
                                </li>
                                <li class="time">
                                    <input class="input is-small" name="minutes" type="text" placeholder="{{ __('00') }}">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer card-footer-gray">
                        <button type="button" class="button is-primary">{{ __('Publish') }}</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h4 class="card_title">{{ __('Category') }}</h4>
                        <div class="form_control">
                            <div class="category_listing">
                                @foreach ( $categories as $category )
                                    <label class="checkbox">
                                        <input type="checkbox" name="category" value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h4 class="card_title">{{ __('Featured image') }}</h4>
                        <div class="form_control">
                            <img class="featured_image" src="" alt="{{ __('Featured image') }}">
                            <div class="choose_fimage">
                                <a href="#">{{ __('Set featured image') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="set_fimage">
        @include('myadmin.partials.media-files-popup')
    </div>
@endsection

@section('footer-scripts')
    <script>
        $('input[name="hours"]').bind('keyup', function(){
            var value = $(this).val();
            if (value > 23) {
                $(this).val(23);
            } else {
                $(this).attr('value', value);
            }
        });
        $('input[name="minutes"]').bind('keyup', function(){
            var value = $(this).val();
            if (value > 59) {
                $(this).val(59);
            } else {
                $(this).attr('value', value);
            }
        });
        // Feautured image
        var fimage = $('.form_control img.featured_image');
        if ( fimage.attr('src').length == '' ) {
            fimage.css('display', 'none');
        }
    </script>
    <script src="{{ asset('public/includes/admin/js/filemanager.js') }}"></script>
    <script>
        $('#delete_file').on('submit', function(e){
            e.preventDefault();

            if (confirm('Are you sure you want delete this file?')) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('my-admin-post-delete-file') }}',
                    data: $('#delete_file').serialize(),
                    success: function(result){
                        $('.ml_files .ml_tab_content li span.ml_file.active').fadeOut(300);
                        $('.ml_files .ml_tab_content li span.ml_file').removeClass('opacitied');
                        $('.ml_file_preview').html('<img src="' + document.location.origin + '/public/includes/images/file-preview.svg" alt="File Preview" title="File Preview" class="file_preview">');
                        $('.ml_sidebar strong.filename').text('');
                        $('.ml_sidebar span.size').text('');
                        $('.ml_sidebar span.date').text('');
                        $('.ml_sidebar .delete-this').css('display', 'none');
                        $('input.fileurl').attr('value', '');
                        $('.open_file_intab, .download_file_directly').attr('href', '#').css('visibility', 'hidden');
                        $('.add_file_to_content').removeClass('show');
                        $('.add_file_to_content a').attr('href', '#');
                    }
                });
            }
        });
    </script>
@endsection
