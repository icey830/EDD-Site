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

	<div class="extensions-header-area page-section-blue full-width">
		<div class="inner">
			<div class="extensions-header clearfix">
				<div class="section-header">
					<h2 class="section-title">Search Results for <strong><?php echo sanitize_text_field( stripslashes( $_GET['download_s'] ) ); ?></strong></h2>
					<p class="section-subtitle">Enter keywords in the form below to perform another search.</p>
					<div class="extensions-search-form">
						<form id="extensions-searchform" class="clearfix" action="<?php echo home_url( '/downloads/' ); ?>" method="get">
							<input class="extensions-search-text" type="search" name="download_s" placeholder="Ex. Payment Gateway" value="<?php echo $q['s']; ?>"/>
							<input class="extensions-search-submit edd-submit button darkblue" type="submit" value="Search" />
							<input type="hidden" name="action" value="download_search" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php

		// extensions search query
		$query = array(
			's'              => $q['s'],
			'post_type'      => 'download',
			'posts_per_page' => 23,
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
					'terms'    => 'bundles',
				),
			),
		);
		$s_query = new WP_Query( $query );

		// popular extensions query when there are no search results
		$pop_query = array(
			'post_type'      => 'download',
			'posts_per_page' => 23,
			'order'          => 'ASC',
			'paged'          => isset( $_GET['page'] ) ? (int) $_GET['page'] : 1,
			'tax_query' => array(
				'relation'     => 'AND',
				array(
					'taxonomy' => 'download_category',
					'field'    => 'slug',
					'terms'    => 'extensions',
				),
				array(
					'taxonomy' => 'download_category',
					'field'    => 'slug',
					'terms'    => 'popular',
				),
			),
		);
		$popular = new WP_Query( $pop_query );

		if ( ! $s_query->have_posts() ) :
			?>
			<div class="edd-no-search-results-area full-width">
				<div class="inner">
					<div class="edd-no-search-results">
						Oops! There are no matches for <em><?php echo stripslashes( $_GET['download_s'] ); ?></em>. Try searching again or browsing the add-ons below.
					</div>
				</div>
			</div>
			<?php
		endif;
	?>

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
					<?php
						echo eddwp_download_grid_promotions();

						// search results
						if ( $s_query->have_posts() ) :
							while ( $s_query->have_posts() ) : $s_query->the_post();
								echo eddwp_download_grid_item_markup();
							endwhile;
							wp_reset_postdata();

						// no search results
						else :
							while ( $popular->have_posts() ) : $popular->the_post();
								echo eddwp_download_grid_item_markup();
							endwhile;
							wp_reset_postdata();
						endif;
					?>
					<div class="download-grid-item flex-grid-cheat"></div>
					<div class="download-grid-item flex-grid-cheat"></div>
				</section><!-- .download-grid three-col -->
				<?php
					$big = 999999999;
					$base = home_url( 'downloads' ) . '/?' . remove_query_arg( 'page', $_SERVER['QUERY_STRING'] ) . '%_%';

					$links = paginate_links( array(
						'base'    => $base,
						'format'  => '&page=%#%',
						'current' => max( 1, isset( $_GET['page'] ) ? (int) $_GET['page'] : 1 ),
						'total'   => $s_query->have_posts() ? $s_query->max_num_pages : $popular->max_num_pages,
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
