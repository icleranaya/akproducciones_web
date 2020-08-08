<?php
$class_footer = '
	margin:0 auto;
	background:#000000;
	border-collapse:collapse;
	border-spacing:0;
	float:none;
	margin:0 auto;
	padding:0;
	text-align:center;
	vertical-align:top;
	width:100%;
';
$td_footer = '
	margin:0;
	border-collapse:collapse!important;
	color:#0a0a0a;
	font-family:Helvetica,Arial,sans-serif;
	font-size:16px;
	font-weight:400;
	line-height:1.3;
	margin:0;
	padding:3% 0;
	text-align:left;
	vertical-align:top;
	word-wrap:break-word;
';
?>

<?php // Footer for template email?>
							<!-- Table Footer -->
							<table align="center" class="x_container x_footer x_float-center" style="<?= $class_footer; ?>">
                            
								<tbody>
									<tr style="padding:0; text-align:left; vertical-align:top">
										<td style="<?= $td_footer; ?>">

											<center style="min-width:580px; width:100%">
							
												<a href="<?= esc_url( home_url( '/' ) ); ?>" target="_blank" style="text-decoration: none; color: #fff; font-weight: 600; margin-bottom: 10px;">
												<?php
	
													$name_blog_footer = get_bloginfo( 'name' );
													$name_blog_footer = strtolower( $name_blog_footer );
													$name_blog_footer = str_replace( " ", "", $name_blog_footer );
													$blog_url = "www.{$name_blog_footer}ca.com"; 
													echo $blog_url;
												
												?>
												</a>
							
												<span class="x_text-center x_float-center" align="center" style="color: rgb(255, 255, 255) !important;
													display: block;
													text-align: center;
													width: 100%;
													font-family: Helvetica, Arial, sans-serif, serif, EmojiFont;
													padding-top: 10px;
													text-decoration: none !important;">
													<a href="mailto:<?= of_get_option( 'mail_contact' ); ?>" style="text-decoration: none;color: #fff"><?= of_get_option( 'mail_contact' ); ?></a>
												</span>
								
												<span class="x_text-center x_float-center" align="center" style="color: rgb(255, 255, 255);
													display: block;
													text-align: center;
													width: 100%;
													font-family: Helvetica, Arial, sans-serif, serif, EmojiFont;
													padding-top: 3%;
													font-size: .8rem;"><?= __( "Diseñado y desarrollado por ", "onepage-theme" ) ?><a href="https://prismaagencia.com/" style="text-decoration: none;color: #fff"><strong><?= __( "prismaagencia.com", "onepage-theme" ); ?></strong></a></span>
											</center>
										</td>
									</tr>
								</tbody>
							</table>
							<!-- /End Table Footer -->
						</center>
						<!-- /End Firts Center -->
					</tr>
					<!-- /End Firts TR -->
				</tbody>
				<!-- /End Tbody -->
			</table>
			<!-- /End Table body -->
		</div>

	</body>
</html>