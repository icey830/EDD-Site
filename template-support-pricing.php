<?php
/* Template Name: Support Pricing */

/**
 * The template for displaying the Support Pricing page.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

add_filter( 'body_class', function( $classes ) {
	$classes[] = 'support-pricing';

	return $classes;
} );

get_header();

the_content();

?>
<section class="main clearfix">
	<section class="content clearfix">
		<h2>We have a <ins>lot</ins> of happy customers!</h2>

		<?php
		$testimonials = new WP_Query(
			array(
				'posts_per_page' => 6,
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
	</section><!-- /.content -->
</section><!-- /.main -->
<?php

get_footer();