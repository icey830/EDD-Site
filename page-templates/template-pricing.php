<?php
/**
 * Template Name: Pricing
 *
 * the template for displaying EDD pricing information
 */

get_header();

// get the active discount code ID (used when we run special sales with a discount)
$discount_code   = get_theme_mod( 'eddwp_active_discount_code', 0 );
$discount_id     = edd_get_discount_id_by_code( $discount_code );
?>

<div id="pricing-page-header-area" class="page-section-white full-width">
	<div class="inner">
		<div class="pircing-page-header-content">
			<h1>Build your store, your way</h1>
			<p>Use Easy Digital Downloads and its extensions to meet your online business needs.</p>
		</div>
	</div>
</div>

<div id="pricing-table-area" class="page-section-white full-width">
	<div class="inner">
		<?php
		// is there currently a sale?
		if ( edd_is_discount_active( $discount_id, '', false ) && edd_is_discount_started( $discount_id, false ) ) {
			?>
			<div class="pricing-page-sale-notice-wrap">
				<span class="pricing-page-sale-notice">Use the code <span><?php echo $discount_code; ?></span> at checkout to save <?php echo edd_get_discount_amount( $discount_id ); ?>% on your purchase!</span>
			</div>
			<?php
		}
		?>
		<?php get_template_part( 'page-templates/template', 'pricing-table' ); ?>
		<h2 class="section-title-alt">Pricing and licensing FAQs</h2>
		<div class="features-grid-content-sections flex-container">
			<div class="edd-feature flex-two">
				<h4>Do I have to purchase additional extensions?</h4>
				<p>No. Extensions are entirely optional but do help to dramatically extend the functionality of your eCommerce store. Analyze the needs of your business to decide whether or not you need additional functionality.</p>
			</div>
			<div class="edd-feature flex-two">
				<h4>Do I have to pay extra for support?</h4>
				<p>Easy Digital Downloads support is free for all users. You may open a <a href="<?php echo home_url( '/support/' ); ?>">support ticket</a> at any time. Extension support, however, requires a valid extension license key. License keys are issued at the time of purchase.</p>
			</div>
			<div class="edd-feature flex-two">
				<h4>Will Easy Digital Downloads and its extensions work with WordPress.com?</h4>
				<p>Yes. However, you must have a Business plan with WordPress.com, which supports third-party plugins. If you do not have a Business plan, Easy Digital Downloads and its extensions cannot be used.</p>
			</div>
			<div class="edd-feature flex-two">
				<h4>What are the license keys used for?</h4>
				<p>License keys simply connect your site to ours, allowing us to send you automatic updates if your license key is in good standing. Likewise, we provide extension support for valid license key holders.</p>
			</div>
			<div class="edd-feature flex-two">
				<h4>Do license keys restrict extension functionality?</h4>
				<p>Absolutely not. Your extensions will work as expected whether you have your license keys activated or not. You are encouraged to test extensions on your staging site without activating license keys.</p>
			</div>
			<div class="edd-feature flex-two">
				<h4>How many sites can I activate my license key on?</h4>
				<p>Premium extensions can be purchased for single site, 2 - 5 sites, or unlimited sites, which determines your license key activation limit. You may deactivate a license key and move it to another site at any time.</p>
			</div>
			<div class="edd-feature flex-two">
				<h4>What happens if I do not renew my license?</h4>
				<p>License keys are subscription-based and will <em>automatically</em> renew every year. If you decide to cancel, you may still use the extension but you will not receive updates or support once the license key expires.</p>
			</div>
			<div class="edd-feature flex-two">
				<h4>How are product bundles licensed?</h4>
				<p>Our <a href="<?php echo home_url( '/downloads/all-access-pass/' ); ?>">All Access Pass</a> comes with unlimited license keys for all included extensions. Other product bundles, as well as the <a href="<?php echo home_url( '/starter-package/' ); ?>">Starter Package</a>, come with single site license keys for included extensions.</p>
			</div>
			<div class="edd-feature flex-two">
				<h4>Can I request a refund?</h4>
				<p>You are more than welcome to request a refund within 30 days of purchasing your license keys. However, no refunds are allowed on the All Access Pass. View full <a href="<?php echo get_theme_mod( 'eddwp_terms_link' ); ?>">terms and conditions</a>.</p>
			</div>
		</div>

		<div class="large-call-to-action-content clearfix">
			<h2 class="large-call-to-action-title">Looking forward to building with Easy Digital Downloads?</h2>
			<div class="large-call-to-action-cta-link">
				<a id="see-pricing" class="edd-submit button blue" href="#pricing-page-header-area"><i class="fa fa-cloud-download" aria-hidden="true"></i>Get started today!</a>
			</div>

			<p class="large-call-to-action-secondary-links">
				<span>or ask a <a href="<?php echo home_url( '/support/' ); ?>">pre-sale question</a></span>
			</p>
		</div>
	</div>
</div>

<?php get_footer(); ?>
