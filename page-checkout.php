<?php
/**
 * The template for displaying the Checkout.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2014, Sunny Ratilal.
 */

get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content<?php if ( ! edd_get_cart_contents() ) echo ' checkout-cart-empty'; ?>">
				<?php while ( have_posts() ) { the_post(); ?>
					<?php if ( edd_get_cart_contents() ) { ?>
						<article class="entry">
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</article>
					<?php } else { ?>
						<article class="entry">
							<h1>Your cart is empty!</h1>
							<h2 class="tagline">Here are some extensions you may be interested in.</h2>
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
												'taxonomy' => 'download_category',
												'field'    => 'slug',
												'terms'    => 'recommended',
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
													the_title( '<h4 class="download-grid-title">', '</h4>' );
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
							</section><!-- .download-grid two-col -->
							<h2 class="tagline">Or maybe you're interested in some themes?</h2>
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
												'taxonomy' => 'download_category',
												'field'    => 'slug',
												'terms'    => 'recommended',
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
													the_title( '<h4 class="download-grid-title">', '</h4>' );
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
							</section><!-- .download-grid two-col -->
						</article>
					<?php } ?>
				<?php } ?>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>