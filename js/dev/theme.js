/**
 * Copyright (c) 2014, Sunny Ratilal. All Rights Reserved.
 */
(function ($) {
	"use strict";

	$(function () {
		var modal = (function () {
			var method = {},
				overlay,
				$modal,
				content,
				close;

			// Center the modal in the viewport
			method.center = function () {
				var top, left;

				top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
				left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;

				$modal.css({
					top:top + $(window).scrollTop(),
					left:left + $(window).scrollLeft()
				});
			};

			// Open the modal
			method.open = function (settings) {
				content.empty().append(settings.content);

				$modal.css({
					width: settings.width || 'auto',
					height: settings.height || 'auto'
				});

				method.center();
				$(window).bind('resize.modal', method.center);
				$modal.fadeIn();
				overlay.fadeIn();
			};

			// Close the modal
			method.close = function () {
				$modal.fadeOut();
				overlay.fadeOut(500, function() {
					content.empty();
				});
				$(window).unbind('resize.modal');
			};

			// Generate the HTML and add it to the document
			overlay = $('<div id="modal-overlay"></div>');
			$modal  = $('<div id="modal"></div>');
			content = $('<div id="content"></div>');
			close   = $('<a id="modal-close" href="#"><i class="fa fa-times-circle-o"></i></a>');

			$modal.hide();
			overlay.hide();
			$modal.append(content, close);

			$('body').append(overlay, $modal);

			close.click(function(e){
				e.preventDefault();
				method.close();
			});

			return method;
		}());

		$('.theme-purchase').on('click', function (e) {
			var data = $(this).parents('.content').find('.edd_download_purchase_form');
			modal.open({content: data });
			e.preventDefault();
		});

		// Hide elements before they transiton in
		$('.testimonial, .extensions-grid li').css({opacity: 0});

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

		// Initialize the slider on the iPhone
		if (jQuery().nivoSlider) {
			$('.iphone-inside').nivoSlider({
				effect: 'fade',
				directionNav: false,
				controlNav: false,
				pauseOnHover: false,
				afterChange: function() {
					$('.' + 'slide-' + $(this).data('nivo:vars').currentSlide + '-text').queue(function(start) {
						this.style.webkitAnimation = 'ios-feature 4s';
						start();
					}).delay(4000).queue(function(pause) {
						this.style.webkitAnimation = 'none';
						pause();
					});
				}
			});
		}

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

		$('.bbp-action-links-dropdown-toggle').on('click', function() {
			var container = $(this).parent();
			$('.fa-caret-up, .bbp-action-links-dropdown', container).slideToggle();
		});


		// Intialise and carry out the transitions
		function initAnimations() {
			if ( $('body').hasClass('home') ) {
				// Extensions
				if ($(document).scrollTop() >= $('.feature-extensions').offset().top - $(window).height() + 400) {
					$('.extensions-grid li').each(function(id) {
						var delay = 150 * parseInt(id);

						$(this).delay(delay).animate({opacity: 1}, 300);
					});
				}

				// iPhone
				if ($(document).scrollTop() >= $('.feature-ios').offset().top - $(window).height() + 500) {
					$('.featureset.feature-ios .iphone').addClass('iphone-animation');
				}

				// Testimonials
				if ($(document).scrollTop() >= $('.feature-customers').offset().top - $(window).height() + 100) {
					$('.feature-customers .testimonial').each(function(id) {
						var delay = 200 * parseInt(id);

						$(this).delay(delay).animate({opacity: 1}, 300);
					});
				}
			}
		}

		// Initialize animations
		if ($('body').hasClass('home')) {
			$(document).scroll(function() { initAnimations(); });
			$(document).resize(function() { initAnimations(); });
		}

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

		// Support Admin
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
		a( "#input_14_2" ).focus(function() {
			a(this).parents( ".ginput_container" ).siblings( ".gfield_description" ).slideDown();
		});
		
	});
}(jQuery));
