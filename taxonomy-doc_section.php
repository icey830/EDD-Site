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