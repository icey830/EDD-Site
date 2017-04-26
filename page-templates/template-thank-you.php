<?php
/**
 * Template Name: Thank You
 *
 * Template used for thanking the user for something
 */
get_header();
the_post();
?>

	<div class="gray-edd-headshot-area page-section-gray full-width">
		<div class="inner">
			<div class="gray-edd-headshot-content clearfix">
				<h2 class="section-title-alt">Thank you!</h2>
				<div class="gray-edd-headshot-text">

					<?php if ( is_page( 'free-download-thanks' ) ) { ?>

						<p>For your personal records, you will receive a confirmation email to the address you provided. If you have any issues with your download, please feel free to <a href="<?php echo home_url( '/support/' ); ?>">contact our support</a> for assistance. You may also use the <a href="http://docs.easydigitaldownloads.com/">documentation</a> to assist with setup and configuration. Enjoy!</p>

					<?php } elseif ( is_page( 'thank-you-for-subscribing' ) ) { ?>

						<p>Your subscription has been confirmed. Be sure to whitelist the <strong>support@easydigitaldownloads.com</strong> email address to make sure none of our emails go to your spam folder. Use the <em>update subscription preferences</em> link from any of our emails to manage your subscription.</p>

					<?php } ?>

				</div>
				<div class="gray-edd-headshot-media">
				</div>
			</div>
		</div>
	</div>

	<div id="recommended-products-thanks-area" class="recommended-products-thanks-area page-section-white full-width">
		<div class="inner">
			<div class="recommended-products-thanks clearfix">

				<?php if ( is_page( 'free-download-thanks' ) ) { ?>

					<h2 class="section-title-alt">Don't leave just yet! There's more.</h2>
					<p class="recommended-products-thanks-intro">Based on your past activity, we've created a list of extensions that you may find useful. Have a look! If you're just getting started, we also have a handy tool for building a <a href="<?php echo home_url( '/starter-package/' ); ?>">custom starter package</a>.</p>
					<?php echo eddwp_rp_shortcode( 6 ); ?>

				<?php } elseif ( is_page( 'thank-you-for-subscribing' ) ) { ?>



				<?php } ?>

			</div>
		</div>
	</div>

<?php
get_footer();