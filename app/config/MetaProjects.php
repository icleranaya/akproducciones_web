<?php
/**
 * The projects-specific functionality of the theme.
 *
 * Defines functions for how to enqueue the projects-specificshow posts.
 *
 * @link https://lordblaster.com.ve/
 * @since 1.0.0
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 */


class MetaProjects
{
	/**
	 * init
	 *
	 * @param  mixed $args
	 *
	 * @return void
	 */
	public function init( $args = array() )
	{
		$this->register($args);
	}
		
	/**
	 * Register a new post Specifications / Applications / Benefits for the products.
	 *
	 * Required $args contents:
	 *
	 * label - The name of the post thumbnail to display in the admin metabox
	 *
	 * id - Used to build the CSS class for the admin meta box. Needs to be unique and valid in a CSS class selector.
	 *
	 * Optional $args contents:
	 *
	 * post_type - The post type to register this thumbnail for. Defaults to post.
	 *
	 * priority - The admin metabox priority. Defaults to 'low'.
	 * 
	 * context - The admin metabox context. Defaults to 'side'.
	 *
	 * @param array|string $args See above description.
	 * @return void
	 */
	private function register( $args = array() )
	{
		$defaults = array(
			'label' => null,
			'id' => null,
			'post_type' => 'post',
			'priority' => 'low',
			'context' => 'side',
		);

		$args = wp_parse_args($args, $defaults);

		// Create and set properties
		foreach( $args as $k => $v )
			$this->$k = $v;

		// Need these args to be set at a minimum
		if( null === $this->label || null === $this->id ):
			if( WP_DEBUG )
				trigger_error( sprintf( __( "The 'label' and 'id' values of the 'args' parameter of '%s::%s()' are required", 'onepage-theme'), __CLASS__, __FUNCTION__) );
			return;
		endif;

		add_action( 'add_meta_boxes', array( $this, 'add_metabox_information' ) );
		add_action( 'save_post', array( $this, 'add_metabox_information_save' ) );
		add_action( 'post_edit_form_tag', array( $this, 'post_edit_form_tag' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_scripts' ) );
		add_action( 'admin_enqueue_styles', array( $this, 'my_admin_styles' ) );

		// Method Ajax
		add_action( 'wp_ajax_lb_ajax_remove_file', array( $this, 'lb_ajax_remove_file' ) );
		add_action( 'wp_ajax_lb_ajax_upload_file', array( $this, 'lb_ajax_upload_file' ) );
	}

	/**
     * Alter the edit form tag to say we have files to upload
     */
    public function post_edit_form_tag()
    {
        echo ' enctype="multipart/form-data"';
    }

	/**
	 * add_admin_scripts
	 * 
	 * Enqueue Scripts.
	 *
	 * @param  mixed $hook
	 *
	 * @return void
	 */
	public function add_admin_scripts( $hook )
	{
		global $post;
		
		if( function_exists( 'wp_enqueue_media' ) )
			wp_enqueue_media();

		if( $hook == 'post-new.php' || $hook == 'post.php' ):
			// wp_enqueue_script( 'wp-color-picker' );
			wp_register_script( 'custom-js', get_template_directory_uri() .'/public/js/admin/app.js', array( 'jquery','wp-color-picker' ), THEME_VERSION );
			wp_enqueue_script( 'custom-js' );
			wp_localize_script( 'custom-js', 'lb_l10n', array(
				'upload'	=> __( 'Cargar', 'onepage-theme' ),
				'remove'	=> __( 'Eliminar', 'onepage-theme' ),
				'ajaxurl'	=> admin_url( 'admin-ajax.php' )
			) );

			wp_enqueue_script( 'svg-injector-2', get_template_directory_uri() . '/public/plugins/svg-injector-2/svg-injector.min.js', array('jquery'), '2.1.3' );
			wp_enqueue_style( 'functions', get_template_directory_uri() . '/public/css/admin/admin.css', array(),  THEME_VERSION );
			wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Raleway|Roboto', false, '1.0');				

		endif;
	}

	/**
	 * my_admin_styles
	 * 
	 * Enqueue styles.
	 *
	 * @return void
	 */
	public function my_admin_styles()
	{
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'wp-color-picker' );
	}

	/**
	 * add_metabox_information
	 * 
	 * Add admin metabox for Gallery for the project.
	 *
	 * @return void
	 */
	public function add_metabox_information()
	{
		add_meta_box( "{$this->post_type}-{$this->id}", __( $this->label, 'onepage-theme' ), array( $this, 'information' ), $this->post_type, $this->context, $this->priority );
	}

	/**
	 * information
	 * 
	 * Output the Information meta box.
	 *
	 * @param  mixed $post
	 *
	 * @return string HTML output
	 */
	public function information( $post )
	{	
		// $gallery = array();

		// for ($j=1; $j <= 4; $j++) { 
		// 	$gallery[$j] = get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_gallery_{$j}", false );
		// }

		$this->post_information_html( $post->ID, get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_file", true ) );	
	}
	
	/**
	 * post_information_html
	 * 
	 * Output the post Information HTML for the metabox.
	 *
	 * @param  array $file
	 *
	 * @return string HTML
	 */
	private function post_information_html( $post, $file )
	{
		?>
		
		<!-- Wrapper MetaBox Projects -->
		<div class="tab-table">
		
			<ul class="tab-links">
				<li class="tab-link">
					<a class="sm-txt-bold" id="gallery-tab" href="#gallery">
						<?= __( 'Archivo de audio mp3', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
			</ul>
			<div id="infoProjectContent" class="tab-content">
				<?php wp_nonce_field( 'info_meta_box_nonce', 'project_info_meta_box_nonce' ); ?>

				<?php
				/**
				 * 
				 * FILE UPLOAD
				 * 
				 */
				?>

				<div id="gallery" class="group ak-table">
					<div class="content-group">
						
						<!-- Load file -->
						<div id="upload_img" class="section">

							<div class="input-group">

								<label for="upload_file" class="input-container" data-post-id="<?= $post; ?>" data-file="<?= ( !empty($file) && $file != " " ? $file['id'] : '' ); ?>">


									<input id="upload_file" class="upload form-control" type="file" size="36" name="upload_file" placeholder="&nbsp;"/>

									<span class="label sm-txt-bold"><?= _e( 'Carga de Archivo', 'onepage-theme' ); ?></span>
									<span class="value"><?= ( !empty($file) && $file != " " ? $file['url'] : 'No se ha seleccionado ningún archivo.' );?></span>
									<span class="border"></span>
									<span class="border-2"></span>
								</label>

								<?php if( function_exists( 'wp_enqueue_media' ) ):?>

									<?php if( !empty($file) && $file != " " ):?>
										<div class="standard-btn">
											<a href="javascript:;" class="btn-remove-file btn-content"><?= __( 'Eliminar', 'onepage-theme' ); ?></a>
										</div>
									<?php else: ?>
										<div class="standard-btn">
											<a href="javascript:;" class="btn-upload-file btn-content"><?= __( 'Cargar', 'onepage-theme' ); ?></a>
										</div>
									<?php endif;?>

								<?php endif;?>

							</div>

						</div>

					</div>
				</div>
			</div>

		</div>
		<!-- ***Wrapper MetaBox Projects -->
		<?= $this->java_metabox(); ?>
		<?php 
	}

	/**
	 * java_metabox
	 * 
	 * jQuery for metabox.
	 *
	 * @return void
	 */
	private function java_metabox()
	{
		ob_start();
		
		?>
		
		<script type="text/javascript">
			$(document).ready(function($){

				/* svg injector */
				new SVGInjector().inject(document.querySelectorAll('svg[data-src]'));
				
			});
		</script>
		<?php
		
		return ob_get_clean();
	}
		
	/**
	 * When the post is saved, saves our custom data
	 *
	 * @param integer $post_id The information's post ID.
	 * @return string HTML
	 */
	public function add_metabox_information_save( $post_id )
	{
		// Bail if we're doing an auto save  
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail 
		if( !isset( $_POST['project_info_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['project_info_meta_box_nonce'], 'info_meta_box_nonce' ) ) return;

		// if our current user can't edit this post, bail  
		if( !current_user_can( 'edit_post', $post_id ) ) return;

		// update_post_meta( $post_id, "{$this->post_type}_{$this->id}_file", $_POST['upload_file']);

	} // end method

	/**
	 *  Handle the file upload process via AJAX
	 *  
	 *  @since 6.2
	 */
	public function lb_ajax_upload_file()
	{
		// $new_file = isset( $_FILES['lb_file_uploaded'] ) ? $_FILES['lb_file_uploaded'] : array();
		$post_id  = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;
		
		// Make sure the file array isn't empty
	    if( !empty( $_FILES['lb_file_uploaded']['name'] ) ):
			
			// Setup the array of supported file types. In this case, it's just PDF.
		    $supported_types = array( "audio/mp4", "audio/mp3", "audio/ogg", "audio/aac", "audio/webm", "audio/mpeg", "audio/wave" );
			
		    // Get the file type of the upload
	        $arr_file_type = wp_check_filetype( basename( $_FILES['lb_file_uploaded']['name'] ) );
	        $uploaded_type = $arr_file_type['type'];
			
	        // Check if the type is supported. If not, throw an error.
			if( in_array( $uploaded_type, $supported_types ) ):
				
	        	// Use the WordPress API to upload the file
	            $upload = wp_upload_bits( $_FILES['lb_file_uploaded']['name'], null, file_get_contents( $_FILES['lb_file_uploaded']['tmp_name'] ) );
	            
	            if( isset($upload['error']) && $upload['error'] != 0 ):
	                wp_send_json_error('Hubo un error al subir tu archivo. El error es: ' . $upload['error']);
	            else:
					
	            	$file_meta = get_post_meta( $post_id, "{$this->post_type}_{$this->id}_file", true );
					
	            	// No files at all
			        if( !$file_meta ):
			            $file_meta = $this->update_legacy_file_meta( $upload );
			            add_post_meta( $post_id, "{$this->post_type}_{$this->id}_file", $file_meta );
					else:
			            // Use this opportunity to update that meta field to the new format
			            $file_meta = $this->update_legacy_file_meta( $upload );
			            update_post_meta( $post_id, "{$this->post_type}_{$this->id}_file", $file_meta );
			        endif;
					
			        wp_send_json_success( array(
						'file_meta'=> $file_meta,
				    	'postId'  => $post_id,
				    	'title'	  => $file_meta['name'],
				    	'url'	  => $file_meta['url'],
				    	'type'	  => $file_meta['extention'],
				    	'size'	  => $file_meta['size'],
				    	'date'	  => $file_meta['date'],
				    	'id_code' => $file_meta['id']
				    ));
	            endif;
	        else:
	            wp_send_json_error( "El tipo de archivo que ha cargado no es soportado." );
	        endif; // end if/else
		endif;
		wp_die();
	}
	
	/**
	 *  Handle the file removal process via AJAX
	 *  
	 *  @since 6.2
	 */
	public function lb_ajax_remove_file()
	{
		$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;
		// $item_id = isset( $_POST['item_id'] ) ? $_POST['item_id'] : 0;
		
		$file = get_post_meta( $post_id, "{$this->post_type}_{$this->id}_file", true );

		if( unlink( $file['file'] ) ):
			// unset( $files[$item_id] );
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_file", " " );
		endif;
		wp_die();
	}

	/**
	 * Update the file meta data from the old single file meta format to the new meta format.
     *
	 * @since 6.2
     *
	 * @param array $file The file
     *
	 * @return array
     */
	private function update_legacy_file_meta( $file )
    {
		$meses = array( "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio" ,"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" );
        if( !isset( $file['source'] ) ):
        	$name = explode( '/', $file['file'] );
        	$extention = explode( '.', $name[ count( $name ) - 1 ] );
        	// New format for files
            $file['source'] 	= 'legacy';
            $file['caption'] 	= $name[ count( $name ) - 1 ];
            $file['name'] 		= $extention[0];            
            $file['extention']  = $extention[ count( $extention ) - 1 ];
            $file['size']		= $this->FileSizeConvert( filesize( $file['file'] ) );
            $file['extra'] 		= '';
            $file['date']		= date( 'd' )." ".$meses[date( 'n' )-1]. ", ".date( 'Y' );
            $file['id'] 		= $this->compute_file_id( $file );
        endif;
		
        return $file;
    }
	
	/** 
	 * Converts bytes into human readable file size. 
	 * 
	 * @param string $bytes 
	 * @return string human readable file size (2,87 Мб) 
	 */ 
	private function FileSizeConvert( $bytes )
	{
		$bytes = floatval($bytes);
		
		$arBytes = array(
			0 => array(
				"UNIT" => "TB",
				"VALUE" => pow(1024, 4)
			),
			1 => array(
				"UNIT" => "GB",
				"VALUE" => pow(1024, 3)
			),
			2 => array(
				"UNIT" => "MB",
				"VALUE" => pow(1024, 2)
			),
			3 => array(
				"UNIT" => "KB",
				"VALUE" => 1024
			),
			4 => array(
				"UNIT" => "B",
				"VALUE" => 1
			),
		);
		
		foreach( $arBytes as $arItem ):
			if( $bytes >= $arItem["VALUE"] ):
				$result = $bytes / $arItem["VALUE"];
				$result = str_replace( ".", "," , strval( round( $result, 2 ) ) )." ".$arItem["UNIT"];
				break;
			endif;
		endforeach;
		
		return $result;
	}
	
	/**
	 * Compute an ID from the file name
	 *
	 * @param string $filename The file name
	 *
	 * @return string The ID
	 */
	private function compute_file_id( $file )
	{
		return md5( $file['file'] );
	}

} // end class