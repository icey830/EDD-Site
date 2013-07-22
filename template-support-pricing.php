<?php
/* Template Name: Support Pricing */

/**
 * The template for displaying the Support Pricing page.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

add_filter( 'body_class', function( $classes ) {
	$classes[] = 'support-pricing';

	return $classes;
} );

get_header();

the_content();

get_footer();