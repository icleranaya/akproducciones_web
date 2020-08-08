(function($){

    $(document).ready(function() {

        var FormFile    = $('.input-group');
        var FileUpload  = FormFile.find( '.input-container' ).children('#upload_file');
        var postID      = FormFile.find( '.input-container' ).data( 'post-id' );

        $(document).on('click', '.btn-upload-file', function ( event ) {
            FileUpload.click();
        });

        FileUpload.on( 'change', function( e ) {
            e.preventDefault();

            // New Form of 
            var fd = new FormData();
            var individual_file = FileUpload[0].files[0];

            // Include file uploaded
            fd.append( 'lb_file_uploaded', individual_file );  
            fd.append( 'action', 'lb_ajax_upload_file' );
            fd.append( 'post_id', postID );

            // Action Ajax
            $.ajax({
                type: 'post',
                url: lb_l10n.ajaxurl,
                data: fd,
                contentType: false,
                processData: false,
                success: function( result ){
                    var value = FormFile.find('.value');
                    value.html( result.data.url );
                    FormFile.find( '.input-container' ).attr( "data-file", result.data.id_code );
                    FormFile.find( ".standard-btn" ).children( ".btn-upload-file" ).addClass( "btn-remove-file" );
                    FormFile.find( ".standard-btn" ).children( ".btn-remove-file" ).removeClass( "btn-upload-file" );
                    FormFile.find( ".standard-btn" ).children( ".btn-remove-file" ).html( lb_l10n.remove );
                }
            });
        }); 
    });

    // Remove file on metabox
    $(document).on('click','.btn-remove-file',function( event ) {
        lb_remove_file( event, $(this).parents('.input-group') );
    });

    // Define function for remove file
    function lb_remove_file( e, selector )
    {
        e.preventDefault();
 
        // Define var for id's of post and file to remove
        var postID = selector.find( ".input-container" ).data("post-id");
        var itemID = selector.find( ".input-container" ).data("file");
 
        $.ajax({
            url: lb_l10n.ajaxurl,
            type: 'post',
            data: {
                action : 'lb_ajax_remove_file',
                post_id: postID,
                item_id: itemID
            },
            success: function( result ){
                selector.find( ".input-container" ).children(".value").html( "No se ha seleccionado ningún archivo." );
                selector.find( '.input-container' ).attr( "data-file", "");
                selector.find( ".standard-btn" ).children( ".btn-remove-file" ).addClass( "btn-upload-file" );
                selector.find( ".standard-btn" ).children( ".btn-upload-file" ).removeClass( "btn-remove-file" );
                selector.find( ".standard-btn" ).children( ".btn-upload-file" ).html( lb_l10n.upload );

            }
        });
    }

})(jQuery);