<?php 
/**
 * Template to show News area.
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

<!-- Header -->
<?php $header->MenuExpanded(); ?>
    
<main id="<?= $news_ID;?>" class="main-<?= $news_ID;?> not-hover-main">
    <div class="<?= $news_ID;?>">
        <ul class="link-list">

            <?php $i = 1; ?>

            <?php
                $content = new WP_Query( array(
                    'order' => 'ASC',
                    'posts_per_page' => '4',
                    'post_type' => 'lb_courses'
                ));
            ?>

            <?php if ( $content->have_posts() ): ?>

                <?php while( $content->have_posts() ): ?>

                    <?php $content->the_post(); ?>
                    <?php $custom_fields = get_post_custom( get_the_ID() ); ?>

                    <li class="link sec-<?= $i;?> <?= $i == 1 ? 'active' : ''; ?>">
                        <h2 class="txt-med news-title"><?= get_the_title();?></h2>
                        <?php if( isset( $custom_fields["lb_courses_course_information_date"] ) ): ?>
                            <p class="sm-txt-normal news-desc"><?= $custom_fields["lb_courses_course_information_date"][0];?></p>
                        <?php endif; ?>
                    </li>

                    <?php $i++;?>

                <?php endwhile; ?>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        </ul>

        <div class="slider-wrapper">
            <div class="swiper-container dynamic-slider">
                <div class="swiper-wrapper">
                
                <?php
                    $content = new WP_Query( array(
                        'order' => 'ASC',
                        'posts_per_page' => '4',
                        'post_type' => 'lb_courses'
                    ));
                ?>

                <?php if ( $content->have_posts() ): ?>

                    <?php while( $content->have_posts() ): ?>

                        <?php $content->the_post(); ?>

                        <div class="swiper-slide">
                            <?php $thumb_url_array_content = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>
                            <div class="slide-inner" style="background-image: url(<?= $thumb_url_array_content[0];?>);"></div>

                            <div class="quote-container blurOut">
                                <h3 class="big-header-bold quote-tittle"><?= get_the_title();?></h3>
                                <?php the_content();?>

                                <div class="slider-btn">
                                    <div class="btn-main">
                                        <a href="<?= get_permalink(); ?>" class="btn-content"><?= __('Ver más','onepage-theme');?></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php endwhile; ?>

                <?php endif; ?>
                
                <?php wp_reset_postdata(); ?>
                    
                </div>
                <div class="swiper-pagination-container">
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-btn-container">
                    <div class="swiper-custom-btn-prev">
                        <svg class="svg-xs slider-svg" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_left.svg"></svg>
                    </div>
                    <div class="swiper-custom-btn-next">
                        <svg class="svg-xs slider-svg" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_right.svg"></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="slider-header-container">
        <ul>
            <?php $j = 1; ?>

            <?php
                $content = new WP_Query( array(
                    'order' => 'ASC',
                    'posts_per_page' => '4',
                    'post_type' => 'lb_courses'
                ));
            ?>

            <?php if ( $content->have_posts() ): ?>

                <?php while( $content->have_posts() ): ?>

                    <?php $content->the_post(); ?>

                    <li class="slide-header tittle-<?= $j;?> <?= $j == 1 ? 'tittle-active' : ''; ?>">
                        <h2 class="stroke-txt">
                            <span class="no-stroke"><?= "0{$j}";?></span>
                            <?= get_the_title();?>
                        </h2>
                    </li>

                    <?php $j++;?>

                <?php endwhile; ?>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
            
        </ul>
    </div>

</main>
<!--main javascript of the page-->
<script>
    /* slider animation code */
    function foward() {
        $('.swiper-slide-prev .quote-container').removeClass('blurIn');
        $('.swiper-slide-prev .quote-container').addClass('blurOut');

        /* change if its a duplicate slide */
        $('.swiper-slide-duplicate-prev .quote-container').removeClass('blurIn');
        $('.swiper-slide-duplicate-prev .quote-container').addClass('blurOut');

        $('.swiper-slide-active .quote-container').removeClass('blurOut');
        $('.swiper-slide-active .quote-container').addClass('blurIn');

        /* change if its a duplicate slide */
        $('.swiper-slide-duplicate-active .quote-container').removeClass('blurOut');
        $('.swiper-slide-duplicate-active .quote-container').addClass('blurIn');
    }

    function backward() {
        $('.swiper-slide-next .quote-container').removeClass('blurIn');
        $('.swiper-slide-next .quote-container').addClass('blurOut');

        /* change if its a duplicate slide */
        $('.swiper-slide-duplicate-next .quote-container').removeClass('blurIn');
        $('.swiper-slide-duplicate-next .quote-container').addClass('blurOut');

        $('.swiper-slide-active .quote-container').removeClass('blurOut');
        $('.swiper-slide-active .quote-container').addClass('blurIn');

        /* change if its a duplicate slide */
        $('.swiper-slide-duplicate-active .quote-container').removeClass('blurOut');
        $('.swiper-slide-duplicate-active .quote-container').addClass('blurIn');
    }

    /* swiper-pagination */
    var interleaveOffset = 0.5;

    var swiperOptions = {
        direction: "horizontal",
        simulateTouch: false,
        touchRatio: 0,
        autoHeight: false,
        loop: true,
        speed: 1000,
        watchSlidesProgress: true,
        pagination: {
            el: ".dynamic-slider .swiper-pagination-container .swiper-pagination",
            clickable: true,
        },
        // Navigation arrows
        navigation: {
            nextEl: ".swiper-custom-btn-next",
            prevEl: ".swiper-custom-btn-prev"
        },
        breakpoints: {
            767: {
                touchRatio: 1,
                simulateTouch: true,
                noSwiping: false,
            },
        },
        on: {
            init: function () {
                $('.swiper-slide-active .quote-container').removeClass('blurOut');
                $('.swiper-slide-active .quote-container').addClass('blurIn');
                $('.swiper-slide-duplicate .quote-container').addClass('blurOut');
                $('.slider-header-container .tittle-active .stroke-txt').addClass('blurInStroke');
            },
            progress: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = slideProgress * innerOffset;
                    swiper.slides[i].querySelector(".slide-inner").style.transform =
                        "translate3d(" + innerTranslate + "px, 0, 0)";
                }
            },
            touchStart: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = "";
                }
            },
            transitionStart: function(){
                backward();
                foward();
            },
            setTransition: function (speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-inner").style.transition =
                        speed + "ms";
                }
            }
        }
    };

    var mySwiper = new Swiper(".dynamic-slider", swiperOptions);

    /* dynamic slider sync button with the text and the slides functionality*/
    var realIndex = { index: 0 };

    $(".swiper-btn-container .swiper-custom-btn-prev").click(function () {
        realIndex.index = mySwiper.previousIndex - 1;

        if (realIndex.index == 0) {
            realIndex.index = 4;
        }

        activate_link(realIndex.index);
        backward();
    });

    $(".swiper-btn-container .swiper-custom-btn-next").click(function () {
        realIndex.index = mySwiper.previousIndex + 1;

        if (realIndex.index == 5) {
            realIndex.index = 1;
        }

        activate_link(realIndex.index);
        foward();
    });

    function activate_link(index) {
        var sec = ".sec-" + index;
        var title = ".tittle-" + index;

        $('.link').removeClass("active");
        $('.slide-header').removeClass("tittle-active");

        if (!$(sec).hasClass("active")) {
            $(sec).addClass("active");
        }

        if (!$(title).hasClass("tittle-active")) {
            $(title).addClass("tittle-active");
        }
    }

    $(".link, .swiper-pagination-bullet").click(function (e) {
        e.preventDefault();
        realIndex.index = $(this).index() + 1;
        activate_link(realIndex.index);
        mySwiper.slideTo(realIndex.index, 1000, false);
        
        backward();
        foward();
    });

    function toggle(e, e2, e3) {
        if ($(e).hasClass(e2)) {
            $(e).removeClass(e2);
        } else {
            $(e3).removeClass(e2);
            $(e).addClass(e2);
        }
    }

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