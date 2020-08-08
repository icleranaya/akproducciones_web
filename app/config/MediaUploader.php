<?php
/**
 * @package   Options_Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2010-2014 WP Theming
 */

class Options_Framework_Media_Uploader {

	/**
	 * Initialize the media uploader class
	 *
	 * @since 1.7.0
	 */
	// public function init() {
	// 	add_action( 'admin_enqueue_scripts', array( $this, 'optionsframework_media_scripts' ) );
	// }

	/**
	 * Media Uploader Using the WordPress Media Library.
	 *
	 * Parameters:
	 *
	 * string $_id - A token to identify this field (the name).
	 * string $_value - The value of the field, if present.
	 * string $_desc - An optional description of the field.
	 *
	 */

	static function optionsframework_uploader( $_id, $_value, $_desc = '', $_name = '' ) {

		// Gets the unique option id
		$options_framework = new Options_Framework;
	    $option_name = $options_framework->get_option_name();

		$output = '';
		$id = '';
		$class = '';
		$int = '';
		$value = '';
		$name = '';

		$id = strip_tags( strtolower( $_id ) );

		// If a value is passed and we don't have a stored value, use the value that's passed through.
		if ( $_value != '' && $value == '' ) {
			$value = $_value;
		}

		if ($_name != '') {
			$name = $_name;
		}
		else {
			$name = $option_name.'['.$id.']';
		}

		if ( $value ) {
			$class = ' has-file';
		}
		
		if ( function_exists( 'wp_enqueue_media' ) ) {
			$output .= '<div class="input-group">';
			$output .= '<label for="' . $id . '" class="input-container">';
			$output .= '<input type="text" name="'.$name.'" class="upload' . $class . '" id="' . $id . '" value="' . $value . '" placeholder="&nbsp;">' . "\n";
			$output .= '<span class="label sm-txt-bold">' . __( 'Carga de Archivo', 'onepage-theme' ) .'</span>';
			$output .= '<span class="border"></span>';
			$output .= '</label>';
			// $output .= '<input id="' . $id . '" class="upload form-control ' . $class . '" type="text" name="'.$name.'" value="' . $value . '" placeholder="' . __( 'Ningún archivo seleccionado', 'onepage-theme' ) .'" />' . "\n";
			if ( ( $value == '' ) ) {
				$output .= '<div class="standard-btn">';
				$output .= '<a href="javascript:;" id="upload-' . $id . '" class="upload-button btn-content">' . __( 'Cargar', 'onepage-theme' ) . '</a>' . "\n";
				$output .= '</div>';
			} else {
				$output .= '<div class="standard-btn">';
				$output .= '<a href="javascript:;" id="remove-' . $id . '" class="remove-file btn-content">' . __( 'Eliminar', 'onepage-theme' ) . '</a>' . "\n";
				$output .= '</div>';
			}
			$output .= '</div>';
		} else {
			$output .= '<p><i>' . __( 'Upgrade your version of WordPress for full media support.', 'onepage-theme' ) . '</i></p>';
		}

		if ( $_desc != '' ) {
			$output .= '<span class="of-metabox-desc">' . $_desc . '</span>' . "\n";
		}

		$output .= '<div class="screenshot" id="' . $id . '-image">' . "\n";

		if ( $value != '' ) {
			$remove = '<a class="remove-image">Eliminar</a>';
			$image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
			if ( $image ) {
				$output .= '<img src="' . $value . '" alt="" />' . $remove;
			} else {
				$parts = explode( "/", $value );
				for( $i = 0; $i < sizeof( $parts ); ++$i ) {
					$title = $parts[$i];
				}

				// No output preview if it's not an image.
				$output .= '';

				// Standard generic output if it's not an image.
				$title = __( 'Ver archivo', 'onepage-theme' );
				$output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">'.$title.'</a></span></div>';
			}
		}
		$output .= '</div>' . "\n";
		return $output;
	}
	
	/**
	 * Enqueue scripts for file uploader
	 */
	// function optionsframework_media_scripts( $hook ) {

	// 	$menu = Options_Framework_Admin::menu_settings();

    //     if ( substr( $hook, -strlen( $menu['menu_slug'] ) ) !== $menu['menu_slug'] )
	//         return;

	// 	if ( function_exists( 'wp_enqueue_media' ) )
	// 		wp_enqueue_media();

	// 	wp_register_script( 'of-media-uploader', get_template_directory_uri() . '/public/js/admin/app.js', array( 'jquery' ), Options_Framework::VERSION );
	// 	wp_enqueue_script( 'of-media-uploader' );
	// 	wp_localize_script( 'of-media-uploader', 'optionsframework_l10n', array(
	// 		'upload' => __( 'Cargar', 'onepage-theme' ),
	// 		'remove' => __( 'Eliminar', 'onepage-theme' )
	// 	) );
	// }
}