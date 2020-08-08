<?php	
	
	// Parallax Defaults
	$parallax_defaults = NULL;

	// Pull all the pages into an array
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');

	$options_categories_obj = get_categories();

	$countsettings = esc_attr( $_REQUEST['count_section'] );
?>	

<div class="sub-option clearfix" data-id="<?= $countsettings; ?>">
	<h3 class="title"><?php _e( 'Título de la página:', 'onepage-theme' ) ?> <span></span>
		<div class="section-toggle"><i class="fas fa-chevron-down"></i></div>
	</h3>
	<div class="sub-option-inner">

		<div class="wrap-btn-delete">
			<div class="standard-btn">
				<a href="javascritp:;" class="remove-parallax btn-content"><?php _e( 'Eliminar', 'onepage-theme' ) ?></a>
			</div>
		</div>

		<div class="inline-label pt-3">
			<label><?php _e( 'Página', 'onepage-theme' ) ?></label>
			<select class="parallax_section_page of-input" name="onepage_theme[parallax_section][<?= $countsettings; ?>][page]">
				<option value=""><?php _e( 'Selecciona una página:', 'onepage-theme') ?></option>
				<?php foreach ($options_pages_obj as $page) { ?>
					<option value="<?= absint($page->ID); ?>"><?= esc_html($page->post_title); ?></option>
				<?php } ?>
			</select>
		</div>

		<div class="inline-label">
			<label><?php _e( 'Diseño', 'onepage-theme' ) ?></label>
			<select class="of-input of-section of-section-layout" name="onepage_theme[parallax_section][<?= $countsettings; ?>][layout]">
				<option value="default_template"><?php _e( 'Sección por defecto', 'onepage-theme' ) ?></option>
				<option value="news_template"><?php _e( 'Sección de Novedades', 'onepage-theme' ) ?></option>
				<option value="about_template"><?php _e( 'Sección Sobre Nosotros', 'onepage-theme' ) ?></option>
				<option value="services_template"><?php _e( 'Sección de Servicios', 'onepage-theme' ) ?></option>
				<option value="academy_template"><?php _e( 'Sección de Academia', 'onepage-theme' ) ?></option>
				<option value="production_template"><?php _e( 'Sección de Producción', 'onepage-theme' ) ?></option>
				<option value="contact_template"><?php _e( 'Sección de contacto', 'onepage-theme' ) ?></option>
			</select>
		</div>

		<div class="inline-label toggle-category" style="display:none">
			<label class=""><?php _e( 'Categoría', 'onepage-theme' ) ?></label>
			<select name="onepage_theme[parallax_section][<?= $countsettings; ?>][category]" class="of-input">
				<option value=""><?php _e( 'Select a Category:', 'onepage-theme' ) ?></option>
			<?php foreach ($options_categories_obj as $category) { ?>
				<option value="<?= absint( $category->cat_ID ); ?>"><?= esc_html( $category->cat_name ); ?></option>
			<?php } ?>
			</select>
		</div>

	</div>
</div>

