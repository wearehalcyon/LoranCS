<?php
    $month = date('m', strtotime($post->date));
    $day = date('d', strtotime($post->date));
    $year = date('Y', strtotime($post->date));
    $hour = date('H', strtotime($post->date));
    $minutes = date('i', strtotime($post->date));
?>

@extends('admin.main')

@section('head-title', 'Dashboard - Edit ' . $post->title . ' - ' . Core::getOption('sitename'))

@section('title', 'Edit Post: ' . $post->title)

@section('content')
    @if(Session::has('removed'))
        <div class="notification is-primary">
            <button class="delete"></button>
            {!! Session::get('created') !!}
        </div>
    @endif
    <form action="{{ route('my-admin-update-post-submit') }}" method="POST" class="editor_form">
        <div class="editor editor_cards">
            @csrf
            <input type="hidden" name="postid" value="{{ $post->id }}">
            <div class="left_side">
                <div class="form_control">
                    <input type="text" name="title" class="input is-medium title" placeholder="{{ __('Title') }}" value="{{ $post->title }}">
                </div>
                <div class="form_control permalink">
                    <strong>
                        {{ __('Permalink: ') }}
                        <a href="{{ Core::getOption('siteurl') . '/' }}">{{ Core::getOption('siteurl') . '/' }}</a>
                    </strong>
                    <input type="text" name="slug" value="{{ $post->slug }}" class="input is-small permalink_input">/
                </div>
                <div class="form_control add_media">
                    <a href="#" class="button is_small">
                        <i class="icofont-multimedia"></i>
                        {{ __('Add Media') }}
                    </a>
                </div>
                <div class="form_control content_editor">
                    <textarea class="textarea has-fixed-size field_editor" name="content">{{ $post->content }}</textarea>
                </div>
                <div class="form_control excerpt_editor">
                    <h4>Excerpt</h4>
                    <textarea class="textarea has-fixed-size" name="excerpt" rows="3">{{ $post->excerpt }}</textarea>
                </div>
                <div class="form_control excerpt_editor">
                    <h4>Authors</h4>
                    <div class="select is-small">
                        <select name="author_id">
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" @if($post->user_id == $author->id){{ __('selected') }}@endif>{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form_control excerpt_editor">
                    <h4>Discussion</h4>
                    <div class="select is-small">
                        <select name="comment_status">
                            <option value="opened"@if($post->comment_status == 'opened'){{ __('selected') }}@endif>{{ __('Opened') }}</option>
                            <option value="closed"@if($post->comment_status == 'closed'){{ __('selected') }}@endif>{{ __('Closed') }}</option>
                        </select>
                    </div>
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
                                    <option value="published"@if($post->status == 'published'){{ __('selected') }}@endif>{{ __('Published') }}</option>
                                    <option value="draft"@if($post->status == 'draft'){{ __('selected') }}@endif>{{ __('Draft') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form_control">
                            <h6 class="card_action_title">{{ __('Date') }}</h6>
                            <ul class="date_listing">
                                <li>
                                    <div class="select is-small">
                                        <select name="month">
                                            <option value="01"@if($month == '01'){{ __('selected') }}@endif>{{ __('01-Jan') }}</option>
                                            <option value="02"@if($month == '02'){{ __('selected') }}@endif>{{ __('02-Feb') }}</option>
                                            <option value="03"@if($month == '03'){{ __('selected') }}@endif>{{ __('03-Mar') }}</option>
                                            <option value="04"@if($month == '04'){{ __('selected') }}@endif>{{ __('04-Apr') }}</option>
                                            <option value="05"@if($month == '05'){{ __('selected') }}@endif>{{ __('05-May') }}</option>
                                            <option value="06"@if($month == '06'){{ __('selected') }}@endif>{{ __('06-Jun') }}</option>
                                            <option value="07"@if($month == '07'){{ __('selected') }}@endif>{{ __('07-Jul') }}</option>
                                            <option value="08"@if($month == '08'){{ __('selected') }}@endif>{{ __('08-Aug') }}</option>
                                            <option value="09"@if($month == '09'){{ __('selected') }}@endif>{{ __('09-Sep') }}</option>
                                            <option value="10"@if($month == '10'){{ __('selected') }}@endif>{{ __('10-Oct') }}</option>
                                            <option value="11"@if($month == '11'){{ __('selected') }}@endif>{{ __('11-Nov') }}</option>
                                            <option value="12"@if($month == '12'){{ __('selected') }}@endif>{{ __('12-Dec') }}</option>
                                        </select>
                                    </div>
                                </li>
                                <li class="day">
                                    <input class="input is-small" name="day" type="text" value="{{ $day }}" placeholder="{{ __('01') }}">
                                </li>
                                <li class="year">
                                    <input class="input is-small" name="year" type="text" value="{{ $year }}" placeholder="{{ __('2021') }}">
                                </li>
                                <li class="at">
                                    {{ __('at') }}
                                </li>
                                <li class="time">
                                    <input class="input is-small" name="hours" type="text" value="{{ $hour }}" placeholder="{{ __('12') }}">
                                </li>
                                <li class="dot">
                                    :
                                </li>
                                <li class="time">
                                    <input class="input is-small" name="minutes" type="text" value="{{ $minutes }}" placeholder="{{ __('00') }}">
                                </li>
                            </ul>
                        </div>
                        <div class="form_control">
                            <h6 class="card_action_title">{{ __('Last Modified At:') }}</h6>
                            {{ date('F d, Y - H:i', strtotime($post->modified)) }}
                        </div>
                    </div>
                    <div class="card-footer card-footer-gray">
                        <button type="submit" class="button is-primary">{{ __('Update') }}</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h4 class="card_title">{{ __('Category') }}</h4>
                        <div class="form_control">
                            <div class="category_listing">
                                @foreach ( $categories as $category )
                                    <label class="checkbox">
                                        <input type="checkbox" name="category_id" value="{{ $category->id }}"@if($post->category_id == $category->id){{ __('checked') }}@endif>
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
                            <input type="hidden" class="featured_image_field" name="featured_image" value="{{ $thumbnail }}">
                            <img class="featured_image" src="{{ $thumbnail }}" alt="{{ __('Featured image') }}">
                            <div class="rm_fimage">
                                <a href="#" class="remove_fimage">{{ __('Remove featured image') }}</a>
                            </div>
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
        @include('admin.partials.media-files-popup')
    </div>
    <div class="add_image_to_editor">
        @include('admin.partials.media-files-popup-tinymce')
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
        $('.delete_file').on('submit', function(e){
            e.preventDefault();

            if (confirm('Are you sure you want delete this file?')) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('my-admin-post-delete-file') }}',
                    data: $('.delete_file').serialize(),
                    success: function(result){
                        var active_file = $('.ml_files .ml_tab_content li span.ml_file.active');
                        var data_attr = active_file.data('name');
                        $('.ml_files .ml_tab_content li span.ml_file').each(function(){
                            if ( $(this).data('name') == data_attr ) {
                                $(this).fadeOut(300)
                            }
                        });
                        active_file.fadeOut(300);
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
