<?php
/**
 * The template for displaying the download tag archives.
 */

global $wp_query;
get_header();
$download_term = $wp_query->get_queried_object();
?>

	<div class="extensions-header-area page-section-blue full-width">
		<div class="inner">
			<div class="extensions-header clearfix">
				<div class="section-header">
					<h2 class="section-title">Tag: <strong><?php echo $download_term->name; ?></strong></h2>
					<?php if ( ! empty( $download_term->description ) ) : ?>
						<p class="section-subtitle"><?php echo $download_term->description; ?></p>
					<?php endif; ?>
					<div class="extensions-search-form">
						<form id="extensions-searchform" class="clearfix" action="<?php echo home_url( 'downloads' ); ?>" method="get">
							<input class="extensions-search-text" type="search" name="download_s" placeholder="Ex. Payment Gateway" />
							<input class="extensions-search-submit edd-submit button darkblue" type="submit" value="Search" />
							<input type="hidden" name="action" value="download_search" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="edd-downloads-area page-section-gray full-width">
		<div class="inner">
			<div class="edd-downloads">
				<section class="download-grid three-col clearfix">
					<?php while ( have_posts() ) : the_post(); ?>
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
					<?php endwhile; wp_reset_postdata(); ?>
				</section>
				<?php eddwp_paginate_links(); ?>
				<div class="third-party-extensions-section">
					<p>View more extensions built by talented developers from the EDD community.</p>
					<a class="edd-submit button blue" href="<?php echo home_url( '3rd-party-extensions' ); ?>"><i class="fa fa-plug"></i>3rd Party Extensions</a>
				</div>
			</div>
		</div>
	</div>
	<?php

get_footer();