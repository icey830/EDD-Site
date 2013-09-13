<?php
/**
 * The template for displaying the doc section archives.
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
				<h1><?php single_term_title(); ?></h1>
				<?php while ( have_posts() ) : the_post(); ?>

					<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">

						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
					</article>

				<?php endwhile; ?>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>