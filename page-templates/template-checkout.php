<?php
/**
 * Template Name: Checkout
 *
 * Doesn't have to be a template but useful if we need it.
 */

get_header();
the_post();
?>

	<div id="checkout-page-area" class="full-width clearfix">
		<div class="inner">
			<section class="checkout-content">

				<article <?php post_class( 'clearfix' ); ?> id="post-<?php echo get_the_ID(); ?>">
					<div class="entry-header">
						<h3 class="entry-title">Checkout Cart</h3>
					</div>
					<div class="entry-content">
						<?php
						if ( eddwp_edd_is_activated() ) :
							$cart_contents = edd_get_cart_contents();
						endif;
						if ( ! empty( $cart_contents ) ) :
							the_content();
						else :
							?>
							<p>Your cart is empty. If this appears to be in error, please clear your browser cookies and try again. If you're interested in extensions for your EDD store, have a look at these popular choices.</p>
							<section class="download-grid two-col narrow-grid clearfix">
								<?php
								$extension_args = array(
									'post_type'      => 'download',
									'paged'          => get_query_var( 'paged' ),
									'posts_per_page' => 2,
									'order'          => isset( $_GET['display'] ) ? 'DESC' : 'ASC',
									'orderby'        => isset( $_GET['display'] ) ? 'date' : 'menu_order',
									'tax_query'      => array(
										'relation'       => 'AND',
										array(
											'taxonomy' => 'download_category',
											'field'    => 'slug',
											'terms'    => 'extensions',
										),
										array(
											'taxonomy' => 'download_tag',
											'field'    => 'slug',
											'terms'    => 'featured',
										),
									),
								);
								$extensions = new WP_Query( $extension_args );

								while ( $extensions->have_posts() ) : $extensions->the_post();
									?>
									<div class="download-grid-item">
										<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
											<?php eddwp_downloads_grid_thumbnail(); ?>
										</a>
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
							<p>Or perhaps you'd like an official EDD theme to power your store?</p>
							<section class="download-grid two-col narrow-grid clearfix">
								<?php
								$extension_args = array(
									'post_type'      => 'download',
									'paged'          => get_query_var( 'paged' ),
									'posts_per_page' => 2,
									'order'          => isset( $_GET['display'] ) ? 'DESC' : 'ASC',
									'orderby'        => isset( $_GET['display'] ) ? 'date' : 'menu_order',
									'tax_query'      => array(
										'relation'     => 'AND',
										array(
											'taxonomy' => 'download_category',
											'field'    => 'slug',
											'terms'    => 'themes',
										),
										array(
											'taxonomy' => 'download_tag',
											'field'    => 'slug',
											'terms'    => 'featured',
										),
									),
								);
								$extensions = new WP_Query( $extension_args );

								while ( $extensions->have_posts() ) : $extensions->the_post();
									?>
									<div class="download-grid-item">
										<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
											<?php eddwp_downloads_grid_thumbnail(); ?>
										</a>
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
							<p>Be sure to check out our <a href="<?php echo home_url( '/downloads/' ); ?>" title="Easy Digital Downloads Extensions">Extensions</a> and <a href="<?php echo home_url( '/themes/' ); ?>" title="Easy Digital Downloads Themes">Themes</a> pages for more.</p>
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