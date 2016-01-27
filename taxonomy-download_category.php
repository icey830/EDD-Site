<?php
/**
 * The template for displaying the download category archives.
 */
global $wp_query;
get_header();
?>
	<section class="main clearfix">

		<?php $download_term = $wp_query->get_queried_object();	?>

		<div class="extensions-header-area full-width">
			<div class="inner">
				<div class="extensions-header clearfix">
					<div class="section-header">
						<h2 class="section-title">Category: <strong><?php echo $download_term->name; ?></strong></h2>
						<?php if ( ! empty( $download_term->description ) ) : ?>
							<p class="section-subtitle"><?php echo $download_term->description; ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="edd-downloads-area full-width">
			<div class="inner">
				<div class="edd-downloads">
					<div class="section-header">
						<div class="filter-label">Categories:</div>
						<?php
							$cat_args = array(
								'exclude'  => array(
									22 /* extensions */,
									162 /* themes */,
									1572 /* child themes */,
									1571 /* featured theme */,
									1536 /* 3rd party */,
								),
							);
							$cats = get_terms( 'download_category', $cat_args );

							if ( $cats ) {
								$cat_list = '<div class="filter clearfix">';
								$cat_list .= '<ul class="download-categories clearfix">';
								$cat_list .= '<li><a href="' . home_url('/downloads') . '">All</a></li>';
								$cat_list .= '<li><a href="' . home_url('/downloads/?display=newest') . '">Newest</a></li>';

								foreach( $cats as $cat ) {
									$cat_list .= '<li><a href="' . get_term_link( $cat->slug, 'download_category' ) . '">' . $cat->name . '</a></li>';
								}

								$cat_list .= '</ul>';
								$cat_list .= '</div>';

								echo $cat_list;
							}
						?>
					</div>
					<section class="download-grid three-col clearfix">
						<?php while ( have_posts() ) : the_post(); ?>
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
						<?php endwhile; wp_reset_postdata(); ?>
						<?php eddwp_paginate_links(); ?>
						<div class="third-party-extensions-section">
							<p>View more extensions built by talented developers from the EDD community.</p>
							<a class="edd-submit button blue" href="<?php echo home_url( '3rd-party-extensions' ); ?>">3rd Party Extensions</a>
						</div>
					</section><!-- .download-grid three-col -->
				</div>
			</div>
		</div>

	</section><!-- /.main -->
	<?php
get_footer();
