'use_strict';

jQuery(document).ready(function($){
    // Documentation tabs
    $('.docs_links ul li a').on('click', function(e){
        e.preventDefault();
        $('.docs_links ul li').removeClass('active');
        $(this).parent().addClass('active');
        var tabname = $(this).attr('href');
        $('.tab_content').fadeOut(0);
        $(tabname).fadeIn(50);
    });
    // Close notification
    $('.notification button.delete, .message button.delete').on('click', function(){
        $(this).parent().fadeOut(300);
    });
    // Autohide notification
    window.setTimeout(function(){
        $('.autohide_message').fadeOut(300);
    }, 3000);
});
