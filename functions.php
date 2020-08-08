<?php
/**
 * functions and definitions
 * 
 * Load the utilities of the subject.
 * 
 * 
 * @author Icler Anaya
 * @link https://lordblaster.com.ve/
 * @author URI: https://github.com/icleranaya
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 **/
if( !function_exists( 'admin_init' ) ):
    require_once dirname( __FILE__ ) . '/app/Kernel.php';
endif;

/**
 * Load Options Framework for theme.
 * 
 * 
 * @author Icler Anaya
 * @link https://lordblaster.com.ve/
 * @author URI: https://github.com/icleranaya
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
if( !function_exists( 'optionsframework_init' ) ):
    require_once dirname( __FILE__ ) . '/app/ThemeOptions.php';
endif;