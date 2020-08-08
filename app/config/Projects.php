<?php
/**
 * 
 * Register the custom post type for projects and the associated taxonomies.
 *
 * @link   https://lordblaster.com.ve/
 * @since  1.0.0
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link   https://gitlab.com/icleranaya
 * 
 * @package akproducciones_web_v2_dev
 */

class Projects
{
	/**
	 * init.
	 *
	 * @see Projects::init()
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
			'name' 					=> _x( 'Proyectos', 'lb_projects', 'onepage-theme' ),
			'singular_name' 		=> _x( 'Proyecto', 'lb_projects', 'onepage-theme' ),
			'all_items'				=> __( 'Todos los proyectos', 'onepage-theme' ),
			'add_new' 				=> __( 'Agregar nuevo', 'onepage-theme' ),
			'add_new_item' 			=> __( 'Agregar nuevo proyecto', 'onepage-theme' ),
			'edit_item' 			=> __( 'Editar proyecto', 'onepage-theme' ),
			'new_item' 				=> __( 'Nuevo proyecto', 'onepage-theme' ),
			'view_item' 			=> __( 'Ver proyecto', 'onepage-theme' ),
			'search_items' 			=> __( 'Buscar proyecto', 'onepage-theme' ),
			'not_found' 			=> __( 'No se encontraton proyectos', 'onepage-theme' ),
			'featured_image'        => __( 'Imagen destacada', 'onepage-theme' ),
        	'set_featured_image'    => __( 'Insetar imagen destacada', 'onepage-theme' ),
        	'remove_featured_image' => __( 'Eliminar imagen destacada', 'onepage-theme' ),
        	'use_featured_image'    => __( 'Usar como imagen destacada', 'onepage-theme' ),
			'parent_item_colon' 	=> __( 'proyecto principal:', 'onepage-theme' ),
			'menu_name' 			=> __( 'proyectos', 'onepage-theme' )
		);

		$args = array(
			'menu_position' 		=> 8,
			'public' 				=> true,
			'show_ui' 				=> true,
			'publicly_queryable' 	=> true,
			'query_var' 			=> true,
			'show_in_rest'          => true,
			'hierarchical' 			=> false,
			'capability_type' 		=> 'post',
			'labels' 				=> $labels,
			'menu_icon' 			=> 'dashicons-media-interactive',
			'rewrite' 				=> array( 'slug' => 'proyectos' ),
			'label'					=> __( 'Proyecto', 'onepage-theme' ),
			'supports' 				=> array( 'title', 'thumbnail', 'excerpt')
		);

		register_post_type( 'lb_projects', $args );
	}
}