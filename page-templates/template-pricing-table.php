<?php
/*
 * main site Pricing table - to be used as a true template part
 */


/**
 * Step 1 - determine whether or not there's a sale going on and gather information
 */
	// Is the Starter Package discount more than its usual 30%?
	if ( '30' != get_theme_mod( 'eddwp_starter_package_discount_percentage', '30' ) ) {
		$starter_package_discounted = true;
	}  else {
		$starter_package_discounted = false;
	}

	// Having a sale? Get the active discount code ID (used when we run special sales with a discount)
	$discount_code   = get_theme_mod( 'eddwp_active_discount_code', 0 );
	$discount_id     = edd_get_discount_id_by_code( $discount_code );

	// is the discount code valid?
	if ( edd_is_discount_active( $discount_id, '', false ) && edd_is_discount_started( $discount_id, false ) ) {
		$discount_valid = true;
	} else {
		$discount_valid = false;
	}

	// get the value of the active discount
	$discount_value  = absint( edd_get_discount_amount( $discount_id ) );


/**
 * Step 2 - get the original prices of all products on the table
 */
	// lowest Starter Package final price
	$sp_price_float  = 108.50;
	$sp_price        = $sp_price_float;

	// Core Extensions Bundle price
	$ceb_price_float = edd_get_download_price( 121068 );
	$ceb_price       = $ceb_price_float;

	// lowest À la carte extension price
	$alc_price_float = 19.00;
	$alc_price       = $alc_price_float;


/**
 * Step 3 - adjust prices on the table only if the sale dictates
 */
	// apply adjusted discount to Starter Package lowest price if necessary
	if ( $starter_package_discounted ) {
		// break the 30% off price down into sections of 5% (of the full value)
		$sp_one_twentieth  = $sp_price_float / 14;
		// now get what the full value would be when it isn't discounted
		$sp_price_float    = $sp_one_twentieth * 20;
		// get the adjusted discount amount
		$sp_discount_value = get_theme_mod( 'eddwp_starter_package_discount_percentage', '30' );
		// apply the adjusted discount to the full price
		$sp_discount_total = $sp_price_float * ( $sp_discount_value / 100 );
		$sp_price          = $sp_price_float - $sp_discount_total;
	}

	// break down the Starter Package lowest price (for display use)
	$sp_price_int = substr( number_format( $sp_price, 2 ), 0, -3 );
	$sp_price_dec = substr( number_format( $sp_price, 2 ), -3 );

	// apply discount to CEB & À la carte if necessary
	if ( $discount_valid ) {
		$ceb_discount_total = $ceb_price_float * ( $discount_value / 100 );
		$ceb_price          = $ceb_price_float - $ceb_discount_total;
		$alc_discount_total = $alc_price_float * ( $discount_value / 100 );
		$alc_price          = $alc_price_float - $alc_discount_total;
	}

	// break down the Core Extensions Bundle price (for display use)
	$ceb_price_int = substr( number_format( $ceb_price, 2 ), 0, -3 );
	$ceb_price_dec = substr( number_format( $ceb_price, 2 ), -3 );

	// break down the lowest À la carte extension price (for display use)
	$alc_price_int = substr( number_format( $alc_price, 2 ), 0, -3 );
	$alc_price_dec = substr( number_format( $alc_price, 2 ), -3 );
?>


<div class="pricing-table-content flex-container">
	<div class="free-column pricing-table-column flex-four">
		<div class="column-content">
			<img class="sitting-edd" src="<?php echo get_template_directory_uri(); ?>/images/mascot/edd-sitting.png" />
			<div class="column-description">
				<div class="description-header">
					Just getting started?
				</div>
				<div class="description-content">
					<p>Great! Easy Digital Downloads is a <strong>FREE eCommerce plugin</strong> for WordPress. Right out of the box, Easy Digital Downloads <span class="mobile-display-hack">includes the following </span>features:</p>
					<ul class="pricing-column-list edd-features-list">
						<li><strong>shopping cart</strong> system</li>
						<li><strong>customer management</strong> tools</li>
						<li><strong>discount codes</strong> creation</li>
						<li>detailed <strong>data reporting</strong></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="column-cta">
			<a onClick="eddwp_send_ga_action( 'event', 'pricing_page', 'download_core', 'Download Core' )" class="pricing-cta edd-submit button blue" href="<?php echo get_theme_mod( 'eddwp_download_core' ); ?>"><i class="fa fa-cloud-download"></i>Download for FREE</a>
		</div>
	</div>

	<div class="starter-package-column pricing-table-column flex-four<?php echo $starter_package_discounted ? ' active-sale-column' : ''; ?>">
		<div class="column-heading enhanced-dark">
			Starter Package
		</div>
		<div class="column-content">
			<div class="column-price">
				<span class="option-price-title">Packages as low as</span>
				<?php if ( $starter_package_discounted ) { ?>
					<span class="option-price-strike">$<?php echo number_format( $sp_price_float, 2 ); ?></span>
				<?php } ?>
				<span class="option-price">$<?php echo $sp_price_int; ?><span class="option-price-sub"><?php echo $sp_price_dec; ?></span><span class="option-price-asterisk">&#42;</span></span>
			</div>
			<div class="column-description">
				<p>Use the Starter Package to build <em>your</em> ideal eCommerce platform.</p>
				<ul class="pricing-column-list">
					<li>automatic <strong><?php echo get_theme_mod( 'eddwp_starter_package_discount_percentage', '30' ) ?>% discount</strong></li>
					<li>broad extension selection</li>
					<li>strategic purchase guidance</li>
					<li>build & save cart for later</li>
				</ul>
			</div>
		</div>
		<div class="column-cta">
			<a onClick="eddwp_send_ga_action( 'event', 'pricing_page', 'starter_package', 'Starter Package' )" class="pricing-cta edd-submit button blue" href="<?php echo home_url( '/starter-package/' ); ?>"><i class="fa fa-cogs" aria-hidden="true"></i>Build custom package</a>
		</div>
	</div>

	<div class="core-bundle-column pricing-table-column flex-four<?php echo $discount_valid ? ' active-sale-column' : ''; ?>">
		<div class="column-heading enhanced">
			Core Bundle
		</div>
		<div class="column-content">
			<div class="column-price">
				<span class="option-price-title">Unlimited license activations</span>
				<?php if ( $discount_valid ) { ?>
					<span class="option-price-strike"><?php echo edd_currency_filter( $ceb_price_float ); ?></span>
				<?php } ?>
				<span class="option-price">$<?php echo $ceb_price_int; ?><span class="option-price-sub"><?php echo $ceb_price_dec; ?></span><span class="option-price-asterisk">&#42;</span></span>
			</div>
			<div class="column-description">
				<p>Hey, agencies and freelancers. This bundle is <em>perfect</em> for client work!</p>
				<ul class="pricing-column-list">
					<li>includes all primary extensions</li>
					<li><strong>unlimited license key</strong> usage</li>
					<?php
					// how many products in the Core Extensions Bundle?
					$core_bundle = get_post_meta( 121068, '_edd_bundled_products' );
					$bundle_count = count( $core_bundle[0] );
					?>
					<li><strong><?php echo $bundle_count; ?> extensions</strong> included</li>
					<li>discounted over 75%</li>
				</ul>
			</div>
		</div>
		<div class="column-cta">
			<a onClick="eddwp_send_ga_action( 'event', 'pricing_page', 'core_extensions', 'Core Extensions Bundle' )" class="pricing-cta edd-submit button darkblue" href="<?php echo home_url( '/downloads/core-extensions-bundle/' ); ?>"><i class="fa fa-eye" aria-hidden="true"></i>Review bundle details</a>
		</div>
	</div>

	<div class="a-la-carte-column pricing-table-column flex-four<?php echo $discount_valid ? ' active-sale-column' : ''; ?>">
		<div class="column-heading">
			À la carte
		</div>
		<div class="column-content">
			<div class="column-price">
				<span class="option-price-title">Extensions starting from</span>
				<?php if ( $discount_valid ) { ?>
					<span class="option-price-strike">$<?php echo number_format( $alc_price_float, 2 ); ?></span>
				<?php } ?>
				<span class="option-price">$<?php echo $alc_price_int; ?><span class="option-price-sub"><?php echo $alc_price_dec; ?></span><span class="option-price-asterisk">&#42;</span></span>
			</div>
			<div class="column-description">
				<p>Purchase individual extensions that meet <em>your</em> business needs.</p>
				<ul class="pricing-column-list">
					<li><strong>email marketing</strong> integrations</li>
					<li>robust <strong>payment gateways</strong></li>
					<li><strong>accounting/bookkeeping</strong> tools</li>
					<li>and much, much more...</li>
				</ul>
			</div>
		</div>
		<div class="column-cta">
			<a onClick="eddwp_send_ga_action( 'event', 'pricing_page', 'browse_all', 'Browse All Extensions' )" class="pricing-cta edd-submit button blue" href="<?php echo home_url( '/downloads/' ); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Browse all extensions</a>
		</div>
	</div>
</div>
<div class="pricing-table-notes">
	<p>&#42; Easy Digital Downloads is a <strong>FREE</strong>, full-featured eCommerce plugin. "Extensions" are additional, <em>optional</em> WordPress plugins that <em>extend the functionality</em> of Easy Digital Downloads. While some extensions are free, the Starter Package, Core Bundle, and most of our à la carte options require a fee for licensing and support.</p>
</div>