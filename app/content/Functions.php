<?php
function optionsframework_options() {

	$overlay = array(
		'overlay0' => __( 'No Overlay', 'onepage-theme' ),
		'overlay1' => __( 'Small Dotted', 'onepage-theme' ),
		'overlay2'  => __( 'Large Dotted', 'onepage-theme' ),
		'overlay3'  => __( 'Light Black', 'onepage-theme' ),
		'overlay4'  => __( 'Black Dotted', 'onepage-theme' )
	);

	$section_template = array(
		'default_template' 		=> __( 'Sección por defecto', 'onepage-theme' ),
		'news_template' 		=> __( 'Sección de Novedades', 'onepage-theme' ),
		'about_template' 		=> __( 'Sección Sobre Nosotros', 'onepage-theme' ),
		'services_template' 	=> __( 'Sección de Servicios', 'onepage-theme' ),
		'academy_template' 		=> __( 'Sección de Academia', 'onepage-theme' ),
		'production_template' 	=> __( 'Sección de Producción', 'onepage-theme' ),
		'contact_template' 		=> __( 'Sección de Contacto', 'onepage-theme' )
	);

	$check = array(
		'yes' => __( 'Yes', 'onepage-theme' ),
		'no' => __( 'No', 'onepage-theme' )
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll',
		'size' => 'cover',
	);

	// Parallax Defaults
	$parallax_defaults = NULL;

	// Test data
	$test_array = array(
		'one' => __( 'One', 'onepage-theme' ),
		'two' => __( 'Two', 'onepage-theme' ),
		'three' => __( 'Three', 'onepage-theme' ),
		'four' => __( 'Four', 'onepage-theme' ),
		'five' => __( 'Five', 'onepage-theme' )
	);

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'quicktags' => true,
		'textarea_rows' => 10
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'onepage-theme' ),
		'two' => __( 'Pancake', 'onepage-theme' ),
		'three' => __( 'Omelette', 'onepage-theme' ),
		'four' => __( 'Crepe', 'onepage-theme' ),
		'five' => __( 'Waffle', 'onepage-theme' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55'
	);

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Seleccione una pagina...';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	/* ====================================================================================================
    ======================================================================================================*/

	/* About theme */
	$about_content = sprintf(
		__('<p class = "ap-intro-text text-justify">%1$ s Es un hermoso tema de WordPress. El diseño se ha elaborado para atraer a sus visitantes, es interactivo, atractivo, divertido, sorprendente, efectivo para activar La acción, invita a sus visitantes a un excelente Llamado a la Acción, excelentes tasas de conversión y muchos más. %2$s Viene con características como: panel de opciones de tema avanzado, totalmente sensible, control deslizante destacado, configuración de publicación avanzada, biografía / Servicios / Academia / Diseño de página / Google Maps / Integración de favoritos personalizada / animación CSS / SEO amigable y mucho más.', 'options_framework_theme</p>', 'onepage-theme' ), THEME_NAME, THEME_NAME
	);

	$about_content .= "<p>".__( 'Para más soporte visítenos en: ', 'onepage-theme' )." <a target='_blank' href='".esc_url('https://prismaagencia.com/')."'>www.prismaagencia.com</a>"."</p>";

	$about_content .= "<hr/><br />";

    $about_content .= __( 'Otros temas de Wordpress:', 'onepage-theme' )." <a target='_blank' href='".esc_url('https://prismaagencia.com/')."'>Temas de Wordpress Prisma Agencia</a><br /><br />";

    $about_content .= __( 'Documentación:', 'onepage-theme' )." <a target='_blank' href='".esc_url('https://prismaagencia.com/')."'>www.prismaagencia.com</a><br /><br />";

    $about_content .= "<hr/><br />";
    $about_content .= "<h4>".__( 'Mantente en contacto', 'onepage-theme' )."</h4>";
    $about_content .= __( 'Soporte de chat en vivo:', 'onepage-theme' )." <a target='_blank' href='".esc_url('https://prismaagencia.com/')."'>www.prismaagencia.com</a><br /><br /><br />";
    $about_content .= "<hr/><br />";
    $about_content .= "<h4>".__( 'Para consultas relacionadas con temas personalizados:', 'onepage-theme' )."</h4>";
    $about_content .= "<a href='mailto:prismaagenciacreativa@gmail.com'>prismaagenciacreativa@gmail.com</a><br /><br />"; 

    /* ====================================================================================================
    ======================================================================================================*/

	/* Pestaña Configuración general */
	$options[] = array(
    	'name' => __( 'General', 'onepage-theme' ),
        'type' => 'heading'
    );

	/* Favicon de la pagina */
	$options[] = array(
		'name' => __( 'Favicon', 'onepage-theme' ),
		'id' => 'favicon',
		'class' => 'sub-option',
		'type' => 'upload'
	);

	/* Agregar logo de la pagina */
	$options[] = array(
		'name' => __( 'Logo', 'onepage-theme' ),
		'id' => 'logo',
		'class' => 'sub-option',
		'type' => 'upload'
	);

	/* Agregar logo de la pagina */
	$options[] = array(
		'name' => __( 'Logo 2', 'onepage-theme' ),
		'id' => 'logo_2',
		'class' => 'sub-option',
		'type' => 'upload'
	);

	/* ====================================================================================================
    ======================================================================================================*/

	/* OnePage */
	$options[] = array(
    	'name' => __( 'Secciones', 'onepage-theme' ),
        'type' => 'heading'
    );

    $options[] = array(
		'desc' => __( '<strong>Nota: Cree una nueva página antes de crear una sección. Cada sección debe tener una página única.</strong>', 'onepage-theme' ),
		'id' => 'onepage_info',
		'type' => 'info'
	);

	$options[] = array(
		'id' => 'parallax_section',
		'std' => $parallax_defaults,
		'options' => $options_pages,
		'overlay' => $overlay,
		'category' => $options_categories,
		'layout' => $section_template,
		'type' => 'onepage'
	);

	$options[] = array(
		'id' => 'parallax_count',
		'type' => 'hidden',
		'std' => '50'
	);

	$options[] = array(
		'id' => 'add_new_section',
		'type' => 'button'
	);

	// /* ====================================================================================================
    // ======================================================================================================*/

	// $options[] = array(
	// 	'name' => __( 'Post Settings', 'onepage-theme' ),
	// 	'type' => 'heading'
	// );

	// $options[] = array(
	// 	'name' => __( 'Show Posted Date', 'onepage-theme' ),
	// 	'desc' => __( 'Check To enable', 'onepage-theme' ),
	// 	'id' => 'post_date',
	// 	'std' => '1',
	// 	'type' => 'checkbox'
	// );

	// $options[] = array(
	// 	'name' => __( 'Show Post Author', 'onepage-theme' ),
	// 	'desc' => __( 'Check To enable', 'onepage-theme' ),
	// 	'id' => 'post_author',
	// 	'std' => '1',
	// 	'type' => 'checkbox'
	// );

	// $options[] = array(
	// 	'name' => __( 'Show Post Footer text', 'onepage-theme' ),
	// 	'desc' => __( 'Check To enable', 'onepage-theme' ),
	// 	'id' => 'post_footer',
	// 	'std' => '1',
	// 	'type' => 'checkbox'
	// );

	/* ====================================================================================================
    ======================================================================================================*/

	/* Social Links */
	$options[] = array(
    	'name' => __( 'Redes sociales', 'onepage-theme' ),
        'type' => 'heading'
    );

	$redes = array('Instagram', 'Facebook');
	$redes_slug = array('instagram', 'facebook');
	$link = array(
		'https://www.instagram.com/',
		'https://www.facebook.com/'
	);

	for( $j = 0; $j < 2; $j++ ):
		if( $j == 0 ):
			$options[] = array(
				'desc' => __( '<h6>' . $redes[$j] . '</h6>', 'onepage-theme' ),
				'id' => $redes[$j].'_info',
				'type' => 'info'
			);	
		else:
			$options[] = array(
				'desc' => __( '<br><h6>' . $redes[$j] . '</h6>', 'onepage-theme' ),
				'id' => $redes[$j].'_info',
				'type' => 'info'
			);
		endif;

		$options[] = array(
			'id' => $redes_slug[$j].'_link',
			'std' => $link[$j],
			'type' => 'text'
		);
	endfor;

	/* ====================================================================================================
    ======================================================================================================*/
	$options[] = array(
    	'name' => __( 'Nosotros', 'onepage-theme' ),
     	'type' => 'heading'
	);

	$options[] = array(
		'name' => __( 'Título de la página de Nosotros.', 'onepage-theme' ),
		'id' => 'title_about',
		'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __( 'Sub-título de la página de Nosotros.', 'onepage-theme' ),
		'id' => 'subtitle_about',
		'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
		'type' => 'text'
	);

	// $options[] = array(
	// 	'name' => __( 'Descripción de la página de Nosotros.', 'onepage-theme' ),
	// 	'desc' => sprintf( __( 'También puede pasar la configuración al editor. Lea más sobre wp_editor en <a href="%1$s" target="_blank">the WordPress codex</a>', 'onepage-theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
	// 	'id' => 'description_about',
	// 	'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	// 	'type' => 'editor',
	// 	'settings' => $wp_editor_settings
	// );
	
	$options[] = array(
		'name' => __( 'Archivo del plano para la página de Nosotros.', 'onepage-theme' ),
		'id' => 'plane_about_dowload',
		'class' => 'sub-option',
		'type' => 'upload'
	);
	
	$options[] = array(
		'name' => __( 'Imagen del plano para la página de Nosotros.', 'onepage-theme' ),
		'id' => 'plane_about',
		'class' => 'sub-option',
		'type' => 'upload'
	);
	
	// $options[] = array(
	// 	'name' =>  __( 'Fondo de la página Nosotros.', 'theme-textdomain' ),
	// 	'id' => 'bg_about',
	// 	'class' => 'sub-option',
	// 	'std' => $background_defaults,
	// 	'type' => 'background'
	// );

	/* ====================================================================================================
    ======================================================================================================*/
	$options[] = array(
    	'name' => __( 'Contacto', 'onepage-theme' ),
     	'type' => 'heading'
	);
	
	$options[] = array(
		'name' => __( 'Imagen de la página de Contacto.', 'onepage-theme' ),
		'id' => 'bg_contact',
		'class' => 'sub-option',
		'type' => 'upload'
	);
	
	/* Google Map */
	$options[] = array(
		'name' => __( 'Mapa de la sección de contacto.', 'onepage-theme' ),
		'id' => 'map_contact',
		'std' => 'https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15706.79567430688!2d-68.0179535!3d10.2050873!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sve!4v1515287643931',
		'type' => 'text'
	);

	/* Dirección de contacto */
	$options[] = array(
		'name' => __( 'Dirección de la sección de contacto.', 'onepage-theme' ),
		// 'desc' => sprintf( __( 'También puede pasar la configuración al editor. Lea más sobre wp_editor en <a href="%1$s" target="_blank">the WordPress codex</a>', 'onepage-theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'address_contact',
		'std' => '145 Gates Avenue, NY 10018, United States',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	/* Telefono de contacto */
	$options[] = array(
		'name' => __( 'Teléfono de la sección de contacto.', 'onepage-theme' ),
		// 'desc' => sprintf( __( 'También puede pasar la configuración al editor. Lea más sobre wp_editor en <a href="%1$s" target="_blank">the WordPress codex</a>', 'onepage-theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'phone_contact',
		'std' => '0345 / 5587 57',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	/* WHATSAPP de contacto */
	$options[] = array(
		'name' => __( 'Whatsapp.', 'onepage-theme' ),
		// 'desc' => sprintf( __( 'También puede pasar la configuración al editor. Lea más sobre wp_editor en <a href="%1$s" target="_blank">the WordPress codex</a>', 'onepage-theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'whatsapp_contact',
		'std' => '0345 / 5587 57',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	/* Correo de contacto */
	$options[] = array(
		'name' => __( 'Correo de contacto.', 'onepage-theme' ),
		'id' => 'mail_contact',
		'std' => 'contacto@akproduccionesca.com',
		'type' => 'text'
	);

	/* ====================================================================================================
    ======================================================================================================*/
	$options[] = array(
    	'name' => __( 'Transferencia', 'onepage-theme' ),
     	'type' => 'heading'
	);

	/* Titular de la transferencia */
	$options[] = array(
		'name' => __( 'Nombre del titulas.', 'onepage-theme' ),
		'id' => 'titular_transferencia',
		'std' => 'Jefferey',
		'type' => 'text'
	);
	
	/* Documento de Identidad del titular */
	$options[] = array(
		'name' => __( 'Documento de identidad del titular.', 'onepage-theme' ),
		'id' => 'document_transferencia',
		'std' => '00.000.000',
		'type' => 'text'
	);

	/* Correo del titular */
	$options[] = array(
		'name' => __( 'Correo del titular.', 'onepage-theme' ),
		'id' => 'mail_transferencia',
		'std' => 'info@akproduccionesca.com',
		'type' => 'text'
	);

	/* Correo de contacto */
	$options[] = array(
		'name' => __( 'Correo de Academia.', 'onepage-theme' ),
		'id' => 'mail_academy',
		'std' => 'contacto@akproduccionesca.com',
		'type' => 'text'
	);

	/* Datos de cuentas bancarias */
	$options[] = array(
		'name' => __( 'Cuentas bancarias.', 'onepage-theme' ),
		// 'desc' => sprintf( __( 'También puede pasar la configuración al editor. Lea más sobre wp_editor en <a href="%1$s" target="_blank">the WordPress codex</a>', 'onepage-theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'cuentas_transferencia',
		'std' => 'Et nihil iusto sit perspiciatis sint. Autem accusamus odio earum blanditiis ipsa dolor molestias praesentium sapiente. Sit explicabo quia.',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	/* ====================================================================================================
    ======================================================================================================*/
	/* About theme */
	$options[] = array(
    	'name' => __( 'Acerca de', 'onepage-theme' ),
        'type' => 'heading'
    );

    $options[] = array(
		// 'name' => sprintf( __( 'About %1$s', 'onepage-theme' ), THEME_NAME ),
		'desc' => $about_content,
		'type' => 'info');

	return $options;
}