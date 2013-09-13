<?php
/* Template Name: Documentation */

/**
 * The template for displaying documentation.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

add_filter( 'body_class', function( $classes ) {
	$classes[] = 'documentation';

	return $classes;
} );

get_header();
the_post();
?>

	<section class="main clearfix">
		<div class="container clearfix">
			<aside class="sidebar">
				<?php get_template_part( 'docs', 'search-form' ); ?>
				<?php dynamic_sidebar( 'documentation-sidebar' ); ?>
			</aside><!-- /.sidebar -->

			<section class="content">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>