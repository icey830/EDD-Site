<?php
/**
 * template for displaying the search results
 */

get_header(); ?>

	<div class="site-container">
		<section class="content">

			<h1 class="page-title">
				<?php printf( __( 'Search Results for: %s', 'edd' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>

			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
					<p class="entry-date"><span><?php the_date(); ?></span></p>
					<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
					<p><a class="edd-submit button blue" href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', 'edd' ); ?></a></p>
					<?php eddwp_post_meta(); ?>
				</article>
			<?php endwhile; ?>

			<?php
				global $wp_query;
				if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>
					<div id="page-nav">
						<ul class="paged">
							<?php
								if ( get_next_posts_link() ) : ?>
									<li class="previous">
										<?php next_posts_link( __( '<span class="nav-previous meta-nav"><i class="fa fa-chevron-left"></i> Older</span>', 'edd' ) ); ?>
									</li>
									<?php
								elseif ( get_previous_posts_link() ) : ?>
									<li class="next">
										<?php previous_posts_link( __( '<span class="nav-next meta-nav">Newer <i class="fa fa-chevron-right"></i></span>', 'edd' ) ); ?>
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