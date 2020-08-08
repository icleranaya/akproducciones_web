<?php 
/**
 * Template to show Services area.
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link https://prismaagencia.com/
 * @author URI: https://gitlab.com/prisma_web
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>

<?php global $contentPost, $header; ?>

<?php $header->MenuExpanded();?>
    
<main class="main-<?= $services_name; ?> not-hover-main">
    <section class="layout-center">

        <!-- Background -->
        <div class="bg-mid-color"></div>
        
        <!-- Content -->
        <div class="center-container">

            <!-- Spliter -->
            <div class="spliter-up-left">
                <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/spliter.png" alt="spliter">
            </div>

            <div class="stroke-right">
                <?php the_title( '<h2 class="stroke-txt">', '</h2>' ); ?>
            </div>

            <!-- Slider -->
            <div class="swiper-container services-slider">
                <div class="swiper-wrapper">
            
                    <?php
                        $content_section = new WP_Query( array(
                            'order' => 'ASC',
                            'posts_per_page' => '10',
                            'post_type' => 'lb_services'
                        ));
                    ?>

                    <?php if ( $content_section->have_posts() ): ?>
                        
                        <?php $wow = 3.5; ?>

                        <?php while( $content_section->have_posts() ): ?>
            
                            <?php $content_section->the_post(); ?>


                            <div class="swiper-slide slider-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?= $wow; ?>s">
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
                                            <a href="<?= get_permalink(); ?>" class="show-link sm-txt-bold"><?= __('Ver más', 'onepage-theme');?></a> <br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $wow += 0.5;?>

                        <?php endwhile; ?>

                    <?php endif; ?>
            
                </div>
            </div>

            <?php wp_reset_postdata(); ?>

            <div class="responsive-data-container">
                <?php the_title( '<h2 class="stroke-txt title-stroke">', '</h2>' ); ?>

                <div class="mobile-card-container">
                    
                    <?php
                        $content_section = new WP_Query( array(
                            'order' => 'ASC',
                            'posts_per_page' => '10',
                            'post_type' => 'lb_services'
                        ));
                    ?>

                    <?php if ( $content_section->have_posts() ): ?>
                        
                        <?php $wow = 3.5; ?>

                        <?php while( $content_section->have_posts() ): ?>
            
                            <?php $content_section->the_post(); ?>

                            <div class="preview-card">

                                <?php if( has_post_thumbnail() ): ?>

                                    <?php $thumb_url_array_content = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>

                                    <img src="<?= $thumb_url_array_content[0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>" class="card-image">

                                <?php endif; ?>
                                <div class="card-overlay">
                                    <div class="card-link-container">
                                        <a href="<?= get_permalink(); ?>" class="show-link sm-txt-bold"><?= get_the_title(); ?></a> <br>
                                    </div>
                                </div>
                            </div>
                        
                            <?php $wow += 0.5;?>

                        <?php endwhile; ?>

                    <?php endif; ?>

                </div>
            </div>

            <!-- Controls Slider -->
            <div class="swiper-custom-btn-left">
                <svg class="svg-small svg-arrow-left" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            </div>

            <div class="swiper-custom-btn-right">
                <svg class="svg-small svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            </div>

        </div>

    </section>

    <div class="scroll-section scroll-mobile-version">
        <div class="link-container ind-up-link">
            <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
        </div>
    </div>
</main>

<!--unique javascript of the page-->
<script>

    /* swiper-pagination */
    var swiperOptions = {
        slidesPerView: 3,
        slidesPerColumn: 1,
        spaceBetween: 30,
        pagination: false,
        navigation: {
            nextEl: '.swiper-custom-btn-right',
            prevEl: '.swiper-custom-btn-left',
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
    };

    var mySwiper = new Swiper(".services-slider", swiperOptions);

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


    /* on responsive the principal screens will have a minified menu */
    $(window).resize(function () {
        if ($(window).width() <= 1100) {
            if ($("header").hasClass("header-collapsed") && $("main").hasClass("not-hover-main")) {
                $("header").removeClass("header-collapsed");
                $("main").removeClass("not-hover-main");
                $("main").addClass("hoverable-main");
            }
        } else {
            if (!$("header").hasClass("header-collapsed") && !$("main").hasClass("not-hover-main")) {
                $("header").addClass("header-collapsed");
                $("main").removeClass("hoverable-main");
                $("main").addClass("not-hover-main");
            }
        }
    });

    $(document).ready(function () {
        if ($(window).width() <= 1100) {
            if ($("header").hasClass("header-collapsed") && $("main").hasClass("not-hover-main")) {
                $("header").removeClass("header-collapsed");
                $("main").removeClass("not-hover-main");
                $("main").addClass("hoverable-main");
            }
        } else {
            if (!$("header").hasClass("header-collapsed") && !$("main").hasClass("not-hover-main")) {
                $("header").addClass("header-collapsed");
                $("main").removeClass("hoverable-main");
                $("main").addClass("not-hover-main");
            }
        }
    });
</script>