<?php
global $post;

// check for All Access access to this product
$aa_check    = eddwp_user_has_aa( get_the_ID() );
$aa_has_pass = $aa_check[0] ? true : false;
$aa_title    = $aa_check[0] ? $aa_check[1] : '';

if ( function_exists( 'edd_rp_get_suggestions' ) ) {
	$suggestion_data = edd_rp_get_suggestions( $post->ID );
}

if ( !empty( $suggestion_data ) && is_array( $suggestion_data ) ) :
	$suggestions = array_keys( $suggestion_data );
	$suggested_downloads = new WP_Query( array( 'post__in' => $suggestions, 'post_type' => 'download' ) );
	if ( $suggested_downloads->have_posts() ) : ?>

		<div class="recommended-products-wrap">
			<h5 class="recommended-products-header">
				<?php
					if ( $aa_has_pass ) {
						printf( 'Users who purchased %s, also purchased:', get_the_title() );
					} else {
						$get_aap = eddwp_user_has_aa( get_the_ID() );
						printf( 'Gain access to these related extensions and %s more by purchasing %s',
							/* there are 3 extensions on this page */
							eddwp_get_number_of_downloads() - 3,
							'<a href="' . home_url( '/downloads/all-access-pass/' ) . '">All Access Pass</a>'
						);
					}
				?>
			</h5>
			<div id="recommended-products" class="download-grid two-col narrow-grid">
				<?php while ( $suggested_downloads->have_posts() ) : ?>
					<?php $suggested_downloads->the_post();	?>
					<div class="download-grid-item">
						<div class="download-grid-thumb-wrap">
							<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
								<a href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'download-grid-thumb' ) ); ?>
								</a>
							<?php endif; ?>
						</div>
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

							<?php
							echo edd_get_purchase_link( array(
								'download_id' => get_the_ID(),
								'price'       => false,
								'direct'      => false,
								'text'        => 'Add to Cart'
							) );
							?>
						</div>
					</div>
				<?php endwhile; ?>
				<div class="download-grid-item flex-grid-cheat"></div>
			</div>
		</div>

	<?php endif; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>
