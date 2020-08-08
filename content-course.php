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

<main class="course-ind-main hoverable-main layout">

    <?php $content_courses = new WP_Query( "post_type=lb_courses&p=" . get_the_ID() );?>

    <?php if ( $content_courses->have_posts() ): ?>
        
        <?php while( $content_courses->have_posts() ): ?>
            
            <?php $content_courses->the_post(); ?>

            <?php $custom_fields = get_post_custom( get_the_ID() ); ?>

            <?php
                $band_gallery = false;
                $i = 1;

                while (!$band_gallery && $i <= 4) {
                    $band_gallery = ( isset( $custom_fields["lb_courses_course_information_gallery_{$i}"] ) ) ? false : true;
                    if ( !$band_gallery) {
                        $gallery[] = $custom_fields["lb_courses_course_information_gallery_{$i}"][0];
                    }
                    $i++;
                }
            ?>

            <!----------  stroke  ------------->
            <div class="stroke-right">
                <?php the_title( "<h2 class=\"stroke-txt\">", "</h2>" ); ?>
            </div>
            <!----------  *stroke*  ------------->

            <!----------  spliters  ------------->
            <div class="spliter-up-right">
                <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/spliter.png" alt="spliter">
            </div>
            <!----------  *spliters*  ------------->

            <div class="bg-mid-color"></div>

            <!---------- ***Main Container*** ------------->
            <div class="container">

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

                    <div class="custom-swiper-pagination wow fadeIn" data-wow-duration="1s" data-wow-delay="3.5s"></div>

                    <div class="banner-items">

                        <?php $sections = of_get_option( 'parallax_section' ); ?>

                        <?php if( !empty( $sections ) ): ?>
                            
                            <?php foreach( $sections as $section ): ?>
                                
                                <?php extract( $section ); ?>
                                
                                <?php
                                    switch ($layout):
                                        
                                        case 'academy_template':
                                            $contentPost->custom_breadcrumbs( $page, "lb_courses_category" );
                                        break;
                                        
                                        default:
                                        break;
                                        
                                    endswitch;
                                ?>           

                            <?php endforeach; ?>

                        <?php endif; ?>

                        <div class="title header-bold wow fadeInUp" data-wow-duration="1s" data-wow-delay="3.5s">
                            <?php  the_title( "<h1>", "</h1>" ); ?>

                            <div class="course-btn wow fadeInUp" data-wow-duration="1s" data-wow-delay="4s">
                                <div class="btn-main">
                                    <a href="<?= get_permalink( get_page_by_path( 'proceso-de-inscripcion' ) ); ?>" class="btn-content"><?= __( 'Inscribirme', 'onepage-theme' ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!------ Content ------->
                <section class="content wow fadeIn" data-wow-duration="1s" data-wow-delay="4.5s">

                    <div id="paraph">
                        <?php the_content(); ?>
                    </div>

                </section>
                <!------- *content* --------->

                <!------------ Table Container ------------->
                <section class="table-container">
                    <!----------  spliters  ------------->
                    <div class="spliter-mid-course">
                        <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/spliter.png" alt="spliter">
                    </div>
                    <!----------  *spliters*  ------------->

                    <div class="table-course-header">
                        <h4 class="sm-header-bold"><?= __( 'A continuación los detalles de este curso:', 'onepage-theme' ); ?></h4>
                    </div>

                    <div class="test-box wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">

                        <!-- Tab Table -->
                        <div class="tab-table">

                            <!-- Tabs Links -->
                            <?= $contentPost->CourseLinksTabsTable( $custom_fields ); ?>
                            <!-- /En Tabs Links -->

                            <!-- Content Tabs -->
                            <?= $contentPost->CourseContentTabsTable( $custom_fields ); ?>
                            <!-- /End Content -->

                        </div>
                        <!-- /end Tab Table -->

                    </div>

                    <!-- Content Responsive Tab Table -->
                    <?= $contentPost->CourseAccordion( $custom_fields ); ?>
                    <!-- /End Content Responsive Tab Table -->

                    <div class="button-course-right">
                        <p class="sm-txt-normal"><?= __( 'Haz clic aqui para inscribirte', 'onepage-theme' ); ?></p>
                        <div class="standard-btn course-btn">
                            <a href="<?= get_permalink( get_page_by_path( 'proceso-de-inscripcion' ) ); ?>" class="btn-content"><?= __( 'Inscripción', 'onepage-theme' ); ?></a>
                        </div>
                    </div>

                </section>

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

        <?php endwhile; ?>
    <?php endif; ?>

</main>
<!--unique javascript of the page-->
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

    (function($) {

        var allPanels = $('.accordion > .content-item').hide();
        
        $('.accordion > .accordion-header > a').click(function() {
            
            if( $(this).hasClass("accordion-active") ) {
                $(this).removeClass("accordion-active");
                $(this).parent().next().slideUp();
            } else {
                $('.accordion > .accordion-header > a').removeClass("accordion-active");
                allPanels.slideUp();
                $(this).addClass("accordion-active");
                $(this).parent().next().slideDown();
                return false;
            }
        });
    
    })(jQuery);
</script>