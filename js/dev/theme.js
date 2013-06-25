/**
 * Copyright (c) 2013, Sunny Ratilal. All Rights Reserved.
 */
(function ($) {
    "use strict";

    $(function () {
    	// Initialize animations
		$(document).scroll(function(){ initAnimations(); });
		$(document).resize(function(){ initAnimations(); });

		// Hide elements before they transiton in
		$('.featureset.feature-taxes img, .testimonial, .extensions-grid li').css({opacity: 0});

		// Initialize the video
		eddVideo();

		$('.remove-notice').on('click', function() {
			$('#notification-area').slideUp();
			$('html').animate({
				'margin-top' : 0,
			});
		});

		$('.bbp-admin-links a').wrap('<li>');

		$('.bbp-reply-header').each(function() {
			$('.bbp-admin-links', this).wrapAll('<ul>').parent().addClass('bbp-action-links-dropdown');
			$('li', this).unwrap();
		});

		// Show the sign in form
		$('.my-account').on('click', function() {
			$('#sign-in-form').toggle();
			$(this).toggleClass('current-page-item');
			return false;
		});

		// Initialize the slider on the iPhone
		if (jQuery().nivoSlider) {
			$('.iphone-inside').nivoSlider({
				effect: 'fade',
				directionNav: false,
				controlNav: false,
				pauseOnHover: false,
				afterChange: function() {
					$( '.' + 'slide-' + $(this).data('nivo:vars').currentSlide + '-text').queue(function(start) {
						this.style.webkitAnimation = 'ios-feature 4s';
						start();
					}).delay(4000).queue(function(pause) {
						this.style.webkitAnimation = 'none';
						pause();
					});
				}
			});
		}

		$('.edd_price_options label').unwrap();

        $('.edd_price_options label').each(function () {
            $(this).removeClass('selected');
            $(this).prepend('<span class="bullet" />');
        });

        $('.edd_price_options label').on('click', function () {
            $('.edd_price_options label').each(function () {
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
        });

        $('.bbp-action-links-dropdown-toggle').on('click', function() {
        	var container = $(this).parent();
        	$('.icon-caret-up, .bbp-action-links-dropdown', container).slideToggle();
        });

        if ($('.edd_price_options input').prop('checked')) {
            $('.edd_price_options input:checked').parent().addClass('selected');
        }

		// Load the video
		function eddVideo() {
	    	// Load YouTube Iframe API
			var tag = document.createElement('script');
			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			var player;

			$('#video-complete, #video-complete-inner').hide();

			$('.video-thumbnail').on('click', function(e) {
				e.preventDefault();

				$(this).parent().parent().animate({
					height: '600px'
				}, 500);

				$('#video-container').fadeIn();

				if ( ! player ) {
					player = new YT.Player('video-container', {
						width: '100%',
						height: 600,
						wmode: 'transparent',
						playerVars: { autoplay: 1, showinfo: 0, disablekb: 1, rel: 0, wmode:'transparent'},
						videoId: 'japHPcIFs4I',
						events: {
							'onStateChange': onPlayerStateChange
						}
					});
				}

				if ( player && player.playVideo ) {
					player.setPlaybackQuality('hd720');
					player.playVideo();
				}

				function onPlayerStateChange(event) {
					if(event.data === 0) {
						 $('#video-complete').show();
						 $('#video-complete-inner').fadeIn(2500);
					}
				}

				return false;
			});

			$('.replay-button').on('click', function() {
				$('#video-complete').fadeOut(2500);
				player.playVideo();
			});

			$('.close-button').on('click', function() {
				$('.hero').animate({
					height: '433px'
				}, 500);
				$('#video-container, #video-complete').fadeOut(1500);
				player.seekTo(0);
				player.pauseVideo();
			});
		};

		// Intialise and carry out the transitions
		function initAnimations() {
			// Extensions
			if ($(document).scrollTop() >= $('.feature-extensions').offset().top - $(window).height() + 400){
				$('.extensions-grid li').each(function(id) {
					var delay = 150 * parseInt(id);

					$(this).delay(delay).animate({opacity:1}, 300);
				});
			}

			// iPhone
			if ($(document).scrollTop() >= $('.feature-ios').offset().top - $(window).height() + 500){
				$('.featureset.feature-ios .iphone').addClass('iphone-animation');
			};

			// Taxes
			if ($(document).scrollTop() >= $('.feature-taxes').offset().top - $(window).height() + 500){
				$('.featureset.feature-taxes img').animate({opacity:1},500);
			};

			// Testimonials
			if ($(document).scrollTop() >= $('.feature-customers').offset().top - $(window).height() + 100){
				$('.feature-customers .testimonial').each(function(id) {
					var delay = 200 * parseInt(id);

					$(this).delay(delay).animate({opacity:1}, 300);
				});
			}
		}
    });
}(jQuery));