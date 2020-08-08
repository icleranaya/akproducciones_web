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

<main class="services-ind-main hoverable-main layout">

    <!----------  spliters  ------------->
    <div class="spliter-up-right">
        <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/spliter.png" alt="spliter">
    </div>
    <!----------  *spliters*  ------------->

    <div class="bg-mid-color"></div>

    <!---------- ***Main Container*** ------------->
    <div class="container">

        <?php $content_service = new WP_Query( "post_type=lb_services&p=" . get_the_ID() );?>

        <?php if ( $content_service->have_posts() ): ?>
            
            <?php while( $content_service->have_posts() ): ?>
                
                <?php $content_service->the_post(); ?>

                <?php $custom_fields = get_post_custom( get_the_ID() ); ?>

                <?php // Feature Service ?>
                <?php
                    $ContentField = array(
                        'preamp'           => isset( $custom_fields["lb_services_service_information_preamp"] ) ? unserialize( $custom_fields["lb_services_service_information_preamp"][0] ) : " ",
                        'consola'          => isset( $custom_fields["lb_services_service_information_consola"] ) ? unserialize( $custom_fields["lb_services_service_information_consola"][0] ) : " ",
                        'cornetas'         => isset( $custom_fields["lb_services_service_information_cornetas"] ) ? unserialize( $custom_fields["lb_services_service_information_cornetas"][0] ) : " ",
                        'interfaz'         => isset( $custom_fields["lb_services_service_information_interfaz"] ) ? unserialize( $custom_fields["lb_services_service_information_interfaz"][0] ) : " ",
                        'software'         => isset( $custom_fields["lb_services_service_information_software"] ) ? unserialize( $custom_fields["lb_services_service_information_software"][0] ) : " ",
                        'visuales'          => isset( $custom_fields["lb_services_service_information_visuales"] ) ? unserialize( $custom_fields["lb_services_service_information_visuales"][0] ) : " ",
                        'monitores'        => isset( $custom_fields["lb_services_service_information_monitores"] ) ? unserialize( $custom_fields["lb_services_service_information_monitores"][0] ) : " ",
                        'instrumentos'     => isset( $custom_fields["lb_services_service_information_instrumentos"] ) ? unserialize( $custom_fields["lb_services_service_information_instrumentos"][0] ) : " ",
                        'amplificadores'   => isset( $custom_fields["lb_services_service_information_amplificadores"] ) ? unserialize( $custom_fields["lb_services_service_information_amplificadores"][0] ) : " ",

                    );
                ?>

                <div class="banner">

                    <?php if( isset( $custom_fields["lb_services_service_information_portada"] ) ): ?>

                        <img src="<?= $custom_fields["lb_services_service_information_portada"][0]; ?>" alt="<?= esc_attr( get_the_title() ); ?>" class="banner-image">
                    
                    <?php endif; ?>

                    <div class="banner-items">

                        <?php $sections = of_get_option( 'parallax_section' ); ?>

                        <?php if( !empty( $sections ) ): ?>
                            
                            <?php foreach( $sections as $section ): ?>
                                
                                <?php extract( $section ); ?>
                                
                                <?php
                                    switch ($layout):
                                        
                                        case 'services_template':
                                            $contentPost->custom_breadcrumbs( $page );
                                        break;
                                        
                                        default:
                                        break;
                                        
                                    endswitch;
                                ?>           

                            <?php endforeach; ?>

                        <?php endif; ?>

                        <div class="title header-bold wow fadeInUp" data-wow-duration="1s" data-wow-delay="3.5s">
                            <?php  the_title( "<h1>", "</h1>" ); ?>
                        </div>
                    </div>
                </div>

                <!------ Content ------->
                <section class="content wow fadeIn" data-wow-duration="1s" data-wow-delay="4s">

                    <div id="paraph">            
                        <?php the_content(); ?>
                    </div>
                    
                    <?php if( isset( $custom_fields["lb_services_service_information_content_editor"] ) ):?>
                        <div class="include-services">
                            <h4 class="txt-bold"><?= __( 'Nuestros servicios incluyen:', 'onepage-theme' ); ?></h4>
                            <?= apply_filters( 'the_content', $custom_fields["lb_services_service_information_content_editor"][0]); ?>
                        </div>
                    <?php endif; ?>

                </section>
                <!------- *content* --------->

                <!------------ Table Container ------------->
                <section class="table-container">
                    <div class="table-header">
                        <h4 class="txt-bold"><?= __( 'Nuestra tecnología.', 'onepage-theme' ); ?></h4>
                    </div>

                    <div class="test-box wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="tab-table">
                            
                            <!-- Tabs Links -->
                            <?= $contentPost->ServiceLinksTabsTable( $ContentField ); ?>
                            <!-- /En Tabs Links -->
                            
                            <!-- Content Tabs -->
                            <?= $contentPost->ServiceContentTabTable( $ContentField ); ?>
                            <!-- /End Content -->

                        </div>
                    </div>

                    <!-- Accordion -->
                    <?= $contentPost->ServiceAccordion( $ContentField ); ?>
                    <!-- /End Accordion -->                 

                    <div class="button-left">
                        <div class="standard-btn">
                            <a href="<?= get_permalink( get_page_by_path( 'contacto' ) ); ?>" class="btn-content"><?= __( 'Contactar', 'onepage-theme' ); ?></a>
                        </div>
                    </div>
                </section>
                <!----------- **Table Container** ------------>

            <?php endwhile; ?>
        <?php endif; ?>

    </div>
    <!---------- **main container** ----------->

    <div class="scroll-section">
        <div class="link-container ind-up-link">
            <svg class="scroll-svg-up svg-arrow-up hide-svg" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            <a href="javascript:;" class="scroll-link scroll-up sm-txt-bold">
                <?= __( 'subir ', 'onepage-theme' ); ?>
                <svg class="scroll-svg-up svg-arrow-up" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_down.svg"></svg>
            </a>
        </div>
    </div>
</main>
<!--unique javascript of the page-->
<script>

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