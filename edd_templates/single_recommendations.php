<?php
global $post;
$suggestion_data = edd_rp_get_suggestions( $post->ID );
if ( is_array( $suggestion_data ) && !empty( $suggestion_data ) ) :
	$suggestions = array_keys( $suggestion_data );
	$suggested_downloads = new WP_Query( array( 'post__in' => $suggestions, 'post_type' => 'download' ) );
	if ( $suggested_downloads->have_posts() ) : ?>
		<div id="edd-rp-single-wrapper">
			<h5 id="edd-rp-single-header"><?php echo sprintf( __( 'Users who purchased %s, also purchased:', 'edd-rp-txt' ), get_the_title() ); ?></h5>
			<div id="edd-rp-items-wrapper" class="edd-rp-single">
				<?php while ( $suggested_downloads->have_posts() ) : ?>
					<?php $suggested_downloads->the_post();	?>
					<div class="edd-rp-item">
						<a href="<?php the_permalink(); ?>">
						<?php the_title( '<h4 class="recommended-product-title">', '</h4>' ); ?>
						<?php if ( has_post_thumbnail( get_the_ID() ) ) :?>
							<div class="edd_cart_item_image">
								<?php echo get_the_post_thumbnail( get_the_ID(), 'edd_download_image' ); ?>
							</div>
						<?php else: ?>
							<br />
						<?php endif; ?>
						</a>
						<?php if ( !edd_has_variable_prices( get_the_ID() ) ) : ?>
							<?php edd_price( get_the_ID() ); ?>
						<?php endif; ?>

						<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID(),
																 'price' => false,
																 'direct' => false ) );	?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>