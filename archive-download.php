<?php
/**
 * The template for displaying all the download items.
 *
 * This archive template doubles as the Extensions template.
 */

get_header();
the_post();
?>

	<div class="extensions-header-area page-section-blue full-width">
		<div class="inner">
			<div class="extensions-header clearfix">
				<div class="section-header">
					<h1 class="section-title">Extensions for Easy Digital Downloads</h1>
					<p class="section-subtitle">Use extensions built specifically for EDD to customize the functionality of your online business.</p>
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

	<div class="edd-downloads-area page-section-white full-width">
		<div class="inner">
			<div class="edd-downloads">
				<div class="section-header extensions-filter">
					<div class="filter-label">
						Categories:
					</div>
					<?php
						$cat_args = array(
							'exclude'  => array(
								1592 /* extensions */,
								1617 /* themes */,
								1571 /* featured theme */,
								1536 /* 3rd party */,
							),
						);
						$cats = get_terms( 'download_category', $cat_args );

						if ( $cats ) :
							$cat_list = '<div class="filter clearfix">';
							$cat_list .= '<ul class="download-categories clearfix">';
							$cat_list .= '<li><a href="' . home_url('/downloads') . '">All</a></li>';
							$cat_list .= '<li><a href="' . home_url('/downloads/?display=newest') . '">Newest</a></li>';

							foreach( $cats as $cat ) :
								$cat_list .= '<li><a href="' . get_term_link( $cat->slug, 'download_category' ) . '">' . $cat->name . '</a></li>';
							endforeach;

							$cat_list .= '</ul>';
							$cat_list .= '</div>';

							echo $cat_list;
						endif;
					?>
				</div>
				<section class="download-grid three-col clearfix">
					<?php echo eddwp_download_gird_promotions(); ?>
					<?php
						$extension_args = array(
							'post_type'      => 'download',
							'paged'          => get_query_var( 'paged' ),
							'posts_per_page' => 23,
							'order'          => isset( $_GET['display'] ) ? 'DESC' : 'ASC',
							'orderby'        => isset( $_GET['display'] ) ? 'date' : 'menu_order',
							'tax_query'      => array(
								'relation'   => 'AND',
								array(
									'taxonomy' => 'download_category',
									'field'    => 'slug',
									'terms'    => array( 'extensions', 'bundles' ),
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
								<div class="download-grid-thumb-wrap">
									<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
										<?php eddwp_downloads_grid_thumbnail(); ?>
									</a>
								</div>
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
					<div class="download-grid-item flex-grid-cheat"></div>
					<div class="download-grid-item flex-grid-cheat"></div>
				</section><!-- .download-grid three-col -->
				<?php
					$big = 999999999;
					$links = paginate_links( array(
						'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'  => '?&page=%#%',
						'current' => max( 1, get_query_var( 'paged' ) ),
						'total'   => $extensions->max_num_pages,
					) );
				?>
				<div class="pagination clearfix">
					<?php echo $links; ?>
				</div>
				<?php wp_reset_postdata(); ?>
				<div class="third-party-extensions-section">
					<p>View more extensions built by talented developers from the EDD community.</p>
					<a class="edd-submit button blue" href="<?php echo home_url( '3rd-party-extensions' ); ?>"><i class="fa fa-plug"></i>3rd Party Extensions</a>
				</div>
			</div>
		</div>
	</div>
	<?php

get_footer();
