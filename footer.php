<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #home div and all content after.
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link https://prismaagencia.com/
 * @author URI: https://gitlab.com/prisma_web
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>
        <?php wp_footer(); ?>
        <script>
            $(document).ready(function() {
				
				if(window.location.protocol != 'https:') {
					location.href = location.href.replace("http://", "https://");
				}
			});
            
            /* fancybox */
            $("[data-fancybox]").fancybox({
                animationEffect: "fade",
                animationDuration: 950
            });

            $(document).ready(function() {
	
                setTimeout(function(){
                    $('body').removeClass('charge');
                    $('body').addClass('loaded');
                }, 3000);
                
            });

            var URLactual = window.location;

            $( ".navigation-menu .menu-item" ).each(function() {
                if ( URLactual.href === $( this ).find(".menu-link").attr("href") ) {
                    $(this).addClass("menu-link-active");
                }
            });

            $( ".menu-navigation-responsive .menu-item" ).each(function() {
                if ( URLactual.href === $( this ).find(".menu-link").attr("href") ) {
                    $(this).addClass("active-menu-item");
                }
            });

            /* initialize wowjs */
            new WOW().init();
            
            /* svg injector */
            new SVGInjector().inject(document.querySelectorAll('svg[data-src]'));

            /* hamburger menu code */
            $(".hamburger-menu").on("click", function(){
                if(!$(".hamburger-menu").hasClass('is-active')){
                    $(".hamburger-menu").addClass('is-active');
                }else{
                    $(".hamburger-menu").removeClass('is-active');
                }

                if(!$("header").hasClass('menu-active')){
                    $("header").addClass('menu-active');
                }else{
                    $("header").removeClass('menu-active');
                }

                if(!$(".responsive-nav-container").hasClass('active-responsive-menu') && !$(".mobile-social-media-container").hasClass('active-responsive-menu')){
                    $(".responsive-nav-container, .mobile-social-media-container").addClass('active-responsive-menu');
                    $(".responsive-nav-container, .mobile-social-media-container").css("visibility", "visible");
                    $(".responsive-nav-container, .mobile-social-media-container").css("opacity", "1");
                    $(".responsive-nav-container, .mobile-social-media-container").css("transition-delay", "0.2s");
                }else{
                    $(".responsive-nav-container, .mobile-social-media-container").removeClass('active-responsive-menu');
                    $(".responsive-nav-container, .mobile-social-media-container").css("opacity", "0");
                    $(".responsive-nav-container, .mobile-social-media-container").css("visibility", "hidden");
                    $(".responsive-nav-container, .mobile-social-media-container").css("transition-delay", "0s");
                }
            });
            /* end hamburger code */

            /* table tab code */

            $(".tab-link a").on("click", function(e) {
                e.preventDefault();
                var hash = $(this).attr('href');
                // window.location.hash = 'tab' + hash.replace('#', '');
                
                if ($(this).hasClass("tab-active")) { //detection for current tab
                    return;
                } else {
                    $(".tab-content > .ak-table").hide();
                    $(".tab-link a").removeClass("tab-active");
                    $(this).addClass("tab-active"); // Activate this
                    $(hash).fadeIn(); // Show content for current tab
                }
            });

            $(".tab-links .tab-link:first-child a").trigger('click'); // Activate first tab

            // if(window.location.hash != ''){
            //     $('.tab-link a[href="'+window.location.hash.replace('tab', '')+'"]').trigger('click');
            // }

            //style for the tables
            $(document).ready(function() {
                var hg = $('.tbl-header').height();

                $('.tbl-content').css({'height': 'calc(100% - ' + hg + 'px)'});
            });

        </script>
    </body>
</html>