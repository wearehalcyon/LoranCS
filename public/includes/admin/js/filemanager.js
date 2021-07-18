'use_strict';

jQuery(document).ready(function($){
    // Time format
    function timeConverter(UNIX_timestamp){
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        if ( hour >= 10 ) {
            var fullhour = hour
        } else {
            var fullhour = '0' + hour;
        }
        if ( min >= 10 ) {
            var fullmin = min
        } else {
            var fullmin = '0' + min;
        }
        if ( sec >= 10 ) {
            var fullsec = sec
        } else {
            var fullsec = '0' + sec;
        }
        var time = month + ' ' + date + ', ' + year + ' at ' + fullhour + ':' + fullmin + ':' + fullsec ;
        return time;
    }
    // Open filemanager
    $('.choose_fimage a').on('click', function(e){
        e.preventDefault();
        $('.set_fimage .media_lib_popup_bg, .set_fimage .media_lib_popup').addClass('open');
    });
    $('.form_control.add_media a').on('click', function(e){
        e.preventDefault();
        $('.add_image_to_editor .media_lib_popup_bg, .add_image_to_editor .media_lib_popup').addClass('open');
    });
    // File manager
    $('.featured_image ul.ml_tabs li a').on('click', function(e){
        e.preventDefault();
        var target = $(this).attr('href');
        $('ul.ml_tabs li, .ml_files .ml_tab_content li').removeClass('active');
        $(this).parent().addClass('active');
        $(target).addClass('active');
        $('.ml_files .ml_tab_content li span.ml_file').removeClass('opacitied');
    });
    $('.featured_image .ml_files .ml_tab_content li span.ml_file').on('click', function(){
        $('.ml_files .ml_tab_content li span.ml_file').removeClass('active').addClass('opacitied');
        $(this).removeClass('opacitied').addClass('active');
        var file_type = $(this).data('type');
        var file_name = $(this).data('name');
        var file_ext = $(this).data('ext');
        var file_size = $(this).data('size') / 1000;
        var file_time = $(this).data('time');
        var src = $(this).data('src');
        if ( file_type == 'images' ) {
            $('.ml_file_preview').html('<img src="' + src + '" alt="File Preview" title="' + file_name + '" class="file_preview">');
        }
        $('.ml_sidebar strong.filename').text(file_name);
        if ( file_size > 1024 ) {
            $('.ml_sidebar span.size').text('Size: ' + (file_size / 1024).toFixed(2) + 'Mb');
        } else if (file_size < 1024) {
            $('.ml_sidebar span.size').text('Size: ' + Math.ceil(file_size) + 'Kb');
        }
        $('.ml_sidebar span.date').text('Added: ' + timeConverter(file_time));
        $('.ml_sidebar .delete-this').css('display', 'block');
        $('.delete_file input.filesource').attr('value', file_type + '/' + file_name);
        $('input.fileurl').attr('value', src);
        $('.open_file_intab, .download_file_directly').attr('href', src).css('visibility', 'visible');
        $('.add_file_to_content').addClass('show');
        $('.add_file_to_content a').attr('href', '#');
    });
    // Close manager
    $('a.ml_close_filemanager').on('click', function(e){
        e.preventDefault();

        $('.media_lib_popup_bg, .media_lib_popup').removeClass('open');
        $('.ml_files .ml_tab_content li span.ml_file').removeClass('active').removeClass('opacitied');
        $('.ml_file_preview').html('<img src="' + document.location.origin + '/public/includes/images/file-preview.svg" alt="File Preview" title="File Preview" class="file_preview">');
        $('.ml_sidebar strong.filename').text('');
        $('.ml_sidebar span.size').text('');
        $('.ml_sidebar span.date').text('');
        $('.ml_sidebar .delete-this').css('display', 'none');
        $('input.fileurl').attr('value', '');
        $('.open_file_intab, .download_file_directly').attr('href', '#').css('visibility', 'hidden');
        $('.add_file_to_content').removeClass('show');
        $('.add_file_to_content a').attr('href', '#');
    });
    // Set Featured Image
    $('.set_fimage .add_file_to_content a').on('click', function(e){
        e.preventDefault();
        var origin = $('.filesource').val().replace('images/', '');
        var src = document.location.origin + '/public/uploads/' + $('.filesource').val();
        var repl = origin.split('.').pop();
        var exts = ['gif', 'jpeg', 'jpg', 'png', 'bmp'];

        if (exts.includes(repl)) {
            $('.media_lib_popup_bg, .media_lib_popup').removeClass('open');
            $('.ml_files .ml_tab_content li span.ml_file').removeClass('active').removeClass('opacitied');
            $('.ml_file_preview').html('<img src="' + document.location.origin + '/public/includes/images/file-preview.svg" alt="File Preview" title="File Preview" class="file_preview">');
            $('.ml_sidebar strong.filename').text('');
            $('.ml_sidebar span.size').text('');
            $('.ml_sidebar span.date').text('');
            $('.ml_sidebar .delete-this').css('display', 'none');
            $('input.fileurl').attr('value', '');
            $('.open_file_intab, .download_file_directly').attr('href', '#').css('visibility', 'hidden');
            $('.add_file_to_content').removeClass('show');
            $('.add_file_to_content a').attr('href', '#');

            $('img.featured_image').attr('src', src).css({
                'display': 'block',
                'opacity': 1
            });
            $('input.featured_image_field').attr('value', $('.filesource').val());
            $('a.remove_fimage').css('display', 'inline-block');
        } else {
            $('.error_format').fadeIn(100);
        }
    });
    // Remove featured image
    if ( $('img.featured_image').attr('src').length ) {
        $('a.remove_fimage').css('display', 'inline-block');
    }
    $('a.remove_fimage').on('click', function(e){
        e.preventDefault();
        $('input.featured_image_field').attr('value', '');
        $('img.featured_image').attr('src', '').css({
            'display': 'none',
            'opacity': 0
        });
        $(this).css('display', 'none');
    });















    /**
     * Insert media to editor
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     *
     */
    // File manager
    $('.tiny_files ul.ml_tabs li a').on('click', function(e){
        e.preventDefault();
        var target = $(this).attr('href');
        $('ul.ml_tabs li, .ml_files .ml_tab_content li').removeClass('active');
        $(this).parent().addClass('active');
        $(target).addClass('active');
        $('.ml_files .ml_tab_content li span.ml_file').removeClass('opacitied');
    });
    $('.tiny_files .ml_files .ml_tab_content li span.ml_file').on('click', function(){
        $('.ml_files .ml_tab_content li span.ml_file').removeClass('active').addClass('opacitied');
        $(this).removeClass('opacitied').addClass('active');
        var file_type = $(this).data('type');
        var file_name = $(this).data('name');
        var file_ext = $(this).data('ext');
        var file_size = $(this).data('size') / 1000;
        var file_time = $(this).data('time');
        var src = $(this).data('src');
        if ( file_type == 'images' ) {
            $('.tinymce_preview .ml_file_preview').html('<img src="' + src + '" alt="File Preview" title="' + file_name + '" class="file_preview">');
        } else if ( file_type == 'audio' ) {
            $('.tinymce_preview .ml_file_preview').html('<audio controls autoplay controlsList="nodownload" src="' + src + '"></audio>');
        } else if ( file_type == 'video' ) {
            $('.tinymce_preview .ml_file_preview').html('<video controls autoplay controlsList="nodownload" src="' + src + '"></video>');
        } else if ( file_type == 'documents' ) {
            $('.tinymce_preview .ml_file_preview').html('<img src="' + document.location.origin + '/public/includes/images/file-preview.svg" alt="File Preview" title="' + file_name + '" class="file_preview">');
        }
        $('.ml_sidebar strong.filename').text(file_name);
        if ( file_size > 1024 ) {
            $('.ml_sidebar span.size').text('Size: ' + (file_size / 1024).toFixed(2) + 'Mb');
        } else if (file_size < 1024) {
            $('.ml_sidebar span.size').text('Size: ' + Math.ceil(file_size) + 'Kb');
        }
        $('.ml_sidebar span.date').text('Added: ' + timeConverter(file_time));
        $('.ml_sidebar .delete-this').css('display', 'block');
        $('.delete_file input.filesource').attr('value', file_type + '/' + file_name);
        $('input.fileurl').attr('value', src);
        $('.open_file_intab, .download_file_directly').attr('href', src).css('visibility', 'visible');
        $('.add_file_to_content').addClass('show');
        $('.add_file_to_content a').attr('href', '#');
    });
    $('.add_image_to_editor .add_file_to_content a').on('click', function(e){
        e.preventDefault();
        var file = $('.filesource').val();
        var src = document.location.origin + '/public/uploads/' + $('.filesource').val();
        var repl = file.split('.').pop();
        var ext_image = ['gif', 'jpeg', 'jpg', 'png', 'bmp'];
        var ext_audio = ['mp3', 'm4a', 'wav', 'ogg'];
        var ext_video = ['mp4', 'm4v', 'mov', 'wmv', 'avi', 'mpg', 'ogv', '3gp', '3g2'];
        var ext_docmt = ['pdf', 'ppt', 'pptx', 'pps', 'ppsx', 'doc', 'docx', 'odt', 'xls', 'xlsx', 'key', 'zip', 'csv', 'rtf', 'txt'];

        $('.media_lib_popup_bg, .media_lib_popup').removeClass('open');
        $('.ml_files .ml_tab_content li span.ml_file').removeClass('active').removeClass('opacitied');
        $('.ml_file_preview').html('<img src="' + document.location.origin + '/public/includes/images/file-preview.svg" alt="File Preview" title="File Preview" class="file_preview">');
        $('.ml_sidebar strong.filename').text('');
        $('.ml_sidebar span.size').text('');
        $('.ml_sidebar span.date').text('');
        $('.ml_sidebar .delete-this').css('display', 'none');
        $('input.fileurl').attr('value', '');
        $('.open_file_intab, .download_file_directly').attr('href', '#').css('visibility', 'hidden');
        $('.add_file_to_content').removeClass('show');
        $('.add_file_to_content a').attr('href', '#');

        if (ext_image.includes(repl)) {
            tinyMCE.activeEditor.selection.setNode(
                tinyMCE.activeEditor.dom.create(
                    'img', {
                        src : src,
                        title : file.replace(/\b(?:images\/|.jpg|.jpeg|.png|.gif|.svg)\b/gi, ''),
                        alt : file.replace(/\b(?:images\/|.jpg|.jpeg|.png|.gif|.svg)\b/gi, ''),
                        class : 'post-content-image',
                        width : 'auto',
                        height : '400'
                    }
                )
            );
        } else if (ext_audio.includes(repl)) {
            tinyMCE.activeEditor.selection.setNode(
                tinyMCE.activeEditor.dom.create(
                    'audio', {
                        src : src,
                        controls : true,
                        class : 'post-content-audio'
                    }
                )
            );
        } else if (ext_video.includes(repl)) {
            tinyMCE.activeEditor.selection.setNode(
                tinyMCE.activeEditor.dom.create(
                    'video', {
                        src : src,
                        controls : true,
                        width : '540',
                        height : '360',
                        class : 'post-content-video'
                    }
                )
            );
        } else if (ext_docmt.includes(repl)) {
            tinymce.activeEditor.selection.setContent(
                tinymce.activeEditor.dom.createHTML(
                    'a',
                    {
                        href: src,
                        title : file.replace(/\b(?:documents\/|.pdf|.ppt|.pptx|.pps|.ppsx|.doc|.docx|.odt|.xls|.xlsx|.key|.zip|.csv|.rtf|.txt)\b/gi, ''),
                        class : 'post-content-file-link',
                        target : '_blank',
                        rel : 'alternate'
                    },
                    file.replace('documents/', '')
                )
            );
        }
    });
});
