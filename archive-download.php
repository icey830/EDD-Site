<?php
/**
 * The template for displaying all the download items.
 *
 * This archive template doubles as the Extensions template.
 */
get_header();
the_post();
?>
	<section class="main clearfix">

		<div class="extensions-header-area full-width">
			<div class="inner">
				<div class="extensions-header clearfix">
					<div class="section-header">
						<h2 class="section-title">Extensions for Easy Digital Downloads</h2>
						<p class="section-subtitle">Use extensions built specifically for EDD to customize the functionality of your online business.</p>
						<div class="extensions-search-form">
							<form id="extensions-searchform" class="clearfix" action="<?php echo home_url( 'downloads' ); ?>" method="get">
								<input class="extensions-search-text" type="search" name="download_s" placeholder="Ex. Payment Gateway" />
								<input class="extensions-search-submit button" type="submit" value="Search" />
								<input type="hidden" name="action" value="download_search" />
							</form>
						</div>
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
						<div id="extensions-bundle-promotion" class="download-grid-item extensions-bundle-promotion">
							<?php
								$bundle_promotion = array(
									0 => array(
										'url'   => home_url( '/?extension=core-extensions-bundle' ),
										'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/core-extensions-bundle-featured.png',
										'title' => 'Core Extensions Bundle',
										'desc'  => 'With the core extensions bundle, get over $2,000 worth of extensions for only $495.',
									),
									1 => array(
										'url'   => home_url( '/starter-package' ),
										'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/starter-package-featured.png',
										'title' => 'Extension Starter Package',
										'desc'  => 'Build your own extension starter package and automatically save 30% on our order.',
									)
								);
								$num = rand( 0, 1 );
							?>
							<a href="<?php echo $bundle_promotion[ $num ]['url']; ?>" title="<?php echo $bundle_promotion[ $num ]['title']; ?>">
								<img class="download-grid-thumb" src="<?php echo $bundle_promotion[ $num ]['image']; ?>"  alt="<?php echo $bundle_promotion[ $num ]['title']; ?>">
							</a>
							<div class="download-grid-item-info">
								<h4 class="download-grid-title"><?php echo $bundle_promotion[ $num ]['title']; ?></h4>
								<p><?php echo $bundle_promotion[ $num ]['desc']; ?></p>
							</div>
							<div class="download-grid-item-cta">
								<a class="green-button" href="<?php echo $bundle_promotion[ $num ]['url']; ?>">More Information</a>
							</div>
						</div>
						<?php
							$extension_args = array(
								'post_type'      => 'download',
								'paged'          => get_query_var( 'paged' ),
								'posts_per_page' => 23,
								'order'          => 'ASC',
								'tax_query'      => array(
									'relation'   => 'AND',
									array(
										'taxonomy' => 'download_category',
										'field'    => 'slug',
										'terms'    => 'extensions',
									),
									array(
										'taxonomy' => 'download_category',
										'field'    => 'slug',
										'terms'    => '3rd-party',
										'operator' => 'NOT IN',
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
											the_title( '<h4 class="download-grid-title">', '</h4>' );
											$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
											echo $short_desc;
										?>
									</div>
									<div class="download-grid-item-cta">
										<a class="download-grid-item-primary-link button" href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">More Information</a>
									</div>
									<?php
										$thrid_party = has_term( '3rd Party', 'download_category', $post->id );
										if( $thrid_party ) {
											echo '<i class="third-party"></i>';
										}
									?>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
						?>
					</section><!-- .download-grid two-col -->
					<?php
						$big = 999999999;
						$links = paginate_links( array(
							'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'  => '?&page=%#%',
							'current' => max( 1, get_query_var( 'paged' ) ),
							'total'   => $extensions->max_num_pages
						) );
					?>
					<div class="pagination clearfix">
						<?php echo $links; ?>
					</div>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>

	</section>
	<?php
get_footer();
