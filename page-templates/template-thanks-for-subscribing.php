<?php
/**
 * Template Name: Thanks for Subscribing
 *
 * the template for newsletter subscription confirmation thanks
 */
get_header();

$post_args = array(
	'post_type'            => 'post',
	'posts_per_page'       => 2,
	'ignore_sticky_posts'  => true
);
$posts = new WP_Query( $post_args );
?>
<div class="newsletter-thanks-area blog-posts-display-area page-section-white full-width">
	<div class="inner">
		<div class="blog-posts-display-content">

			<h2 class="section-title-alt">Most recent posts &nbsp;<a href="<?php echo home_url( 'subscribe' ); ?>" class="subscribe-to-blog"><i class="fa fa-envelope" aria-hidden="true"></i> Sign up for email updates!</a></h2>

			<div class="continue-search-form">
				<?php get_search_form(); ?>
			</div>

			<section class="recent-blog-posts download-grid two-col clearfix">

				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
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
<?php
get_footer();