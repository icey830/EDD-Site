/**
 * theme JS
 */
(function ($) {
	"use strict";

	$(function () {


		// Simple Notices remove notice
		$('.remove-notice').on('click', function() {
			$('#notification-area').slideUp();
			$('html').animate({
				'margin-top' : 0
			});
		});


		// Show the sign in form
		$('.my-account').on('click', function() {
			$('#sign-in-form').toggle();
			$(this).toggleClass('current-page-item');
			return false;
		});

		$('.nav-tabs a').on('click', function(e) {
			e.preventDefault();
			$(this).tab('show');
		});


		// Pricing Options Radio Buttons
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
		$('.header i').on('click', function() {
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


		// Support Form - Email address notice
		$( "#input_14_2" ).focus(function() {
			$(this).parents( ".ginput_container" ).siblings( ".gfield_description" ).slideDown();
		});

		// New Support Form - Email address notice
		$( "#input_16_2" ).focus(function() {
			$(this).parents( ".ginput_container" ).siblings( ".gfield_description" ).slideDown();
		});

		// Click to show support form
		$( ".edd-support-ticket-link" ).on('click', function() {
			$(this).parents( ".edd-docs-link-wrap" ).siblings( ".support-docs-form-container" ).slideDown();
			$( ".ginput_container_text input" ).focus();
			return false;
		});

	});
}(jQuery));
