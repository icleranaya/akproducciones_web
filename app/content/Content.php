<?php
/**
 * The content-theme functionality of the theme.
 *
 * Defines functions for how to enqueue the content-theme show posts.
 *
 * @link https://lordblaster.com.ve/
 * @since 1.0.0
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * 
 * @package akproducciones_web_v2_dev
 */


class ContentPost
{
	/**
	 * content.
	 *
	 * @see ContentPost::content()
	 * @since 1.0.0
	 *
	 * @access public
	 * @param int 	$cat ID of category.
	 * @param int   $num (default: 4) Depth of page. Used for padding.
	 * @param int 	$short_excerpt (default: 50) Arguments.
	 * @return associative array
	 */
	public function content( $cat, $exclude = false, $link = true, $num = 4, $short_excerpt = 50 )
	{
	    $content = array();
		$content_query = new WP_Query( 'cat='.$cat.'&showposts='.$num );

	    // Check if the category has a post
	    if( $content_query->have_posts() ) :
	    	// Implementation of the wordpress loop to load the content of each post
	        while( $content_query->have_posts() ) :
	            $content_query->the_post();
	            // it is verified that the post has a prominent image,
	            // otherwise the image is loaded by default
				$temp_content = array();
	            if( has_post_thumbnail() ):
					$thumb_url_array_content = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
	                $temp_content['image'] = $thumb_url_array_content[0];
					$temp_content['alt'] = esc_attr( get_the_title() );
	            else:
	            	$temp_content['image'] = get_template_directory_uri().'/public/images/backgrounds/no-thumb.jpg';
	            	$temp_content['alt'] = 'no-thumb';
	            endif;
				$temp_content['title'] = get_the_title();
				$temp_content['id'] = get_the_ID();
				$temp_content['link'] = get_permalink();
				$temp_content['excerpt'] = apply_filters( 'the_excerpt', get_the_excerpt() );
				$temp_content['excerpt_no_format'] = get_the_excerpt();
				$temp_content['excerpt_short'] = $this->excerpt( $short_excerpt );
				$temp_content['category_post'] = $this->category( $cat, $exclude, $link );
				$temp_content['category_post_no_link'] = $this->category_no_link( $cat );
				$temp_content['category_array_slug'] = $this->category_array_slug( $cat );
				$temp_content['time'] = get_the_time( 'D, d M Y' );
				$temp_content['content'] = apply_filters( 'the_content', get_the_content() );
				$temp_content['content_no_format'] = get_the_content();
				$content[] = $temp_content;
				
	        endwhile;
	    endif;
	    wp_reset_postdata();
	    return $content;
	}

	/**
	 * content_page.
	 *
	 * @see ContentPost::content_page()
	 * @since 1.0.0
	 *
	 * @access public
	 * @param int 	$page ID of page.
	 * @return associative array
	 */
	public function content_page( $page )
	{
	    $content_page = array();
	    $content_page_query = new WP_Query( 'page_id='.$page );
	    // it verifies that the page contains content
	    if( $content_page_query->have_posts() ) :
	    	// implementation of the wordpress loop to load the content of the page
	        while( $content_page_query->have_posts() ) :
	            $content_page_query->the_post();
	            // it verifies that the page contains a prominent image,
	            // otherwise the image is loaded by default
	            $temp_content_page = array();
	            if( has_post_thumbnail() ):
	                $thumb_url_array_content_page = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
	                $temp_content_page['image'] = $thumb_url_array_content_page[0];
	                $temp_content_page['alt'] = esc_attr( get_the_title() );
	            else:
	            	$temp_content_page['image'] = get_template_directory_uri().'/public/images/backgrounds/no-thumb.jpg';
	                $temp_content_page['alt'] = 'no-thumb';
	            endif;
	            $temp_content_page['title'] = get_the_title();
	            $temp_content_page['link'] = get_permalink();
	            $temp_content_page['excerpt'] = apply_filters( 'the_excerpt', get_the_excerpt() );
	            $temp_content_page['content'] = apply_filters( 'the_content', get_the_content() );
	            $content_page[] = $temp_content_page;
	        endwhile;
	    endif;
	    wp_reset_postdata();
	    return $content_page;
	}
	/**
	 * category.
	 *
	 * @see ContentPost::category()
	 * @since 1.0.0
	 *
	 * @access private
	 * @return string
	 */
	private function category( $c, $exc, $l )
	{
	    $category_post = get_the_category();
	    $print_category = "";
	    for( $cat = 0; $cat < count( $category_post ); $cat++ ):
	    	$print_category .= !$exc ? "<a href='".esc_url( get_category_link( $category_post[$cat]->term_id ) )."'>":
	    			 ( $l && !$exc ) ? "<a href='".esc_url( get_category_link( $category_post[$cat]->term_id ) )."'>":
	    			 "";		    	
	    	$print_category .= !$exc ? $category_post[$cat]->name :
	    	( $category_post[$cat]->term_id != $c ) ? $category_post[$cat]->name : "";
	    	$print_category .= !$exc ? "</a>":
	    			 ( $l && !$exc ) ? "</a>":
	    			 "";
	    	$print_category .= ( $cat == 0 && count( $category_post ) > 1 ) && !$exc ? ", " : "";
	    	$print_category .= !$exc && ($cat+1) == count( $category_post ) ? ".":
	    					( count( $category_post ) > 1 &&  ($cat+1) == count( $category_post ) ) ? "." : "";
	    endfor;
	    //$print_category .= ".";
	    return $print_category;
	}

	/**
	 * category_no_link.
	 *
	 * @see ContentPost::category_no_link()
	 * @since 1.0.0
	 *
	 * @access private
	 * @return string
	 */
	private function category_no_link( $c )
	{
		$exc = '';
	    $category_post = get_the_category();
	    $print_category = "";
	    for( $cat = 0; $cat < count( $category_post ); $cat++ ):	    	
	    	$print_category .= !$exc ? $category_post[$cat]->slug :
	    	( $category_post[$cat]->term_id != $c ) ? $category_post[$cat]->slug : "";
	    	$print_category .= ( $cat == 0 && count( $category_post ) > 1 ) && !$exc ? " " : " ";
	    endfor;
	    return $print_category;
	}

	/**
	 * category_array.
	 *
	 * @see ContentPost::category_no_link()
	 * @since 1.0.0
	 *
	 * @access private
	 * @return string
	 */
	private function category_array_slug( $c )
	{
	    $category_post = get_the_category();
		$category_arg = array();
		for( $cat = 0; $cat < count( $category_post ); $cat++ ):
			if( $category_post[$cat]->term_id != $c )		    	
				$category_arg[$cat] = $category_post[$cat]->slug;	
		endfor;
		sort( $category_arg );
	    return $category_arg;
	}

	/**
	 * excerpt.
	 *
	 * @see ContentPost::excerpt()
	 * @since 1.0.0
	 *
	 * @access public
	 * @param int 	$num Number of characters that the excerpt will contain.
	 * @return string
	 */
	public function excerpt( $num )
	{
		$limit = $num+1;
		$excerpt = explode(' ', get_the_content(), $limit );
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt);
	    return $excerpt;
	}
	
	/**
	 * custom_breadcrumbs
	 *
	 * @param  mixed $section_ID
	 *
	 * @return void
	 */
	public function custom_breadcrumbs( $section_ID, $custom_taxonomy = " " )
	{
		
		// Settings
		$separator          = '/';
		$breadcrums_id      = 'corner-link';
		$breadcrums_class   = 'corner-link white-text wow fadeIn';
		
		// Get the query & post information
		global $post,$wp_query;
		
		// Do not display on the homepage
		if ( !is_front_page() ) {
		
			// Build the breadcrums
			echo "<div id=\"{$breadcrums_id}\" class=\"{$breadcrums_class}\" data-wow-duration=\"0.5s\"> ";
			
			echo "<svg class=\"svg-xs\" data-src=\"" . get_template_directory_uri() . "/public/images/icons/arrow_left.svg\"></svg>&nbsp;<span>&nbsp;</span> ";
			
			if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
				
				
			} else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
				
				// If post is a custom post type
				$post_type = get_post_type();
				
				// If it is a custom post type display name and link
				if($post_type != 'post') {
					
					echo "<a class=\"back-link sm-txt-bold\" href=\"" . get_permalink( $section_ID ) . "\">" . get_the_title( $section_ID ) . "</a>";
					echo "<span class=\"sm-txt-bold\">{$separator}</span> ";
				
				}
				echo "<span class=\"sm-txt-bold my-10 spacing\">" . get_queried_object()->name . "</span>";
				
			} else if ( is_single() ) {
				
				// If post is a custom post type
				$post_type = get_post_type();
				
				// If it is a custom post type display name and link
				if($post_type != 'post') {
					
				
					echo "<a class=\"back-link sm-txt-bold\" href=\"" . get_permalink( $section_ID ) . "\">" . get_the_title( $section_ID ) . "</a>";
					echo "<span class=\"sm-txt-bold\">{$separator}</span> ";
				
				}
				
				// Get post category info
				$category = get_the_category();
				
				if(!empty($category)) {
				
					// Get last category post is in
					$last_category = end(array_values($category));
					
					// Get parent any categories and create array
					$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
					$cat_parents = explode(',',$get_cat_parents);
					
					// Loop through parent categories and store in variable $cat_display
					$cat_display = '';
					foreach($cat_parents as $parents) {
						$cat_display .= "<span>{$parents}</span>";
						$cat_display .= "<span class=\"sm-txt-bold\">{$separator}</span> ";
					}
				
				}
				
				// If it's a custom post type within a custom taxonomy
				if( $custom_taxonomy != " " ):
					$taxonomy_exists = taxonomy_exists($custom_taxonomy);
					if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
						
						$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
						if ($taxonomy_terms) {
							$cat_id         = $taxonomy_terms[0]->term_id;
							$cat_nicename   = $taxonomy_terms[0]->slug;
							$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
							$cat_name       = $taxonomy_terms[0]->name;
						}
					}
				endif;
				
				// Check if the post is in a category
				if(!empty($last_category)) {
					echo $cat_display;
					echo "<span class=\"sm-txt-bold my-10 spacing\">" . get_the_title() . "</span>";
					
				// Else if post is in a custom taxonomy
				} else if(!empty($cat_id)) {
					
					echo "<a class=\"back-link sm-txt-bold\" href=\"{$cat_link}\">{$taxonomy_terms[0]->name}</a>";
					echo "<span class=\"sm-txt-bold\">{$separator}</span>";
					echo "<span class=\"sm-txt-bold my-10 spacing\">" . get_the_title() . "</span>";
				
				} else {
					
					echo "<span class=\"sm-txt-bold my-10 spacing\">" . get_the_title() . "</span>";
					
				}
				
			} else if ( is_category() ) {
				
				// Category page
				echo single_cat_title('', false);
				
			} else if ( is_page() ) {
				
				// Standard page
				if( $post->post_parent ){
					
					// If child page, get parents 
					$anc = get_post_ancestors( $post->ID );
					
					// Get parents in the right order
					$anc = array_reverse($anc);
					
					// Parent page loop
					if ( !isset( $parents ) ) $parents = null;
					foreach ( $anc as $ancestor ) {
						$parents .= "<a class=\"back-link sm-txt-bold\" href=\"" . get_permalink($ancestor) . "\">" . get_the_title($ancestor) . "</a>";
						$parents .= "<span>{$separator}</span> ";
					}
					
					// Display parent pages
					echo $parents;
					
					// Current page
					echo get_the_title();
					
				} else {
					
					// Just display current page if not parents
					echo get_the_title();
					
				}
				
			} else if ( is_tag() ) {
				
				// Tag page
				
				// Get tag information
				$term_id        = get_query_var('tag_id');
				$taxonomy       = 'post_tag';
				$args           = 'include=' . $term_id;
				$terms          = get_terms( $taxonomy, $args );
				$get_term_name  = $terms[0]->name;
				
				// Display the tag name
				echo $terms[0]->name;
						
			} else if ( get_query_var('paged') ) {
				
				// Paginated archives
				echo __( 'Página ', 'onepage-theme') .  get_query_var( 'paged' );
				
			} else if ( is_search() ) {
			
				// Search results page
				echo __( "Search results for: ", "onepage-theme" ) . get_search_query();
			
			} elseif ( is_404() ) {
				
				// 404 page
				echo __( "Error 404", "onepage-theme" );
			}
		
			echo "</div>";
			
		}
		
	}

	/**
	 * CourseLinksTabsTable
	 *
	 * @param  mixed $content
	 *
	 * @return void
	 */
	public function CourseLinksTabsTable( $content )
	{
		ob_start();
		?>
		<ul class="tab-links">
			<?php if( isset( $content["lb_courses_course_information_content_editor"] ) ):?>
                <!-- content_editor -->
                <li class="tab-link">
                    <a href="#tab1" class="sm-txt-bold">
                        <?= __( 'Contenido ', 'onepage-theme' ); ?>
                        <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                    </a>
                </li>
            <?php endif; ?>
            <?php if( isset( $content["lb_courses_course_information_duration_editor"] ) ):?>
                <!-- duration_editor -->
                <li class="tab-link">
                    <a href="#tab2" class="sm-txt-bold">
                        <?= __( 'Duración / Horario ', 'onepage-theme' ); ?>
                        <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                    </a>
                </li>
            <?php endif; ?>
            <?php if( isset( $content["lb_courses_course_information_invertion_editor"] ) ):?>
                <!-- invertion_editor -->
                <li class="tab-link">
                    <a href="#tab3" class="sm-txt-bold">
                        <?= __( 'Inversión ', 'onepage-theme' ); ?>
                        <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                    </a>
                </li>
            <?php endif; ?>
            <?php if( isset( $content["lb_courses_course_information_instructor_editor"] ) ):?>
                <!-- instructor_editor -->
                <li class="tab-link">
                    <a href="#tab4" class="sm-txt-bold">
                        <?= __( 'Instructor ', 'onepage-theme' ); ?>
                        <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                    </a>
                </li>
            <?php endif; ?>
            <?php if( isset( $content["lb_courses_course_information_location_editor"] ) ):?>
                <!-- location_editor -->
                <li class="tab-link">
                    <a href="#tab5" class="sm-txt-bold">
                        <?= __( 'Ubicación ', 'onepage-theme' ); ?>
                        <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                    </a>
                </li>
            <?php endif; ?>
		</ul>
		<?php

		return ob_get_clean();	
	}

	/**
	 * CourseContentTabsTable
	 *
	 * @param  mixed $content
	 *
	 * @return void
	 */
	public function CourseContentTabsTable( $content )
	{
		ob_start();
		?>
			<div class="tab-content course-content">
                <?php if( isset( $content["lb_courses_course_information_content_editor"] ) ):?>
                    <!-- content_editor -->
                    <div id="tab1" class="ak-table ak-course-tab">
                        <h2 class="sm-txt-bold"><?= __( 'En este curso se incluyen las siguientes áreas:', 'onepage-theme' ); ?></h2>
                        <ul class="course-list">
                            <?= apply_filters( 'the_content', $content["lb_courses_course_information_content_editor"][0]); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if( isset( $content["lb_courses_course_information_duration_editor"] ) ):?>
                    <!-- duration_editor -->
                    <div id="tab2" class="ak-table ak-course-tab">
                        <h2 class="sm-txt-bold"><?= __( 'En este curso se incluyen las siguientes áreas:', 'onepage-theme' ); ?></h2>
                        <ul class="course-list">
                            <?= apply_filters( 'the_content', $content["lb_courses_course_information_duration_editor"][0]); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if( isset( $content["lb_courses_course_information_invertion_editor"] ) ):?>
                    <!-- invertion_editor -->
                    <div id="tab3" class="ak-table ak-course-tab">
                        <h2 class="sm-txt-bold"><?= __( 'En este curso se incluyen las siguientes áreas:', 'onepage-theme' ); ?></h2>
                        <ul class="course-list">
                            <?= apply_filters( 'the_content', $content["lb_courses_course_information_invertion_editor"][0]); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if( isset( $content["lb_courses_course_information_instructor_editor"] ) ):?>
                    <!-- instructor_editor -->
                    <div id="tab4" class="ak-table ak-course-tab">
                        <h2 class="sm-txt-bold"><?= __( 'En este curso se incluyen las siguientes áreas:', 'onepage-theme' ); ?></h2>
                        <ul class="course-list">
                            <?= apply_filters( 'the_content', $content["lb_courses_course_information_instructor_editor"][0]); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if( isset( $content["lb_courses_course_information_location_editor"] ) ):?>
                    <!-- location_editor -->
                    <div id="tab5" class="ak-table ak-course-tab">
                        <h2 class="sm-txt-bold"><?= __( 'En este curso se incluyen las siguientes áreas:', 'onepage-theme' ); ?></h2>
                        <ul class="course-list">
                            <?= apply_filters( 'the_content', $content["lb_courses_course_information_location_editor"][0]); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
		<?php

		return ob_get_clean();
	}

	/**
	 * CourseAccordion
	 *
	 * @param  mixed $content
	 *
	 * @return void
	 */
	public function CourseAccordion( $content )
	{
		ob_start();
		?>
			<!-- Accordion -->
			<div class="accordion">
				<?php if( isset( $content["lb_courses_course_information_content_editor"] ) ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-1">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Contenido ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item txt-center">
						<?= apply_filters( 'the_content', $content["lb_courses_course_information_content_editor"][0]); ?>
					</div>
				<?php endif; ?>

				<?php if( isset( $content["lb_courses_course_information_duration_editor"] ) ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-1">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Duración / Horario ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item txt-center">
						<?= apply_filters( 'the_content', $content["lb_courses_course_information_duration_editor"][0]); ?>
					</div>
				<?php endif; ?>

				<?php if( isset( $content["lb_courses_course_information_invertion_editor"] ) ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-1">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Inversión ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item txt-center">
						<?= apply_filters( 'the_content', $content["lb_courses_course_information_invertion_editor"][0]); ?>
					</div>
				<?php endif; ?>

				<?php if( isset( $content["lb_courses_course_information_instructor_editor"] ) ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-1">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Instructor ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item txt-center">
						<?= apply_filters( 'the_content', $content["lb_courses_course_information_instructor_editor"][0]); ?>
					</div>
				<?php endif; ?>

				<?php if( isset( $content["lb_courses_course_information_location_editor"] ) ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-1">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Ubicación ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item txt-center">
						<?= apply_filters( 'the_content', $content["lb_courses_course_information_location_editor"][0]); ?>
					</div>
				<?php endif; ?>
                
            </div>
            <!-- /End Accordion -->
		<?php

		return ob_get_clean();
	}

	/**
	 * ServiceLinksTabsTable
	 *
	 * @param  mixed $content
	 *
	 * @return void
	 */
	public function ServiceLinksTabsTable( $content = array() )
	{
		extract( $content);

		ob_start();
		?>
			<ul class="tab-links">
                <?php if( isset( $interfaz ) && !empty( $interfaz ) && $interfaz != " " ):?>
                    <li class="tab-link">
                        <a href="#tab1" class="sm-txt-bold">
                            <?= __( 'Interfaz ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( isset( $preamp ) && !empty( $preamp ) && $preamp != " " ):?>
                    <li class="tab-link">
                        <a href="#tab2" class="sm-txt-bold">
                            <?= __( 'Preamp ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( isset( $consola ) && !empty( $consola ) && $consola != " " ):?>
                    <li class="tab-link">
                        <a href="#tab3" class="sm-txt-bold">
                            <?= __( 'Consola ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( isset( $cornetas ) && !empty( $cornetas ) && $cornetas != " " ):?>
                    <li class="tab-link">
                        <a href="#tab4" class="sm-txt-bold">
                            <?= __( 'Cornetas ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( isset( $monitores ) && !empty( $monitores ) && $monitores != " " ):?>
                    <li class="tab-link">
                        <a href="#tab5" class="sm-txt-bold">
                            <?= __( 'Monitores ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( isset( $amplificadores ) && !empty( $amplificadores ) && $amplificadores != " " ):?>
                    <li class="tab-link">
                        <a href="#tab6" class="sm-txt-bold">
                            <?= __( 'Amplificadores ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( isset( $software ) && !empty( $software ) && $software != " " ):?>
                    <li class="tab-link">
                        <a href="#tab7" class="sm-txt-bold">
                            <?= __( 'Software ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( isset( $instrumentos ) && !empty( $instrumentos ) && $instrumentos != " " ):?>
                    <li class="tab-link">
                        <a href="#tab8" class="sm-txt-bold">
                            <?= __( 'Instrumentos ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
				<?php endif; ?>
				<?php if( isset( $visuales ) && !empty( $visuales ) && $visuales != " " ):?>
                    <li class="tab-link">
                        <a href="#tab9" class="sm-txt-bold">
                            <?= __( 'Visuales ', 'onepage-theme' ); ?>
                            <svg class="svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
		<?php
		
		return ob_get_clean();
	}

	/**
	 * ServiceContentTabTable
	 *
	 * @param  mixed $content
	 *
	 * @return void
	 */
	public function ServiceContentTabTable( $content = array() )
	{
		extract( $content);

		ob_start();
		?>
		<div class="tab-content">
            <?php if( isset( $interfaz ) && !empty( $interfaz ) && $interfaz != " " ):?>
                <div id="tab1" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $interfaz as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['marca'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                        <td class="sm-txt-med"><?= $item['cantidad'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            <?php endif; ?>
            <?php if( isset( $preamp ) && !empty( $preamp ) && $preamp != " " ):?>
                <div id="tab2" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $preamp as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['marca'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                        <td class="sm-txt-med"><?= $item['cantidad'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            <?php endif; ?>
            <?php if( isset( $consola ) && !empty( $consola ) && $consola != " " ):?>
                <div id="tab3" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $consola as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['marca'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                        <td class="sm-txt-med"><?= $item['cantidad'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            <?php endif; ?>
            <?php if( isset( $cornetas ) && !empty( $cornetas ) && $cornetas != " " ):?>
                <div id="tab4" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $cornetas as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['marca'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                        <td class="sm-txt-med"><?= $item['cantidad'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            <?php endif; ?>
            <?php if( isset( $monitores ) && !empty( $monitores ) && $monitores != " " ):?>
                <div id="tab5" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $monitores as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['marca'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                        <td class="sm-txt-med"><?= $item['cantidad'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            <?php endif; ?>
            <?php if( isset( $amplificadores ) && !empty( $amplificadores ) && $amplificadores != " " ):?>
                <div id="tab6" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $amplificadores as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['marca'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                        <td class="sm-txt-med"><?= $item['cantidad'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            <?php endif; ?>
            <?php if( isset( $software ) && !empty( $software ) && $software != " " ):?>
                <div id="tab7" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $software as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['marca'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            <?php endif; ?>
            <?php if( isset( $instrumentos ) && !empty( $instrumentos ) && $instrumentos != " " ):?>
                <div id="tab8" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Equipo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Marca', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Modelo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $instrumentos as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['equipo'] ?></td>
                                        <td class="sm-txt-med"><?= $item['marca'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                        <td class="sm-txt-med"><?= $item['cantidad'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
			<?php endif; ?>
			<?php if( isset( $visuales ) && !empty( $visuales ) && $visuales != " " ):?>
                <div id="tab9" class="ak-table">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th class="sm-txt-bold"><?= __( 'Equipo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Tipo', 'onepage-theme' ); ?></th>
                                    <th class="sm-txt-bold"><?= __( 'Cantidad', 'onepage-theme' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php foreach( $visuales as $key => $item ): ?>
                                    <tr>
                                        <td class="sm-txt-med"><?= $item['equipo'] ?></td>
                                        <td class="sm-txt-med"><?= $item['modelo'];?></td>
                                        <td class="sm-txt-med"><?= $item['cantidad'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            <?php endif; ?>
        </div>
		<?php
		
		return ob_get_clean();
	}

	/**
	 * ServiceAccordion
	 *
	 * @param  mixed $content
	 *
	 * @return void
	 */
	public function ServiceAccordion( $content )
	{
		extract( $content);

		ob_start();
		?>
			<div class="accordion">
				<?php if( isset( $interfaz ) && !empty( $interfaz ) && $interfaz != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Interfaz ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $interfaz as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['marca']}, {$item['modelo']}, {$item['cantidad']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if( isset( $preamp ) && !empty( $preamp ) && $preamp != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Preamp ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $preamp as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['marca']}, {$item['modelo']}, {$item['cantidad']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if( isset( $consola ) && !empty( $consola ) && $consola != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Consola ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $consola as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['marca']}, {$item['modelo']}, {$item['cantidad']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if( isset( $cornetas ) && !empty( $cornetas ) && $cornetas != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Cornetas ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $cornetas as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['marca']}, {$item['modelo']}, {$item['cantidad']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if( isset( $monitores ) && !empty( $monitores ) && $monitores != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Monitores ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $monitores as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['marca']}, {$item['modelo']}, {$item['cantidad']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if( isset( $amplificadores ) && !empty( $amplificadores ) && $amplificadores != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Amplificadores ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $amplificadores as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['marca']}, {$item['modelo']}, {$item['cantidad']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if( isset( $software ) && !empty( $software ) && $software != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Software ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $software as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['marca']}, {$item['modelo']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if( isset( $instrumentos ) && !empty( $instrumentos ) && $instrumentos != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Instrumentos ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $instrumentos as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['equipo']}, {$item['marca']}, {$item['modelo']}, {$item['cantidad']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if( isset( $visuales ) && !empty( $visuales ) && $visuales != " " ):?>
					<div class="accordion-header">
						<a href="javascript:;" class="accordion-link-header accordion-bg-2">
							<span class="accordion-title txt-capitalize txt-center"><?= __( 'Visuales ', 'onepage-theme' ); ?></span>
							<svg class="accordion-header-icon" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
						</a>
					</div>
					<div class="content-item sub-accordion-wrapper txt-left">
						<ul class="sub-accordion-content">
							<?php foreach( $visuales as $key => $item ): ?>
								<li class="sub-accordion-item">
									<?= "{$item['equipo']}, {$item['tipo']}, {$item['cantidad']}.";?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
            </div>
		<?php
		
		return ob_get_clean();	
	}
}