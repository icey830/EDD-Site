<?php
/**
 * main generic template
 */

get_header(); ?>

	<div class="site-container">
		<section class="content">

			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
					<div class="entry-header">
						<span class="entry-date"><?php the_date(); ?></span>
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
						<p><a class="edd-submit button blue" href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', 'edd' ); ?></a></p>
					</div>
				</article>
			<?php endwhile; ?>

			<?php
				global $wp_query;
				if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>
					<div id="page-nav">
						<ul class="paged">
							<?php
								if ( get_next_posts_link() ) :
									?>
									<li class="previous">
										<?php next_posts_link( __( '<span class="nav-previous meta-nav">&larr; Older Posts</span>', 'edd' ) ); ?>
									</li>
									<?php
								endif;

								if ( get_previous_posts_link() ) :
									?>
									<li class="next">
										<?php previous_posts_link( __( '<span class="nav-next meta-nav">Newer Posts &rarr;</span>', 'edd' ) ); ?>
									</li>
									<?php
								endif;
							?>
						</ul>
					</div>
					<?php
				endif;
			?>

		</section>
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>