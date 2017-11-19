<?php
/**
 * download sidebar (NOT widgetized... for now)
 */
$is_extension  = has_term( 'extensions', 'download_category', get_the_ID() );
$is_theme      = has_term( 'themes', 'download_category', get_the_ID() );
$is_bundle     = has_term( 'bundles', 'download_category', get_the_ID() );
$is_all_access = get_post_meta( get_the_ID(), '_edd_all_access_enabled', true );
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
elseif ( $is_all_access ) :
	$download_type = 'all-access';
else :
	$download_type = 'extension';
endif;
$license = get_theme_mod( 'eddwp_terms_link' );

// check for recurring pricing
if ( eddwp_recurring_is_activated() ) {
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
$aa_check      = eddwp_user_has_aa_access( get_the_ID() );
$aa_has_access = $aa_check[0] ? true : false;
$aa_title      = $aa_check[0] ? $aa_check[1] : '';
?>

<aside class="sidebar download-sidebar<?php echo $aa_has_access ? ' has-aa-access' : '' ; ?>">
	<div class="download-access download-info-section">
		<div class="pricing-header">
			<?php
			if ( $aa_has_access ) {
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
			<?php if ( $aa_has_access ) { ?>
				<p class="all-access-terms">
					<?php if ( eddwp_user_has_aa_access( get_the_ID() ) ) { ?>
						As an <?php echo $aa_title; ?> customer, you can download this <?php echo $download_type; ?> by clicking the button below. To view your All Access Pass details, visit <a href="<?php echo home_url( '/your-account/#tab-all-access' ); ?>">your account</a>.
					<?php } else { ?>
						You're already an <?php echo $aa_title; ?> customer, you can renew your access pass by clicking the button below. To view your All Access Pass details, visit <a href="<?php echo home_url( '/your-account/#tab-all-access' ); ?>">your account</a>.
					<?php } ?>
				</p>
			<?php } ?>
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
					if ( false == $is_all_access && ! $aa_has_access ) {
						echo '<i class="fa fa-info-circle"></i>';

						// terms for paid downloads
						if ( eddwp_recurring_is_activated() && $recurring ) {
							if ( $is_bundle ) {
								echo 'This subscription is billed yearly and can be cancelled at any time. ';
							} else {
								echo 'All purchase options are billed yearly. You may cancel your subscription at any time. ';
							}
							printf( '%1$s subject to yearly license for support and updates. %2$s.', 'all-access' == $download_type ? 'Access pass' : ucfirst( $download_type ) . 's', '<a href="' . $license . '" target="_blank">View terms</a>' );
						} elseif ( $is_extension && ! $recurring && ! $is_unlicensed ) { // safety net

							// this should never happen
							printf( '%1$s subject to yearly license for support and updates. %2$s.',  'all-access' == $download_type ? 'Access pass' : ucfirst( $download_type ) . 's', '<a href="' . $license . '" target="_blank">View terms</a>' );
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
					} elseif ( $is_all_access ) {

						// actual All Access passes
						echo '<i class="fa fa-info-circle"></i> ' . get_the_title() . ' purchases are billed yearly. You may cancel a subscription at any time. ';
						printf( 'Support and updates for included extensions are subject to valid license. %1$s.', '<a href="' . $license . '" target="_blank">View terms</a>' );
					}
					?>
				</p>
			</div>
		</div>
	</div>
	<?php if ( ! $is_3rd_party && ! $is_all_access ) { ?>
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
	<?php if ( $is_theme || $is_unlicensed || $is_wporg || $is_3rd_party ) {
		$all_access_pass = home_url( '/downloads/all-access-pass/' );
		?>
		<div class="core-extensions download-info-section">
			<h3 class="widget-title">All Access Pass</h3>
			<p>Receive the best discount Easy Digital Downloads has to offer when you purchase our All Access Pass. <a href="<?php echo $all_access_pass; ?>">Learn more</a>.</p>
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