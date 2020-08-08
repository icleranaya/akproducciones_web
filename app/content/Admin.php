<?php
/**
 * The admin-specific functionality of the theme.
 *
 * Defines hooks for how to enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link   https://lordblaster.com.ve/
 * @since  1.0.0
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link   https://gitlab.com/icleranaya
 * 
 * @package akproducciones_web_v2_dev
 */

class Admin
{
    /**
     * The unique identifier of this theme.
     *
     * @since    1.0.0
     *
     * @var string The string used to uniquely identify this theme.
     */
	protected $theme_name; 

	/**
     * The current version of the theme.
     *
     * @since    1.0.0
     *
     * @var string The current version of the theme.
     */
    protected $theme_version;
    
    /**
     * Directory of theme options.
     * 
     * @since 1.0.0
     * 
     * @var string directory of theme options.
     */
    protected $options_directory;
    
    /**
     * Directory of the theme manager file.
     * 
     * @since 1.0.0
     * 
     * @var string directory of the theme manager file.
     */
    protected $admin_directory;
    
    /**
	 * init.
	 *
	 * @see Admin::init()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
    public function init()
    {
		/**
		 * Required for the configuration of courses and services of the template. 
		 * 
		 * @since 1.0.0
		 **/
		// require_once dirname( __FILE__, 2 ) . '/config/Kernel.php';

        $this->theme_name = 'Ak Producciones';
		$this->theme_version = '2.0.0';
		$this->admin_directory = get_template_directory_uri() . '/app/';
		$this->options_directory = $this->admin_directory;
		$this->defineConstants();
		
        /**
	     * Register the stylesheets for theme.
	     *
	     * @since 1.0.0
	     */
		add_action( 'wp_enqueue_scripts', array( $this, 'load_styles' ) );

        /**
	     * Register the JavaScript for theme.
	     *
	     * @since 1.0.0
	     */
		add_action( 'wp_enqueue_scripts', array( $this, 'load_script' ) );

        /**
	     * Add excerpt to page for theme.
	     *
	     * @since 1.0.0
	     */
        $this->prefix_add_excerpt_to_page();
        
        /**
	     * Register the Ajax for theme.
	     *
	     * @since 1.0.0
	     */
		add_action( 'wp_ajax_get_my_option', array( $this, 'template_get_my_option' ) );

        /**
		 * Support post thumbnails for theme.
		 *
		 * @since 1.0.0
		 */
		if ( !current_theme_supports( 'post-thumbnails' ) )
            add_theme_support( 'post-thumbnails', array( 'post', 'page', 'lb_courses', 'lb_services', 'lb_projects', 'lb_team' ) );

		/**
		 * Support for Shortcodes
		 *
		 * @since 1.0.0
		 */
		add_filter( 'widget_text', 'shortcode_unautop');
		add_filter( 'widget_text', 'do_shortcode');
		add_filter( 'comment_text', 'shortcode_unautop');
		add_filter( 'comment_text', 'do_shortcode' );
		add_filter( 'the_excerpt', 'shortcode_unautop');
		add_filter( 'the_excerpt', 'do_shortcode');
		add_filter( 'get_the_excerpt', 'shortcode_unautop');
		add_filter( 'get_the_excerpt', 'do_shortcode');
		add_filter( 'term_description', 'shortcode_unautop');
		add_filter( 'term_description', 'do_shortcode' );
        remove_filter( 'pre_term_description', 'wp_filter_kses' );

		/**
		 * Add short code for Inscription Process.
		 */
		add_shortcode( 'custom_inscription_process', array( $this, 'CustomInscriptionProcess' ) );

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /language/ directory.
		 * If you're building a theme based on OnePage, use a find and replace
		 * to change 'OnePage' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'onepage-theme', get_template_directory() . '/resources/lang' );

		/**
	     * Action of load content home page.
	     *
	     * @since 1.0.0
	     */
		add_action( 'wp_ajax_nopriv_lb_ajax_inscription',array( $this, 'lb_ajax_inscription' ) );
    }

    /**
	 * load_styles.
	 *
	 * @see Admin::load_styles()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
	public function load_styles()
	{
        if( !is_admin() ):
			wp_enqueue_style( 'style', get_template_directory_uri() . '/public/css/landing/app.css' , false, THEME_VERSION );
	    endif;
    }
    
    /**
	 * load_script.
	 *
	 * @see Admin::load_script()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
	public function load_script()
	{
	    if( !is_admin() ):
			wp_deregister_script( 'jquery' );
	        wp_register_script( 'jquery', get_template_directory_uri() . '/public/plugins/jquery/jquery.min.js', false, '3.2.1' );
			wp_enqueue_script( 'jquery' );

			/* Swiper.js */
			wp_enqueue_script( 'swiper', get_template_directory_uri() . '/public/plugins/swiper/swiper.min.js', array('jquery'), '4.4.1' );

			/* svg-injector-2.js */
			wp_enqueue_script( 'svg-injector-2', get_template_directory_uri() . '/public/plugins/svg-injector-2/svg-injector.min.js', array('jquery'), '2.1.3', true );
			
			/* wow.js */
			wp_enqueue_script( 'wow', get_template_directory_uri() . '/public/plugins/wow/wow.min.js', array('jquery'), '1.1.3', true );

			/* App.js */
			wp_register_script( 'app', get_template_directory_uri() . '/public/js/landing/app.js', array('jquery'), THEME_VERSION, true );
			wp_enqueue_script( 'app' );
			wp_localize_script( 'app', 'lb_l10n', array(
				'ajaxurl'	=> admin_url( 'admin-ajax.php' )
			));
			// wp_enqueue_script( 'app', get_template_directory_uri() . '/public/js/landing/app.js', array('jquery'), THEME_VERSION, true );

	    endif;
	}
    
    /**
	 * prefix_add_excerpt_to_page.
	 *
	 * @see Admin::prefix_add_excerpt_to_page()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
    public function prefix_add_excerpt_to_page()
    {
        add_post_type_support( 'page', 'excerpt' );
    }

    /**
	 * template_get_my_option.
	 *
	 * @see Admin::template_get_my_option()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
	function template_get_my_option()
	{
		require get_template_directory() . '/app/content/Ajax.php';
		die();
	}

    /**
	 * Setup theme constants.
	 *
	 * @see Admin::defineConstants()
	 * @since 1.0.0
	 *
	 * @access private
	 * @return void
	 */
    private function defineConstants()
    {
        // theme version
        // if (!defined('THEME_VERSION')) {
        //     define('THEME_VERSION', $this->version);
        // }
        $this->checkConstantDefined( 'THEME_VERSION', $this->theme_version );
        // theme name
        // if (!defined('THEME_NAME')) {
        //     define('THEME_NAME', $this->name);
        // }
        $this->checkConstantDefined( 'THEME_NAME', $this->theme_name ); 
        // theme direcotry admin
        // if (!defined('THEME_NAME')) {
        //     define('THEME_NAME', $this->name);
        // }
        $this->checkConstantDefined( 'ADMIN_DIRECTORY', $this->admin_directory );
        // theme directory options
        // if (!defined('THEME_NAME')) {
        //     define('THEME_NAME', $this->name);
        // }
        $this->checkConstantDefined( 'OPTIONS_FRAMEWORK_DIRECTORY', $this->options_directory );
    }
    
    /**
	 * Setup theme constants.
	 *
	 * @see Admin::checkConstantDefined()
	 * @since 1.0.0
	 *
	 * @param string 	$key. Define name of constant.
	 * @param string 	$value. Define value of constant.
	 * 
	 * @access private
	 * @return void
	 */
	private function checkConstantDefined( $key, $value )
    {
        // theme version
        // if (!defined('THEME_VERSION')) {
        //     define('THEME_VERSION', $this->version);
        // }
        if( !defined( $key ) )
            define( $key, $value );
	}

	/**
	 * CustomInscriptionProcess.
	 *
	 * @see Admin::CustomInscriptionProcess()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return string
	 */
	public function CustomInscriptionProcess()
	{
		ob_start();
		
		include( locate_template( 'resources/layouts/inscription_template.php' ) );

		return ob_get_clean();
	}

	/**
	 * AddPagesRequire.
	 *
	 * @see Admin::AddPagesRequire()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
	public function AddPagesRequire()
	{
		$add_pages = array(
			'proceso-de-inscripcion' => array(
                'name'         =>   'proceso-de-inscripcion',
                'title'        =>   __( 'Proceso de Inscripción', 'onepage-theme'),
                'content'      =>   '[custom_inscription_process]'
			),
		);

		foreach( $add_pages as $key => $page ):
			$key;
			$this->CreatePage( esc_sql( $page['name']), $page['title'], $page['content'] );
		endforeach;
	}

	/**
	 * CreatePage.
	 *
	 * @see Admin::CreatePage()
	 * @since 1.0.0
	 *
	 * @access private
	 * @return void
	 */
	private function CreatePage( $slug, $page_title = '', $page_content = '' )
	{
		$page_id = 0;
	    if( $this->ExistsPostBySlug( $slug ) ):
		    $page_data = array(
		        'post_status' => 'publish',
		        'post_type' => 'page',
		        'post_author' => 1,
		        'post_name' => $slug,
		        'post_title' => $page_title,
		        'post_content' => $page_content,
		        'comment_status' => 'closed',
		        'ping_status' => 'closed',
		    );
		    $page_id = wp_insert_post( $page_data );
		endif;
	    return $page_id;
	}

	/**
	 * ExistsPostBySlug.
	 *
	 * @see Admin::ExistsPostBySlug()
	 * @since 1.0.0
	 *
	 * @access private
	 * @return void
	 */
	private function ExistsPostBySlug( $post_slug )
	{
		$args_posts = array(
	        'post_type'      => 'page',
	        'post_status'    => 'any',
	        'name'           => $post_slug,
	        'posts_per_page' => 1,
	    );
	    $loop_posts = new WP_Query( $args_posts );
	    return ! $loop_posts->have_posts();
	}

	/**
	 * lb_ajax_inscription.
	 *
	 * @see LoadUtilsTheme::lb_ajax_inscription()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return void
	 */
	public function lb_ajax_inscription()
	{
		global $mail;
		
		$Ci = isset( $_POST['ci'] ) ? $_POST['ci'] : 0;
		$Curso = isset( $_POST['curso'] ) ? $_POST['curso'] : 0;
		$Email = isset( $_POST['email'] ) ? $_POST['email'] : 0;
		$Monto = isset( $_POST['monto'] ) ? $_POST['monto'] : 0;
		$Banco = isset( $_POST['banco'] ) ? $_POST['banco'] : 0;
		$FindName = !empty( $_POST['name'] ) ? $_POST['name'] : "";
		$Deposito = isset( $_POST['deposito'] ) ? $_POST['deposito'] : 0;
		
		$FindName = sanitize_text_field( $FindName );
		$Email = sanitize_email( $Email );
		$Banco = sanitize_text_field( $Banco );
		$Curso = sanitize_text_field( $Curso );
		$Deposito = sanitize_text_field( $Deposito );
		$Curso = sanitize_text_field( $Curso );
		$Curso = str_replace( "-", " ", $Curso );

		$Sended = $mail->SendEmail( of_get_option( 'mail_academy' ), $FindName, $Email, $Monto, $Banco, $Ci, $Curso, $Deposito );

		if( $Sended )
			wp_send_json_success( __( 'Su solicitud ha sido enviada con exito.', 'onepage-theme' ) );
		else
			wp_send_json_success( __( 'Ocurrio un problema al enviar su solicitud. Intentelo de nuevo más tarde.', 'onepage-theme' ));
		wp_die();
	}
}