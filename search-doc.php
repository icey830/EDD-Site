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

$search = isset( $_GET['doc_s'] ) ? $_GET['doc_s'] : '';

$engine = SearchWP::instance();
// perform the search
$posts = $engine->search( 'documentation', $search, 1 );

?>
	<section class="main clearfix">
		<div class="container clearfix">
			<aside class="sidebar doc-search-sidebar">
				<?php get_template_part( 'docs', 'search-form' ); ?>
				<?php dynamic_sidebar( 'documentation-sidebar' ); ?>
			</aside><!-- /.sidebar -->

			<h1>Search results for: <span class="search-query"><?php $search; ?></span></h1>

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