<?php
/**
 * The template for displaying all the videos.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
global $wp_query;
get_header();
?>
	<section class="main clearfix">

		<section class="extensions-container">
			<h1>Videos</h1>
			<div class="extensions clearfix">
				<?php
				$c = 0; while ( have_posts() ) : the_post(); $c++;
				?>
					<div class="extension <?php if ( 0 == $c%3 ) echo ' extension-clear'; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
						</a>
						<?php the_excerpt(); ?>
						<div class="overlay">
							<a href="<?php the_permalink(); ?>" class="overlay-view-details button">View Video</a>
						</div>
					</div>
					<?php
				endwhile;

				$big = 999999999;

				$links = paginate_links(
					array(
						'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'  => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total'   => $wp_query->max_num_pages
					)
				);
				?>
				<div class="clear"></div>
				<div class="pagination">
					<?php echo $links; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			</div>
		</section><!-- /.extensions-container -->
	</section><!-- /.main -->
<?php get_footer(); ?>