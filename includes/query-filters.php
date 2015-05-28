<?php
/*
 * Query filters and template redirects
 *
 */


function eddwp_template_redirects() {

	if( isset( $_GET['s_type'] ) && 'doc' == $_GET['s_type'] ) {
		include( get_template_directory() . '/search-doc.php' ); exit;
	}

}
add_action( 'template_redirect', 'eddwp_template_redirects' );

function eddwp_pre_get_posts( $query ) {

	if( is_admin() )
		return;

	if( $query->is_main_query() && is_tax( 'download_category' ) ) {

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

	if( $query->is_main_query() && is_post_type_archive( 'download' ) && ! isset( $_GET['display'] ) ) {

		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
	}

}
add_action( 'pre_get_posts', 'eddwp_pre_get_posts', 9999 );