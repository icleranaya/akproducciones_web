<?php 
/**
 * Template to show Contact area.
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

<main class="main-<?= $contact_name; ?> not-hover-main">

    <section class="layout-center">

        <!-------  spliters  -------->
        <div class="spliter-down-right">
            <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/spliter.png" alt="spliter">
        </div>
        <!-------  *spliters*  ------>

        <div class="bg-mid-color"></div>

        <!-- ------ stroke ------- -->
        <div class="stroke-right">
            <h2 class="wite-text stroke-txt">
                <?= get_the_title()?>
            </h2>
        </div>
        <!-- ----- **stroke** ------ -->

        <!---------- main container ------------>
        <div class="center-container-row">
            
            <!--------  info-container  --------->
            <div class="container-info">

                <!------- info contac ---------->
                <div class="info-contac">

                    <h4 class="white-text header-bold header wow fadeIn" data-wow-duration="1.5s" data-wow-delay="3.5s"><?= __('Contacto', 'onepage-theme'); ?></h4>

                    <!------- Telf container -------->
                    <div class="telf wow fadeIn" data-wow-duration="1.5s" data-wow-delay="4s">
                        <p class="white-text xs-txt-med title"><?= __('Whatsapp', 'onepage-theme'); ?></p>
                        <span class="white-text lg-txt-bold sub-title"><?= of_get_option('whatsapp_contact'); ?></span>

                        <div class="btn-container">
                            <div class="contact-btn">
                                <?php
									$prioridad = array( "0", "-", ".", " " );
									$phone_whatsapp = str_replace( $prioridad,"",of_get_option('whatsapp_contact'));
								?>
                                <a href="https://wa.me/58<?= $phone_whatsapp;?>" target="_blank" class="btn-content">
                                    <svg class="svg-md" data-src="<?= get_template_directory_uri(); ?>/public/images/svg/whatsapp.svg"></svg>
                                    <?= __('contactar', 'onepage-theme'); ?>
                                </a>
                            </div>
                        </div>

                        <p class="white-text xs-txt-med title"><?= __('Sala de ensayo', 'onepage-theme'); ?></p>
                        <span class="white-text lg-txt-bold sub-title"><?= of_get_option('phone_contact'); ?></span>
                    </div>
                    <!------ **Telf container** ----->

                    <!------- Direction container ------->
                    <div class="dir wow fadeIn" data-wow-duration="1.5s" data-wow-delay="4.5s">

                        <span class="sm-txt-med"><?= __('Correo', 'onepage-theme'); ?></span>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?= of_get_option('mail_contact'); ?>" class="txt-bold email" target="_blank">
                            <?= of_get_option('mail_contact'); ?>
                        </a>
                        <span class="txt-bold"><?= __('Dirección', 'onepage-theme'); ?></span>
                        <?= apply_filters( 'the_content', of_get_option('address_contact') );?>

                        <div class="btn-container">

                            <div class="contact-btn">
                                <a data-fancybox data-type="iframe" data-src="<?= of_get_option('map_contact'); ?>" href="javascript:;" class="btn-content">
                                    <svg class="svg-md" data-src="<?= get_template_directory_uri(); ?>/public/images/svg/map.svg"></svg>
                                    <?= __( 'ver mapa', 'onepage-theme' );?>
                                </a>
                            </div>

                        </div>

                    </div>
                    <!----- ***Direction container*** ------>

                    <!--deployment-->
                    <div class="prisma-link wow fadeIn" data-wow-duration="1.5s" data-wow-delay="5s">
                        <p class="prisma-text sm-txt-normal">Diseñado y Desarrollado por <a href="https://prismaagencia.com" target="_blank" class="prisma sm-txt-normal">Prisma Agencia Creativa.</a></p>
                    </div>
                    <!-- ***deployment*** -->

                </div>
                <!------ ***info contac*** ------>

                <div class="image-container">

                    <?php if( of_get_option('bg_contact') ): ?>
                        <img src="<?= of_get_option('bg_contact'); ?>" alt="ak producciones imagen contacto">
                    <?php else: ?>
                        <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/no-thumb.jpg" alt="ak producciones imagen contacto">
                    <?php endif; ?>
                </div>

            </div>
            <!--------  **info-container**  --------->

        </div>
        <!---------- **main container** ----------->
    
    </section>
</main>

<script>

    /* svg injector */
    new SVGInjector().inject(document.querySelectorAll('svg[data-src]'));


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