/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {

	// Loads the color pickers
	$('.of-color').wpColorPicker();

	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	// Loads tabbed sections if they exist
	if ( $('.tab-links').length > 0 ) {
		options_framework_tabs();
	}

	function options_framework_tabs() {

		var $group = $('.group'),
			$navtabs = $('.tab-links a'),
			active_tab = '';

		// Hides all the .group sections to start
		$group.hide();

		// Find if a selected tab is saved in localStorage
		if ( typeof(localStorage) != 'undefined' ) {
			active_tab = localStorage.getItem('active_tab');
			// console.log( active_tab );
		}

		// If active tab is saved and exists, load it's .group
		if ( active_tab != '' && $(active_tab).length ) {
			$(active_tab).fadeIn();
			$(active_tab + '-tab').addClass('tab-active');
		} else {
			$('.group:first').fadeIn();
			$('.tab-links a:first').addClass('tab-active');
		}

		// Bind tabs clicks
		$navtabs.click(function(e) {

			e.preventDefault();

			// Remove active class from all tabs
			$navtabs.removeClass('tab-active');

			$(this).addClass('tab-active').blur();

			if (typeof(localStorage) != 'undefined' ) {
				localStorage.setItem('active_tab', $(this).attr('href') );
			}

			var selected = $(this).attr('href');

			$group.hide();
			$(selected).fadeIn();

		});
	}

	$('#enable_parallax').click(function() {
  		$('#section-sticky_header').fadeToggle(400);
	});

	if ($('#enable_parallax:checked').val() == undefined) {
		$('#section-sticky_header').show();
	}

	$( "#section-parallax_section .controls" ).sortable({
		axis: "y"
	});

	$( "#sub-option-inner" ).disableSelection();

	$(document).on('click', '.section-toggle', function(){
		$(this).parent('.title').next('.sub-option-inner').slideToggle();
	});

	$('.parallax_section_page').on('change',function(){
		var sled = $(this).find("option:selected").text();
		$(this).parents('.sub-option').find('.title span').text(sled);
	}).change();

	$(document).on('click','.remove-parallax', function(){
		var $this = $(this);
		$this.parents('.sub-option').slideUp(800);
		setTimeout( function() {
      	$this.parents('.sub-option').remove();
		},750 );
	});

	$('#section-parallax_section .of-section-layout').each(function() {
        var IntlayoutValue = $(this).val();
        if (IntlayoutValue == 'demo_template' || IntlayoutValue == 'demo_template' ) {
            $(this).parents('.sub-option-inner').find('.toggle-category').show();
        } else {
            $(this).parents('.sub-option-inner').find('.toggle-category').hide();
        }
    });

    $(document).on('change', '.of-section-layout', function() {
        var layoutValue = $(this).val();
        if (layoutValue == 'demo_template' || layoutValue == 'demo_template' ) {
            $(this).parents('.sub-option-inner').find('.toggle-category').fadeIn();
        } else {
            $(this).parents('.sub-option-inner').find('.toggle-category').fadeOut();
        }
    });
    
	$('.title-update.text-left').click(function(){
        $('.feature-img').slideToggle();
    });
});