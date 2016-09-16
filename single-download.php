<?php
/**
 * The template for displaying a download.
 */

global $post;

get_header();
the_post();
$is_extension       = has_term( 'extensions', 'download_category', get_the_ID() );
$is_bundle          = has_term( 'bundles', 'download_category', get_the_ID() );
$is_3rd_party       = has_term( '3rd-party', 'download_category', get_the_ID() );
$is_payment_gateway = has_term( 'gateways', 'download_category', get_the_ID() );
$developer          = get_post_meta( get_the_ID(), 'ecpt_developer', true );
$has_license        = get_post_meta( get_the_ID(), '_edd_sl_enabled', true );

// get the download
if ( $is_extension && ! $is_bundle ) :
	$download_type = 'extension';
elseif ( $is_theme ) :
	$download_type = 'theme';
elseif ( $is_bundle ) :
	$download_type = 'bundle';
endif;
?>

	<div class="site-container">
		<section class="content">

			<article class="single-download-entry hentry" id="post-<?php echo get_the_ID(); ?>">
				<div class="entry-header">
						<?php the_title( '<h1 class="entry-title download-entry-title">', '</h1>' ); ?>
				</div>
				<div class="entry-content">
					<div class="download-data clearfix">
						<div class="download-img">
							<?php
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) );
								$old_default = home_url( '/wp-content/uploads/2013/07/defaultpng.png' );
								if ( has_post_thumbnail() && $image[0] !== $old_default ) :
									the_post_thumbnail( 'edd_download_image', array( 'class' => 'featured-img' ) );
								endif;
							?>
						</div>
						<div class="download-meta-data">
							<?php if ( ! $is_3rd_party ) { ?>
								<div class="download-details download-info-section">
									<h5 class="download-details-title"><?php echo ucfirst( $download_type ); ?> Details</h5>
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
									<div class="author clearfix">
										<p>
											<span class="edd-download-detail-label">Developed by: </span>
											<?php if ( get_post_meta( get_the_ID(), 'ecpt_developer', true ) ) : ?>
												<span class="edd-download-detail"><?php echo $developer; ?></span>
											<?php else : ?>
												<span class="edd-download-detail"><?php echo get_the_author(); ?></span>
											<?php endif; ?>
										</p>
									</div>
									<?php if ( $has_license && ! $is_bundle ) { ?>
										<div class="version clearfix">
											<?php $version = get_post_meta( get_the_ID(), '_edd_sl_version', true ); ?>
											<p><span class="edd-download-detail-label">Current version:</span> <span class="edd-download-detail"><?php echo $version; ?><a href="#" class="changelog-link" title="View Changelog" data-toggle="modal" data-target="#show-changelog"><i class="fa fa-file-text-o"></i></a></span></p>
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
										<h5 class="widget-title">Requirements</h5>
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
															echo get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) . ' or higher';												}
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
									<?php
								}
							?>
						</div>
						<?php if ( $is_payment_gateway ) { ?>
							<div class="gateway-filter-note download-info-section">
								<span>Need help choosing the right payment gateway for your business? Use our <a href="<?php echo home_url( '/downloads/category/gateways/' ); ?>">payment gateway filter</a>.</span>
							</div>
						<?php } ?>
					</div>
					<?php the_content(); ?>
				</div>
			</article>

		</section>
		<?php get_sidebar( 'download' ); ?>
	</div>

<?php get_footer(); ?>