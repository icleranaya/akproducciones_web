<?php
/**
 * The template part for displaying results in single pages.
 * 
 * @author Icler Anaya
 * @link https://lordblaster.com.ve/
 * @author URI: https://github.com/icleranaya
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>

<?php global $contentPost, $header; ?>

<?php $header->MenuCollapsed(); ?>

<main class="proyect-ind-main hoverable-main layout">
    <?php $content_project = new WP_Query( "post_type=lb_projects&p=" . get_the_ID() );?>

    <?php $exclude = get_the_ID();?>

    <?php if ( $content_project->have_posts() ): ?>
        
        <?php while( $content_project->have_posts() ): ?>
            
            <?php $content_project->the_post(); ?>

            <?php $sections = of_get_option( 'parallax_section' ); ?>

            <?php if( !empty( $sections ) ): ?>
    
                <?php foreach( $sections as $section ): ?>
                    
                    <?php extract( $section ); ?>
                    
                    <?php
            
                        switch( $layout ){
            
                            case 'production_template':
                                $page_ID = $page;
                                break;
            
                            default:
                                break;
                        }
                    ?>           
            
                <?php endforeach; ?>

            <?php endif; ?>

            <?php $custom_fields = get_post_custom( get_the_ID() ); ?>

            <?php
                $band_gallery = false;
                $i = 1;

                while (!$band_gallery && $i <= 4) {
                    $band_gallery = ( isset( $custom_fields["lb_projects_project_information_gallery_{$i}"] ) ) ? false : true;
                    if ( !$band_gallery) {
                        $gallery[] = $custom_fields["lb_projects_project_information_gallery_{$i}"][0];
                    }
                    $i++;
                }
            ?>

            <!-- ------ stroke ------- -->
            <div class="stroke-right">
                <?php the_title( "<h2 class=\"stroke-txt\">", "</h2>" ); ?>
            </div>
            <!-- ----- **stroke** ------ -->

            <div class="bg-mid-color"></div>

            <!---------- ***Main Container*** ------------->
            <div class="container">
                
                <!---------- Banner ------------->
                <div class="banner">

                    <div class="swiper-container proy-header-slider">
                        <div class="swiper-wrapper">
                            
                            <?php for( $i = 0; $i < count( $gallery ); $i++ ): ?>
                                <?php if( $gallery[$i] ): ?>

                                    <div class="swiper-slide">
                                        <img src="<?= $gallery[$i]; ?>" class="banner-image" alt="imagen de proyecto ak producciones">
                                    </div>

                                <?php endif; ?>
                            <?php endfor; ?>
                        
                        </div>
                    </div>

                    <div class="custom-swiper-pagination wow fadeIn" data-wow-duration="1s"></div>

                    <div class="banner-items">

                        <?php $sections = of_get_option( 'parallax_section' ); ?>

                        <?php if( !empty( $sections ) ): ?>
                            
                            <?php foreach( $sections as $section ): ?>
                                
                                <?php extract( $section ); ?>
                                
                                <?php
                                    switch ($layout):
                                        
                                        case 'production_template':
                                            $contentPost->custom_breadcrumbs( $page );
                                        break;
                                        
                                        default:
                                        break;
                                        
                                    endswitch;
                                ?>           

                            <?php endforeach; ?>

                        <?php endif; ?>

                        <div class="title header-bold wow fadeInUp" data-wow-duration="1s" data-wow-delay="4s">
                            <?php  the_title( "<h1>", "</h1>" ); ?>
                        </div>
                    </div>

                </div>
                <!---------- ***Banner*** ------------->

                <!------ Content ------->
                <section class="content wow fadeIn" data-wow-duration="1s" data-wow-delay="4.5s">
                    <div id="paraph">
                        <?php the_content();?>
                    </div>
                </section>
                <!------- *content* --------->
        
        <?php endwhile; ?>
    <?php endif; ?>
    
    <?php wp_reset_postdata(); ?>
                <!------- Card Container ---------->
                <section class="box-container">

                    <?php
                        $projects = new WP_Query( array(
                            'order' => 'ASC',
                            'posts_per_page' => '3',
                            'post_type' => 'lb_projects',
                            'post__not_in' => array( $exclude )
                        ));
                    ?>

                    <?php if ( $projects->have_posts() ): ?>

                        <?php $wow = 0.5; ?>

                        <?php while( $projects->have_posts() ): ?>
            
                            <?php $projects->the_post(); ?>

                            <div class="box wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?= $wow; ?>s">
                                <div class="preview-card">

                                    <?php if( has_post_thumbnail() ): ?>

                                        <?php $thumb_url_array_content = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>

                                        <img src="<?= $thumb_url_array_content[0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>" class="card-image">

                                    <?php endif; ?>
                                    <div class="card-overlay">
                                        <div class="card-title-container">
                                            <?php the_title( "<h2 class=\"header-bold card-title\">", "</h2>" ); ?>
                                        </div>

                                        <div class="card-link-container">
                                            <a href="<?= get_permalink(); ?>" class="show-link sm-txt-bold"><?= __( "Ver más", "onepage-theme" ); ?></a> <br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $wow += 0.5; ?>
                        
                        <?php endwhile; ?>

                    <?php endif; ?>
                </section>
                <!--------- **Card Container** ----------->

                <?php wp_reset_postdata(); ?>

                <!-- Card Container Responsive -->
                <section class="mobile-next-proyects">

                    <?php
                        $projects = new WP_Query( array(
                            'order' => 'ASC',
                            'posts_per_page' => '3',
                            'post_type' => 'lb_projects',
                            'post__not_in' => array( $exclude )
                        ));
                    ?>

                    <?php if ( $projects->have_posts() ): ?>

                        <?php $wow = 0.5; ?>

                        <?php while( $projects->have_posts() ): ?>

                            <?php $projects->the_post(); ?>

                            <div class="proy-desc wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                                <a href="<?= get_permalink(); ?>" class="sm-txt-bold"><?= get_the_title(); ?></a>

                                <div class="proy-overlay">
                                    <?php if( has_post_thumbnail() ): ?>

                                        <?php $thumb_url_array_content = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>

                                        <img src="<?= $thumb_url_array_content[0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>">

                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php $wow += 0.5; ?>
                        
                        <?php endwhile; ?>

                    <?php endif; ?>
                    
                </section>
                <!-- /End Card Container Responsive -->

            </div>
            <!---------- **main container** ----------->

    <div class="scroll-section scroll-desktop-version">
        <div class="link-container ind-up-link">
            <a href="javascript:;" class="scroll-link scroll-up sm-txt-bold">
                <?= __( 'subir ', 'onepage-theme' ); ?> 
                <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            </a>
        </div>
    </div>

    <div class="scroll-section scroll-mobile-version">
        <div class="link-container ind-up-link">
            <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
        </div>
    </div>
</main>

<script>

    /* swiper-pagination */
    var mySwiper = new Swiper(".proy-header-slider", {
        direction: "vertical",
        simulateTouch: false,
        touchRatio: 0,
        autoplay: {
            delay: 5000,
        },
        loop: true,
        speed: 700,
        pagination: {
            el: ".custom-swiper-pagination",
            clickable: true,
        },
        on: {
            slideChangeTransitionEnd: function () {
                this.autoplay.start();
            },
        },
        // breakpoints: {
        //     850: {
        //         slidesPerView: 2,
        //         slidesPerColumn: 2
        //     },
        //     510: {
        //         slidesPerView: 1,
        //         slidesPerColumn: 0
        //     }
        // }
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.ind-up-link').addClass('link-active');
        } else {
            if ($('.ind-up-link').hasClass('link-active')) {
                $('.ind-up-link').removeClass('link-active');
            }
        }
    });

    $('.ind-up-link').on('click', function (e) {
        $('body,html').animate({
            scrollTop: 0
        }, 1100, "easeInOutExpo");
    });
</script>
