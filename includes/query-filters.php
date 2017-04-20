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

	// Modify Author archive query to display extensions only
	if( $query->is_author ) {
		$query->set( 'post_type', 'download' );
	}
	remove_action( 'pre_get_posts', 'eddwp_author_archive_query' );

}
add_action( 'pre_get_posts', 'eddwp_pre_get_posts', 99999999 );