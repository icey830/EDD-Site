<?php
/* Template Name: Features */

/**
 * The template for displaying the Features page.
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

	<section class="headline">
		<h1><?php the_content(); ?></h1>
	</section>

	<?php
	$features = new WP_Query( array( 'post_type' => 'features', 'nopaging' => true, 'order' => 'ASC' ) );

	while ( $features->have_posts() ) {
		$features->the_post();
		?>
		<section class="feature-area <?php echo ( 'Yes' == get_post_meta( get_the_ID(), 'ecpt_padding', true ) ) ? 'feature-pad' : null; ?> <?php echo 'feature-' . get_post_meta( get_the_ID(), 'ecpt_position', true ); ?> feature-<?php the_ID(); ?>">
			<section class="feature-text">
				<div class="feature-text-inner">
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>
				</div><!-- /.feature-text-inner -->
				<img src="<?php echo get_post_meta( get_the_ID(), 'ecpt_featureimageurl', true ); ?>" />
			</section><!-- /.feature-text -->
		</section><!-- /.feature-area -->
		<?php
	}

	wp_reset_postdata();
	?>
	<section class="feature-area" id="feature-edd">
		<section class="feature-text">
			<div class="feature-text-inner">
				<h3>Not sure yet? Come by <a href="<?php echo home_url( '/support/' ); ?>">Support</a> and ask anything you want!</h3>
			</div><!-- /.feature-text-inner -->
		</section><!-- /.feature-text -->
	</section><!-- /.feature-area -->

	<section class="feature-area" id="feature-testimonials">
		<section class="feature-text">
			<div class="feature-text-inner">
				<h2>With over 300,000 downloads, we got your back...</h2>
				<p>We have <del>some</del> <ins>a lot</ins> of happy customers and here's what some are saying:</p>

				<div class="testimonials">
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
				?>
				</div><!-- /.testimonials -->
			</div><!-- /.feature-text-inner -->
		</section><!-- /.feature-text -->
	</section><!-- /.feature-area -->

<?php get_footer(); ?>