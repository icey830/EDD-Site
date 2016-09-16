<?php
/**
 * download sidebar (NOT widgetized... for now)
 */

$is_extension  = has_term( 'extensions', 'download_category', get_the_ID() );
$is_theme      = has_term( 'themes', 'download_category', get_the_ID() );
$is_bundle     = has_term( 'bundles', 'download_category', get_the_ID() );
$has_license   = get_post_meta( get_the_ID(), '_edd_sl_enabled', true );

$is_3rd_party  = has_term( '3rd-party', 'download_category', get_the_ID() );
$is_unlicensed = has_term( 'unlicensed', 'download_tag', get_the_ID() );
$is_wporg      = has_term( 'wporg', 'download_tag', get_the_ID() );
$developer     = get_post_meta( get_the_ID(), 'ecpt_developer', true );
$external_url  = get_post_meta( get_the_ID(), 'ecpt_externalurl', true );
$activations   = get_post_meta( get_the_ID(), 'ecpt_licenseactivations', true );

// get the download
if ( $is_extension && ! $is_bundle ) :
	$download_type = 'extension';
elseif ( $is_theme ) :
	$download_type = 'theme';
elseif ( $is_bundle ) :
	$download_type = 'bundle';
endif;
$license = get_theme_mod( 'eddwp_terms_link' );

// check for recurring pricing
$single_recurring = EDD_Recurring()->is_recurring( get_the_ID() );
$variable_pricing = edd_has_variable_prices( get_the_ID() );
$recurring = false;
if ( $variable_pricing ) {
	$get_prices = edd_get_variable_prices( get_the_ID() );
	foreach ( $get_prices as $option ) {
		if ( isset( $option['recurring'] ) && 'yes' === $option['recurring'] ) {
			$recurring = true;
		}
	}
} elseif ( ! $variable_pricing && $single_recurring ) {
	$recurring = true;
}
?>

<aside class="sidebar download-sidebar">
	<?php if ( ! $is_3rd_party && ! $is_unlicensed ) { ?>
		<h3 class="pricing-title"><?php echo ucfirst( $download_type ); ?> Pricing</h3>
	<?php } else { ?>
		<h3 class="pricing-title"><?php echo ucfirst( $download_type ); ?> Details</h3>
	<?php } ?>
	<div class="download-access download-info-section">
		<div class="pricing-info">
			<div class="pricing">
				<?php
					if ( ! $is_3rd_party || ( $is_3rd_party && $is_wporg ) ) {
						echo edd_get_purchase_link( array( 'id' => get_the_ID() ) );
					} else {
						?>
						<a class="external-download-button edd-submit button darkblue" href="<?php echo esc_url( $external_url ); ?>">View <?php echo ucfirst( $download_type ); ?></a>
						<?php
					}
				?>
			</div>
			<div class="terms clearfix">
				<p>
					<?php

						// terms for paid downloads
						if ( class_exists( 'EDD_Recurring' ) && $recurring ) {
							if ( $is_bundle ) {
								echo 'This subscription is billed yearly and can be cancelled at any time. ';
							} else {
								echo 'All price options are billed yearly. You may cancel your subscription at any time. ';
							}
							printf( '%1$ss subject to yearly license for support and updates. %2$s.', ucfirst( $download_type ), '<a href="' . $license . '" target="_blank">View terms</a>' );
						} elseif ( $is_extension && ! $recurring && ! $is_unlicensed ) { // safety net

							// this should never happen
							printf( '%1$ss subject to yearly license for support and updates. %2$s.', ucfirst( $download_type ), '<a href="' . $license . '" target="_blank">View terms</a>' );
						}

						// terms for free or external downloads
						if ( $is_theme && ! $is_3rd_party ) {
							printf( 'Downloading this %1$s grants you a lifetime license for support and updates.', $download_type );
						} elseif ( $is_theme && $is_3rd_party ) {
							printf( 'This %1$s is maintained and supported by %2$s.', $download_type, $developer );
						}

						// unlicensed downloads (like .org, iTunes, etc.)
						if ( $is_unlicensed ) {
							printf( 'This %1$s is not subject to our licensing terms as it is distributed and maintained by a 3rd party.', $download_type );
						}
					?>
				</p>
			</div>
		</div>
	</div>
	<?php if ( ! $is_bundle ) {
		$core_extensions = home_url( '/downloads/core-extensions-bundle/' );
		?>
		<div class="core-extensions download-info-section secondary-sidebar-section">
			<h3 class="widget-title">Core Extensions</h3>
			<p>Receive the best discount EDD has to offer when you purchase our Core Extensions Bundle. <a href="<?php echo $core_extensions; ?>">Learn more</a>.</p>
		</div>
	<?php } ?>
	<?php
		$doc_url = get_post_meta( get_the_ID(), 'ecpt_documentationlink', true );
		if ( $doc_url ) {
			?>
			<div class="related-items download-info-section secondary-sidebar-section">
				<h3 class="widget-title">Documentation</h3>
				<ul class="related-links">
					<li><a href="<?php echo $doc_url; ?>">View Setup Documentation</a></li>
				</ul>
			</div>
			<?php
		}
	?>
	<div class="support-ticket download-info-section secondary-sidebar-section">
		<h3 class="widget-title">Support</h3>
		<div>Need help? Feel free to submit a <a href="<?php echo home_url( '/support/' ); ?>">support ticket</a>.</div>
	</div>
</aside>