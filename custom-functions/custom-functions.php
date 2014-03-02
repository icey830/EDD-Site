<?php

/*
Plugin Name: Custom Functions Plugin
Plugin URI: http://pippinsplugins.com/
Description: Put custom functions in this plugin
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Version: 1.0
*/


/*********************************************
* Connection types
*********************************************/


function eddwp_connection_types() {
	p2p_register_connection_type( array(
		'name' => 'extensions_to_docs',
		'from' => 'extension',
		'to' => 'docs',
		'reciprocal' => true
	) );
	p2p_register_connection_type( array(
		'name' => 'docs_to_docs',
		'from' => 'docs',
		'to' => 'docs',
		'reciprocal' => true
	) );
	p2p_register_connection_type( array(
		'name' => 'videos_to_docs',
		'from' => 'videos',
		'to' => 'docs',
		'reciprocal' => true
	) );
	p2p_register_connection_type( array(
		'name' => 'extensions_to_forums',
		'from' => 'extension',
		'to' => 'forum',
		'reciprocal' => true
	) );
}
add_action( 'p2p_init', 'eddwp_connection_types' );


function eddwp_extenstion_cats_shortcode() {

	$cats = get_terms( 'extension_category' );
	if( $cats ) {
		$return = '<ul class="extension-categories">';
			$return .= '<li><a href="' . home_url('/extensions') . '">All</a></li>';
			$return .= '<li><a href="' . home_url('/extensions/?display=newest') . '">Newest</a></li>';
			foreach( $cats as $cat ) {
				$return .= '<li><a href="' . get_term_link( $cat->slug, 'extension_category' ) . '">' . $cat->name . '</a></li>';
			}
		$return .= '</ul>';
		return $return;
	}
}
add_shortcode( 'extension_cats', 'eddwp_extenstion_cats_shortcode' );


function eddwp_bbpress_new_topic_notice() {
	if( bbp_is_single_forum() )
		echo '<div class="bbp-template-notice"><p>Please search the forums for existing questions before posting a new one.</p></div>';
}
add_action( 'bbp_template_notices', 'eddwp_bbpress_new_topic_notice');

function eddwp_query_filters( $query ) {
	if( ! isset( $_GET['display'] ) )
		return;

	switch( $_GET['display'] ) {

		case 'newest' :

			$query->set( 'order', 'DESC' );
			$query->set( 'orderby', 'date' );

			break;

	}
}
add_action( 'pre_get_posts', 'eddwp_query_filters', 999 );