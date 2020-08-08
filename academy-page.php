<?php
/**
 * Template Academy Page.
 * 
 * Template Name: Academy page.
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link https://prismaagencia.com/
 * @author URI: https://gitlab.com/prisma_web
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>

<?php get_header(); ?>

<?php $sections = of_get_option( 'parallax_section' ); ?>

<?php if( !empty( $sections ) ): ?>
    
    <?php foreach( $sections as $section ): ?>
         
        <?php extract( $section ); ?>
         
        <?php
 
            switch( $layout ){
 
                case 'academy_template':
                    $academy_name = "academia";
                    include( locate_template( "resources/layouts/academy_template.php" ) );
                    break;
 
                default:
                    break;
            }
        ?>           
 
    <?php endforeach; ?>

<?php else: ?>

    <?php get_template_part('demo'); ?>

<?php endif; ?>

<?php get_footer(); ?>