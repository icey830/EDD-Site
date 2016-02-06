<?php
/**
 * generic archives template
 */

get_header(); ?>

	<div class="site-container">
		<section class="content">

			<?php if ( have_posts() ) : ?>
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

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

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'edd' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'edd');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'edd' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'edd' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'edd' );

						else :
							_e( 'Archives', 'edd' );

						endif;
					?>
				</h1>

				<?php while ( have_posts() ) : the_post(); ?>

					<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
						<p class="entry-date"><span><?php the_date(); ?></span></p>
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php
							the_excerpt();
							eddwp_post_meta();
						?>
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

			<?php endif; // end if - have_posts() ?>

		</section>
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>