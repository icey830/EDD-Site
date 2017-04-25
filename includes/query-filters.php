<?php
/*
 * Query filters and template redirects
 */


/**
 * product display filtering
 */
function eddwp_pre_get_posts( $query ) {

	if( is_admin() ) {
		return;
	}

	if( $query->is_main_query() && ( is_tax( 'download_category' ) || is_tax( 'download_tag' ) || is_tax( 'gateway_features' ) || is_tax( 'gateway_currencies' ) || is_tax( 'gateway_countries' ) ) ) {

		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );

	}

	if( $query->is_main_query() && is_post_type_archive( 'download' ) ) {

		$tax_query = array(
			array(
				'taxonomy' => 'download_category',
				'field'    => 'slug',
				'terms'    => '3rd-party',
				'operator' => 'NOT IN'
			)
		);

		$query->set( 'tax_query', $tax_query );

	}

	if( $query->is_main_query() && is_tax( 'download_category', '3rd-party' ) ) {

		$no_3rd_party_themes = array(
			array(
				'taxonomy' => 'download_category',
				'field'    => 'slug',
				'terms'    => 'themes',
				'operator' => 'NOT IN'
			)
		);

		$query->set( 'tax_query', $no_3rd_party_themes );
	}

	if( $query->is_main_query() && is_post_type_archive( 'download' ) && ! isset( $_GET['display'] ) ) {

		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
	}

	if ( $query->is_home() ) {
		if ( $query->is_main_query() ) {
			$query->set( 'posts_per_page', 2 );

		// modify blog home queries - part 1
		// https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
		} elseif ( ! $query->is_main_query() ) {
			$offset        = 2;
			$post_per_page = 15;
			if ( $query->is_paged ) {
				$blog_offset = $offset + ( ( $query->query_vars['paged']-1 ) * $post_per_page );
				$query->set( 'offset', $blog_offset );
			} else {
				$query->set( 'offset', $offset );
			}
		}
	}

	// remove downloads from blog search
	if( $query->is_main_query() && ( $query->is_search() || is_category() || is_tag() ) ) {
		$query->set( 'post_type', 'post' );
		$query->set( 'posts_per_page', 15 );
		$query->set( 'orderby', 'post_date' );
		$query->set( 'order', 'DESC' );
	}
}
add_action( 'pre_get_posts', 'eddwp_pre_get_posts', 99999999 );


// Modify Author archive query to display extensions only
function eddwp_author_archive_query( $query ) {
	if( $query->is_author ) {
		$query->set( 'post_type', 'download' );
	}
	remove_action( 'pre_get_posts', 'eddwp_author_archive_query' );
}
add_action( 'pre_get_posts', 'eddwp_author_archive_query' );


// modify blog home queries - part 2
// https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
function eddwp_adjust_offset_pagination( $found_posts, $query ) {
	$offset = 2;
	if ( ! $query->is_main_query() && $query->is_home() ) {
		return $found_posts - $offset;
	}
	return $found_posts;
}
add_filter( 'found_posts', 'eddwp_adjust_offset_pagination', 1, 2 );