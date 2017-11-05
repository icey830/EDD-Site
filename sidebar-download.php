<?php
/**
 * download sidebar (NOT widgetized... for now)
 */

$is_extension  = has_term( 'extensions', 'download_category', get_the_ID() );
$is_theme      = has_term( 'themes', 'download_category', get_the_ID() );
$is_bundle     = has_term( 'bundles', 'download_category', get_the_ID() );
$is_all_access = has_term( 'all-access', 'download_category', get_the_ID() );
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
if ( class_exists( 'EDD_Recurring' ) ) {
	$single_recurring = EDD_Recurring()->is_recurring( get_the_ID() );
}
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

// check for All Access access to this product
$aa_has_access['success'] = false;
if ( class_exists( 'EDD_All_Access' ) ) {
	$aa_has_access = edd_all_access_check( array( 'download_id' => get_the_ID() ) );
	if ( $aa_has_access['success'] ) {
		$aa_pass_title = get_the_title( $aa_has_access['all_access_pass']->download_id );
	}
}
?>

<aside class="sidebar download-sidebar<?php echo $aa_has_access['success'] ? ' has-aa-access' : '' ; ?>">
	<div class="download-access download-info-section">
		<div class="pricing-header">
			<?php
			if ( $aa_has_access['success'] ) {
				?>
				<h3 class="widget-title"><i class="fa fa-gift"></i> You have access!</h3>
				<?php
			} else {
				if ( ! $is_3rd_party && ! $is_unlicensed && ! $is_theme ) {
					?>
					<h3 class="widget-title">Purchase <?php echo $is_all_access ? 'Access' : ucfirst( $download_type ); ?></h3>
					<?php
				} else {
					?>
					<h3 class="widget-title">Download <?php echo ucfirst( $download_type ); ?></h3>
					<?php
				}
			}
			?>
		</div>
		<div class="pricing-info">
			<?php
				if ( $aa_has_access['success'] ) {
					?>
					<p class="all-access-terms">As an <?php echo $aa_pass_title; ?> customer, you can download this <?php echo $download_type; ?> by clicking the button below. To view your All Access Pass details, visit <a href="<?php echo home_url( '/your-account/#tab-all-access' ); ?>" target="_blank">your account</a>.</p>
					<?php
				}
			?>
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
					if ( ! $aa_has_access['success'] ) {
						echo '<i class="fa fa-info-circle"></i>';

						// terms for paid downloads
						if ( class_exists( 'EDD_Recurring' ) && $recurring ) {
							if ( $is_bundle ) {
								echo 'This subscription is billed yearly and can be cancelled at any time. ';
							} else {
								echo 'All purchase options are billed yearly. You may cancel your subscription at any time. ';
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
					}
					?>
				</p>
			</div>
		</div>
	</div>
	<?php if ( ! $is_3rd_party ) { ?>
		<div class="download-details download-info-section">
			<h3 class="widget-title"><?php echo ucfirst( $download_type ); ?> Details</h3>
			<div class="author clearfix">
				<p>
					<span class="edd-download-detail-label">Developer:</span>&nbsp;
					<?php if ( $developer ) : ?>
						<span class="edd-download-detail"><?php echo $developer; ?></span>
					<?php else : ?>
						<span class="edd-download-detail"><?php echo get_the_author(); ?></span>
					<?php endif; ?>
				</p>
			</div>
			<?php if ( $is_bundle ) { ?>
				<div class="license-activations clearfix">
					<p>
						<span class="edd-download-detail-label">Number of sites:</span>&nbsp;
						<?php if ( ! empty( $activations ) ) { ?>
							<span class="edd-download-detail"><?php echo $activations; ?></span>
						<?php } else { ?>
							<span class="edd-download-detail">unlimited</span>
						<?php } ?>
					</p>
				</div>
			<?php } ?>
			<?php
			if ( $has_license && ! $is_bundle ) { ?>
				<div class="version clearfix">
					<?php $version = get_post_meta( get_the_ID(), '_edd_sl_version', true ); ?>
					<p><span class="edd-download-detail-label">Version:</span> <span class="edd-download-detail"><?php echo $version; ?><a href="#" class="changelog-link" title="View Changelog" data-toggle="modal" data-target="#show-changelog"><i class="fa fa-file-text-o"></i></a></span></p>
				</div>
				<?php
				// get the changelog data
				$changelog = stripslashes( get_post_meta( get_the_ID(), '_edd_sl_changelog', true ) );

				// if it exists, append the changelog (from either source) to the relevent content output
				if ( ! empty( $changelog ) ) {
					?>
					<!-- Changelog Modal -->
					<div class="changelog-modal modal fade" id="show-changelog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title" id="myModalLabel"><?php the_title(); ?> Changelog</h5>
								</div>
								<div class="modal-body">
									<?php echo wpautop( $changelog ); ?>
								</div>
								<div class="modal-footer">
									<a href="#" data-dismiss="modal">Close</a>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			<?php } ?>
		</div>
	<?php } ?>
	<?php
	if ( get_post_meta( get_the_ID(), 'ecpt_minimumwp', true ) ||
		get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) ||
		get_post_meta( get_the_ID(), 'ecpt_minimumphp', true ) ) {
		?>
		<div class="download-requirements download-info-section">
			<h3 class="widget-title">Requirements</h3>
			<?php if ( get_post_meta( get_the_ID(), 'ecpt_minimumwp', true ) ) { ?>
				<div class="wordpress-ver clearfix">
					<p>
						<span class="edd-download-detail-label">WordPress:</span>&nbsp;
						<span class="edd-download-detail">
							<?php
							if ( get_post_meta( get_the_ID(), 'ecpt_minimumwp', true ) ) {
								echo get_post_meta( get_the_ID(), 'ecpt_minimumwp', true ) . ' or higher';
							}
							?>
						</span>
					</p>
				</div>
			<?php } ?>
			<?php if ( get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) ) { ?>
				<div class="edd-ver clearfix">
					<p>
						<span class="edd-download-detail-label">EDD:</span>&nbsp;
						<span class="edd-download-detail">
							<?php
							if ( get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) ) {
								echo get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) . ' or higher';
							}
							?>
						</span>
					</p>
				</div>
			<?php } ?>
			<?php if ( get_post_meta( get_the_ID(), 'ecpt_minimumphp', true ) ) { ?>
				<div class="php-ver clearfix">
					<p>
						<span class="edd-download-detail-label">PHP:</span>&nbsp;
						<span class="edd-download-detail">
							<?php
							if ( get_post_meta( get_the_ID(), 'ecpt_minimumphp', true ) ) {
								echo get_post_meta( get_the_ID(), 'ecpt_minimumphp', true ) . ' or higher';
							}
							?>
						</span>
					</p>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ( ! $is_bundle ) {
		$core_extensions = home_url( '/downloads/core-extensions-bundle/' );
		?>
		<div class="core-extensions download-info-section">
			<h3 class="widget-title">Core Extensions</h3>
			<p>Receive the best discount EDD has to offer when you purchase our Core Extensions Bundle. <a href="<?php echo $core_extensions; ?>">Learn more</a>.</p>
		</div>
	<?php } ?>
	<?php
	$doc_url = get_post_meta( get_the_ID(), 'ecpt_documentationlink', true );
	if ( $doc_url ) {
		?>
		<div class="related-items download-info-section">
			<h3 class="widget-title">Documentation</h3>
			<ul class="related-links">
				<li><a href="<?php echo $doc_url; ?>">View Setup Documentation</a></li>
			</ul>
		</div>
		<?php
	}
	?>
	<div class="support-ticket download-info-section">
		<h3 class="widget-title">Support</h3>
		<div>Need help? Feel free to submit a <a href="<?php echo home_url( '/support/' ); ?>">support ticket</a>.</div>
	</div>
</aside>