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

				<?php
				global $wp_query;
				if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { ?>
					<div id="page-nav">
						<ul class="paged">
							<?php if( get_next_posts_link() ) { ?>
								<li class="previous">
									<?php next_posts_link( __( '<span class="nav-previous meta-nav"><i class="fa fa-chevron-left"></i> Older</span>', 'edd' ) ); ?>
								</li>
							<?php
							} if( get_previous_posts_link() ) { ?>
								<li class="next">
									<?php previous_posts_link( __( '<span class="nav-next meta-nav">Newer <i class="fa fa-chevron-right"></i></span>', 'edd' ) ); ?>
								</li>
							<?php } ?>
						</ul><!-- /.paged -->
					</div><!-- /#page-nav -->
				<?php
				} // end if

				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
				?>
			</section><!-- /.content -->

			<aside class="sidebar">
				<?php eddwp_newsletter_sidebar(); ?>
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</aside><!-- /.sidebar -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>