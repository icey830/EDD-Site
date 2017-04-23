<?php
/**
 * generic archives template
 */

get_header(); ?>

	<div class="site-container">
		<section class="content">

			<?php if ( have_posts() ) : ?>
				<header class="page-header hentry">
					<h3 class="page-title">
						<?php
							if ( is_category() ) :
								single_cat_title( 'Category: ' );

							elseif ( is_tag() ) :
								single_tag_title( 'Tag: ' );

							elseif ( is_author() ) :
								/* Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								*/
								the_post();
								printf( __( 'Author: %s', 'edd' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'edd' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'edd' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'edd' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							else :
								_e( 'Archives', 'edd' );

							endif;
						?>
					</h3>
					<?php
						// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>
				</header>

				<?php while ( have_posts() ) : the_post(); ?>

					<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
						<div class="entry-header">
							<p class="entry-date"><i class="fa fa-calendar"></i> <span class="post-date updated"><?php echo get_the_date(); ?></span></p>
							<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
						</div>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
							<p><a class="edd-submit button blue" href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', 'edd' ); ?></a></p>
						</div>
						<div class="entry-footer">
							<?php eddwp_post_byline(); ?>
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

			<?php endif; // end if - have_posts() ?>

		</section>
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>