<?php
/**
 * Taxonomy template.
 *
 * @author Icler Anaya
 * @link https://lordblaster.com.ve/
 * @author URI: https://github.com/icleranaya
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>

<?php get_header(); ?>

<?php global $contentPost, $header; ?>

<?php $header->MenuCollapsed();?>

<main class="aca-individual-main hoverable-main">
    <section class="layout-center">

        <div class="bg-mid-color"></div>

        <div class="center-container">

            <!-- ------ stroke ------- -->
            <div class="stroke-right">
                <h2 class="stroke-txt">
                    <?= __( 'Academia', 'onepage-theme' ); ?>
                </h2>
            </div>
            <!-- ----- **stroke** ------ -->

            <?php if ( have_posts() ): ?>

                <!---------- main container ------------>
                <div class="swiper-container ind-aca-slider">

                    <?php $sections = of_get_option( 'parallax_section' ); ?>

                    <?php if( !empty( $sections ) ): ?>
                        
                        <?php foreach( $sections as $section ): ?>
                            
                            <?php extract( $section ); ?>
                            
                            <?php
                                switch ($layout):
                                    
                                    case 'academy_template':
                                        $contentPost->custom_breadcrumbs( $page );
                                    break;
                                    
                                    default:
                                    break;
                                    
                                endswitch;
                            ?>           

                        <?php endforeach; ?>

                    <?php endif; ?>
                    
                    <!------------------- Swiper Container -------------------->
                    <div class="swiper-wrapper">

                        <?php $wow = 3.5; ?>

                        <?php while( have_posts() ): ?>

                            <?php the_post(); ?>
                            
                            <div class="swiper-slide slider-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?= $wow; ?>s">
                                <div class="card-half">

                                    <div class="card-overlay">

                                        <?php if( has_post_thumbnail() ): ?>

                                            <?php $thumb_url_array_content = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>

                                            <img src="<?= $thumb_url_array_content[0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>" class="card-image">
                                        
                                        <?php endif; ?>

                                    </div>

                                    <div class="card-description">
                                        <div class="card-title-container">
                                            <?php the_title( "<h2 class=\"header-bold card-title\">", "</h2>" ); ?>
                                        </div>

                                        <div class="card-link-container">
                                            <a href="<?= get_permalink(); ?>" class="show-link sm-txt-bold"><?= __('Ver más', 'onepage-theme');?></a>
                                            <br>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <?php $wow += 0.5; ?>

                        <?php endwhile; ?>
                    
                    </div>

                    <?php wp_reset_postdata(); ?>
                    <!------------------- ***Swiper Container*** -------------------->

                </div>
                <!---------- **main container** ----------->

                <div class="responsive-data-container">
                    <h2 class="stroke-txt title-stroke">
                        <?= single_term_title(); ?>
                    </h2>

                    <!---------------- Mobile-Card_container ----------------------->
                    <div class="corner-link wow fadeIn" data-wow-duration="1s">
                        <svg class="svg-xs" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_left.svg"></svg>
                        <span> </span>
                        <?php $sections = of_get_option( 'parallax_section' ); ?>

                        <?php if( !empty( $sections ) ): ?>
                            
                            <?php foreach( $sections as $section ): ?>
                                
                                <?php extract( $section ); ?>
                                
                                <?php
                                    switch ($layout):
                                        
                                        case 'academy_template':
                                            echo "<a href=\"" . get_permalink( $page ) . "\" class=\"back-link sm-txt-bold\">";
                                            echo __( 'Academia', 'onepage-theme' );
                                            echo "</a>";
                                        break;
                                        
                                        default:
                                        break;
                                        
                                    endswitch;
                                ?>           

                            <?php endforeach; ?>

                        <?php endif; ?>
                    </div>
                            
                    <div class="mobile-card-container">
                        
                        <?php while( have_posts() ): ?>

                            <?php the_post(); ?>

                            <!----------------------------------------------------->
                            <div class="card-half">
                                <div class="card-overlay">
                                    <div class="title-position">
                                        <?php the_title( "<span class=\"card-title header-bold\">", "</span>" ); ?>
                                    </div>
                                    <?php if( has_post_thumbnail() ): ?>

                                        <?php $thumb_url_array_content = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>

                                        <img src="<?= $thumb_url_array_content[0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>" class="card-image">
                                    
                                    <?php endif; ?>
                                </div>
                                <div class="card-description">
                                    <div class="card-title-container">
                                        <?php the_title( "<h2 class=\"header-bold card-title\">", "</h2>" ); ?>
                                    </div>

                                    <div class="card-link-container">
                                        <a href="<?= get_permalink(); ?>" class="show-link sm-txt-bold"><?= __('Ver más', 'onepage-theme');?></a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <!----------------------------------------------------->

                        <?php endwhile; ?>

                    </div>
                    <!---------------- ***Mobile-Card_container ----------------------->
                </div>

            <?php endif; ?>

        </div>
        
        <div class="swiper-custom-btn-left">
            <svg class="svg-small svg-arrow-left" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
        </div>

        <div class="swiper-custom-btn-right wow fadeIn" data-wow-duration="2s">
            <svg class="svg-small svg-arrow-right" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
        </div>

        <div class="scroll-section scroll-mobile-version">
            <div class="link-container ind-up-link">
                <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            </div>
        </div>

    </section>
</main>
<!--unique javascript of the page-->
<script>
    /* swiper-pagination */
    var mySwiper = new Swiper(".ind-aca-slider", {
        slidesPerView: 3,
        slidesPerColumn: 1,
        spaceBetween: 45,
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

<?php get_footer(); ?>