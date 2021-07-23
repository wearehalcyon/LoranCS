<div class="media_lib_popup_bg"></div>
<div class="media_lib_popup tiny_files">
    <div class="ml_header">
        <h2>{{ __('Media Library') }}</h2>
        <a href="#" class="button ml_close_filemanager">{{ __('Close') }}</a>
    </div>
    <div class="ml_explorer">
        <div class="ml_files">
            <ul class="ml_tabs">
                <li class="active"><a href="#tiny_images">{{ __('Images') }}</a></li>
                <li><a href="#tiny_audio">{{ __('Audio') }}</a></li>
                <li><a href="#tiny_video">{{ __('Video') }}</a></li>
                <li><a href="#tiny_docs">{{ __('Documents') }}</a></li>
            </ul>
            <ul class="ml_tab_content">
                <li id="tiny_images" class="tab_content image active">
                    <h4 class="tab_title">{{ __('Images') }}</h4>
                    <div class="files_list_box">
                        @foreach($images as $image)
                            <?php
                            $img = 'public/uploads/images/' . $image;
                            $fileinfo = pathinfo(public_path($img));
                            $imgsize = filesize($img);
                            $imgtime = filemtime($img);
                            ?>
                            @if(in_array($fileinfo['extension'], $extensions['images']))
                                <span class="ml_file" title="{{ $image }}" data-type="images" data-name="{{ $image }}" data-ext="{{ $fileinfo['extension'] }}" data-size="{{ $imgsize }}" data-time="{{ $imgtime }}" data-src="{{ asset('public/uploads/images/' . $image) }}">
                                    <img src="{{ asset('public/uploads/images/' . $image) }}" alt="{{ $image }}">
                                </span>
                            @endif
                        @endforeach
                    </div>
                </li>
                <li id="tiny_audio" class="tab_content audio">
                    <h4 class="tab_title">{{ __('Audio') }}</h4>
                    <div class="files_list_box">
                        @foreach($audios as $audio)
                            <?php
                            $audiopath = 'public/uploads/audio/' . $audio;
                            $audioinfo = pathinfo(public_path($audiopath));
                            $audiosize = filesize($audiopath);
                            $audiotime = filemtime($audiopath);
                            ?>
                            @if(in_array($audioinfo['extension'], $extensions['audio']))
                                <span class="ml_file" title="{{ $audio }}" data-type="audio" data-name="{{ $audio }}" data-ext="{{ $audioinfo['extension'] }}" data-size="{{ $audiosize }}" data-time="{{ $audiotime }}" data-src="{{ asset('public/uploads/audio/' . $audio) }}">
                                    <img src="{{ asset('public/includes/images/audio-file.svg') }}" alt="{{ $audio }}">
                                    <p>{{ $audio }}</p>
                                </span>
                            @endif
                        @endforeach
                    </div>
                </li>
                <li id="tiny_video" class="tab_content video">
                    <h4 class="tab_title">{{ __('Video') }}</h4>
                    <div class="files_list_box">
                        @foreach($videos as $video)
                            <?php
                            $videopath = 'public/uploads/video/' . $video;
                            $videoinfo = pathinfo(public_path($videopath));
                            $videosize = filesize($videopath);
                            $videotime = filemtime($videopath);
                            ?>
                            @if(in_array($videoinfo['extension'], $extensions['video']))
                                <span class="ml_file" title="{{ $video }}" data-type="video" data-name="{{ $video }}" data-ext="{{ $videoinfo['extension'] }}" data-size="{{ $videosize }}" data-time="{{ $videotime }}" data-src="{{ asset('public/uploads/video/' . $video) }}">
                                    <img src="{{ asset('public/includes/images/video-file.svg') }}" alt="{{ $video }}">
                                    <p>{{ $video }}</p>
                                </span>
                            @endif
                        @endforeach
                    </div>
                </li>
                <li id="tiny_docs" class="tab_content documents">
                    <h4 class="tab_title">{{ __('Documents') }}</h4>
                    <div class="files_list_box">
                        @foreach($documents as $document)
                            <?php
                            $documentpath = 'public/uploads/documents/' . $document;
                            $documentinfo = pathinfo(public_path($documentpath));
                            $documentsize = filesize($documentpath);
                            $documenttime = filemtime($documentpath);
                            ?>
                            @if(in_array($documentinfo['extension'], $extensions['documents']))
                                <span class="ml_file" title="{{ $document }}" data-type="documents" data-name="{{ $document }}" data-ext="{{ $documentinfo['extension'] }}" data-size="{{ $documentsize }}" data-time="{{ $documenttime }}" data-src="{{ asset('public/uploads/documents/' . $document) }}">
                                    <img src="{{ asset('public/includes/images/document-file.svg') }}" alt="{{ $document }}">
                                    <p>{{ $document }}</p>
                                </span>
                            @endif
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
        <div class="ml_sidebar tinymce_preview">
            <h4>{{ __('File information') }}</h4>
            <div class="ml_file_preview">
                <img src="{{ asset('public/includes/images/file-preview.svg') }}" alt="File Preview" title="File Preview" class="file_preview">
            </div>
            <div class="form_control">
                <strong class="filename"></strong>
                <span class="fileinfo size"></span>
                <span class="fileinfo date"></span>
            </div>
            <div class="form_control delete-this">
                <form class="delete_file" method="POST">
                    @csrf
                    <input class="filesource" type="hidden" name="filename" value="1">
                    <button type="submit">{{ __('Delete this file') }}</button>
                </form>
            </div>
            <div class="form_control filesourceurl">
                <h5>{{ __('File source URL') }}</h5>
                <input class="input is-small fileurl" type="text" value="" readonly>
                <a href="#" class="button is-small is-fullwidth open_file_intab" target="_blank">{!! __('Open file <i class="icofont-external-link"></i>') !!}</a>
                <a href="#" class="button is-small is-fullwidth is-link is-outlined download_file_directly" download>{!! __('Download file <i class="icofont-download-alt"></i>') !!}</a>
            </div>
            <div class="add_file_to_content">
                <a href="#" class="button is-fullwidth is-link">{{ __('Add file') }}</a>
                <div class="notification is-small is-danger error_format">
                    <button class="delete"></button>
                    {{ __('You can\'t use this file. Please check if file have all requirements.') }}
                </div>
            </div>
        </div>
    </div>
</div>
