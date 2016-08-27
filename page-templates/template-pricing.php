<?php
/**
 * Template Name: Pricing
 *
 * the template for displaying EDD pricing information
 */

get_header(); ?>

<div id="edd-is-free-area" class="page-section-white full-width">
	<div class="inner">
		<div class="edd-is-free-content clearfix">
			<h2 class="section-title-alt">How much does Easy Digital Downloads cost?</h2>
			<div class="flex-container">
				<div class="edd-is-free-content flex-two">

					<p>Easy Digital Downloads is a <span class="edd-free">free</span> eCommerce plugin for WordPress. Without paying a dime, you can start building your digital store using our plugin and we won't ask for anything in return.</p>
					<p>Because we do not provide an eCommerce service, we will not take a percentage of your sales. There are no monthly fees to use the plugin.</p>
				</div>
				<div class="edd-is-free-content flex-two">

					<p>Easy Digital Downloads is hosted in the official WordPress plugin directory. You can search for it through your WordPress dashboard Plugins screen or download it now by clicking the button below.</p>
					<a class="edd-submit button blue" href="<?php echo get_theme_mod( 'eddwp_download_core' ); ?>"><i class="fa fa-cloud-download"></i>Get Easy Digital Downloads</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="extension-pricing-area" class="page-section-gray full-width">
	<div class="inner">
		<div class="extension-pricing-content clearfix">
			<h2 class="section-title-alt">Why is Easy Digital Downloads free?</h2>
			<div class="extension-pricing-description flex-container">
				<div class="flex-two">
					<p>There are several required components needed to build a complete eCommerce system. With Easy Digital Downloads, we aim to provide all of those basic components free of charge.</p>
					<p>That said, no two businesses are exactly the same. What you need for your business is not what your neighbor needs for hers. For that reason, Easy Digital Downloads was designed to support additional functionality through other WordPress plugins, referred to as add-ons.</p>
					<p>Add-ons can be things like invoicing tools, payment gateways, and much more. Though there are several free add-ons, our premium add-ons require that you purchase a license for updates and support. </p>
					<p>Individual add-ons, like Stripe Payment Gateway, are available in three license variations to fit your business needs.</p>
				</div>
				<div class="stripe-payment-gateway-wrap flex-two">
					<div class="stripe-payment-gateway-pricing">
						<div class="pricing-header">
							<h3 class="add-on-title"><a href="<?php echo home_url( '/downloads/stripe-gateway/' ); ?>">Stripe Payment Gateway</a></h3>
						</div>
						<div class="pricing-info">
							<div class="pricing">
								<?php echo edd_get_purchase_link( array( 'download_id' => 167 ) ); // Stripe ?>
							</div>
							<div class="terms clearfix">
								<p>
									<i class="fa fa-info-circle"></i>
									All price options are billed yearly. You may cancel your subscription at any time. Extensions subject to yearly license for support and updates. <a href="<?php echo get_theme_mod( 'eddwp_terms_link' ); ?>">View terms</a>.
								</p>
							</div>
						</div>
					</div>
					<span class="view-all-extensions"><a href="<?php echo home_url( '/downloads/' ); ?>">view all extensions</a></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="license-info-area" class="page-section-white full-width">
	<div class="inner">
		<div class="license-info-content clearfix">
			<h2 class="section-title-alt">License Key Frequently Asked Questions</h2>
			<div class="features-grid-content-sections flex-container">
				<div class="flex-two">
					<h4>What are the license keys used for?</h4>
					<p>License keys simply connect your site to ours, allowing us to send you automatic updates if your license is in good standing. We also provide add-on support for valid license holders.</p>
				</div>
				<div class="flex-two">
					<h4>Do license keys restrict add-on functionality?</h4>
					<p>Absolutely not. Your add-ons will work as expected whether you have your license keys activated or not. You are encouraged to test add-ons on your staging site without activating licenses.</p>
				</div>
				<div class="flex-two">
					<h4>How many sites can I activate my license on?</h4>
					<p>Premium add-ons can be purchased for single site, 2 - 5 sites, or unlimited sites, which determines your license activation limit. You may deactivate a license and move it to another site at any time.</p>
				</div>
				<div class="flex-two">
					<h4>What happens if I do not renew my license?</h4>
					<p>License keys are subscription-based, meaning your license will renew automatically every year. If you decide to cancel, you may still use the add-on but you will not receive updates or support.</p>
				</div>
				<div class="flex-two">
					<h4>How are product bundles licensed?</h4>
					<p>Our <a href="<?php echo home_url( '/downloads/core-extensions-bundle' ); ?>">Core Extensions Bundle</a> comes with unlimited licenses for all included add-ons. All other product bundles, as well as the <a href="<?php echo home_url( '/starter-package' ); ?>">Starter Package</a>, come with single site licenses for included add-ons.</p>
				</div>
				<div class="flex-two">
					<h4>Can I request a refund?</h4>
					<p>You are more than welcome to request a refund within 30 days of purchasing your licenses. However, no refunds are allow on the Core Extensions Bundle. View full <a href="<?php echo get_theme_mod( 'eddwp_terms_link' ); ?>">terms and conditions</a>.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
