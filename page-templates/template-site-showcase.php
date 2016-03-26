<?php
/**
 * Template Name: Site Showcase
 */

get_header();
the_post();
?>

<div class="site-showcase-area page-section-white full-width">
	<div class="inner">
		<div class="site-showcase">
			<h2 class="section-title-alt">Site Showcase</h2>
			<section class="download-grid two-col clearfix">
				<?php
					$featured_showcases = array(
						'post_type'      => 'showcase',
						'posts_per_page' => 2,
						'tax_query'      => array(
							array(
								'taxonomy' => 'showcasecategory',
								'field'    => 'slug',
								'terms'    => 'featured',
							)
						)
					);
					$featured = new WP_Query( $featured_showcases );

					while ( $featured->have_posts() ) : $featured->the_post();
						$array = shortcode_parse_atts( get_the_content() );
						if ( ! empty( $array['link'] ) ) {
							?>
							<div class="download-grid-item showcase-grid-item">
								<a href="<?php echo $array['link']; ?>">
									<?php eddwp_downloads_grid_thumbnail(); ?>
								</a>

								<div class="download-grid-item-info">
									<?php
									the_title('<h4 class="download-grid-title"><a href="' . $array['link'] . '">', '</a></h4>');
									?>
								</div>
							</div>
						<?php
						}
					endwhile;
					wp_reset_postdata();
				?>
				<div class="download-grid-item flex-grid-cheat"></div>
			</section><!-- .download-grid two-col -->

			<section class="download-grid three-col clearfix">
				<?php
					$site_showcases = array(
						'post_type'      => 'showcase',
						'nopaging'       => true,
						'tax_query'      => array(
							array(
								'taxonomy' => 'showcasecategory',
								'field'    => 'slug',
								'terms'    => 'featured',
								'operator' => 'NOT IN'
							)
						)
					);
					$sites = new WP_Query( $site_showcases );

					while ( $sites->have_posts() ) : $sites->the_post();
						$array = shortcode_parse_atts( get_the_content() );
						if ( ! empty( $array['link'] ) ) {
							?>
							<div class="download-grid-item showcase-grid-item">
								<a href="<?php echo $array['link']; ?>">
									<?php eddwp_downloads_grid_thumbnail(); ?>
								</a>

								<div class="download-grid-item-info">
									<?php
									the_title('<h4 class="download-grid-title"><a href="' . $array['link'] . '">', '</a></h4>');
									?>
								</div>
							</div>
							<?php
						}
					endwhile;
					wp_reset_postdata();
				?>
				<div class="download-grid-item flex-grid-cheat"></div>
				<div class="download-grid-item flex-grid-cheat"></div>
			</section><!-- .download-grid three-col -->
		</div>
	</div>
</div>

<div class="showcase-submission-area page-section-gray full-width">
	<div class="inner">
		<div class="section-header">
			<h3 class="section-title">Showcase Submission</h3>
		</div>
		<div class="showcase-submission clearfix">
			<?php the_content(); ?>
		</div>
	</div>
</div>
<?php

get_footer();