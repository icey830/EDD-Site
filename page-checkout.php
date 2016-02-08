<?php
/**
 * EDD checkout template
 */

get_header(); ?>

	<div class="site-container">
		<section class="<?php if ( ! edd_get_cart_contents() ) echo ' checkout-cart-empty'; ?>">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php if ( edd_get_cart_contents() ) : ?>
					<article class="entry">
						<div class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</div>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article>
				<?php else : ?>
					<article class="entry">
						<h1>Your cart is empty!</h1>

						<h3 class="entry-title">Here are some extensions you may be interested in.</h3>

						<section class="download-grid two-col clearfix">
							<?php
								$eddwp_ext_args = array(
									'post_type'      => 'download',
									'posts_per_page' => 2,
									'tax_query'      => array(
										'relation'     => 'AND',
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
										array(
											'taxonomy' => 'download_category',
											'field'    => 'slug',
											'terms'    => '3rd-party',
											'operator' => 'NOT IN',
										),
									),
								);
								$eddwp_ext = new WP_Query( $eddwp_ext_args );

								while ( $eddwp_ext->have_posts() ) : $eddwp_ext->the_post();
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
						</section>

						<h3 class="entry-title">Or perhaps you're interested in our themes?</h3>

						<section class="download-grid two-col clearfix">
							<?php
								$eddwp_theme_args = array(
									'post_type'      => 'download',
									'posts_per_page' => 2,
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
										array(
											'taxonomy' => 'download_category',
											'field'    => 'slug',
											'terms'    => '3rd-party',
											'operator' => 'NOT IN',
										),
									),
								);
								$eddwp_themes = new WP_Query( $eddwp_theme_args );

								while ( $eddwp_themes->have_posts() ) : $eddwp_themes->the_post();
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
						</section>
					</article>
				<?php endif; ?>

			<?php endwhile; ?>

		</section>
	</div>

<?php get_footer(); ?>