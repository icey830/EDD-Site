<?php
/* Template Name: Showcase */

/**
 * The template for displaying the Showcase page.
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
			<?php
			printf( '<h1>%1$s</h1><p>%2$s</p>', get_the_title(), 'A collection of just <span class="highlight">some</span> of the great websites running Easy Digital Downloads.' );
			?>
		</section><!-- /.content -->

		<section class="showcase clearfix">
			<div class="sites clearfix">
				<?php
				$featured_showcases = new WP_Query(
					array(
						'post_type'      => 'showcase',
						'posts_per_page' => 2,
						'tax_query'      => array(
							array(
								'taxonomy' => 'showcasecategory',
								'field'    => 'slug',
								'terms'    => 'featured',
								'operator' => 'IN'
							)
						)
					)
				);

				while ( $featured_showcases->have_posts() ) {
					$featured_showcases->the_post();
				?>
				<div class="featured-site">
						<a href="<?php $array = shortcode_parse_atts( get_the_content() ); echo $array['link']; ?>">
							<?php the_post_thumbnail( 'featured-showcase' ); ?>
						</a>
						<a class="text-overlay" href="<?php echo $array['link'] ?>">
							<?php the_title(); ?>
							<span class="button">Launch Website</span>
						</a><!-- /.text-overlay -->
					</div><!-- /.featured-site -->
				<?php
				}

				wp_reset_postdata();
				?>

				<div class="clearfix"></div>

				<?php
				$showcases = new WP_Query(
					array(
						'post_type' => 'showcase',
						'nopaging' => true,
						'tax_query' => array(
							array(
								'taxonomy' => 'showcasecategory',
								'field'    => 'slug',
								'terms'    => 'featured',
								'operator' => 'NOT IN'
							)
						)
					)
				);

				while ( $showcases->have_posts() ) {
					$showcases->the_post();
					?>
					<div class="site">
						<a href="<?php $array = shortcode_parse_atts( get_the_content() ); echo $array['link']; ?>">
							<?php the_post_thumbnail( 'showcase' ); ?>
						</a>
						<a class="text-overlay" href="<?php echo $array['link'] ?>">
							<?php the_title(); ?>
							<span class="button">Launch Website</span>
						</a><!-- /.text-overlay -->
					</div><!-- /.site -->
					<?php
				}

				wp_reset_postdata();
				?>
			</div><!-- /.sites -->
			<div class="the-content clearfix">
				<?php the_content(); ?>
			</div>
		</section><!-- /.showcase -->

	</section><!-- /.main -->
<?php get_footer(); ?>