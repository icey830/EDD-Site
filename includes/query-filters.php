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

	if( ! $query->is_main_query() || ! is_tax( 'extension_category' ) )
		return;

	$query->set( 'orderby', 'menu_order' );
	$query->set( 'order', 'ASC' );
}
add_action( 'pre_get_posts', 'eddwp_pre_get_posts', 9999 );