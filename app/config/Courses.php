<?php
/**
 * 
 * Register the custom post type for courses and the associated taxonomies.
 *
 * @link   https://lordblaster.com.ve/
 * @since  1.0.0
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link   https://gitlab.com/icleranaya
 * 
 * @package akproducciones_web_v2_dev
 */

class Courses
{
	/**
	 * init.
	 *
	 * @see Courses::init()
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
     * Register the custom post type for courses and the associated taxonomies
     */
	public function register_custom_types()
	{
		$labels = array(
			'name'               	=> _x( 'Cursos', 'lb_courses', 'onepage-theme' ),
			'singular_name'      	=> _x( 'Curso', 'lb_courses', 'onepage-theme' ),
			'all_items'				=> __( 'Todos los cursos', 'onepage-theme' ),
			'add_new'            	=> __( 'Añadir nuevo', 'onepage-theme' ),
			'add_new_item'       	=> __( 'Añadir nuevo curso', 'onepage-theme' ),
			'edit' 					=> __( 'Editar', 'onepage-theme' ), 
			'edit_item'          	=> __( 'Editar curso', 'onepage-theme' ),
			'new_item'           	=> __( 'Nuevo curso', 'onepage-theme' ),
			'view_item'          	=> __( 'Ver curso', 'onepage-theme' ),
			'search_items'       	=> __( 'Buscar curso', 'onepage-theme' ),
			'not_found'          	=> __( 'No se encontraron cursos', 'onepage-theme' ),
			'featured_image'        => __( 'Imagen destacada', 'onepage-theme' ),
        	'set_featured_image'    => __( 'Insertar imagen destacada', 'onepage-theme' ),
        	'remove_featured_image' => __( 'Eliminar imagen destacada', 'onepage-theme' ),
        	'use_featured_image'    => __( 'Usar como imagen destacada', 'onepage-theme' ),
			'not_found_in_trash' 	=> __( 'No se encontro cursos en la papelera', 'onepage-theme' ),
			'parent_item_colon'  	=> __( 'Curso principal:', 'onepage-theme' ),
			'menu_name'          	=> __( 'Cursos', 'onepage-theme' ),
		);

		$args = array(
			'menu_position' 		=> 6,
			'public' 				=> true,
			'show_ui' 				=> true,
			'publicly_queryable' 	=> true,
			'query_var'           	=> true,
			'show_in_rest'          => true,
			'hierarchical'        	=> false,
			'capability_type' 		=> 'post',
			'labels'              	=> $labels,
			'rewrite' 				=> array( 'slug' => 'cursos' ),
			'label'				  	=> __( 'Curso', 'onepage-theme' ),
			'menu_icon' 			=> 'dashicons-welcome-learn-more',
			'supports'            	=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'sticky')
		);

		register_post_type( 'lb_courses', $args );

		$labels = array(
			'name'                       => _x('Categorías del curso', 'lb_courses', 'onepage-theme'),
			'singular_name'              => _x('Categoría del curso', 'lb_courses', 'onepage-theme'),
			'search_items'               => _x('Buscar categoría de curso', 'lb_courses', 'onepage-theme'),
			'popular_items'              => _x('Categoría de cursos populares', 'lb_courses', 'onepage-theme'),
			'all_items'                  => _x('Todas las categoría de cursos', 'lb_courses', 'onepage-theme'),
			'parent_item'                => _x('Categoría de curso principal', 'lb_courses', 'onepage-theme'),
			'parent_item_colon'          => _x('Categoría de curso principal:', 'lb_courses', 'onepage-theme'),
			'edit_item'                  => _x('Editar categoría de curso', 'lb_courses', 'onepage-theme'),
			'update_item'                => _x('Actualizar categoría de curso', 'lb_courses', 'onepage-theme'),
			'add_new_item'               => _x('Agregar nueva categoría de curso', 'lb_courses', 'onepage-theme'),
			'new_item_name'              => _x('Nueva categoría de curso', 'lb_courses', 'onepage-theme'),
			'separate_items_with_commas' => _x('Categorías de cursos separadas con comas', 'lb_courses', 'onepage-theme'),
			'add_or_remove_items'        => _x('Agregar o eliminar categoría de curso', 'lb_courses', 'onepage-theme'),
			'choose_from_most_used'      => _x('Elige entre las categorías de cursos más utilizadas', 'lb_courses', 'onepage-theme'),
			'menu_name'                  => _x('Categorías', 'lb_courses', 'onepage-theme'),
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
			'rewrite' 			=> array( 'slug' => 'category_courses' )
		);

		register_taxonomy( 'lb_courses_category', array( 'lb_courses' ), $args );
	}
}