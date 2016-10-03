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
			$(this).prepend('<span class="bullet" />');
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


		// mod action links for bbPress topics
		$('.bbp-action-links-dropdown-toggle').on('click', function() {
			var container = $(this).parent();
			$('.fa-caret-up, .bbp-action-links-dropdown', container).slideToggle();
		});


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


		// Account page expired license toggle
		$('.expired-key-toggle').on('click',function(e){
			e.preventDefault();
			$('.toggle-keys-container').slideToggle();
		});


		// Support
		$('#wp-admin-bar-assigned_tickets').click(function(){
			$('#TB_overlay, #TB_window').toggle();
			return false;
		});

		$('#TB_overlay').click(function() {
			$('#TB_overlay, #TB_window').toggle();
			return false;
		});


		// Forums
		$('#bbp-forum-289 .bbp-forum-title').on('click', function() {
			$('.bbp-forums-list', this.parent).slideToggle();
			return false;
		});

		$('#bbp-forum-3560 .bbp-forum-title').on('click', function() {
			$('#bbp-forum-3560 .bbp-forums-list', this.parent).slideToggle();
			return false;
		});

		// Click to show support form
		$( ".edd-support-ticket-link" ).on('click', function() {
			$(this).parents( ".edd-docs-link-wrap" ).siblings( ".support-docs-form-container" ).slideDown();
			$( ".ginput_container_text input" ).focus();
			return false;
		});

	});
}(jQuery));
