<?php 
/**
 * Template to show Academy area.
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

<main class="main-<?= $academy_name; ?> not-hover-main">
    <section class="scroll-sec layout-center">

        <!-------  spliters  -------->
        <div class="spliter-down-right">
            <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/spliter.png" alt="spliter">
        </div>
        <!-------  *spliters*  ------>

        <div class="bg-mid-color"></div>

        <!-- ------ stroke ------- -->
        <div class="stroke-right">
            <h2 class="stroke-txt"><?= get_the_title()?></h2>
        </div>
        <!-- ----- **stroke** ------ -->

        <div class="center-container-row">
            <div class="info-container">

                <?php if( have_posts() ): ?>
                    <?php while ( have_posts() ) : ?>

                        <?php the_post(); ?>

                        <?php if( has_post_thumbnail() ): ?>
                            
                            <?php $thumb_url_array_content_page = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>
                            <div class="profile-photo">
                                <img src="<?= $thumb_url_array_content_page[0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>">
                            </div>

                        <?php else: ?>

                            <div class="profile-photo">
                                <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/no-thumb.jpg" alt="no-thumb">
                            </div>

                        <?php endif; ?>
                        
                        <div class="profile-description wow fadeIn" data-wow-duration="1.5s" data-wow-delay="3.5s">

                            <h2 class="header-bold line-h-40 head-margin white-text"><?= __("Academia de<br>AK Producciones", 'onepage-theme');?></h2>

                            <?php the_content(); ?>
                        
                        </div>
		
				    <?php endwhile;?>
			    <?php endif; ?>

            </div>

        </div>

    </section>

    <section class="scroll-sec layout-center">
        <div class="center-container">

            <div class="swiper-container academy-slider">

                <div class="swiper-wrapper">

                    <?php $categories = get_terms('lb_courses_category'); ?>

                    <?php $wow = 0.5; ?>

                    <?php foreach( $categories as $category ): ?>
            
                        <div class="swiper-slide slider-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?= $wow; ?>s">
                            <div class="preview-card">

                                <?php $thumb_url_array_content = wp_get_attachment_image_src( get_term_meta ( $category->term_id, 'showcase-taxonomy-image-id', true ), 'full', true ); ?>
                                <?php if ( $thumb_url_array_content[0] ): ?>
                                    <img src="<?= $thumb_url_array_content[0]; ?>" class="card-image">
                                <?php endif; ?>
                                <div class="card-overlay">
                                    <div class="card-title-container">
                                        <h2 class="header-bold card-title"><?= $category->name; ?></h2>
                                    </div>

                                    <div class="card-link-container">
                                        <a href="<?= get_term_link( $category->slug, 'lb_courses_category' ); ?>" class="show-link sm-txt-bold"><?= __('Ver más', 'onepage-theme');?></a> <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $wow += 0.5; ?>
                        
                    <?php endforeach; ?>

                </div>

            </div>

            <!---------------- Mobile-Card-Container -------------------->
            <div class="responsive-data-container">
                <h2 class="stroke-txt title-stroke">
                    <?= __( 'Cursos', 'onepage-theme' ); ?>
                </h2>

                <div class="mobile-card-container">

                    <?php $wow = 0.5; ?>

                    <?php foreach( $categories as $category ): ?>

                        <!---------------------------------------------->
                        <div class="preview-card">
                            <?php $thumb_url_array_content = wp_get_attachment_image_src( get_term_meta ( $category->term_id, 'showcase-taxonomy-image-id', true ), 'full', true ); ?>
                            <?php if ( $thumb_url_array_content[0] ): ?>
                                <img src="<?= $thumb_url_array_content[0]; ?>" alt="<?= esc_attr( $category->name ) ?>" class="card-image">
                            <?php endif; ?>
                            <div class="card-overlay">

                                <div class="card-link-container">
                                    <a href="<?= get_term_link( $category->slug, 'lb_courses_category' ); ?>" class="show-link sm-txt-bold"><?= $category->name; ?></a>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------------------->

                        <?php $wow += 0.5; ?>
                    
                    <?php endforeach; ?>

                </div>
            </div>
            <!---------------- *** Mobile-Card_container ---------------->

            <div class="swiper-custom-btn-left">
                <svg class="svg-small svg-arrow-left" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            </div>

            <div class="swiper-custom-btn-right">
                <svg class="svg-small svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            </div>
        </div>
    </section>

    <div class="scroll-section">
        <div id="down-link" class="link-container">
            <a href="javascript:;" class="scroll-link sm-txt-bold"><?= __('scroll', 'onepage-theme'); ?> 
                <svg data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg></a>
        </div>

        <div id="up-link" class="link-container">
            <a href="javascript:;" class="scroll-link scroll-up sm-txt-bold"><?= __('subir', 'onepage-theme'); ?> 
                <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg></a>
        </div>
    </div>

    <div class="scroll-section scroll-mobile-version">
        <div class="link-container ind-up-link">
            <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
        </div>
    </div>
</main>
<!--unique javascript of the page-->
<script>
    var mySwiper = new Swiper(".academy-slider", {
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
    });

    /* scroll code */

    //initialize scrollify

    $(function () {
        $.scrollify({
            section: ".scroll-sec",
            sectionName: false,
            interstitialSection: "",
            easing: "easeInOutQuart",
            scrollSpeed: 1300,
            offset: 0,
            scrollbars: true,
            standardScrollElements: ".plane",
            setHeights: true,
            overflowScroll: true,
            updateHash: true,
            touchScroll: true,
            before: function () { },
            after: function () { }
        });
    });

    /* if window size is less than 767 disable scrollify */

    $(window).resize(function () {
        if ($(window).width() <= 767) {
            $.scrollify.disable();
        } else {
            $.scrollify.enable();
        }
    });

    $(document).ready(function () {
        if ($(window).width() <= 767) {
            $.scrollify.disable();
        } else {
            $.scrollify.enable();
        }
    });

    /* end of disable scrollify code */

    $(document).ready(function () {
        /* on scroll move verify in what screen are you on */
        $('#down-link').addClass('link-active');
        $(this).scroll(function () {
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