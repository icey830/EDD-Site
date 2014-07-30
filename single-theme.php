<?php
/**
 * The template for displaying a theme.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

get_header();
the_post();
$exclude_ids = array( get_the_ID() );
?>

	<section class="headline">
		<h1><?php the_title(); ?></h1>
	</section>

	<section class="theme-preview">
		<?php the_post_thumbnail( 'full' ); ?>
	</section>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<?php the_content(); ?>
			</section><!-- /.content -->

			<aside class="sidebar">
				<?php echo get_post_meta( get_the_ID(), 'ecpt_sidebar', true ); ?>
				<div class="social-share">
					
				</div><!-- /.social-share -->
			</aside><!-- /.sidebar -->
		</div><!-- /.container -->
	</section><!-- /.main -->

	<section class="secondary">
		<div class="container clearfix">
			<section class="quotes clearfix">
				<h2>Serving over 300,000 customers</h2>
				<p>We have <del>some</del> <ins>a lot</ins> of happy customers and here's what some are saying:</p>
				<div class="clearfix">
					<?php
					$testimonials = new WP_Query(
						array(
							'posts_per_page' => 2,
							'post_type' => 'testimonials',
							'orderby' => 'rand',
							'post_status' => 'publish',
						)
					);

					while ( $testimonials->have_posts() ) {
						$testimonials->the_post(); ?>
						<div class="quote">
							<blockquote>
								<p><?php the_content(); ?></p>
								<cite><?php echo get_post_meta( get_the_ID(), 'ecpt_author', true ); ?></cite>
							</blockquote>
						</div>
					<?php
					}

					wp_reset_postdata();
					wp_reset_query();

					?>
				</div><!-- /.clearfix -->
				<div class="themes clearfix">
					<h2>Browse our theme collection</h2>
					<?php
					$themes = new WP_Query(
						array(
							'posts_per_page' => 3,
							'post_type' => 'theme',
							'orderby' => 'rand',
							'post_status' => 'publish',
							'post__not_in' => $exclude_ids
						)
					);

					$c = 0; while ( $themes->have_posts() ) { $c++;
						$themes->the_post(); ?>
						<div class="theme <?php if ( 0 == $c % 3 ) echo ' theme-clear'; ?>">
							<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
								<div class="thumbnail-holder"><?php the_post_thumbnail( 'theme-showcase' ); ?></div>
								<span class="theme-name"><?php the_title(); ?></span>
							</a>
						</div>
					<?php
					}
					
					wp_reset_postdata();
					wp_reset_query();
					?>
				</div><!-- /.themes -->
			</section>
		</div>
	</section><!-- /.secondary -->

<?php get_footer(); ?>