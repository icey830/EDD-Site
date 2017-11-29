<?php
/**
 * Template Name: Checkout
 *
 * Doesn't have to be a template but useful if we need it.
 */

get_header();
the_post();
if ( eddwp_edd_is_activated() ) :
	$cart_contents = edd_get_cart_contents();
endif;
?>

	<div id="checkout-page-area" class="full-width clearfix">
		<div class="inner">
			<section class="checkout-content">

				<article <?php post_class( 'clearfix' ); ?> id="post-<?php echo get_the_ID(); ?>">
					<div class="entry-header">
						<h3 class="entry-title">
							<?php
								if ( ! empty( $cart_contents ) ) :
									echo 'Checkout Cart';
								else :
									echo 'Oops! Your cart is empty.';
								endif;
							?>
						</h3>
					</div>
					<div class="entry-content">
						<?php
						if ( ! empty( $cart_contents ) ) :
							the_content();
						else :
							?>
							<p>If this appears to be in error, please clear your browser cookies and try again. If you're interested in extensions for your Easy Digital Downloads store, we've got you covered!</p>
							<section class="download-grid two-col narrow-grid clearfix">
								<?php
								$aap_id     = eddwp_get_post_id_by_slug( 'all-access-pass' );
								$rp_id      = eddwp_get_post_id_by_slug( 'recurring-payments' );
								$extensions = new WP_Query( array( 'post_type' => 'download', 'post__in' => array( $aap_id, $rp_id ) ) );

								while ( $extensions->have_posts() ) : $extensions->the_post();
									?>
									<div class="download-grid-item">
										<div class="download-grid-thumb-wrap">
											<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
												<?php eddwp_downloads_grid_thumbnail(); ?>
											</a>
										</div>
										<div class="download-grid-item-info">
											<?php
											the_title( sprintf(
												'<h4 class="download-grid-title"><a href="%s">',
												home_url( '/downloads/' . $post->post_name ) ),
												'</a></h4>'
											);
											$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
											echo $short_desc;
											?>
										</div>
										<div class="download-grid-item-cta">
											<a class="download-grid-item-primary-link button" href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">More Information</a>
										</div>
									</div>
								<?php
								endwhile;
								wp_reset_postdata();
								?>
								<div class="download-grid-item flex-grid-cheat"></div>
							</section>
							<p>Or perhaps you'd like an official Easy Digital Downloads theme to power your store? Give these a try for <strong>FREE</strong> to see how our official themes extract the most value from our ecosystem.</p>
							<section class="download-grid two-col narrow-grid clearfix">
								<?php
								$themedd_id = eddwp_get_post_id_by_slug( 'themedd' );
								$vendd_id   = eddwp_get_post_id_by_slug( 'vendd' );
								$themes     = new WP_Query( array( 'post_type' => 'download', 'post__in' => array( $themedd_id, $vendd_id ) ) );

								while ( $themes->have_posts() ) : $themes->the_post();
									?>
									<div class="download-grid-item">
										<div class="download-grid-thumb-wrap">
											<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
												<?php eddwp_downloads_grid_thumbnail(); ?>
											</a>
										</div>
										<div class="download-grid-item-info">
											<?php
											the_title( sprintf(
												'<h4 class="download-grid-title"><a href="%s">',
												home_url( '/downloads/' . $post->post_name ) ),
												'</a></h4>'
											);
											$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
											echo $short_desc;
											?>
										</div>
										<div class="download-grid-item-cta">
											<a class="download-grid-item-primary-link button" href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">More Information</a>
										</div>
									</div>
								<?php
								endwhile;
								wp_reset_postdata();
								?>
								<div class="download-grid-item flex-grid-cheat"></div>
							</section>
							<p>For more options, check out our <a href="<?php echo home_url( '/downloads/' ); ?>" title="Easy Digital Downloads Extensions">full extensions catalogue</a> and <a href="<?php echo home_url( '/themes/' ); ?>" title="Easy Digital Downloads Themes">theme recommendations</a>.</p>
						<?php
						endif;
						?>
					</div>
				</article>

			</section>
		</div>
	</div>

<?php
get_footer();