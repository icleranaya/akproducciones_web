<?php
/**
 * Template to show page 404 (not found).
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

<main class="main-404 layout-center">
        <div class="bg-image-overlay">
            <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/black-microphone.jpg" alt="black-microphone ak producciones">
        </div>

        <div class="center-nf">
            <h2 class="header-bold white-text nf-title"><?= __( 'Página no ', 'onepage-theme' ); ?><span class="tic-text"><?= __( 'encontrada', 'onepage-theme' ); ?></span></h2>

            <div class="text-center">
                <span class="grad-text" id="text1">4</span>
                <span class="grad-text" id="text2">0</span>
                <span class="grad-text" id="text3">4</span>
            </div>

            <div class="nf-btn">
                <div class="standard-btn">
                    <a href="<?= esc_url( home_url( '/' ) ); ?>" class="btn-content"><?= __( 'Volver a Inicio', 'onepage-theme' ); ?></a>
                </div>
            </div>
        </div>
        </div>
        
    </main>

<?php get_footer(); ?>