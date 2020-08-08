<?php
/**
 * Page template.
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

<?php while( have_posts() ): ?>

	<?php the_post(); ?>

	<?php the_content(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
