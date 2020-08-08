<?php
/**
 * The head of our theme.
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link https://prismaagencia.com/
 * @author URI: https://gitlab.com/prisma_web
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>

<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="shortcut icon" href="<?= of_get_option( 'favicon' ); ?>" type="image/png">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
		
		<?php wp_head(); ?>
	
	</head>

    <!-- 
	 **
	 * 
	 * @Theme Name:	Ak Producciones
	 * @Author: Icler Anaya <contacto@lordblaster.com.ve - @icleranaya>
     *          Juan Soto <juanvidalsototovar@gmail.com - @juanv18>
     *          Tomas Moreno <tmoreno.mgl@gmail.com - @tomasml>
	 * @Package: akproducciones_web_v2_dev
	 * @Since: 1.0.0
	 * @GitHub Template Theme URI: https://gitlab.com/prisma_web/akproducciones_web_v2_dev.git
	 * @GitHub Branch: master
	 * @License: GPL-3.0+
	 * @License URI: http://www.gnu.org/licenses/gpl-3.0.txt
	 * @Version: 2.0.0
	 * @Description: Este proyecto fue desarrollado sin la ayuda de plantillas bases, y con diseño exclusivo para este sitio web.
	 *
	 **
     -->
    <!-- Preloader Ak Producciones -->
    <body class="charge">
		<div class="main-charge">
			<img src="<?= get_template_directory_uri(); ?>/public/images/ak_logo_responsive.png" alt="logo ak producciones" class="load-img">
		</div>
