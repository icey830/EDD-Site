<?php
/**
 * blog home template
 */
$top_args = array(
	'posts_per_page' => 2,
);
$top_query = new WP_query ( $top_args );

get_header(); ?>

	<div class="blog-home-area blog-home-recent-posts page-section-white full-width">
		<div class="inner">
			<div class="blog-home-content clearfix">
				<div class="continue-search-form">
					<?php get_search_form(); ?>
				</div>

				<h2 class="section-title-alt">Most recent posts<a href="#" class="subscribe-to-blog"><i class="fa fa-envelope" aria-hidden="true"></i> Sign up for email updates!</a></h2>

				<section class="recent-blog-posts download-grid two-col clearfix">

					<?php while ( $top_query->have_posts() ) : $top_query->the_post(); ?>
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

	<div class="blog-home-area blog-home-browse-posts page-section-white full-width">
		<div class="inner">
			<div class="blog-home-content clearfix">

				<div class="all-posts-header">
					<h2 class="section-title-alt">Browse categories</h2>
				</div>

				<?php eddwp_blog_categories(); ?>

				<?php
				// middle set of blog posts
				$middle_args = array(
					'posts_per_page' => 15,
					'offset'         => 2,
				);
				$middle_query = new WP_query ( $middle_args );
				?>

				<section class="download-grid three-col clearfix">

					<?php while ( $middle_query->have_posts() ) : $middle_query->the_post(); ?>
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

			</div>
		</div>
	</div>

<?php get_footer(); ?>