<?php
/*
 * Template Name: Enhanced Download
 * Template Post Type: download
 *
 */
global $post;

get_header();
the_post();

$the_download_title   = get_the_title();
$the_download_content = get_the_content();
$is_extension         = has_term( 'extensions', 'download_category', get_the_ID() );
$is_theme             = has_term( 'themes', 'download_category', get_the_ID() );
$is_bundle            = has_term( 'bundles', 'download_category', get_the_ID() );
$developer            = get_post_meta( get_the_ID(), 'ecpt_developer', true );
$has_license          = get_post_meta( get_the_ID(), '_edd_sl_enabled', true );
$version              = get_post_meta( get_the_ID(), '_edd_sl_version', true );
$is_payment_gateway   = has_term( 'gateways', 'download_category', get_the_ID() );
$is_3rd_party         = has_term( '3rd-party', 'download_category', get_the_ID() );
$is_unlicensed        = has_term( 'unlicensed', 'download_tag', get_the_ID() );
$is_wporg             = has_term( 'wporg', 'download_tag', get_the_ID() );
$developer            = get_post_meta( get_the_ID(), 'ecpt_developer', true );
$external_url         = get_post_meta( get_the_ID(), 'ecpt_externalurl', true );
$activations          = get_post_meta( get_the_ID(), 'ecpt_licenseactivations', true );
$license              = get_theme_mod( 'eddwp_terms_link' );

// get the download
if ( $is_extension && ! $is_bundle ) :
	$download_type = 'extension';
elseif ( $is_theme ) :
	$download_type = 'theme';
elseif ( $is_bundle ) :
	$download_type = 'bundle';
endif;

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

	<div class="download-description-area page-section-white full-width">
		<div class="inner">

			<div class="site-container download-landing">

				<article class="single-download-entry hentry" id="post-<?php echo get_the_ID(); ?>">
					<div class="entry-header">
						<?php
						echo '<h1 class="download-landing-entry-title download-landing-title">' . $the_download_title . '</h1>';
						$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
						echo '<div class="download-landing-title-description">' . $short_desc . '</div>';
						?>
						<div class="download-featured-image">
							<?php
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) );
							$old_default = home_url( '/wp-content/uploads/2013/07/defaultpng.png' );
							if ( has_post_thumbnail() && $image[0] !== $old_default ) :
								the_post_thumbnail( 'edd_download_image', array( 'class' => 'featured-img' ) );
							endif;
							?>
						</div>
					</div>
					<div class="entry-content">
						<div class="download-long-description">
							<div class="download-meta">
								<div class="download-meta-group download-author">
									Developed by:
									<span class="download-meta-value download-author-name">
																<?php
																if ( get_post_meta( get_the_ID(), 'ecpt_developer', true ) ) {
																	echo $developer;
																} else {
																	echo get_the_author();
																}
																?>
															</span>
								</div>
								<?php if ( $has_license && ! $is_bundle ) { ?>
									<div class="download-meta-group download-version">
										Current version:
										<span class="download-meta-value download-version">
																	<?php echo $version; ?><a href="#" class="changelog-link" title="View Changelog" data-toggle="modal" data-target="#show-changelog"><i class="fa fa-file-text-o"></i></a>
																</span>
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
									</div>
								<?php } ?>
								<div class="download-meta-group download-price">
									Starting price:
									<span class="download-meta-value download-starting-price">
																<?php echo edd_currency_filter( edd_get_lowest_price_option( get_the_ID() ) ); ?>
															</span>
								</div>
							</div>
							<div class="download-description-content">
								<?php the_content(); ?>
								<div class="gradient">
								</div>
							</div>
							<div class="read-full-description">
							</div>
							<!--
							<div class="download-purchase-details">
								<a href="#purchase-details">Skip to purchase details</a>
							</div>
							-->
						</div>
					</div>
				</article>

			</div>

		</div>
	</div>

<?php if ( preg_match( '/\[gallery[^\]]*]/uis', $the_download_content , $matches ) ) { ?>
	<div class="download-screenshots-area page-section-gray full-width">
		<div class="inner">
			<div class="download-landing-details">
				<div class="download-screenshots clearfix">
					<div class="screenshots-header">
						<h2 class="download-landing-title"><?php echo ucfirst( $download_type ); ?> Screenshots</h2>
						<div class="download-landing-title-description">
							Have a closer look at <?php echo $the_download_title; ?> functionality.
						</div>
					</div>
					<?php echo do_shortcode( $matches[0] ); ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

	<div class="download-purchase-area page-section-white full-width">
		<div class="inner">
			<div class="download-landing-details">
				<div class="download-purchase-details">
					<h2 id="purchase-details" class="download-landing-title"><?php echo ucfirst( $download_type ); ?> Pricing</h2>
					<div class="download-terms download-landing-title-description clearfix">
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
					<div class="download-pricing">
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
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>