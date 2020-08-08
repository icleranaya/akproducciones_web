<?php

// Don't load if admin_init is already defined
if( ( !is_admin() || is_admin() ) && !function_exists( 'admin_init' ) ) :

    function admin_init()
    {
        global $header, $contentPost, $mail;
        
    	// Loads the required Admin classes.
    	
        /**
         * Load Header Theme.
         */
        require_once dirname( __FILE__ ) . '/content/Header.php';
        
        /**
         * Load Content Theme.
         */
        require_once dirname( __FILE__ ) . '/content/Content.php';
        
        /**
         * Menu Config.
         */
        // require_once dirname( __FILE__ ) . '/content/MenuLB.php';
        
        /**
         * Load Admin Config.
         */
        require_once dirname( __FILE__ ) . '/content/Admin.php';
        
        /**
         * Register the custom post type for courses and the associated taxonomies
         */
        require_once dirname( __FILE__ ) . '/config/Courses.php';

        /**
         * Adding an image upload to a custom taxonomy.
         */
        require_once dirname( __FILE__ ) . '/config/CategoryThumbnail.php';

        /**
         * Register the custom post type for services and the associated taxonomies
         */
        require_once dirname( __FILE__ ) . '/config/Services.php';

        /**
         * Register the custom post type for Projects
         */
        require_once dirname( __FILE__ ) . '/config/Projects.php';

        /**
         * Register the custom post type for Team
         */
        require_once dirname( __FILE__ ) . '/config/Team.php';

        /**
		 * Load Projects Info Metabox.
		 */
        require_once dirname( __FILE__ ) . '/config/MetaProjects.php';

        /**
		 * Load Courses Info Metabox.
		 */
        require_once dirname( __FILE__ ) . '/config/CoursesMeta.php';

        /**
		 * Load Services Info Metabox.
		 */
        require_once dirname( __FILE__ ) . '/config/MetaServices.php';

        /**
		 * Load Template Email.
		 */
        require_once dirname( __FILE__ ) . '/content/tools/mail/EmailsTemplate.php';
        
        // Instantiate the mail template config.
        $mail = new Email;
        $mail->init();
    	
    	// Instantiate the header theme config.
    	$header = new Header;
		$header->init();
        
        // Instantiate the admin config.
    	$LoadUtilities = new Admin;
        $LoadUtilities->init();

        // Instanciación for loading content of the whole theme.
        $contentPost = new ContentPost;

        // Instantiate the courses config.
        $Courses = new Courses;
        $Courses->init();
        
        // Instantiate the CategoryThumbail config.
        $CategoryThumbnail = new CategoryThumbail;
        $CategoryThumbnail->init();

        // Instantiate the Services config.
        $Services = new Services;
        $Services->init();

        // Instantiate the Projects config.
        $Projects = new Projects;
        $Projects->init();

        // Instantiate the Team config.
        $Team = new Team;
        $Team->init();
        
        // Instantiate the MetaProjects config.
        $MetaboxProject = new MetaProjects;
        $MetaboxProject->init( array(
                'label' => __( 'Información de proyecto', 'onepage-theme' ),
                'id' => 'project_information',
                'post_type' => 'lb_projects',
                'priority' => 'low',
                'context' => 'normal',
            )
        );

        // Instantiate the CoursesMeta config.
        $CoursesMeta = new CoursesMeta;
        $CoursesMeta->init( array(
                'label' => __( 'Información de curso', 'onepage-theme' ),
                'id' => 'course_information',
                'post_type' => 'lb_courses',
                'priority' => 'low',
                'context' => 'normal',
            )
        );

        // Instantiate the MetaServices config.
        $MetaServices = new MetaServices;
        $MetaServices->init( array(
                'label' => __( 'Información de curso', 'onepage-theme' ),
                'id' => 'service_information',
                'post_type' => 'lb_services',
                'priority' => 'low',
                'context' => 'normal',
            )
        );

        /**
	     * Add pages require for theme.
	     *
	     * @since 1.0.0
	     */
		add_action( 'wp_loaded', array( $LoadUtilities, 'AddPagesRequire' ) );
    }
    
    add_action( 'init', 'admin_init');

endif;