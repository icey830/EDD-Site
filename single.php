<?php
/**
 * The template for displaying the blog index page.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<?php while ( have_posts() ) { the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
					<p class="entry-date"><span><?php the_date(); ?></span></p>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
						}
						the_content();
						eddwp_post_meta();
					?>
				</article>
				<?php } // end while ?>

				<div class="edd-post-footer clearfix">
					<div class="newsletter-wrap">
						<?php eddwp_newsletter_form(); ?>
					</div>
				</div>

				<?php
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template();
					}
				?>
			</section><!-- /.content -->

			<aside class="sidebar">
				<?php eddwp_newsletter_form(); ?>
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</aside><!-- /.sidebar -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>