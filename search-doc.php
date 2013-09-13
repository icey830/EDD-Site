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

global $post;

$originalPost = $post;

$engine = SearchWP::instance();
// perform the search
$posts = $engine->search( 'documentation', get_search_query(), 1 );

?>
	<section class="main clearfix">
		<div class="container clearfix">
			<aside class="sidebar doc-search-sidebar">
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

			<h1>Search results for: <span class="search-query"><?php the_search_query(); ?></span></h1>

			<section class="content">
				<?php if( ! empty( $posts ) ) : ?>
					<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
						<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</article>
					<?php endforeach; ?>
				<?php else : ?>
					<article>
						<p>No results found.</p>
					</article>
				<?php endif; ?>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->
	<?php $post = $originalPost; ?>
<?php get_footer(); ?>