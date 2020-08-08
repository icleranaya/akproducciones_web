<?php
/**
 * Template to show all individual posts.
 *
 * @author Icler Anaya
 * @link https://lordblaster.com.ve/
 * @author URI: https://github.com/icleranaya
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>

<?php get_header(); ?>


<?php if( is_singular( 'lb_courses' ) ): ?>

	<?php get_template_part( 'content', 'course' ); ?>

<?php elseif( is_singular( 'lb_services' ) ): ?>

	<?php get_template_part( 'content', 'service' ); ?>
	
<?php elseif( is_singular( 'lb_projects' ) ): ?>

	<?php get_template_part( 'content', 'project' ); ?>

<?php endif; ?>

<?php get_footer(); ?>
	
