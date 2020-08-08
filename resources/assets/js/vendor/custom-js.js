jQuery(document).ready(function($){

    var lb_upload;
    var lb_selector;

    function lb_add_file( event, selector ) {

        var upload = $(".uploaded-file"), frame;
        var $el = $(this);
        lb_selector = selector;

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if ( lb_upload ) {
            lb_upload.open();
        } else {
            // Create the media frame.
            lb_upload = wp.media.frames.lb_upload =  wp.media({
                // Set the title of the modal.
                title: $el.data('choose'),

                // Customize the submit button.
                button: {
                    // Set the text of the button.
                    text: $el.data('update'),
                    // Tell the button not to close the modal, since we're
                    // going to refresh the page when the image is selected.
                    close: false
                }
            });

            // When an image is selected, run a callback.
            lb_upload.on( 'select', function() {
                // Grab the selected attachment.
                var attachment = lb_upload.state().get('selection').first();
                lb_upload.close();
                lb_selector.find('.upload').val(attachment.attributes.url);
                if ( attachment.attributes.type == 'image' ) {
                    lb_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '">').slideDown('fast');
                }
                lb_selector.find('.btn-upload').unbind().addClass('btn-remove').removeClass('btn-upload').html("Eliminar");
                lb_selector.find('.of-background-properties').slideDown();
                lb_selector.find('.btn-remove').on('click', function() {
                    lb_remove_file( $(this).parents('#upload_img') );
                });
            });

        }

        // Finally, open the modal.
        lb_upload.open();
    }

    function lb_remove_file(selector) {
        selector.find('.upload').val('');
        selector.find('.of-background-properties').hide();
        selector.find('.screenshot').slideUp();
        selector.find('.btn-remove').unbind().addClass('btn-upload').removeClass('btn-remove').html("Cargar");
        // We don't display the upload button if .upload-notice is present
        // This means the user doesn't have the WordPress 3.5 Media Library Support
        if ( $('.section-upload .upload-notice').length > 0 ) {
            $('.btn-upload').remove();
        }
        selector.find('.btn-upload').on('click', function( event ) { lb_add_file( event, $(this).parents('#upload_img'));});
    }

    $( document ).on( 'click', '.btn-remove' , function() {
        lb_remove_file( $(this).parents( '#upload_img' ) );
    });
    $( document ).on( 'click','.btn-upload', function( event ) {
        lb_add_file( event, $(this).parents( '#upload_img' ) );
    });
});