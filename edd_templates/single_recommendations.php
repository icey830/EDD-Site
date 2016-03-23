<?php
global $post;
$suggestion_data = edd_rp_get_suggestions( $post->ID );
if ( is_array( $suggestion_data ) && !empty( $suggestion_data ) ) :
	$suggestions = array_keys( $suggestion_data );
	$suggested_downloads = new WP_Query( array( 'post__in' => $suggestions, 'post_type' => 'download' ) );
	if ( $suggested_downloads->have_posts() ) : ?>

		<div id="recommended-products" class="download-grid two-col narrow-grid">
			<h5 class="recommended-products-header"><?php echo sprintf( __( 'Users who purchased %s, also purchased:', 'edd-rp-txt' ), get_the_title() ); ?></h5>
			<?php while ( $suggested_downloads->have_posts() ) : ?>
				<?php $suggested_downloads->the_post();	?>
				<div class="download-grid-item">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail( get_the_ID() ) ) :?>
							<div class="edd_cart_item_image">
								<?php echo get_the_post_thumbnail( get_the_ID(), 'download-grid-thumb' ); ?>
							</div>
						<?php endif; ?>
					</a>
					<div class="download-grid-item-info">
						<?php
							the_title( sprintf( '<h4 class="download-grid-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' );
							$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
							echo $short_desc;
						?>
					</div>
					<div class="download-grid-item-cta recommended-products-cta">
						<?php if ( !edd_has_variable_prices( get_the_ID() ) ) : ?>
							<?php edd_price( get_the_ID() ); ?>
						<?php endif; ?>

						<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID(),
																 'price' => false,
																 'direct' => false ) );	?>
					</div>
				</div>
			<?php endwhile; ?>
			<div class="download-grid-item flex-grid-cheat"></div>
		</div>

	<?php endif; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>