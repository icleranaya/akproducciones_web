(function($){

    // Function for the action Ajax of add item
    function lb_feature_section( e, section, selector, wrapper )
    {
        e.preventDefault();

        var lb_marca       = selector.find('.marca').val(),
            lb_equipo      = selector.find('.equipo').val(),
            lb_modelo      = selector.find('.modelo').val(),
            lb_post_id     = selector.data('id'),
            lb_section     = selector.data('section'),
            lb_cantidad    = selector.find('.cantidad').val(),
            lb_template    = wrapper.find('.lb-content-template-' + section);

        $.ajax({
            type: "post",
            url: lb_l10n.ajaxurl,
            data: {
                action:     "lb_feature_section",
                marca:      lb_marca,
                equipo:     lb_equipo,
                modelo:     lb_modelo,
                post_id:    lb_post_id,
                section:    lb_section,
                cantidad:   lb_cantidad
            },
            success: function (result) {
                var newIdCode   = result.data.item_ID,
                    section     = result.data.section,
                    item        = lb_template.find( ".item" ).first().clone();

                selector.find('.marca').val("");
                selector.find('.equipo').val("");
                selector.find('.modelo').val("");
                selector.find('.cantidad').val("");
                item.appendTo( ".lb-content-" + section );
                item.attr( 'data-item-id', newIdCode );
                item.attr( 'data-section', section );
                if (result.data.equipo) {
                    item.children( ".equipo" ).html( result.data.equipo );
                }
                if (result.data.marca) {
                    item.children( ".marca" ).html( result.data.marca );
                }
                if (result.data.modelo) {
                    item.children( ".modelo" ).html( result.data.modelo );
                }
                if (result.data.cantidad) {
                    item.children( ".cantidad" ).html( result.data.cantidad );
                }
            }
        });
    }

    // Function for the action Ajax of remove item
    function lb_remove_item( e, selector )
    {
        e.preventDefault();

        var item_ID = selector.data("item-id"),
            section = selector.data("section"),
            post_ID = selector.data("post-id");

        $.ajax({
            type: "post",
            url: lb_l10n.ajaxurl,
            data: {
                action: "lb_remove_item",
                post_id: post_ID,
                item_id: item_ID,
                section: section
            },
            success: function () {
                selector.remove();
            }
        });
    }

    // Add new item for Feature
    $(document).on('click', '.btn-add', function ( event ) {
        var section = $(this).attr("id"),
            SelectorWrapper = $(this).parent('.btn-wrap').parent( '.inputs-for-table.' + section ),
            SelectorWrapperContent = $(this).parent('.btn-wrap').parent('.inputs-for-table').parent( '.' + section );
        
        // Call to function for action
        lb_feature_section( event, section, SelectorWrapper, SelectorWrapperContent );
    });

    // Remove item on metabox
    $(document).on('click','.remove-item',function ( event ) {
        lb_remove_item( event, $(this).parents('.item') );
    });

})(jQuery);