<?php 
/**
 * Template to show Inscription Process.
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link https://prismaagencia.com/
 * @author URI: https://gitlab.com/prisma_web
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>
<main class="main-signup">
    <section class="layout-center">

        <div class="bg-high-color-gray"></div>

        <!-- Logo -->
        <a class="logo-container" href="<?= esc_url( home_url( '/' ) ); ?>">
			<img src="<?= of_get_option( 'logo' );?>" alt="ak producciones logo" class="logo">
        </a>
        
        <!--------- Main container --------->
        <div class="center-container-row">

            <!------- Info cotainer -------->
            <div class="container-info">

                <!-------- Info Contenido -------->
                <div class="info">
                    <h4 class="white-text header-bold header"><?= __( '¿Cómo inscribirse?', 'onepage-theme' ); ?></h4>

                    <div class="white-text sub-header">
                        <span class="white-text txt-bold">
                            <?= __( 'Las inscripciones a nuestros cursos y talleres se <br> realizan on-line siguiendo los siguientes pasos.', 'onepage-theme' ); ?>
                        </span>
                    </div>

                    <!------- list ------->
                    <div class="list">

                        <ul>
                            <li>
                                <span class="white-text txt-bold">1</span>
                                <p class="white-text xs-txt-med">
                                    <?= __( 'Verifique las fechas y horarios ofertados en la sección ', 'onepage-theme' ); ?>
                                    <?php $sections = of_get_option( 'parallax_section' ); ?>

                                    <?php if( !empty( $sections ) ): ?>
                                        
                                        <?php foreach( $sections as $section ): ?>
                                            
                                            <?php extract( $section ); ?>
                                            
                                            <?php
                                                switch ($layout):
                                                    
                                                    case 'academy_template':
                                                        echo "<a href=" . get_permalink( $page ) . " class=\"link xs-txt-bold\">" . __( 'Academia.', 'onepage-theme' ) . "</a>";
                                                    break;
                                                    
                                                    default:
                                                    break;
                                                    
                                                endswitch;
                                            ?>           
                                    
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </p>
                            </li>
                            <li>
                                <span class="white-text txt-bold">2</span>
                                <p class="white-text xs-txt-med">
                                    <?= __( 'Deposite o transfiera el costo correspondiente a la opción académica de <br>su interés a nuestras cuentas bancarias.', 'onepage-theme' ); ?>
                                </p>
                            </li>
                            <li>
                                <span class="white-text txt-bold">3</span>
                                <p class="white-text xs-txt-med">
                                    <?= __( 'Formalice su inscripción rellenando el formulario que se presenta a <br>continuación, una vez completado el formulario presione enviar.', 'onepage-theme' ); ?>
                                </p>
                            </li>
                        </ul>

                    </div>
                    <!------- *list* ------->

                    <div class="form-link">

                        <span class="white-text txt-bold">
                            <?= __( 'Haz', 'onepage-theme' ); ?>
                            <span class="link-container-1">
                                <a href="javascript:;" data-fancybox data-src="#inscription-form" class="show-link txt-bold" data-options='{"touch" : false}'>
                                    <?= __( 'click aquí', 'onepage-theme' ); ?>
                                </a>
                            </span>
                            <?= __( ' para rellenar el formulario de inscripción.', 'onepage-theme' ); ?>
                        </span>
                    </div>

                </div>
                <!-------- **Info Contenido** -------->

                <!------- Box info -------->
                <div class="info-box">

                    <!------- back link -------->
                    <div id="go-back">
                        <svg class="svg-xs" data-src="<?= get_template_directory_uri(); ?>/public/images/icons/arrow_left.svg"></svg>
                        <a href="javascript:history.back()" class="back-link show-link txt-bold"><?= __( 'Ir atrás', 'onepage-theme' ) ?></a>
                    </div>
                    <!-------- **back link** -------->

                    <div class="box-head">
                        <span class="white-text txt-bold"><?= __( 'Datos', 'onepage-theme' ); ?></span>
                    </div>
                    
                    <div class="box-body">
                    
                        <!------- Content ------->
                        <div class="box-content">
                            <p class="white-text xs-txt-med">
                                <?= of_get_option( 'titular_transferencia' ); ?>
                                <br>
                                <?= "C.I. " . of_get_option( 'document_transferencia' ); ?>
                                <br>
                                <?= of_get_option( 'mail_transferencia' ); ?>
                            </p>
                            <div class="sm-txt-bold">
                                <?= apply_filters( 'the_content', of_get_option('cuentas_transferencia') );?>
                            </div>
                        </div>
                        <!----- **Content** ----->
                    </div>
                </div>
                <!------- **Box info** -------->

                <!------- responsive submit btn -------->

                <div class="submit-container responsive-submit-btn">
                    <button type="submit" data-fancybox data-src="#inscription-form" class="standard-btn">
                        <span class="btn-content"><?= __( 'Rellenar formulario', 'onepage-theme' ) ?></span>
                    </button>
                </div>

                <!------- **responsive submit btn** -------->

                <!------- responsive back btn -------->

                <div class="back-btn">
                    <div class="contact-btn">
                        <a href="javascript:history.back()" class="btn-content">
                            <?= __( 'Ir atrás', 'onepage-theme' ) ?>
                        </a>
                    </div>
                </div>
                <!------- **responsive back btn** -------->

            </div>
            <!-------- **Info cotainer** -------->

        </div>
        <!-------- **Main container** --------->
    </section>

    <!--form login-->
    <div style="display: none;" id="inscription-form">
        <section class="layout-center">

            <a href="<?= esc_url( home_url( '/' ) ); ?>" class="logo-container">
                <img src="<?= of_get_option( 'logo' );?>" alt="ak producciones logo" class="logo">
            </a>                                  
        
            <div class="bg-high-color-gray"></div>

            <!--------- Main container --------->
            <div class="center-container-row">
                
                <!------- Info cotainer -------->
                <div class="container-info">
                                                
                    <h3 class="form-header white-text header-bold header"><?= __( 'Inscripción', 'onepage-theme' ); ?></h3>

                    <div class="form-container" id="ak-form">
                        <!-- Alert -->
                        <div class="wrap-alert">
                            <div class="alert">
                                <span class="closebtn">&times;</span>
                                <strong class="content"></strong>
                            </div>
                        </div>
                        <div class="form-wrapper">
                            
                            <div class="form-column" id="left">
                                <label for="name" class="input-container">
                                    <input type="text" name="name" id="name" placeholder="&nbsp;">
                                    <span class="label sm-txt-bold"><?= __( 'Nombre y Apellido (*)', 'onepage-theme' ); ?></span>
                                    <span class="border"></span>
                                </label>

                                <label for="email" class="input-container">
                                    <input type="text" name="email" id="email" placeholder="&nbsp;">
                                    <span class="label sm-txt-bold"><?= __( 'Correo Electrónico (*)', 'onepage-theme' ); ?></span>
                                    <span class="border"></span>
                                </label>

                                <label for="monto" class="input-container">
                                    <input type="text" name="monto" id="monto" class="thousand-sep"
                                        placeholder="&nbsp;" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    <span class="label sm-txt-bold"><?= __( 'Monto Pagado (*)', 'onepage-theme' ); ?></span>
                                    <span class="border"></span>
                                </label>

                                <label for="banco" class="input-container">
                                    <input type="text" name="banco" id="banco" placeholder="&nbsp;">
                                    <span class="label sm-txt-bold"><?= __( 'Nombre del banco al que pago (*)', 'onepage-theme' ); ?></span>
                                    <span class="border"></span>
                                </label>
                            </div>

                            <div class="form-column" id="right">
                                <label for="id" class="input-container">
                                    <input type="text" name="id" id="id" class="thousand-sep"
                                        placeholder="&nbsp;">
                                    <span class="label sm-txt-bold"><?= __( 'Cédula de Identidad (*)', 'onepage-theme' ); ?></span>
                                    <span class="border"></span>
                                </label>

                                <label for="curso" class="input-container">
                                    <select name="curso" id="curso" required>
                                        <option value="" disabled selected hidden><?= __( 'Seleccione un curso...', 'onepage-theme' ); ?></option>

                                            <?php
                                                $content = new WP_Query( array(
                                                    'order' => 'ASC',
                                                    'posts_per_page' => '10',
                                                    'post_type' => 'lb_courses'
                                                ));
                                            ?>

                                            <?php if ( $content->have_posts() ): ?>

                                                <?php while( $content->have_posts() ): ?>
                                    
                                                    <?php $content->the_post(); ?>

                                                    <?php $post = get_post( get_the_ID() ); ?>

                                                    <option value="<?= $post->post_name; ?>"><?= get_the_title(); ?></option>

                                                <?php endwhile; ?>

                                            <?php endif; ?>
                                    </select>
                                    <span class="label sm-txt-bold"><?= __( 'Curso o Taller pagado (*)', 'onepage-theme' ); ?></span>
                                    <span class="border"></span>
                                    <i class="fas fa-caret-down arrow-select"></i>
                                </label>

                                <label for="deposito" class="input-container">
                                    <input type="text" name="deposito" id="deposito" placeholder="&nbsp;"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                    <span class="label sm-txt-bold"><?= __( 'Número de Depósito o Transferencia (*)', 'onepage-theme' ); ?></span>
                                    <span class="border"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    
                    <div class="submit-container">
                        <button type="submit" class="standard-btn submit-btn">
                            <span class="btn-content"><?= __( 'Enviar', 'onepage-theme' ); ?></span>
                        </button>
                    </div>

                </div>

            </div>

        </section>
    </div>
</main>
<!--unique javascript of the page-->
<script>
    /*code for adding the thousand separator*/
    var $form = $("#ak-form");
    var $input = $form.find(".thousand-sep");

    $input.on("keyup", function (event) {
        var selection = window.getSelection().toString();
        if (selection !== '') {
            return;
        }

        if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
            return;
        }

        var $this = $(this);
        var input = $this.val();

        var input = input.replace(/[\D\s\._\-]+/g, "");

        input = input ? parseInt(input, 10) : 0;

        $this.val(function () {
            return (input === 0) ? "" : input.toLocaleString("es-VE");
        });
    });
</script>