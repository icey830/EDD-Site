<?php
/**
 * Template Name: Site Showcase
 */
get_header();
the_post();
?>
	<section class="main clearfix">

		<div class="extensions-header-area full-width">
			<div class="inner">
				<div class="extensions-header clearfix">
					<div class="section-header">
						<h2 class="section-title">Easy Digital Downloads Showcase</h2>
						<p class="section-subtitle">A collection of just some of the great websites running Easy Digital Downloads.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="site-showcase-area full-width">
			<div class="inner">
				<div class="site-showcase">
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
										'operator' => 'IN'
									)
								)
							);
							$featured = new WP_Query( $featured_showcases );

							while ( $featured->have_posts() ) : $featured->the_post();
								?>
								<div class="download-grid-item">
									<?php
										the_post_thumbnail( 'download-grid-thumb', array(
											'class' => 'download-grid-thumb' )
										);
									?>
									<div class="download-grid-item-info">
										<?php
											the_title( '<h4 class="download-grid-title">', '</h4>' );
										?>
									</div>
									<div class="download-grid-item-cta">
										<a class="download-grid-item-primary-link button" href="<?php $array = shortcode_parse_atts( get_the_content() ); echo $array['link']; ?>">Visit Site</a>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
						?>
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
							$sites = new WP_Query( $featured_showcases );

							while ( $sites->have_posts() ) : $sites->the_post();
								?>
								<div class="download-grid-item">
									<?php
										the_post_thumbnail( 'download-grid-thumb', array(
											'class' => 'download-grid-thumb' )
										);
									?>
									<div class="download-grid-item-info">
										<?php
											the_title( '<h4 class="download-grid-title">', '</h4>' );
										?>
									</div>
									<div class="download-grid-item-cta">
										<a class="download-grid-item-primary-link button" href="<?php $array = shortcode_parse_atts( get_the_content() ); echo $array['link']; ?>">Visit Site</a>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
						?>
					</section><!-- .download-grid three-col -->
				</div>
			</div>
		</div>

		<div class="showcase-submission-area full-width">
			<div class="inner">
				<div class="section-header">
					<h3 class="section-title">Showcase Submission</h3>
				</div>
				<div class="showcase-submission clearfix">
					<?php the_content(); ?>
				</div>
			</div>
		</div>

	</section><!-- /.main -->
	<?php
get_footer();