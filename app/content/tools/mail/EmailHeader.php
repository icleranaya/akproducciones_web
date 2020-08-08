<?php

$table_body = '
	background:#ececec;
	margin:0;
	border-collapse:collapse;
	border-spacing:0;
	color:#0a0a0a;
	font-family:Helvetica,Arial,sans-serif;
	font-size:16px;
	font-weight:400;
	height:100%;
	line-height:1.3;
	margin:0;
	padding:0;
	text-align:left;
	vertical-align:top;
	width:100%;
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

$bg_header = '
	margin:0 auto;
	background:#7F0014;
	border-collapse:collapse;
	border-spacing:0;
	float:none;
	margin:0 auto;
	padding:0;
	text-align:center;
	vertical-align:top;
	width:100%;
';

$td_2 = '
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
?>

<?php // Header for template email ?>
<!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	    <title><?= get_bloginfo( 'name' ); ?></title>
	</head>

	<body style="margin:0;">

    	<div style="margin: 0; overflow: hidden;">

			<!-- Table body -->
			<table style="<?= $table_body; ?>">

				<!-- Tbody -->
				<tbody>

					<!-- Firts TR -->
					<tr style="padding:0; text-align:left; vertical-align:top">

						<td class="x_center" align="center" valign="top" style="<?= $td_body; ?>">

							<!-- Firt Center -->
							<center style="min-width:580px; width:100%">

								<!-- Second Table Header -->
								<table align="center" class="x_container x_float-center" style="<?= $bg_header; ?>">

									<tbody>
										<tr style="padding:0; text-align:left; vertical-align:top">
											<td style="<?= $td_2; ?>">
												
												<!-- Three Table -->
												<table class="x_row x_collapse" style="border-collapse:collapse; border-spacing:0; display:table; padding:0; text-align:left; vertical-align:top; width:100%">
													
													<tbody>
														<tr style="padding:0; text-align:left; vertical-align:top">
															<th class="x_logo-container x_small-12 x_large-12 x_columns x_first x_last" style="margin:0 auto; color:#0a0a0a; font-family:Helvetica,Arial,sans-serif; font-size:16px; font-weight:400; line-height:1.3; margin:0 auto; padding:0; padding-bottom:10px; padding-left:0; padding-right:0; padding-top:5px; text-align:left; width:588px">
																
																<!-- Four Table -->
																<table style="border-collapse:collapse; border-spacing:0; padding:0; text-align:left; vertical-align:top; width:100%">
																	<tbody>
																		<tr style="padding:0; text-align:left; vertical-align:top">
																			<th style="margin:0; color:#0a0a0a; font-family:Helvetica,Arial,sans-serif; font-size:16px; font-weight:400; line-height:1.3; margin:0; padding:0; text-align:left">
																				<center style="min-width:532px; width:100%; display: flex;">
																					<img src="<?= of_get_option( 'logo' ); ?>" class="x_logo x_float-center" alt="" align="center" style="width: 5rem; height: 3rem; margin-left: 7rem; margin-top: 1.5rem;">
																					<span style="margin: 0; color:#ffffff; margin-left: 2rem; font-size: 2rem;line-height: 2.3;margin-top: 1.5rem;"><?= __( "Nueva solicitud de inscripción.", "onepage-theme" );?></span>
																				</center>
																			</th>
																		</tr>
																	</tbody>
																</table>
																<!-- /End Four Table -->
															</th>
														</tr>
													</tbody>
												</table>
												<!-- /End Three Table -->
											</td>
										</tr>
									</tbody>
								</table> 
								<!-- /End Second Table Header -->