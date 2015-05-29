<?php
/**
 * Template Name: Themes Page
 *
 * The template for displaying all the themes.
 */
get_header();
the_post();
$featured_theme_args = array(
	'post_type' => 'download',
	'orderby'   => 'menu_order',
	'order'     => 'ASC',
	'tax_query' => array(
		array(
			'taxonomy' => 'download_category',
			'field'    => 'slug',
			'terms'    => 'featured-theme',
		),
	),
);
$featured_theme = new WP_Query( $featured_theme_args );
$no_duplicates = array(); // don't repeat the same theme twice
?>
	<section class="main clearfix">

		<?php while ( $featured_theme->have_posts() ) : $featured_theme->the_post(); $no_duplicates[] = $post->ID; ?>
			<div class="featured-download-area full-width">
				<div class="inner">
					<div class="featured-download clearfix">
					<div class="section-header">
						<h2 class="section-title">Get the most out of Easy Digital Downloads.</h2>
						<p class="section-subtitle">While EDD is designed to work with any theme, the themes below take advantage of more EDD features.</p>
					</div>
						<div class="featured-download-thumb">
							<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
								<?php eddwp_downloads_grid_thumbnail(); ?>
							</a>
						</div>
						<div class="featured-download-info">
							<?php
								the_title( '<h3 class="featured-download-title"><span class="featured-download-label">Featured</span>', '</h3>' );
								the_excerpt();
							?>
							<a class="featured-download-primary-link button" href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">See Theme Details</a>
							<a class="featured-download-secondary-link gray-button" href="<?php echo home_url( '/checkout/?edd_action=add_to_cart&download_id=' . get_the_ID() ); ?>">Purchase <?php the_title(); ?></a>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>

		<div class="edd-downloads-area full-width">
			<div class="inner">
				<div class="edd-downloads">
					<div class="section-header">
						<h2 class="section-title">Official Easy Digital Downloads Themes</h2>
						<p class="section-subtitle">These themes were optimized to work with EDD and its extensions by our team members.</p>
					</div>
					<section class="download-grid two-col clearfix">
						<?php
							$eddwp_theme_args = array(
								'post_type' => 'download',
								'orderby'   => 'menu_order',
								'order'     => 'ASC',
								'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'download_category',
										'field'    => 'slug',
										'terms'    => 'themes',
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
								if ( ! in_array( $post->ID, $no_duplicates ) ) :
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
								endif;
							endwhile;
							wp_reset_postdata();
						?>
					</section><!-- .download-grid two-col -->
				</div>
			</div>
		</div>

		<div class="recommended-downloads-area full-width">
			<div class="inner">
				<div class="recommended-downloads">
					<div class="section-header">
						<h2 class="section-title">Recommended Community Themes</h2>
						<p class="section-subtitle">The following themes were designed by talented developers from the EDD community.</p>
					</div>
					<section class="download-grid three-col clearfix">
						<?php
							$eddwp_theme_args = array(
								'post_type' => 'download',
								'orderby'   => 'menu_order',
								'order'     => 'ASC',
								'posts_per_page' => 100,
								'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'download_category',
										'field'    => 'slug',
										'terms'    => 'themes',
									),
									array(
										'taxonomy' => 'download_category',
										'field'    => 'slug',
										'terms'    => '3rd-party',
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
						<p class="theme-forest-edd-link">
							<a class="edd-subtmi button blue" href="http://themeforest.net/tags/easy%20digital%20downloads?ref=mordauk">View all EDD Themes on ThemeForest</a>
						</p>
					</section><!-- .download-grid three-col -->
				</div>
			</div>
		</div>

	</section>
	<?php
get_footer();