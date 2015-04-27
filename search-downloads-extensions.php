<?php
/**
 * The template for displaying search results for downloads with "extensions" category.
 */
get_header();

$q['s'] = $_GET['download_s'];
$q['s'] = sanitize_text_field( stripslashes( $q['s'] ) );
if ( empty( $_GET['s'] ) && $wp_query->is_main_query() ) {
	$q['s'] = urldecode( $q['s'] );
}
?>
	<section class="main clearfix">

		<div class="extensions-header-area full-width">
			<div class="inner">
				<div class="extensions-header clearfix">
					<div class="section-header">
						<h2 class="section-title">Search Results for <strong><?php echo sanitize_text_field( stripslashes( $_GET['download_s'] ) ); ?></strong></h2>
						<p class="section-subtitle">Enter keywords in the form below to perform another search.</p>
						<div class="extensions-search-form">
							<form id="extensions-searchform" class="clearfix" action="<?php echo home_url( 'extensions-template' ); ?>" method="get">
								<input class="extensions-search-text" type="search" name="download_s" placeholder="Ex. Payment Gateway" value="<?php echo $q['s']; ?>"/>
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
									162 /* live site - themes */,
									1571 /* live site - featured theme */,
									11 /* local site - themes (delete) */,
									187 /* local site - featured theme (delete) */,
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
								<a class="download-grid-item-secondary-link gray-button" href="<?php echo $bundle_promotion[ $num ]['url']; ?>">More Information</a>
							</div>
						</div>
						<?php
							$query = array(
								's'              => $q['s'],
								'post_type'      => 'download',
								'posts_per_page' => 20,
								'paged'          => isset( $_GET['page'] ) ? (int) $_GET['page'] : 1,
								'tax_query' => array(
									'relation'     => 'OR',
									array(
										'taxonomy' => 'download_category',
										'field'    => 'slug',
										'terms'    => 'extensions',
									),
									array(
										'taxonomy' => 'download_category',
										'field'    => 'slug',
										'terms'    => 'bundle',
									),
								),
							);
							
							$s_query = new WP_Query( $query );

							while ( $s_query->have_posts() ) : $s_query->the_post();
								?>
								<div class="download-grid-item">
									<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
										<?php
											the_post_thumbnail( 'download-grid-thumb', array(
												'class' => 'download-grid-thumb' )
											);
										?>
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
					</section><!-- .download-grid three-col -->
					<?php
						$big = 999999999;
						$base = home_url( 'extensions-template' ) . '/?' . remove_query_arg( 'page', $_SERVER['QUERY_STRING'] ) . '%_%';
		
						$links = paginate_links( array(
							'base'    => esc_url( $base ),
							'format'  => '&page=%#%',
							'current' => max( 1, isset( $_GET['page'] ) ? (int) $_GET['page'] : 1 ),
							'total'   => $s_query->max_num_pages
						) );
					?>
					<div class="pagination">
						<?php echo $links; ?>
					</div>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>

	</section>
	<?php
get_footer();