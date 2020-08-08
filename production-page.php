<?php
/**
 * Template Production Page.
 * 
 * Template Name: Production page.
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
 
                case 'production_template':
                    $production_name = "producciones";
                    include( locate_template( "resources/layouts/production_template.php" ) );
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