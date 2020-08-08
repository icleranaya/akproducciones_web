<?php
/**
 * 
 * Register the custom post type for services and the associated taxonomies.
 *
 * @link   https://lordblaster.com.ve/
 * @since  1.0.0
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link   https://gitlab.com/icleranaya
 * 
 * @package akproducciones_web_v2_dev
 */

class Services
{
	/**
	 * init.
	 *
	 * @see Services::init()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
	public function init()
	{
		$this->register_custom_types();
	}
    
    /**
	 * Register the custom post type for services and the associated taxonomies
	 */
	public function register_custom_types()
	{
		$labels = array(
			'name' 					=> _x( 'Servicios', 'lb_services', 'onepage-theme' ),
			'singular_name' 		=> _x( 'Servicio', 'lb_services', 'onepage-theme' ),
			'all_items'				=> __( 'Todos los servicios', 'onepage-theme' ),
			'add_new' 				=> __( 'Agregar nuevo', 'onepage-theme' ),
			'add_new_item' 			=> __( 'Agregar nuevo servicio', 'onepage-theme' ),
			'edit_item' 			=> __( 'Editar servicio', 'onepage-theme' ),
			'new_item' 				=> __( 'Nuevo servicio', 'onepage-theme' ),
			'view_item' 			=> __( 'Ver servicio', 'onepage-theme' ),
			'search_items' 			=> __( 'Buscar servicio', 'onepage-theme' ),
			'not_found' 			=> __( 'No se encontraton servicios', 'onepage-theme' ),
			'featured_image'        => __( 'Imagen destacada', 'onepage-theme' ),
        	'set_featured_image'    => __( 'Insetar imagen destacada', 'onepage-theme' ),
        	'remove_featured_image' => __( 'Eliminar imagen destacada', 'onepage-theme' ),
        	'use_featured_image'    => __( 'Usar como imagen destacada', 'onepage-theme' ),
			'parent_item_colon' 	=> __( 'Servicio principal:', 'onepage-theme' ),
			'menu_name' 			=> __( 'Servicios', 'onepage-theme' )
		);

		$args = array(
			'menu_position' 		=> 7,
			'public' 				=> true,
			'show_ui' 				=> true,
			'publicly_queryable' 	=> true,
			'query_var' 			=> true,
			'show_in_rest'          => true,
			'hierarchical' 			=> false,
			'capability_type' 		=> 'post',
			'labels' 				=> $labels,
			'menu_icon' 			=> 'dashicons-admin-generic',
			'rewrite' 				=> array( 'slug' => 'servicios' ),
			'label'					=> __( 'Servicio', 'onepage-theme' ),
			'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'excerpt')
		);

		register_post_type( 'lb_services', $args );
	}
}