<?php
/* Template Name: Themes */

/**
 * The template for displaying Themes.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

get_header();
the_post();
?>
	<section class="main clearfix">
		<section class="content clearfix">
			<h1><?php the_title(); ?></h1>
		</section><!-- /.content -->

		<section class="themes-container">
			<div class="themes clearfix">
				<?php
				$themes =  new WP_Query( array( 'post_type' => 'theme', 'posts_per_page' => 30, 'paged' => get_query_var( 'paged' ) ) );
				$c = 0; while ( $themes->have_posts() ) { $themes->the_post(); $c++;
				?>
					<div class="theme <?php if ( 0 == $c%3 ) echo ' theme-clear'; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
						</a>
						<a class="overlay" href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<span class="button">View Details</span>
						</a>
					</div>
				<?php
				}

				$big = 999999999;

				$links = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $themes->max_num_pages
				));
				?>
				<div class="clear"></div>
				<div class="pagination">
					<?php echo $links; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			</div><!-- /.themes -->
		</section><!-- /.theme-container -->
	</section><!-- /.main -->
<?php get_footer(); ?>