<?php
/**
 * MenuLB Menu
 *
 * Class Name: MenuLB
 * Plugin Name: MenuLB Menu
 * Author: Icler Anaya <contacto@lordblaster.com.ve>
 * Version: 3.0.3
 * Author URI: https://github.com/icleranaya
 * License: GPL-3.0+
 *
 * Check if Class Exists.
 **/

/**
 * MenuLB class.
 *
 * @extends Walker_Nav_Menu
 */
class MenuLB extends Walker_Nav_Menu
{

	/**
	 * Start El.
	 *
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @access public
	 * @param mixed $output Passed by reference. Used to append additional content.
	 * @param mixed $item Menu item data object.
	 * @param int   $depth (default: 0) Depth of menu item. Used for padding.
	 * @param array $args (default: array()) Arguments.
	 * @param int   $id (default: 0) Menu item ID.
	 * @return void
	 */
	public function start_el( &$output, $item, $depth = 0 , $args = array(), $id = 0 )
	{
		$object			= $item->object;
    	$type			= $item->type;
    	$title			= $item->title;
    	$description	= $item->description;
    	$permalink		= $item->url;
		
		$output .= "<li class=\"menu-item\">";

		// Añadir SPAN si no hay Permalink
		if ( $permalink && $permalink != '#' ) {
			$output .= "<a href=\"{$permalink}\" class=\"menu-link\">";
		} else {
			$output .= "<span>";
		}

		$output .= $title;
		
		if ( $permalink && $permalink != '#' ) {
			$output .= "</a>";
		} else {
			$output .= "</span>";
		}

		// Añadir SPAN si no hay Permalink
		if ( $permalink && $permalink != '#' ) {
			$output .= "<a href=\"{$permalink}\" class=\"hover-link\">";
		} else {
			$output .= "<span>";
		}

		$output .= $title;
		
		if ( $permalink && $permalink != '#' ) {
			$output .= "</a>";
		} else {
			$output .= "</span>";
		}


	}

}