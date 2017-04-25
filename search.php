<?php
/**
 * template for displaying the search results
 */

get_header();
?>

<div class="blog-home-area blog-posts-display-area page-section-white full-width">
	<div class="inner">
		<div class="blog-posts-display-content clearfix">

			<?php if ( have_posts() ) : ?>

				<h2 class="section-title-alt">Search results: <span class="queried-term"><?php echo sanitize_text_field( stripslashes( $_GET['s'] ) ); ?></span></h2>

			<?php else : ?>

				<h2 class="section-title-alt">No results found for: <span class="queried-term"><?php echo sanitize_text_field( stripslashes( $_GET['s'] ) ); ?></span></h2>

				<p class="alert">Oops! That keyword phrase returns no results. Try searching again or browsing the posts below.</p>

			<?php endif; ?>

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

				<?php else : ?>

					<?php
					// no results query
					$n_query = array(
						'post_type'      => 'post',
						'posts_per_page' => 15,
						'paged'          => isset( $_GET['page'] ) ? (int) $_GET['page'] : 1,
					);
					$nr_query = new WP_Query( $n_query );
					?>

					<?php while ( $nr_query->have_posts() ) : $nr_query->the_post(); ?>
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

							<div class="entry-footer">
								<?php //eddwp_post_terms(); ?>
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
					'total'   => $wp_query->have_posts() ? $wp_query->max_num_pages : $nr_query->max_num_pages,
				) ) . '</div>';
			?>

		</div>
	</div>
</div>

<?php get_footer(); ?>