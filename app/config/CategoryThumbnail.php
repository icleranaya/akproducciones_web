<?php

class CategoryThumbail
{
    /**
     * __construc
     *
     * @return void
     */
    public function __construc()
    {
        // 
    }

    /**
     * init
     * 
     * Initialize the class and start calling our hooks and filters
     *
     * @return void
     */
    public function init()
    {
        add_action( 'admin_footer', array( $this, 'add_script' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
        add_action( 'created_lb_courses_category', array( $this, 'save_category_image' ), 10, 2 );
        add_action( 'edited_lb_courses_category', array( $this, 'updated_category_image' ), 10, 2 );
        add_action( 'lb_courses_category_add_form_fields', array( $this, 'add_category_image' ), 10, 2 );
        add_action( 'lb_courses_category_edit_form_fields', array( $this, 'update_category_image' ), 10, 2 );
    }

    /**
     * add_script
     *
     * Enqueue styles and scripts.
     * 
     * @return void
     */
    public function add_script()
    {
        if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'lb_courses_category' ) {
            return;
        }

        ?>
        <script>
            $(document).ready( function($) {
                _wpMediaViewsL10n.insertIntoPost = '<?php _e( "Insertar", "onepage-theme" ); ?>';

                function ct_media_upload( button_class )
                {
                    var _custom_media = true,
                        _orig_send_attachment = wp.media.editor.send.attachment;
                    
                    $('body').on('click', button_class, function(e) {
                        var button_id = '#'+$(this).attr('id');
                        var send_attachment_bkp = wp.media.editor.send.attachment;
                        var button = $(button_id);
                        _custom_media = true;

                        wp.media.editor.send.attachment = function( props, attachment )
                        {
                            if( _custom_media )
                            {
                                $('#showcase-taxonomy-image-id').val(attachment.id);
                                $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                                $( '#category-image-wrapper .custom_media_image' ).attr( 'src',attachment.url ).css( 'display','block' );
                            }
                            else
                            {
                                return _orig_send_attachment.apply( button_id, [props, attachment] );
                            }
                        }
                        wp.media.editor.open(button);
                        return false;
                    });
                }
                
                ct_media_upload('.showcase_tax_media_button.button');
                
                $('body').on('click','.showcase_tax_media_remove',function(){
                    $('#showcase-taxonomy-image-id').val('');
                    $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                });

                $(document).ajaxComplete(function( event, xhr, settings ) {
                    var queryStringArr = settings.data.split('&');
                    if( $.inArray('action=add-tag', queryStringArr) !== -1 )
                    {
                        var xml = xhr.responseXML;
                        $response = $(xml).find('term_id').text();

                        if($response!="")
                        {
                            // Clear the thumb image
                            $('#category-image-wrapper').html('');
                        }
                    }
                });
            });
        </script>
        <?php
    }

    /**
     * load_media
     *
     * @return void
     */
    public function load_media()
    {
        if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'lb_courses_category' ) {
            return;
        }
        wp_enqueue_media();
    }

    /**
     * save_category_image
     *
     * Save the form field.
     * 
     * @param  mixed $term_id
     * @param  mixed $tt_id
     *
     * @return void
     */
    public function save_category_image( $term_id, $tt_id )
    {
        if( isset( $_POST['showcase-taxonomy-image-id'] ) && '' !== $_POST['showcase-taxonomy-image-id'] ){
            add_term_meta( $term_id, 'showcase-taxonomy-image-id', absint( $_POST['showcase-taxonomy-image-id'] ), true );
        }
    }

    /**
     * updated_category_image
     *
     * Update the form field value.
     * 
     * @param  mixed $term_id
     * @param  mixed $tt_id
     *
     * @return void
     */
    public function updated_category_image( $term_id, $tt_id )
    {
        if( isset( $_POST['showcase-taxonomy-image-id'] ) && '' !== $_POST['showcase-taxonomy-image-id'] ):
            update_term_meta( $term_id, 'showcase-taxonomy-image-id', absint( $_POST['showcase-taxonomy-image-id'] ) );
        else:
            update_term_meta( $term_id, 'showcase-taxonomy-image-id', '' );
        endif;        
    }

    /**
     * add_category_image
     *
     * Add a form field in the new category page.
     * 
     * @param  mixed $taxonomy
     *
     * @return void
     */
    public function add_category_image( $taxonomy )
    {
        ?>
        <div class="form-field term-group">
            <label for="showcase-taxonomy-image-id"><?php _e( 'Imagen destacada', 'onepage-theme' ); ?></label>
            <input type="hidden" id="showcase-taxonomy-image-id" name="showcase-taxonomy-image-id" class="custom_media_url" value="">
            <div id="category-image-wrapper"></div>
            <p>
                <input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e( 'Agregar imagen', 'onepage-theme' ); ?>" />
                <input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e( 'Eliminar imagen', 'onepage-theme' ); ?>" />
            </p>
        </div>
        <?php
    }


    /**
     * update_category_image
     *
     * Edit the form field.
     * 
     * @param  mixed $term
     * @param  mixed $taxonomy
     *
     * @return void
     */
    public function update_category_image( $term, $taxonomy )
    {
        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="showcase-taxonomy-image-id"><?php _e( 'Imagen destacada', 'onepage-theme' ); ?></label>
            </th>
            <td>
                <?php $image_id = get_term_meta( $term->term_id, 'showcase-taxonomy-image-id', true ); ?>
                
                <input type="hidden" id="showcase-taxonomy-image-id" name="showcase-taxonomy-image-id" value="<?= esc_attr( $image_id ); ?>">
                <div id="category-image-wrapper">
                    <?php if( $image_id ): ?>
                        
                        <?= wp_get_attachment_image( $image_id, 'thumbnail' ); ?>

                    <?php endif; ?>
                </div>
                <p>
                    <input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e( 'Agregar imagen', 'onepage-theme' ); ?>" />
                    <input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e( 'Eliminar imagen', 'onepage-theme' ); ?>" />
                </p>
            </td>
        </tr>
        <?php   
    }

}

?>