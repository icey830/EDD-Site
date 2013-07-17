<?php
/* Template Name: Features */
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
				<h3>Not sure yet? Come by <a href="support.html">Support</a> and ask anything you want!</h3>
			</div><!-- /.feature-text-inner -->
		</section><!-- /.feature-text -->
	</section><!-- /.feature-area -->

<?php get_footer(); ?>