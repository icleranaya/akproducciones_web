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


class MetaServices
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
		add_action( 'wp_ajax_lb_feature_section', array( $this, 'lb_feature_section' ) );
		add_action( 'wp_ajax_lb_remove_item', array( $this, 'lb_remove_item' ) );
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
			wp_register_script( 'custom-js', get_template_directory_uri() .'/public/js/admin/app.js', array( 'jquery','wp-color-picker' ), THEME_VERSION );
			wp_enqueue_script( 'custom-js' );
			wp_localize_script( 'custom-js', 'lb_l10n', array(
				'upload'	=> __( 'Cargar', 'onepage-theme' ),
				'remove'	=> __( 'Eliminar', 'onepage-theme' ),
				'ajaxurl'	=> admin_url( 'admin-ajax.php' )
			) );
			
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
		$this->post_information_html( array(
			'post'				=> $post,
			'preamp'			=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_preamp", true ),
			'portada'			=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_portada", false ),
			'consola'			=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_consola", true ),
			'cornetas'			=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_cornetas", true ),
			'interfaz'			=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_interfaz", true ),
			'software'			=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_software", true ),
			'visuales'			=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_visuales", true ),
			'monitores'			=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_monitores", true ),
			'instrumentos'		=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_instrumentos", true ),
			'amplificadores'	=> get_post_meta( $post->ID, "{$this->post_type}_{$this->id}_amplificadores", true )
		));	
	}

	/**
	 * post_information_html
	 * 
	 * Output the post Information HTML for the metabox.
	 *
	 * @param  array $info
	 *
	 * @return string HTML
	 */
	private function post_information_html( $info )
	{
		extract( $info );
		
		?>
		<!-- Wrapper MetaBox Services -->
		<div class="tab-table">

			<ul class="tab-links">
				<li class="tab-link">
					<a class="sm-txt-bold" id="gallery-tab" href="#gallery">
						<?= __( 'Portada del servicio', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="interfaz-tab" href="#interfaz">
						<?= __( 'Interfaz', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="preamp-tab" href="#preamp">
						<?= __( 'Preamp', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="monitores-tab" href="#monitores">
						<?= __( 'Monitores', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="amplificadores-tab" href="#amplificadores">
						<?= __( 'Amplificadores', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="software-tab" href="#software">
						<?= __( 'Software', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="consola-tab" href="#consola">
						<?= __( 'Consola', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="cornetas-tab" href="#cornetas">
						<?= __( 'Cornetas', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="instrumentos-tab" href="#instrumentos">
						<?= __( 'Instrumentos', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
				<li class="tab-link">
					<a class="sm-txt-bold" id="visuales-tab" href="#visuales">
						<?= __( 'Visuales', 'onepage-theme' ); ?>
						<svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
					</a>
				</li>
			</ul>

			<div id="infoServicesContent" class="tab-content">
				<?php wp_nonce_field( 'info_meta_box_nonce', 'project_info_meta_box_nonce' ); ?>

				<!-- Gallery -->
				<div id="gallery" class="group ak-table">
					<div class="content-group">
						<div id="upload_img" class="section">
							<div class="input-group">

								<label for="upload_image_portada" class="input-container">
									<input id="upload_image_portada" class="upload form-control" type="text" size="36" name="upload_image_portada" value="<?= ( !empty($portada) && $portada[0] != " " ? $portada[0]: '' );?>" placeholder="&nbsp;"/>
									
									<span class="label sm-txt-bold"><?= _e( 'Carga de Archivo', 'onepage-theme' ); ?></span>
									<span class="border"></span>
								</label>

								<?php if( function_exists( 'wp_enqueue_media' ) ):?>

									<?php if( !empty($portada) && $portada[0] != " " ):?>
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
								<?php if( !empty($portada) && $portada[0] != " " ): ?>
									<img src="<?= $portada[0];?>" id="picsrc">
								<?php else: ?>
									<img src="" id="picsrc">
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Interfaz -->
				<?php $this->template( $post, "interfaz", $interfaz ); ?>

				<!-- Preamp -->
				<?php $this->template( $post, "preamp", $preamp ); ?>

				<!-- Monitores -->
				<?php $this->template( $post, "monitores", $monitores ); ?>

				<!-- Amplificadores -->
				<?php $this->template( $post, "amplificadores", $amplificadores ); ?>

				<!-- Software -->
				<?php $this->template( $post, "software", $software ); ?>

				<!-- Consola -->
				<?php $this->template( $post, "consola", $consola ); ?>

				<!-- Cornetas -->
				<?php $this->template( $post, "cornetas", $cornetas ); ?>

				<!-- Instrumentos -->
				<?php $this->template( $post, "instrumentos", $instrumentos ); ?>

				<!-- Visuales -->
				<?php $this->template( $post, "visuales", $visuales ); ?>
				
			</div>

		</div>
		<!-- ***Wrapper MetaBox Services -->
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
		
		if( !empty($_POST['upload_image_portada']) ):

			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_portada", $_POST['upload_image_portada']);

		else:
			
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_portada", " ");

		endif;


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

	/**
	 * lb_feature_section
	 *
	 * @return void
	 */
	public function lb_feature_section()
	{
		$marca		= isset( $_POST['marca'] ) ? $_POST['marca'] : " ";
		$equipo		= isset( $_POST['equipo'] ) ? $_POST['equipo'] : " ";
		$modelo		= isset( $_POST['modelo'] ) ? $_POST['modelo'] : " ";
		$post_id	= isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;
		$section	= isset( $_POST['section'] ) ? $_POST['section'] : " ";
		$cantidad	= isset( $_POST['cantidad'] ) ? $_POST['cantidad'] : " ";

		$content = get_post_meta( $post_id, "{$this->post_type}_{$this->id}_{$section}", true );

		if( $section == "instrumentos" || $section == "visuales" ):
			$new_id = $this->compute_id( $equipo );
		else:
			$new_id = $this->compute_id( $modelo );
		endif;


		if( empty( $content ) ):
			if( $section == "instrumentos" ):
				$feature = array( $new_id => array(
					'marca'		=> $marca,
					'equipo'	=> $equipo,
					'modelo'	=> $modelo,
					'cantidad'	=> $cantidad,
					'item_ID'	=> $new_id
				));
			elseif( $section == "software" ):
				$feature = array( $new_id => array(
					'marca'		=> $marca,
					'modelo'	=> $modelo,
					'item_ID'	=> $new_id
				));
			elseif( $section == "visuales" ):
				$feature = array( $new_id => array(
					'marca'		=> $marca,
					'equipo'	=> $equipo,
					'cantidad'	=> $cantidad,
					'item_ID'	=> $new_id
				));
			else:
				$feature = array( $new_id => array(
					'marca'		=> $marca,
					'modelo'	=> $modelo,
					'cantidad'	=> $cantidad,
					'item_ID'	=> $new_id
				));
			endif;

			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_{$section}", $feature );
						
		else:
			if( $section == "instrumentos" || $section == "visuales" ):
				$content[ $new_id ] = array(
					'marca'		=> $marca,
					'equipo'	=> $equipo,
					'modelo'	=> $modelo,
					'cantidad'	=> $cantidad,
					'item_ID'	=> $new_id
				);
			elseif( $section == "software" ):
				$content[ $new_id ] = array(
					'marca'		=> $marca,
					'modelo'	=> $modelo,
					'item_ID'	=> $new_id
				);
			elseif( $section == "visuales" ):
				$content[ $new_id ] = array(
					'marca'		=> $marca,
					'equipo'	=> $equipo,
					'cantidad'	=> $cantidad,
					'item_ID'	=> $new_id
				);
			else:
				$content[ $new_id ] = array(
					'marca'		=> $marca,
					'modelo'	=> $modelo,
					'cantidad'	=> $cantidad,
					'item_ID'	=> $new_id
				);
			endif;
			

			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_{$section}", $content );

		endif;

		if( $section == "instrumentos" || $section == "visuales" ):
			wp_send_json_success( array(
				'marca'		=> $marca,
				'equipo'	=> $equipo,
				'modelo'	=> $modelo,
				'cantidad'	=> $cantidad,
				'section'	=> $section,
				'item_ID'	=> $new_id
			));
		elseif( $section == "software" ):
			wp_send_json_success( array(
				'marca'		=> $marca,
				'modelo'	=> $modelo,
				'section'	=> $section,
				'item_ID'	=> $new_id
			));
		elseif( $section == "visuales" ):
			wp_send_json_success( array(
				'marca'		=> $marca,
				'equipo'	=> $equipo,
				'cantidad'	=> $cantidad,
				'section'	=> $section,
				'item_ID'	=> $new_id
			));
		else:
			wp_send_json_success( array(
				'marca'		=> $marca,
				'modelo'	=> $modelo,
				'cantidad'	=> $cantidad,
				'section'	=> $section,
				'item_ID'	=> $new_id
			));
		endif;

		wp_die();		
	}

	/**
     * Compute an ID from the name
     *
     * @param string $name The name
     *
     * @return string The ID
     */
    private function compute_id( $equipo )
    {
        return $id = md5( $equipo );
	}

	/**
	 * lb_remove_item
	 * 
	 * Handle the item removal process via AJAX
	 *
	 * @return void
	 */
	public function lb_remove_item()
	{
		$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;
		$item_id = isset( $_POST['item_id'] ) ? $_POST['item_id'] : 0;
		$section = isset( $_POST['section'] ) ? $_POST['section'] : " ";

		$content = get_post_meta( $post_id, "{$this->post_type}_{$this->id}_{$section}", true );

		if( !empty( $content ) ):
			unset( $content[$item_id] );
			update_post_meta( $post_id, "{$this->post_type}_{$this->id}_{$section}", $content );
		endif;
		wp_die();
	}

	/**
	 * template
	 *
	 * @param  string $section
	 * @param  array $content
	 *
	 * @return void
	 */
	private function template( $post, $section, $content = array() )
	{
		?>
			<div id="<?= $section ?>" class="group ak-table">
				<div class="<?= $section; ?>">

					<div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
									<?php if( $section == "instrumentos" || $section == "visuales" ): ?>
										<th class="sm-txt-bold"><?= __( 'Equipo', 'onepage-theme' ); ?></th>
									<?php endif; ?>
									<?php if( $section != "visuales" ): ?>
										<th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
										<th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
									<?php else: ?>
										<th class="sm-txt-bold"><?= __( 'Tipo', 'onepage-theme' ); ?></th>
									<?php endif; ?>
									<?php if( $section != "software" ): ?>
										<th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
									<?php endif; ?>
                                    <th class="sm-txt-bold"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>


					<div class="tbl-inputs">
						<table class="table">
							<tbody class="lb-content-<?= $section; ?>">
							<?php if( $content ): ?>
								<?php foreach( $content as $key => $item ): ?>
									<tr class="item" data-post-id="<?= $post->ID; ?>" data-item-id="<?= $item['item_ID'];?>" data-section="<?= $section ?>">
										
										<?php if( $section == "instrumentos" || $section == "visuales" ): ?>
											<td class="text-center equipo"><?= $item['equipo'];?></td>
										<?php endif; ?>

										<?php if( $section != "visuales" ): ?>
											<td class="text-center marca"><?= $item['marca'];?></td>
										<?php endif; ?>
										
										<td class="text-center modelo"><?= $item['modelo'];?></td>
										
										<?php if( $section != "software" ): ?>
											<td class="text-center cantidad"><?= $item['cantidad'];?></td>
										<?php endif; ?>
										
										<td class="lb-actions">
											<a href="javascript:;" class="remove-item" title="<?= __( 'Eliminar', 'onepage-theme'); ?>"><i class="far fa-trash-alt"></i></a>
										</td>
												   </tr>
								<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
						</table>
					</div>
					<table class="table">
						<tbody class="lb-content-template-<?= $section; ?>" style="display:none;">
							<tr class="item" data-post-id="<?= $post->ID; ?>" data-item-id="" data-section="">
								
								<?php if( $section == "instrumentos" || $section == "visuales" ): ?>
									<td class="text-center equipo"></td>
								<?php endif; ?>

								<?php if( $section != "visuales" ): ?>
									<td class="text-center marca"></td>
								<?php endif; ?>	
								
								<td class="text-center modelo"></td>
								
								<?php if( $section != "software" ): ?>
									<td class="text-center cantidad"></td>
								<?php endif; ?>
								
								<td class="lb-actions">
									<a href="javascript:;" class="remove-item" title="<?= __( 'Eliminar', 'onepage-theme'); ?>"><i class="far fa-trash-alt"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="inputs-for-table <?= $section; ?>" data-id="<?= $post->ID; ?>" data-section="<?= $section ?>">
						<div class="inputs-group">

							<?php if( $section == "instrumentos" || $section == "visuales" ): ?>
								<label for="standard-input" class="input-container">
									<input type="text" name="equipo" class="equipo" id="standard-input" placeholder="&nbsp;">
									<span class="label"><?= __( 'Ingrese un nombre', 'onepage-theme' ); ?></span>
									<span class="border"></span>
								</label>
							<?php endif; ?>
							
							<?php if( $section != "visuales" ): ?>
								<label for="standard-input" class="input-container">
									<input type="text" name="marca" class="marca" id="standard-input" placeholder="&nbsp;">
									<span class="label"><?= __( 'Ingrese una marca', 'onepage-theme' ); ?></span>
									<span class="border"></span>
								</label>
							<?php endif; ?>
							
							<label for="standard-input" class="input-container">
								<input type="text" name="modelo" class="modelo" id="standard-input" placeholder="&nbsp;">
								<span class="label"><?= __( 'Ingrese un modelo', 'onepage-theme' ); ?></span>
								<span class="border"></span>
							</label>

							<?php if( $section != "software" ): ?>
								<label for="standard-input" class="input-container">
									<input type="text" name="cantidad" class="cantidad" id="standard-input" placeholder="&nbsp;" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
									<span class="label"><?= __( 'Ingrese la cantidad', 'onepage-theme' ); ?></span>
									<span class="border"></span>
								</label>
							<?php endif; ?>

						</div>
						<div class="standard-btn btn-wrap">
							<a href="javascript:;" id="<?= $section; ?>" class="btn-content btn-add"><?= __( 'Agregar', 'onepage-theme' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		<?php
		
	}
		
} // end class