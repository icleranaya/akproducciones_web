<?php
/**
 * The load header functionality of the theme.
 *
 * Defines hooks for how to enqueue the load header stylesheet and JavaScript.
 *
 * @link https://lordblaster.com.ve/
 * @since 1.0.0
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link   https://gitlab.com/icleranaya
 * 
 * @package akproducciones_web_v2_dev
 */

class Header
{
    /**
	 * init.
	 *
	 * @see Header::init()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
    public function init()
    {
        /**
	     * Add Styles and Scripts to header of page the theme.
	     *
	     * @since 1.0.0
	     */
		// add_action( 'wp_head', array( $this, 'header_styles_scripts' ) );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
    }

    /**
	 * header_styles_scripts.
	 *
	 * @see HeaderTheme::header_styles_scripts()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
	public function header_styles_scripts()
	{
		$dynamic_style = "";
		$user = new WP_User( get_current_user_id() );
		echo "<style type='text/css'>"; 

		if($user->roles):

			if($user->roles[0] != "administrator"):
				$dynamic_style .= "#wpadminbar{display: none!important;}";
			else:
				$dynamic_style .= "#dashboard{padding-top: 2%;}";
				$dynamic_style .= "body.admin-panel header.main-header{margin-top: 30px;}";
				$dynamic_style .= "@media screen and (max-width: 390px) { #dashboard{padding-top: 15%;}body.admin-panel header.main-header{margin-top: 46px;}}";
			endif;

		endif;

		echo $dynamic_style;
		echo "</style>\n";
	}
    
    /**
	 * MenuCollapsed.
	 *
	 * @see Header::MenuCollapsed()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
    public function MenuCollapsed()
    {
		?>
		
		<?php $redes_slug = array( 'instagram', 'facebook' ); ?>

        <header>
			<!--minified svg logo of the page-->
			<a href="<?= esc_url( home_url( '/' ) ); ?>" class="mini-logo">
				<img src="<?= of_get_option( 'logo_2' );?>" alt="ak producciones logo">
			</a>

			<!-- Menu Hamburger Icon -->
			<div class="hamburger hamburger-menu hamburger--squeeze">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
			<!-- /End Menu Hamburger Icon -->

			<div class="side-menu">
				<!-- Logo -->
				<a class="logo-container" href="<?= esc_url( home_url( '/' ) ); ?>">
					<img src="<?= of_get_option( 'logo' );?>" alt="ak producciones logo" class="sidemenu-logo">
				</a>

				<!-- Menu -->
				<nav>
					<ul id="menu_nav_ul" class="navigation-menu">
						<?php $sections = of_get_option( 'parallax_section' ); ?>

						<?php if( !empty( $sections ) ): ?>
							
							<?php foreach( $sections as $section ): ?>
								
								<?php extract( $section ); ?>
								
								<?php
									switch ($layout):

										case 'news_template':
											$this->MenuItem( $layout, $page );
										break;
										
										case 'services_template':
											$this->MenuItem( $layout, $page );
										break;

										case 'about_template':
											$this->MenuItem( $layout, $page );
										break;
										
										case 'academy_template':
											$this->MenuItem( $layout, $page );
										break;
										
										case 'production_template':
											$this->MenuItem( $layout, $page );
										break;
										
										case 'contact_template':
											$this->MenuItem( $layout, $page );
										break;
										
										default:
										break;
										
									endswitch;
								?>           
						
							<?php endforeach; ?>

						<?php endif; ?>
					</ul>
				</nav>

				<!-- Social Links -->
				<div class="social-media-container">
					<ul class="social-media">

						<?php for( $j = 0; $j < 2; $j++ ):?>
							<?php if( of_get_option( $redes_slug[$j].'_link' ) && $redes_slug[$j] == 'facebook' ): ?>
								<li class="soc-media-item">
									<a href="<?= of_get_option( $redes_slug[$j].'_link' ); ?>" class="media-link" target="_blank">
										<svg class="menu-media" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/facebook.svg"></svg>
									</a>
								</li>
							<?php endif; ?>
							<?php if( of_get_option( $redes_slug[$j].'_link' ) && $redes_slug[$j] == 'instagram' ): ?>
								<li class="soc-media-item">
									<a href="<?= of_get_option( $redes_slug[$j].'_link' ); ?>" class="media-link" target="_blank">
										<svg class="menu-media" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/instagram.svg"></svg>
									</a>
								</li>
							<?php endif; ?>
						<?php endfor; ?>

					</ul>
				</div>
				<!-- /End Social Links -->

				<!-- Mobile Menu -->
				<div class="mobile-nav">
					<div class="responsive-nav-container">
						<ul>
							<?php $sections = of_get_option( 'parallax_section' ); ?>

							<?php if( !empty( $sections ) ): ?>
								
								<?php foreach( $sections as $section ): ?>
									
									<?php extract( $section ); ?>
									
									<?php
										switch ($layout):

											case 'news_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											case 'services_template':
												$this->MenuMobileItem( $layout, $page );
											break;

											case 'about_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											case 'academy_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											case 'production_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											case 'contact_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											default:
											break;
											
										endswitch;
									?>           

								<?php endforeach; ?>

							<?php endif; ?>
						</ul>
					</div>

					<div class="mobile-social-media-container">
						<ul class="mobile-social-media">
							
							<?php for( $j = 0; $j < 2; $j++ ):?>
								<?php if( of_get_option( $redes_slug[$j].'_link' ) && $redes_slug[$j] == 'facebook' ): ?>
									<li>
										<a href="<?= of_get_option( $redes_slug[$j].'_link' ); ?>" class="media-link" target="_blank">
											<svg class="menu-media" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/facebook.svg"></svg>
										</a>
									</li>
								<?php endif; ?>
								<?php if( of_get_option( $redes_slug[$j].'_link' ) && $redes_slug[$j] == 'instagram' ): ?>
									<li>
										<a href="<?= of_get_option( $redes_slug[$j].'_link' ); ?>" class="media-link" target="_blank">
											<svg class="menu-media" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/instagram.svg"></svg>
										</a>
									</li>
								<?php endif; ?>
							<?php endfor; ?>

						</ul>
					</div>
				</div>
				<!-- /End Mobile Menu -->
			</div>
		</header>
        <?php
	}
	
	/**
	 * MenuExpanded.
	 *
	 * @see Header::MenuExpanded()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
    public function MenuExpanded()
    {
		?>
		
		<?php $redes_slug = array( 'instagram', 'facebook' ); ?>

        <header class="header-collapsed">
			<!--minified svg logo of the page-->
			<a href="<?= esc_url( home_url( '/' ) ); ?>" class="mini-logo">
				<img src="<?= of_get_option( 'logo_2' );?>" alt="ak producciones logo">
			</a>

			<!-- Menu Hamburger Icon -->
			<div class="hamburger hamburger-menu hamburger--squeeze">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
			<!-- /End Menu Hamburger Icon -->

			<div class="side-menu">
				<!-- Logo -->
				<a class="logo-container" href="<?= esc_url( home_url( '/' ) ); ?>">
					<img src="<?= of_get_option( 'logo' );?>" alt="ak producciones logo" class="sidemenu-logo">
				</a>

				<!-- Menu -->
				<nav>
					<ul id="menu_nav_ul" class="navigation-menu">
						<?php $sections = of_get_option( 'parallax_section' ); ?>

						<?php if( !empty( $sections ) ): ?>
							
							<?php foreach( $sections as $section ): ?>
								
								<?php extract( $section ); ?>
								
								<?php
									switch ($layout):

										case 'news_template':
											$this->MenuItem( $layout, $page );
										break;
										
										case 'services_template':
											$this->MenuItem( $layout, $page );
										break;

										case 'about_template':
											$this->MenuItem( $layout, $page );
										break;
										
										case 'academy_template':
											$this->MenuItem( $layout, $page );
										break;
										
										case 'production_template':
											$this->MenuItem( $layout, $page );
										break;
										
										case 'contact_template':
											$this->MenuItem( $layout, $page );
										break;
										
										default:
										break;
										
									endswitch;
								?>           
						
							<?php endforeach; ?>

						<?php endif; ?>
					</ul>
				</nav>

				<!-- Social Links -->
				<div class="social-media-container">
					<ul class="social-media">

						<?php for( $j = 0; $j < 2; $j++ ):?>
							<?php if( of_get_option( $redes_slug[$j].'_link' ) && $redes_slug[$j] == 'facebook' ): ?>
								<li class="soc-media-item">
									<a href="<?= of_get_option( $redes_slug[$j].'_link' ); ?>" class="media-link" target="_blank">
										<svg class="menu-media" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/facebook.svg"></svg>
									</a>
								</li>
							<?php endif; ?>
							<?php if( of_get_option( $redes_slug[$j].'_link' ) && $redes_slug[$j] == 'instagram' ): ?>
								<li class="soc-media-item">
									<a href="<?= of_get_option( $redes_slug[$j].'_link' ); ?>" class="media-link" target="_blank">
										<svg class="menu-media" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/instagram.svg"></svg>
									</a>
								</li>
							<?php endif; ?>
						<?php endfor; ?>

					</ul>
				</div>
				<!-- /End Social Links -->
				
				<!-- Mobile Menu -->
				<div class="mobile-nav">
					<div class="responsive-nav-container">
						<ul class="menu-navigation-responsive">
							<?php $sections = of_get_option( 'parallax_section' ); ?>

							<?php if( !empty( $sections ) ): ?>
								
								<?php foreach( $sections as $section ): ?>
									
									<?php extract( $section ); ?>
									
									<?php
										switch ($layout):

											case 'news_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											case 'services_template':
												$this->MenuMobileItem( $layout, $page );
											break;

											case 'about_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											case 'academy_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											case 'production_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											case 'contact_template':
												$this->MenuMobileItem( $layout, $page );
											break;
											
											default:
											break;
											
										endswitch;
									?>           

								<?php endforeach; ?>

							<?php endif; ?>
						</ul>
					</div>

					<div class="mobile-social-media-container">
						<ul class="mobile-social-media">
							
							<?php for( $j = 0; $j < 2; $j++ ):?>
								<?php if( of_get_option( $redes_slug[$j].'_link' ) && $redes_slug[$j] == 'facebook' ): ?>
									<li>
										<a href="<?= of_get_option( $redes_slug[$j].'_link' ); ?>" class="media-link" target="_blank">
											<svg class="menu-media" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/facebook.svg"></svg>
										</a>
									</li>
								<?php endif; ?>
								<?php if( of_get_option( $redes_slug[$j].'_link' ) && $redes_slug[$j] == 'instagram' ): ?>
									<li>
										<a href="<?= of_get_option( $redes_slug[$j].'_link' ); ?>" class="media-link" target="_blank">
											<svg class="menu-media" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/instagram.svg"></svg>
										</a>
									</li>
								<?php endif; ?>
							<?php endfor; ?>

						</ul>
					</div>
				</div>
				<!-- /End Mobile Menu -->
			</div>
		</header>
        <?php
	}
	
	/**
	 * MenuItem
	 *
	 * @param  mixed $template
	 * @param  mixed $page_ID
	 *
	 * @return void
	 */
	private function MenuItem( $template, $page_ID )
	{
		?>
		<?php if( $template != "news_template" ):?>
			<li class="menu-item">
				<a href="<?= get_permalink( $page_ID ); ?>" class="menu-link"><?= get_the_title( $page_ID ); ?></a>
				<a href="<?= get_permalink( $page_ID ); ?>" class="hover-link"><?= get_the_title( $page_ID ); ?></a>
			</li>
		<?php else:?>
			<li class="menu-item">
				<a href="<?= esc_url( home_url( '/' ) ); ?>" class="menu-link"><?= get_the_title( $page_ID ); ?></a>
				<a href="<?= esc_url( home_url( '/' ) ); ?>" class="hover-link"><?= get_the_title( $page_ID ); ?></a>
			</li>
		<?php endif;?>
		<?php		
	}

	/**
	 * MenuMobileItem
	 *
	 * @param  mixed $template
	 * @param  mixed $page_ID
	 *
	 * @return void
	 */
	private function MenuMobileItem( $template, $page_ID )
	{

		?>
		<?php if( $template != "news_template" ):?>
			<li class="menu-item">
				<a href="<?= get_permalink( $page_ID ); ?>" class="menu-link"><?= get_the_title( $page_ID ); ?></a>
			</li>
		<?php else:?>
			<li class="menu-item">
				<a href="<?= esc_url( home_url( '/' ) ); ?>" class="menu-link"><?= get_the_title( $page_ID ); ?></a>
			</li>
		<?php endif;?>
		<?php		
	}
}