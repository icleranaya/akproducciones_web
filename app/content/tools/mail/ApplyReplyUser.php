<?php
$body_content = '
	margin:0 auto;
	border-collapse:collapse;
	border-spacing:0;
	float:none;
	margin:0 auto;
	padding:0;
	text-align:center;
	vertical-align:top;
	width:580px;
';

$td_body = '
	margin:0;
	border-collapse:collapse!important;
	color:#0a0a0a;
	font-family:Helvetica,Arial,sans-serif;
	font-size:16px;
	font-weight:400;
	line-height:1.3;
	margin:0;
	padding:0;
	text-align:left;
	vertical-align:top;
	word-wrap:break-word;
';

$body_2 = '
	border-collapse:collapse;
	border-spacing:0;
	display:table;
	padding:0;
	text-align:left;
	vertical-align:top;
	width:100%;
';

$th_1 = '
	margin:0 auto;
	color:#0a0a0a;
	font-family:Helvetica,Arial,sans-serif;
	font-size:16px;
	font-weight:400;
	line-height:1.3;
	margin:0 auto;
	padding:0;
	text-align:left;
	width:564px;
';

$content = '
	margin:0;
	font-family:Helvetica,Arial,sans-serif;
	font-weight: 600;
	font-size:24px;
	color:#6c6c6c;
	line-height:1.3;
	margin:0;
	padding:0 1.1%;
	text-align:center;

';

$body = '
	border-collapse:collapse; 
	border-spacing:0; 
	padding:0; 
	text-align:left; 
	vertical-align:top; 
	width:100%;
	background: #fff;
	margin: 3% 0;
	border-radius:0.1rem;
';

$content_2 = '
	margin:0;
	color:#0a0a0a;
	font-family:Helvetica,Arial,sans-serif;
	font-size:16px;
	font-weight:400;
	line-height:1.3;
	margin:0;
	padding:0 3%;
	text-align:center;
	background: #fff;
';?>

<?php // Content for template email ?>
<!-- Table Content -->
<table align="center" class="x_container x_float-center" style="<?= $body_content; ?>">
    <tbody>
        <tr style="padding:0; text-align:left; vertical-align:top">
            <td style="<?= $td_body; ?>">

                <!-- Second Table Content -->
                <table class="x_row" style="<?= $body_2; ?>">
                    <tbody>
                        <tr style="padding:0; text-align:left; vertical-align:top">
                            <th class="x_small-12 x_large-12 x_columns x_first x_last" style="<?= $th_1; ?>">
                                
                                <!-- Header Content -->
                                <table style="<?= $body; ?>">
                                    <tbody>
                                        <tr style="padding:0; text-align:center; vertical-align:top;">
                                            <th style="<?= $content; ?>">
                                                <p><?= __( "¡Saludos {$findname}!", "onepage-theme" ); ?></p>
                                                <p style="font-size:18px;font-weight: 400;"><?= __( "Hemos recibido tu solicitud de inscripción para uno de nuestros cursos.", "onepage-theme" ) ?></p>
                                                <p style="font-size:18px;font-weight: 400;"><?= __( "A continuación se mostrara la información de la solicitud.", "onepage-theme" ) ?></p>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- /End Header Content -->

                                <!-- Content -->
                                <table style="<?= $body; ?>">
                                    <tbody>
                                        <tr style="padding:0; text-align:left; vertical-align:top;margin:5px 0!important;">
                                            <th style="<?= $content_2; ?>">
                                                <!-- Template Content -->
                                                <p>
                                                    <table style="border-collapse: collapse; color: #212529;background-color: #fff;" cellspacing="1" bgcolor="#cccccc" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= __( "Nombre y Apellido", "onepage-theme" ); ?></th>
																<th align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= __( "Correo", "onepage-theme" ) ?></th>
																<th align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= __( "C.I.", "onepage-theme" ) ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= $findname; ?></td>
																<td align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= $correo; ?></td>
																<td align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= $ci; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </p>
                                                <!-- /End Template Content -->
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
								<!-- /End Content -->

								<!-- Content 2 -->
                                <table style="<?= $body; ?>">
                                    <tbody>
                                        <tr style="padding:0; text-align:left; vertical-align:top;margin:5px 0!important;">
                                            <th style="<?= $content_2; ?>">
                                                <!-- Template Content -->
                                                <p>
                                                    <table style="border-collapse: collapse; color: #212529;background-color: #fff;" cellspacing="1" bgcolor="#cccccc" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= __( "Curso", "onepage-theme" ); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= $curso; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </p>
                                                <!-- /End Template Content -->
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- /End Content 2 -->
								
								<!-- Content 3 -->
                                <table style="<?= $body; ?>">
                                    <tbody>
                                        <tr style="padding:0; text-align:left; vertical-align:top;margin:5px 0!important;">
                                            <th style="<?= $content_2; ?>">
                                                <!-- Template Content -->
                                                <p>
                                                    <table style="border-collapse: collapse; color: #212529;background-color: #fff;" cellspacing="1" bgcolor="#cccccc" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= __( "Banco", "onepage-theme" ); ?></th>
																<th align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= __( "Referencia", "onepage-theme" ) ?></th>
																<th align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= __( "Monto", "onepage-theme" ) ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= $banco; ?></td>
																<td align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= $deposito; ?></td>
																<td align="center" style="border-bottom: 2px solid #e9ecef;padding: .75rem;vertical-align: top;border-top: 1px solid #e9ecef;"><?= $monto; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </p>
                                                <!-- /End Template Content -->
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- /End Content 3 -->
                            </th>
                        </tr>
                    </tbody>
                </table>
                <!-- /End Second Table Content -->
            </td>
        </tr>
    </tbody>
</table>
<!-- /End Table Content -->