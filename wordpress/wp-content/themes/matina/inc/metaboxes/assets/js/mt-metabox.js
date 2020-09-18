/**
 * update function for post format featured image option.
*/
function mt_imageType() {
    var cur_selection = jQuery('#post-featured-image-option option:selected').val();

    if( cur_selection === undefined ) {
        return;
    }

    if( cur_selection == 'default' ) {
        jQuery('.mt-image-checkbox-options').hide();
    } else {
        jQuery('.mt-image-checkbox-options').fadeIn();
    }
}


jQuery(document).ready(function($){
    "use strict";
    /**
     * Radio Image control in metabox
     */
    $( '.mt-meta-options-wrap .buttonset' ).buttonset();

    /**
     * Meta tabs and its content
     */
    var curTab = $('.mt-meta-menu-wrapper li.active').data('tab');
    $('.mt-metabox-content-wrapper').find('#'+curTab).show();
    $('.mt-metabox-content-wrapper').find('#'+curTab).addClass('active');
    
    $('ul.mt-meta-menu-wrapper li').click(function (){
        var id = $(this).data('tab');
        
        $('ul.mt-meta-menu-wrapper li').removeClass('active');
        $(this).addClass('active');
        $('.mt-metabox-content-wrapper').find('.mt-single-meta').removeClass('active');
        
        $('.mt-metabox-content-wrapper .mt-single-meta').hide();
        $('#'+id).fadeIn();
        $('#post-meta-selected').val(id);
    });

    /**
     * Image up-loader
     */
    upload_media_image('.mt-upload-button');
    delete_media_image('.mt-delete-button');

    /**
     * Featured Image Post Meta Box Scripts
     */
    mt_imageType();
    $('#post-featured-image-option').change(function() {
        mt_imageType();
    });
});