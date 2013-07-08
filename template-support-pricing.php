<?php
/* Template Name: Support Pricing */

add_filter( 'body_class', function( $classes ) {
	$classes[] = 'support-pricing';
	
	return $classes;
} );

get_header();
?>

	<?php the_content(); ?>

<?php get_footer(); ?>