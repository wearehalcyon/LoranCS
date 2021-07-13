'use_strict';

jQuery(document).ready(function(){
    // Slug from string
    function string_to_slug(str){
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to   = "aaaaeeeeiiiioooouuuunc------";
        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    }
    // TinyMCE Init
    tinymce.init({
        selector:'textarea.field_editor',
        height: 400,
        skin: 'LoranCS',
        menubar: false,
        content_style: 'body{font-size: 14pt;font-family:serif;}',
        toolbar: 'styleselect | bold italic forecolor backcolor | align | link | image media table visualblocks | code | outdent indent searchreplace | pagebreak | preview wordcount fullscreen',
        plugins: 'code image imagetools link fullscreen media pagebreak preview searchreplace table visualblocks wordcount textcolor'
    });
    // Permalink generator
    $('form.editor_form input.title').keyup(function(){
        var text = $(this).val();
        var target = $('input.permalink_input');
        if ( text.length && target.val().length == '' ) {
            $('input.permalink_input').attr('value', string_to_slug(text) + '/');
        } else {
            $('input.permalink_input').attr('value', '');
        }
    });
});
