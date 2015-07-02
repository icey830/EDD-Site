<?php
/**
 * The template for displaying all the videos.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
global $wp_query;
get_header();
?>
	<section class="main clearfix">

		<div class="extensions-header-area full-width">
			<div class="inner">
				<div class="extensions-header clearfix">
					<div class="section-header">
						<h2 class="section-title">Easy Digital Downloads Videos</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="edd-videos-area full-width">
			<div class="inner">
				<div class="edd-downloads">

					<section class="download-grid three-col clearfix">
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="download-grid-item">
								<a href="<?php echo home_url( '/videos/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
									<?php eddwp_downloads_grid_thumbnail(); ?>
								</a>
								<div class="download-grid-item-info">
									<?php
										the_title( '<h4 class="download-grid-title">', '</h4>' );
										$short_desc = the_excerpt();
										echo $short_desc;
									?>
								</div>
								<div class="download-grid-item-cta">
									<a class="download-grid-item-primary-link button" href="<?php the_permalink(); ?>">View Video</a>
								</div>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</section><!-- /.extensions-container -->

				</div>
			</div>
		</div>
	</section><!-- /.main -->
<?php get_footer(); ?>