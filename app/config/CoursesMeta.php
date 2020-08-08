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


class CoursesMeta
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
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_scripts' ) );
		add_action( 'admin_enqueue_styles', array( $this, 'my_admin_styles' ) );
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
			wp_enqueue_script( 'wp-color-picker' );
			// wp_register_script( 'custom-js', get_template_directory_uri() .'/public/js/admin/app.js', array( 'jquery' ) );
			// wp_enqueue_script( 'custom-js' );
			// wp_localize_script( 'custom-js', 'lb_l10n', array(
			// 	'upload' => __( 'Cargar', 'onepage-theme' ),
			// 	'remove' => __( 'Eliminar', 'onepage-theme' )
			// ) );
			
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
		$gallery = array();

		for ($j=1; $j <= 4; $j++) { 
			$gallery[$j] = get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_gallery_{$j}", false );
		}

		$date 				= get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_date", false );
		$content_edit 		= get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_content_editor", false );
		$duration_edit 		= get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_duration_editor", false );
		$invertion_edit 	= get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_invertion_editor", false );
		$instructor_edit 	= get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_instructor_editor", false );
		$location_edit 		= get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_location_editor", false );

		$this->post_information_html( $gallery, $date, $content_edit, $duration_edit, $invertion_edit, $instructor_edit, $location_edit );	
	}
	
	/**
	 * post_information_html
	 * 
	 * Output the post Information HTML for the metabox.
	 *
	 * @param  array $gallery
	 *
	 * @return string HTML
	 */
	private function post_information_html( $gallery, $date, $content_edit, $duration_edit, $invertion_edit, $instructor_edit, $location_edit )
	{
		?>
		<!-- Wrapper MetaBox Courses -->
		<div class="tab-table">
			<ul class="tab-links">
				<li class="tab-link">
					<a class="sm-txt-bold" id="gallery-tab" href="#gallery">
						<?= __( 'Slider', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="date-tab" href="#date">
						<?= __( 'Fecha Inicio', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="content-tab" href="#content">
						<?= __( 'Contenido', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="duration-tab" href="#duration">
						<?= __( 'Duración / Horario', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="invertion-tab" href="#invertion">
						<?= __( 'Inversión', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="instructor-tab" href="#instructor">
						<?= __( 'Instructor', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="location-tab" href="#location">
						<?= __( 'Ubicación', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
			</ul>
			<div id="infoCourseContent" class="tab-content">
				<?php wp_nonce_field( 'info_meta_box_nonce', 'project_info_meta_box_nonce' ); ?>

				<?php
				/**
				 * 
				 * GALLERY PANEL
				 * 
				 */
				?>

				<div id="gallery" class="group ak-table">
					<div class="content-group">
						<?php for( $i = 1; $i <= 4; $i++ ): ?>
							<div id="upload_img" class="section">

								<div class="input-group">

									<label for="upload_image_gallery_<?= $i;?>" class="input-container">

										<input id="upload_image_gallery_<?= $i;?>" class="upload form-control" type="text" size="36" name="upload_image_gallery_<?= $i;?>" value="<?= ( !empty($gallery[$i]) && $gallery[$i][0] != " " ? $gallery[$i][0]: '' );?>" placeholder="&nbsp;"/>

										<span class="label sm-txt-bold"><?= _e( 'Carga de Archivo', 'onepage-theme' ); ?></span>
										<span class="border"></span>
									</label>
									
									<?php if( function_exists( 'wp_enqueue_media' ) ):?>

										<?php if( !empty($gallery[$i]) && $gallery[$i][0] != " " ):?>
											<div class="standard-btn">
												<a href="javascript:;" id="remove_image_button" class="btn-remove btn-lb btn-content"><?= __( 'Eliminar', 'onepage-theme' ); ?></a>
											</div>
										<?php else: ?>
											<div class="standard-btn">
											<a href="javascript:;" id="upload_image_button" class="btn-upload btn-lb btn-content"><?= __( 'Cargar', 'onepage-theme' ); ?></a>
											</div>
										<?php endif;?>

									<?php endif;?>

								</div>

								<div class="screenshot">
									<?php if( !empty($gallery[$i]) && $gallery[$i][0] != " " ): ?>
										<img src="<?= $gallery[$i][0];?>" id="picsrc">
									<?php else: ?>
										<img src="" id="picsrc">
									<?php endif; ?>
								</div>

							</div>
						<?php endfor; ?>
					</div>
				</div>

				<?php
				/**
				 * 
				 * DATE PANEL
				 * 
				 */
				?>

				<div id="date" class="group ak-table">
					<div class="content-group">
						<div id="input-text" class="section">

							<label for="date_meta_box" class="input-container">

								<input id="date_meta_box" name="date_meta_box" type="text" value="<?= ( !empty($date) && $date[0] != " " ? $date[0]: '' );?>" placeholder="&nbsp;"/>

								<span class="label sm-txt-bold"><?= _e( 'Fecha de Inicio', 'onepage-theme' ); ?></span>
								<span class="border"></span>
							</label>
						</div>
					</div>
				</div>

				<?php
				/**
				 * 
				 *  CONTENT PANEL
				 * 
				 */
				?>
				<div id="content" class="group ak-table">
					<div class="wrapper-editor">
						<?php
							$output = '';
							
							$editor_settings = array(
								'textarea_name' => 'content_editor',
								'quicktags' => true,
								'media_buttons' => false,
								'wpautop' => true, // Default
								'textarea_rows' => 10
							);
							if( !empty($content_edit) && $content_edit[0] != " " ):
								wp_editor( $content_edit[0], "{$this->post_type}_{$this->id}_content_editor", $editor_settings );						
							else:
								wp_editor( "", "{$this->post_type}_{$this->id}_content_editor", $editor_settings );
							endif;
							
							$output = '';
						?>
					</div>
				</div>

				<?php
				/**
				 * 
				 *  DURATION PANEL
				 * 
				 */
				?>
				<div id="duration" class="group ak-table">
					<div class="wrapper-editor">
						<?php
							$output = '';
							
							$editor_settings = array(
								'textarea_name' => 'duration_editor',
								'quicktags' => true,
								'media_buttons' => false,
								'wpautop' => true, // Default
								'textarea_rows' => 10
							);
							if( !empty($duration_edit) && $duration_edit[0] != " " ):
								wp_editor( $duration_edit[0], "{$this->post_type}_{$this->id}_duration_editor", $editor_settings );						
							else:
								wp_editor( "", "{$this->post_type}_{$this->id}_duration_editor", $editor_settings );
							endif;
							
							$output = '';
						?>
					</div>
				</div>

				<?php
				/**
				 * 
				 *  INVERTION PANEL
				 * 
				 */
				?>
				<div id="invertion" class="group ak-table">
					<div class="wrapper-editor">
						<?php
							$output = '';
							
							$editor_settings = array(
								'textarea_name' => 'invertion_editor',
								'quicktags' => true,
								'media_buttons' => false,
								'wpautop' => true, // Default
								'textarea_rows' => 10
							);
							if( !empty($invertion_edit) && $invertion_edit[0] != " " ):
								wp_editor( $invertion_edit[0], "{$this->post_type}_{$this->id}_invertion_editor", $editor_settings );						
							else:
								wp_editor( "", "{$this->post_type}_{$this->id}_invertion_editor", $editor_settings );
							endif;
							
							$output = '';
						?>
					</div>
				</div>

				<?php
				/**
				 * 
				 *  INSTRUCTOR PANEL
				 * 
				 */
				?>
				<div id="instructor" class="group ak-table">
					<div class="wrapper-editor">
						<?php
							$output = '';
							
							$editor_settings = array(
								'textarea_name' => 'instructor_editor',
								'quicktags' => true,
								'media_buttons' => false,
								'wpautop' => true, // Default
								'textarea_rows' => 10
							);
							if( !empty($instructor_edit) && $instructor_edit[0] != " " ):
								wp_editor( $instructor_edit[0], "{$this->post_type}_{$this->id}_instructor_editor", $editor_settings );						
							else:
								wp_editor( "", "{$this->post_type}_{$this->id}_instructor_editor", $editor_settings );
							endif;
							
							$output = '';
						?>
					</div>
				</div>

				<?php
				/**
				 * 
				 *  LOCATION PANEL
				 * 
				 */
				?>
				<div id="location" class="group ak-table">
					<div class="wrapper-editor">
						<?php
							$output = '';
							
							$editor_settings = array(
								'textarea_name' => 'location_editor',
								'quicktags' => true,
								'media_buttons' => false,
								'wpautop' => true, // Default
								'textarea_rows' => 10
							);
							if( !empty($location_edit) && $location_edit[0] != " " ):
								wp_editor( $location_edit[0], "{$this->post_type}_{$this->id}_location_editor", $editor_settings );						
							else:
								wp_editor( "", "{$this->post_type}_{$this->id}_location_editor", $editor_settings );
							endif;
							
							$output = '';
						?>
					</div>
				</div>
			</div>

		</div>
		<!-- ***Wrapper MetaBox Courses -->
		<?= $this->java_metabox(); ?>
		<?php 
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

		for ( $j=1; $j <= 4; $j++ ):

			if( !empty($_POST['upload_image_gallery_' . $j]) ):

				update_post_meta( $post_id, "{$this->post_type}_{$this->id}_gallery_{$j}", $_POST['upload_image_gallery_' . $j]);

			else:
				
				update_post_meta( $post_id, "{$this->post_type}_{$this->id}_gallery_{$j}", " ");

			endif;

		endfor;
		
		// Fecha de inicio Input
		if( !empty( $_POST['date_meta_box'] ) )
		{
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_date", $_POST['date_meta_box'] );

		} else {
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_date", " " );
		}

		// Content Editor 
		if( !empty( $_POST['content_editor'] ) )
		{
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_content_editor", $_POST['content_editor'] );

		} else {
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_content_editor", " " );
		}

		// Duration Editor 
		if( !empty( $_POST['duration_editor'] ) )
		{
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_duration_editor", $_POST['duration_editor'] );

		} else {
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_duration_editor", " " );
		}

		// Invertion Editor 
		if( !empty( $_POST['invertion_editor'] ) )
		{
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_invertion_editor", $_POST['invertion_editor'] );

		} else {
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_invertion_editor", " " );
		}

		// Instructor Editor 
		if( !empty( $_POST['instructor_editor'] ) )
		{
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_instructor_editor", $_POST['instructor_editor'] );

		} else {
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_instructor_editor", " " );
		}

		// Location Editor 
		if( !empty( $_POST['location_editor'] ) )
		{
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_location_editor", $_POST['location_editor'] );

		} else {
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_location_editor", " " );
		}

	} // end method

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
		
} // end class