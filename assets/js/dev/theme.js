/**
 * theme JS
 */
(function ($) {
	"use strict";

	$(function () {

		// svg fallback to png for unsupported browsers
		function svgasimg() {
			return document.implementation.hasFeature(
			"http://www.w3.org/TR/SVG11/feature#Image", "1.1");
		}

		if (!svgasimg()){
			var e = document.getElementsByTagName("img");
			if (!e.length){
			e = document.getElementsByTagName("IMG");
			}
			for (var i=0, n=e.length; i<n; i++){
			var img = e[i],
				src = img.getAttribute("src");
			if (src.match(/svgz?$/)) {
				/* URL ends in svg or svgz */
				img.setAttribute("src",
				img.getAttribute("data-fallback"));
			}
			}
		}


		// header cart quantity
		var body = $(document.body);
		var header_cart_total = $('.cart-qty');
		body.on('edd_cart_item_added',function(event, response){
			header_cart_total.html(response.cart_quantity);
		});
		body.on('edd_cart_item_removed',function(event, response){
			header_cart_total.html (response.cart_quantity);
		});

		// header call to actions
		body.on('click', '#front-page-hero .hero-primary-cta-button', function() {
			eddwp_send_ga_action( 'event', 'cta', 'download', 'Download Core' );
		});

		body.on('click', '#front-page-hero .hero-secondary-cta-link', function() {
			eddwp_send_ga_action( 'event', 'cta', 'download', 'Download Core' );
		});

		// Simple Notices remove notice
		$('.remove-notice').on('click', function() {
			$('#notification-area').slideUp();
			$('html').animate({
				'margin-top' : 0
			});
		});

		// Radio Buttons Graphics
		$('.edd_price_options label').unwrap();

		$('.edd_price_options label').each(function () {
			$(this).removeClass('selected');
			$(this).prepend('<span class="radio-button" />');
		});

		$('.edd_price_options label').on('click', function () {
			var parent = $(this).parent();
			$(parent).children().each(function () {
				$(this).removeClass('selected');
			});
			$(this).addClass('selected');
		});

		if ($('.edd_price_options input').prop('checked') || $(".edd_price_options input:checked")) {
			$('.edd_price_options input:checked').parent().addClass('selected');
		}


		// Checkbox Graphics
		$('.lists-wrap .ginput_container_checkbox label').each(function () {
			$(this).prepend('<span class="bullet" />');
		});


		// Payment Method Radio Buttons
		$('#edd-payment-mode-wrap label').each(function () {
			$(this).removeClass('selected');
			$(this).prepend('<div class="icon" />');
		});

		$('#edd-payment-mode-wrap label').on('click', function () {
			$('#edd-payment-mode-wrap label').each(function () {
				$(this).removeClass('selected');
			});
			$(this).addClass('selected');
		});

		if ($('#edd-payment-mode-wrap input').prop('checked')) {
			$('#edd-payment-mode-wrap input:checked').parent().addClass('selected');
		}


		// Load the mobile nav menu
		$('.fa.menu-toggle').on('click', function() {
			$('#primary').slideToggle();
		});

		$(window).resize(function() {
			if ($( window ).width() >= 944) {
				$('#primary').show();
			}
		});


		// Toggles
		$('.tb-toggle').each(function(){
			$(this).find('.toggle-content').hide();
		});
		$('.tb-toggle a.toggle-trigger').click(function(){
			var el = $(this), parent = el.closest('.tb-toggle');

			if( el.hasClass('active') )
			{
				parent.find('.toggle-content').hide();
				el.removeClass('active');
			}
			else
			{
				parent.find('.toggle-content').show();
				el.addClass('active');
			}
			return false;
		});


		// Checkout form login toggle
		$('.edd-checkout-show-login-form').on('click',function(e){
			e.preventDefault();
			$(this).parents( ".edd-show-login-wrap" ).siblings( "#edd_login_fields" ).show();
			$( "#edd_login_fields #edd_user_login" ).focus();
		});


		// Account page expired license toggle
		$('.expired-key-toggle').on('click',function(e){
			e.preventDefault();
			$('.toggle-keys-container').slideToggle();
			return false;
		});


		// Click to show support form
		$( ".edd-support-ticket-link" ).on('click', function() {
			$(this).parents( ".edd-docs-link-wrap" ).siblings( ".support-docs-form-container" ).slideDown();
			$( ".ginput_container_text input" ).focus();
			return false;
		});

		// Self Help Support
		// Select option to show support search form
		$( ".self-help-issue-select select" ).on('change', function() {
			$(this).parents( '.gfield' ).siblings( '.helpscout-docs' ).find('.ginput_container_text input').focus();
		});

		// Self Help Support
		// prevent support page Next button from showing after Help Scout doc search runs
		$( '.self-help-show-next-button input[type="checkbox"]' ).on('change', function () {
			var checked      = $(this).is( ':checked' );
			var gform_footer = $(this).parents( '.gform_page_fields' ).siblings( '.gform_page_footer' );
			if ( checked ) {
				gform_footer.show();
			} else {
				gform_footer.hide();
			}
		});

		// Self Help Support
		// toggle display of extended FAQ output
		$( ".self-help-support-faq-toggle" ).on('click', function(e) {
			e.preventDefault();
			$(this).siblings( ".self-help-support-faq-container" ).slideToggle();
		});

		// Self Help Support
		// Google Analytics events
		body.on('change', '.self-help-ga-trigger-start input[name="input_1"]', function() {
			eddwp_send_ga_action( 'event', 'Support', 'supportStart', 'Started Support Flow' );
		});
		body.on('click', '.self-help-resources-page .gform_next_button', function() {
			eddwp_send_ga_action( 'event', 'Support', 'supportNext', 'Started Submission' );
		});

		// Pricing page Click/Scroll effect
		$( "#see-pricing" ).click( function() {
			$( 'html, body' ).animate( {
				scrollTop: $( "#pricing-page-header-area" ).offset().top
			}, 500 );
			event.preventDefault();
		});

		// Enhanced Downloads Click/Scroll effect
		$( "#see-purchase-details" ).click( function() {
			$( 'html, body' ).animate( {
				scrollTop: $( "#download-purchase-area" ).offset().top
			}, 500 );
			event.preventDefault();
		});

	});
}(jQuery));

function eddwp_send_ga_action( type, category, action, label ) {
	if (typeof __gaTracker !== 'undefined') {
		__gaTracker('send', {
			hitType      : type,
			eventCategory: category,
			eventAction  : action,
			eventLabel   : label,
		});
	}

	return true;
}