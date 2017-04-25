<?php
/**
 * main generic template
 */

get_header(); ?>

<div class="blog-home-area page-section-white full-width">
	<div class="inner">
		<div class="blog-home-content clearfix">

			<h2 class="section-title-alt">Recent posts<a href="#" class="subscribe-to-blog"><i class="fa fa-envelope" aria-hidden="true"></i> Sign up for email updates!</a></h2>

			<div class="continue-search-form">
				<?php get_search_form(); ?>
			</div>

			<section class="download-grid three-col clearfix">

				<?php if ( have_posts() ) : ?>

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

				<?php endif; ?>

			</section>

			<?php
			$big = 999999999;
			echo '<div class="pagination clearfix">' . paginate_links( array(
					'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
					'format'  => 'paged=%#%',
					'current' => max( 1, get_query_var( 'paged' ) ),
					'total'   => $wp_query->max_num_pages,
				) ) . '</div>';
			?>

		</div>
	</div>
</div>

<?php get_footer(); ?>