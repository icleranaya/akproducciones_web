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

class Team
{
	/**
	 * init.
	 *
	 * @see Team::init()
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
			'name' 					=> _x( 'Integrantes', 'lb_team', 'onepage-theme' ),
			'singular_name' 		=> _x( 'Integrante', 'lb_team', 'onepage-theme' ),
			'all_items'				=> __( 'Todos los integrantes', 'onepage-theme' ),
			'add_new' 				=> __( 'Agregar nuevo', 'onepage-theme' ),
			'add_new_item' 			=> __( 'Agregar nuevo integrante', 'onepage-theme' ),
			'edit_item' 			=> __( 'Editar integrante', 'onepage-theme' ),
			'new_item' 				=> __( 'Nuevo integrante', 'onepage-theme' ),
			'view_item' 			=> __( 'Ver integrante', 'onepage-theme' ),
			'search_items' 			=> __( 'Buscar integrante', 'onepage-theme' ),
			'not_found' 			=> __( 'No se encontraton integrantes', 'onepage-theme' ),
			'featured_image'        => __( 'Imagen destacada', 'onepage-theme' ),
        	'set_featured_image'    => __( 'Insetar imagen destacada', 'onepage-theme' ),
        	'remove_featured_image' => __( 'Eliminar imagen destacada', 'onepage-theme' ),
        	'use_featured_image'    => __( 'Usar como imagen destacada', 'onepage-theme' ),
			'parent_item_colon' 	=> __( 'Integrante principal:', 'onepage-theme' ),
			'menu_name' 			=> __( 'Equipo', 'onepage-theme' )
		);

		$args = array(
			'menu_position' 		=> 9,
			'public' 				=> true,
			'show_ui' 				=> true,
			'publicly_queryable' 	=> true,
			'query_var' 			=> true,
			'show_in_rest'          => true,
			'hierarchical' 			=> false,
			'capability_type' 		=> 'post',
			'labels' 				=> $labels,
			'menu_icon' 			=> 'dashicons-groups',
			'rewrite' 				=> array( 'slug' => 'services' ),
			'label'					=> __( 'Equipo', 'onepage-theme' ),
			'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail' )
		);

		register_post_type( 'lb_team', $args );

		$labels = array(
			'name'                       => _x('Cargo del equipo', 'lb_team', 'onepage-theme'),
			'singular_name'              => _x('Cargo del equipo', 'lb_team', 'onepage-theme'),
			'search_items'               => _x('Buscar cargo de equipo', 'lb_team', 'onepage-theme'),
			'popular_items'              => _x('Cargo de integrantes populares', 'lb_team', 'onepage-theme'),
			'all_items'                  => _x('Todos los cargos del equipo', 'lb_team', 'onepage-theme'),
			'parent_item'                => _x('Cargo del integrante principal', 'lb_team', 'onepage-theme'),
			'parent_item_colon'          => _x('Cargo del integrante principal:', 'lb_team', 'onepage-theme'),
			'edit_item'                  => _x('Editar cargo del integrante', 'lb_team', 'onepage-theme'),
			'update_item'                => _x('Actualizar cargo del integrante', 'lb_team', 'onepage-theme'),
			'add_new_item'               => _x('Agregar nuevo cargo al equipo', 'lb_team', 'onepage-theme'),
			'new_item_name'              => _x('Nuevo cargo del equipo', 'lb_team', 'onepage-theme'),
			'separate_items_with_commas' => _x('Cargos de los integrantes separados con comas', 'lb_team', 'onepage-theme'),
			'add_or_remove_items'        => _x('Agregar o eliminar cargo al integrante', 'lb_team', 'onepage-theme'),
			'choose_from_most_used'      => _x('Elige entre los cargos del equipo más utilizados', 'lb_team', 'onepage-theme'),
			'menu_name'                  => _x('Cargos', 'lb_team', 'onepage-theme'),
		);

		$args = array(
			'public'            => true,
			'show_in_menu'      => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'labels'            => $labels,
			'rewrite' 			=> array( 'slug' => 'category_team' )
		);

		register_taxonomy( 'lb_team_category', array( 'lb_team' ), $args );
	}
}