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
				<aside id="search-wp-widget" class="widget widget_doc_search">
					<div class="search-widet-wrap">
						<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
							<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'edd' ); ?>" />
							<input type="hidden" name="s_type" value="doc" />
							<input type="submit" class="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'edd' ); ?>" />
						</form>
					</div>
				</aside>
				<?php dynamic_sidebar( 'documentation-sidebar' ); ?>
			</aside><!-- /.sidebar -->

			<section class="content">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>