<?php
/**
 * blog home template
 */
$blog_front = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
get_header(); ?>

<?php if ( 1 === $blog_front ) : ?>

	<div class="blog-home-area blog-home-recent-posts page-section-white full-width">
		<div class="inner">
			<div class="blog-home-content clearfix">

				<h2 class="section-title-alt">Most recent posts &nbsp;<a href="#" class="subscribe-to-blog"><i class="fa fa-envelope" aria-hidden="true"></i> Sign up for email updates!</a></h2>

				<div class="continue-search-form">
					<?php get_search_form(); ?>
				</div>

				<section class="recent-blog-posts download-grid two-col clearfix">

					<?php while ( have_posts() ) : the_post(); ?>
						<div <?php post_class( 'download-grid-item' ); ?> id="post-<?php echo get_the_ID(); ?>">

							<div class="entry-header">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="download-grid-thumb-wrap">
										<a href="<?php echo get_permalink(); ?>" title="<?php get_the_title(); ?>">
											<?php the_post_thumbnail( 'full', array( 'class' => 'download-grid-thumb' ) ); ?>
										</a>
									</div>
								<?php } ?>
							</div>

							<div class="download-grid-item-info entry-content">
								<?php
									eddwp_post_byline();
									the_title( sprintf( '<h1 class="entry-title download-grid-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h1>' );
									the_excerpt();
								?>
							</div>

							<div class="entry-footer">
								<?php eddwp_post_terms(); ?>
							</div>

						</div>
					<?php endwhile; wp_reset_postdata(); ?>
					<div class="download-grid-item flex-grid-cheat"></div>
					<div class="download-grid-item flex-grid-cheat"></div>

				</section>

			</div>
		</div>
	</div>

<?php endif; ?>

	<div class="blog-home-area <?php echo ( 1 === $blog_front ) ? 'blog-home-browse-posts' : ''; ?> page-section-white full-width">
		<div class="inner">
			<div class="blog-home-content clearfix">

				<?php if ( 1 === $blog_front ) : ?>
					<h2 class="section-title-alt">Browse categories</h2>
				<?php else : ?>
					<h2 class="section-title-alt">Browse posts &nbsp;<a href="#" class="subscribe-to-blog"><i class="fa fa-envelope" aria-hidden="true"></i> Sign up for email updates!</a></h2>

					<div class="continue-search-form">
						<?php get_search_form(); ?>
					</div>
				<?php endif; ?>

				<?php eddwp_blog_categories(); ?>

				<?php
				// middle set of blog posts
				$args = array(
					'posts_per_page' => 15,
					'paged' => get_query_var( 'paged' )
				);
				$main_blog = new WP_query ( $args );
				?>

				<section class="download-grid three-col clearfix">

					<?php while ( $main_blog->have_posts() ) : $main_blog->the_post(); ?>
						<div <?php post_class( array( 'download-grid-item', 'secondary-posts' ) ); ?> id="post-<?php echo get_the_ID(); ?>">

							<div class="entry-header">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="download-grid-thumb-wrap">
										<a href="<?php echo get_permalink(); ?>" title="<?php get_the_title(); ?>">
											<?php the_post_thumbnail( 'full', array( 'class' => 'download-grid-thumb' ) ); ?>
										</a>
									</div>
								<?php } ?>
							</div>

							<div class="download-grid-item-info">

								<?php
								eddwp_post_byline_lite();
								the_title( sprintf( '<h1 class="entry-title download-grid-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h1>' );
								?>
							</div>

						</div>
					<?php endwhile; wp_reset_postdata(); ?>
					<div class="download-grid-item flex-grid-cheat"></div>
					<div class="download-grid-item flex-grid-cheat"></div>

				</section>

				<?php
				$big = 999999999;
				echo '<div class="pagination clearfix">' . paginate_links( array(
						'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
						'format' => 'paged=%#%',
						'current' => max( 1, get_query_var( 'paged' ) ),
						'total' => $main_blog->max_num_pages,
					) ) . '</div>';
				?>

			</div>
		</div>
	</div>

<?php get_footer(); ?>