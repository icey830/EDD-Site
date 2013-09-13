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