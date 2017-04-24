<?php
/**
 * generic archives template
 */

get_header(); ?>

<div class="blog-home-area page-section-white full-width">
	<div class="inner">
		<div class="blog-home-content clearfix">

			<div class="continue-search-form">
				<?php get_search_form(); ?>
			</div>

			<?php if ( have_posts() ) : ?>
				<header class="page-header hentry">
					<h2 class="section-title-alt">
						<?php
						if ( is_category() ) :
							?>
							Category: <span class="queried-term"><?php single_cat_title(); ?></span>
							<?php

						elseif ( is_tag() ) :
							?>
							Tag: <span class="queried-term"><?php single_tag_title(); ?></span>
							<?php

						elseif ( is_author() ) :
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author: %s', 'edd' ), '<span class="vcard queried-term"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'edd' ), '<span class="queried-term">' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'edd' ), '<span class="queried-term">' . get_the_date( 'F Y' ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'edd' ), '<span class="queried-term">' . get_the_date( 'Y' ) . '</span>' );

						else :
							_e( 'Archives', 'edd' );

						endif;
						?>
					</h2>
				</header>

			<?php endif; ?>

			<?php
				if ( is_category() ) :
					eddwp_blog_categories();
				endif;
			?>

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