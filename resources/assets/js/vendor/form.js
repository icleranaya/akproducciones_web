(function($){

    // Submit Form for Inscription
    $(document).on('click','.submit-btn',function ( event ) {
        lb_send_email( event, $(this), $(this).parents( '.container-info' ).find( '.form-wrapper' ) );
    });
    
    function lb_send_email( e, element, container )
    {
        e.preventDefault();

        var $AjaxTrue,
            $left        = container.find( '#left' ),
            $right       = container.find( '#right' ),
            $EmailTrue   = false,
            $EmailRegex  = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i;

        if( $EmailRegex.test( $left.find( '#email' ).val() ) )
            $EmailTrue = true;

        $AjaxTrue = $left.find( '#name' ).val().length > 0 &&
                    $left.find( '#email' ).val().length > 0 &&
                    $EmailTrue &&
                    $left.find( '#monto' ).val().length > 0 &&
                    $left.find( '#banco' ).val().length > 0 &&
                    $right.find( '#id' ).val().length > 0 &&
                    $right.find( '#curso' ).val().length > 0 &&
                    $right.find( '#deposito' ).val().length > 0;
            
        if( $AjaxTrue ){
            // Action Ajax
            $.ajax({
                url: lb_l10n.ajaxurl,
                type: 'post',
                data: {
                    action : 'lb_ajax_inscription',
                    ci: $right.find( '#id' ).val(),
                    name: $left.find( '#name' ).val(),
                    email: $left.find( '#email' ).val(),
                    monto: $left.find( '#monto' ).val(),
                    banco: $left.find( '#banco' ).val(),
                    curso: $right.find( '#curso' ).val(),
                    deposito: $right.find( '#deposito' ).val()
                },
                beforeSend: function(){
                    element.attr('disabled', true);
                },
                success: function( result ) {
                    element.attr('disabled', false);

                    container.parents( '#ak-form' ).find( '.wrap-alert' ).children( '.alert' ).css( 'display', 'block');
                    container.parents( '#ak-form' ).find( '.wrap-alert' ).children( '.alert' ).addClass( 'success' );
                    container.parents( '#ak-form' ).find( '.wrap-alert' ).children( '.alert' ).children( '.content' ).html( result.data );

                    $right.find( '#id' ).val("");
                    $left.find( '#name' ).val("");
                    $left.find( '#email' ).val("");
                    $left.find( '#monto' ).val(""),
                    $left.find( '#banco' ).val("");
                    $right.find( '#curso' ).val("");
                    $right.find( '#deposito' ).val("");   
                }
            });

        } else {
            container.parents( '#ak-form' ).find( '.wrap-alert' ).children( '.alert' ).css( 'display', 'block');
            container.parents( '#ak-form' ).find( '.wrap-alert' ).children( '.alert' ).addClass( 'danger' );
            container.parents( '#ak-form' ).find( '.wrap-alert' ).children( '.alert' ).children( '.content' ).html( "Todos los campos marcados con (*) son obligatorios." );
        }
    }

    $(document).on('click','.closebtn',function ( event ) {
        $(this).parents( '.alert' ).css( 'display', 'none');
        $(this).parents( '.alert' ).children( '.content' ).html( '' );

        if( $(this).parents( '.alert' ).hasClass( 'danger' ) )
            $(this).parents( '.alert' ).removeClass( 'danger' );

        if( $(this).parents( '.alert' ).hasClass( 'success' ) )
            $(this).parents( '.alert' ).removeClass( 'success' );
    });

})(jQuery);