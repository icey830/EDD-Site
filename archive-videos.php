<?php
/**
 * video archives
 */

global $wp_query;
get_header();
?>

	<div class="extensions-header-area page-section-blue full-width">
		<div class="inner">
			<div class="extensions-header clearfix">
				<div class="section-header">
					<h2 class="section-title">Easy Digital Downloads Videos</h2>
				</div>
			</div>
		</div>
	</div>

	<div class="edd-videos-area page-section-white full-width">
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
									the_title( sprintf(
										'<h4 class="download-grid-title"><a href="%s">',
										home_url( '/videos/' . $post->post_name ) ),
										'</a></h4>'
									);
									$short_desc = the_excerpt();
									echo $short_desc;
								?>
							</div>
							<div class="download-grid-item-cta">
								<a class="download-grid-item-primary-link button" href="<?php the_permalink(); ?>">View Video</a>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</section>

			</div>
		</div>
	</div>

<?php get_footer(); ?>