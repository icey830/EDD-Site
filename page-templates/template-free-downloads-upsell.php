<?php
/**
 * Template Name: Free Downloads Upsell
 *
 * Template used for the redirect page after Free Downloads is used
 */
get_header();
the_post();
?>

	<div id="free-downloads-header-area" class="free-downloads-header-area page-section-gray full-width">
		<div class="inner">
			<div class="free-downloads-header clearfix">
				<h2 class="section-title-alt">Thanks! Your download will begin momentarily.</h2>
				<div class="free-downloads-header-content">
					<p>For your personal records, you will receive a confirmation email to the address you provided. If you have  any issues with your download, please feel free to <a href="<?php echo home_url( '/support/' ); ?>">contact our support</a> for assistance. You may also use the <a href="http://docs.easydigitaldownloads.com/">documentation</a> to assist with setup and configuration. Enjoy!</p>
				</div>
				<div class="free-downloads-header-media">
				</div>
			</div>
		</div>
	</div>

	<div id="recommended-products-thanks-area" class="recommended-products-thanks-area page-section-white full-width">
		<div class="inner">
			<div class="recommended-products-thanks clearfix">
				<h2 class="section-title-alt">Don't leave just yet! There's more.</h2>
				<p class="recommended-products-thanks-intro">Based on your past activity, we've created a list of extensions that other customers found useful. Have a look! If you're just getting started, we also have a handy tool for building a <a href="<?php echo home_url( '/starter-package/' ); ?>">custom starter package</a>.</p>
				<?php
				if ( is_user_logged_in() ) :

					// adjust/readjust the returned results
					add_filter( 'edd_users_purchased_products_payments', 'eddwp_alter_purchased_products_payment_count', 10, 1 );
					$downloads = edd_get_users_purchased_products();
					remove_filter( 'edd_users_purchased_products_payments', 'eddwp_alter_purchased_products_payment_count', 10, 1 );

					if ( ! empty( $downloads ) ) {
						// list the product IDs for the returned purchases
						$purchased = array();
						foreach ($downloads as $ids) {
							$purchased[] = $ids->ID;
						}
						$ids = implode(',', $purchased);
					} else {
						// Stripe, Recurring Payments
						$ids = '167,28530';
					}

					// build Recommended Products output based on the recent free download
					// and the products from the customer's last purchase
					echo do_shortcode('[recommended_products ids="' . $ids . '" user="true" count="6"]');
				endif;
				?>
			</div>
		</div>
	</div>

<?php
get_footer();