<?php 
/**
 * Template to show About area.
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

<main class="main-<?= $about_name; ?> not-hover-main">

    <!---------- Section 1 ------------>
    <section class="scroll-sec layout-center">

        <div class="bg-box"></div>

        <!-------  spliters  -------->
        <div class="spliter-down-left">
            <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/spliter.png" alt="spliter">
        </div>
        <!-------  *spliters*  ------>

        <!---------- main container ------------>
        <div class="center-container-row">

            <?php if( have_posts() ): ?>
                <?php while ( have_posts() ) : ?>

                    <?php the_post(); ?>

                    <div class="half-content wow fadeIn" data-wow-duration="1.5s" data-wow-delay="3.5s">
                        <h2 class="header-bold white-text"><?= of_get_option('title_about'); ?></h2>
                        <?php the_content(); ?>
                    </div>

                    <?php if( has_post_thumbnail() ): ?>
                        
                        <?php $thumb_url_array_content_page = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>
                        <div class="big-box">
                            <img src="<?= $thumb_url_array_content_page[0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>">
                        </div>

                    <?php else: ?>

                        <div class="big-box">
                            <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/no-thumb.jpg" alt="no-thumb">
                        </div>

                    <?php endif; ?>
                    
		
			    <?php endwhile;?>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
            
        </div>
        <!---------- **main container** ----------->
    </section>
    <!---------- **Section 1** ----------->

    <!---------- Section 2 ------------>
    <section class="scroll-sec layout-center">

        <div class="bg-high-color occult-area"></div>

        <!-- ------ stroke ------- -->
        <div class="stroke-right-up occult-area">
            <h2 class="stroke-txt txt-capitalize">
                <?= of_get_option('subtitle_about'); ?>
            </h2>
        </div>
        <!-- ----- **stroke** ------ -->

        <!---------- main container ------------>
        <div class="center-start-container">

            <div class="plane-container">

                <span class="white-text header-bold"><?= __( 'Instalaciones', 'onepage-theme' ); ?></span>
                <p class="white-text xs-txt-med"><?= __( 'Mapa arquitectónico de las Instalaciones.', 'onepage-theme' ); ?></p>

                <div class="plane wow slideInUp" data-wow-duration="1s">
                    <?php if( of_get_option('plane_about') ): ?>
                        <img src="<?= of_get_option('plane_about'); ?>" alt="ak producciones imagen contacto" class="plane-img">
                    <?php endif; ?>
                </div>

                <div class="btn-container">
                    <div class="download-btn btn-download-container">
                        <a href="<?= of_get_option( 'plane_about_dowload' ); ?>" target="_blank" class="btn-content"><?= __( 'Descargar plano', 'onepage-theme' ); ?></a>
                    </div>
                </div>
            </div>

        </div>
        <!---------- **main container** ----------->

    </section>
    <!---------- **Section 2** ----------->

    <!---------- Section 3 ------------>
    <section class="scroll-sec layout-center">

        <!---------- main container ------------>
        <div class="center-container-row">

            <div class="swiper-container nosotros-slider slider-up">

                <div class="swiper-wrapper slider-container-up">

                    <?php
                        $content_section = new WP_Query( array(
                            'order' => 'ASC',
                            'posts_per_page' => '10',
                            'post_type' => 'lb_team'
                        ));
                    ?>

                    <?php if ( $content_section->have_posts() ): ?>

                        <?php $i = 1; ?>

                        <?php $wow = 0.5; ?>

                        <?php while( $content_section->have_posts() ): ?>
            
                            <?php $content_section->the_post(); ?>

                            <!--------- Item  #<?= $i; ?>---------->
                            <div class="swiper-slide item wow fadeIn" data-wow-duration="1s" data-wow-delay="<?= $wow; ?>s">

                                <div class="profile-card">

                                    <div class="profile-photo-container">
                                        <?php if( has_post_thumbnail() ): ?>
                                            <?php $thumb_url_array_content = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>
                                            <img src="<?= $thumb_url_array_content[0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>">
                                        <?php endif;?>
                                    </div>

                                    <div class="profile-info">
                                        <h1 class="name sm-header-bold"><?= get_the_title(); ?></h1>

                                        <?php $categories = get_the_terms( get_the_ID(), 'lb_team_category' ); ?>
                                            
                                        <?php foreach( $categories as $category ): ?>
                                            <span class="employment txt-bold"><?= $category->name; ?></span>
                                        <?php endforeach; ?>

                                        <?php the_content(); ?>
                                    </div>

                                </div>

                            </div>
                            <!--------- *Item #<?= $i; ?>* ---------->

                            <?php $wow += 0.5; ?>
                            <?php $i++; ?>

                        <?php endwhile; ?>

                    <?php endif; ?>

                </div>

            </div>

        </div>
        <!---------- **main container** ----------->

        <div class="swiper-custom-btn-left">
            <svg class="svg-small svg-arrow-left" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
        </div>

        <div class="swiper-custom-btn-right wow fadeIn" data-wow-duration="2s">
            <svg class="svg-small svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
        </div>

        <div class="scroll-section scroll-desktop-version">
            <div id="down-link" class="link-container">
                <a href="javascript:;" class="scroll-link sm-txt-bold">
                    <?= __( 'scroll ', 'onepage-theme' ); ?>
                    <svg data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg></a>
            </div>
    
            <div id="up-link" class="link-container">
                <a href="javascript:;" class="scroll-link scroll-up sm-txt-bold">
                    <?= __( 'subir ', 'onepage-theme' ); ?>
                    <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg></a>
            </div>
        </div>

        <div class="scroll-section scroll-mobile-version">
            <div class="link-container ind-up-link">
                <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            </div>
        </div>

    </section>
    <!---------- **Section 3** ----------->


</main>
<!--unique javascript of the page-->
<script>

    var mySwiper = new Swiper(".nosotros-slider", {
        breakpoints: {
            1350: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            890: {
                slidesPerView: 2,
            },
            767: {
                slidesPerView: 1,
            },
        },
        slidesPerView: 4,
        slidesPerColumn: 1,
        spaceBetween: 50,
        pagination: false,
        navigation: {
            nextEl: '.swiper-custom-btn-right',
            prevEl: '.swiper-custom-btn-left',
        },
        // breakpoints: {
        //     1350: {
        //         slidesPerView: 3,
        //     },
        //     890: {
        //         slidesPerView: 2,
        //     },
        //     580: {
        //         slidesPerView: 1,
        //     },
        // }
    });

    /* scroll code */

    //initialize scrollify

    $(function() {
    	$.scrollify({
            section : ".scroll-sec",
            sectionName: false,
    		interstitialSection : "",
    		easing: "easeInOutQuart",
    		scrollSpeed: 1300,
    		offset : 0,
    		scrollbars: true,
    		standardScrollElements: ".plane",
    		setHeights: true,
    		overflowScroll: true,
    		updateHash: true,
    		touchScroll:true,
    		before: function () {},
    		after: function () {}
    	});
    });
    
    /* if window size is less than 767 disable scrollify */

    $(window).resize(function () {
        if ($(window).width() <= 767) {
            $.scrollify.disable();
        }else{
            $.scrollify.enable();
        }
    });

    $(document).ready(function () {
        if ($(window).width() <= 767) {
            $.scrollify.disable();
        }else{
            $.scrollify.enable();
        }
    });

    /* end of disable scrollify code */

    $(document).ready(function () {
        /* on scroll move verify in what screen are you on */
        $('#down-link').addClass('link-active');
        $(this).scroll(function () {
            if ($(window).width() > 767) {
                showBg();
                $(".scroll-sec .bg-high-color").css("position", "fixed");
            }else{
                $(".scroll-sec .bg-high-color").css("position", "absolute");
            }

            if ($.scrollify.currentIndex() >= 0 && $.scrollify.currentIndex() < $('.scroll-sec').length - 1) {
                if ($('#up-link').hasClass('link-active')) {
                    $('#up-link').removeClass('link-active');
                }
                $('#down-link').addClass('link-active');
            } else if ($.scrollify.currentIndex() == $('.scroll-sec').length - 1) {
                if ($('#down-link').hasClass('link-active')) {
                    $('#down-link').removeClass('link-active');
                }
                $('#up-link').addClass('link-active');
            }
        });
    });

    $('#down-link').on('click', function (e) {
        e.preventDefault();
        $.scrollify.next();
    });

    $('#up-link').on('click', function (e) {
        e.preventDefault();
        $.scrollify.move(0);
    });

    function showBg() {
        if ($.scrollify.currentIndex() == 0) {
            $('.bg-high-color').addClass('occult-area');
            $('.stroke-right-up').addClass('occult-area');
        } else {
            $('.bg-high-color').removeClass('occult-area');
            $('.stroke-right-up').removeClass('occult-area');
        }
    }
    /* end scroll code */

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