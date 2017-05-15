<?php
/*
 * main site Pricing table - to be used as a true template part
 */
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
			<a class="pricing-cta edd-submit button blue" href="<?php echo get_theme_mod( 'eddwp_download_core' ); ?>"><i class="fa fa-cloud-download"></i>Download for FREE</a>
		</div>
	</div>

	<div class="starter-package-column pricing-table-column flex-four">
		<div class="column-heading enhanced-dark">
			Starter Package
		</div>
		<div class="column-content">
			<div class="column-price">
				<span class="option-price-title">Packages as low as</span>
				<span class="option-price">$108<span class="option-price-sub">.50</span><span class="option-price-asterisk">&#42;</span></span>
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
			<a class="pricing-cta edd-submit button blue" href="<?php echo home_url( '/starter-package/' ); ?>"><i class="fa fa-cogs" aria-hidden="true"></i>Build custom package</a>
		</div>
	</div>

	<div class="core-bundle-column pricing-table-column flex-four">
		<div class="column-heading enhanced">
			Core Bundle
		</div>
		<div class="column-content">
			<div class="column-price">
				<span class="option-price-title">Unlimited license activations</span>
				<span class="option-price">$799<span class="option-price-sub">.00</span><span class="option-price-asterisk">&#42;</span></span>
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
			<a class="pricing-cta edd-submit button darkblue" href="<?php echo home_url( '/downloads/core-extensions-bundle/' ); ?>"><i class="fa fa-eye" aria-hidden="true"></i>Review bundle details</a>
		</div>
	</div>

	<div class="a-la-carte-column pricing-table-column flex-four">
		<div class="column-heading">
			À la carte
		</div>
		<div class="column-content">
			<div class="column-price">
				<span class="option-price-title">Extensions starting from</span>
				<span class="option-price">$19<span class="option-price-sub">.00</span><span class="option-price-asterisk">&#42;</span></span>
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
			<a class="pricing-cta edd-submit button blue" href="<?php echo home_url( '/downloads/' ); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Browse all extensions</a>
		</div>
	</div>
</div>
<div class="pricing-table-notes">
	<p>&#42; Easy Digital Downloads is a <strong>FREE</strong>, full-featured eCommerce plugin. "Extensions" are additional, <em>optional</em> WordPress plugins that <em>extend the functionality</em> of Easy Digital Downloads. While some extensions are free, the Starter Package, Core Bundle, and most of our à la carte options require a fee for licensing and support.</p>
</div>