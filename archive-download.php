<?php
/**
 * The template for displaying all the download items.
 */
?>

<?php get_header(); ?>

	<section class="main clearfix">

		<section class="edd-downloads-container">
			<div class="edd-downloads clearfix">
				<?php
				$c = 0; while ( have_posts() ) : the_post(); $c++;
				?>
					<div class="edd-download<?php if ( 0 == $c%3 ) echo ' edd-download-clear'; if ( has_term( '3rd Party', 'download_category', get_the_ID() ) ) echo ' third-party-edd-download'; if ( eddwp_is_extension_free() ) echo ' free-edd-download'; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
							<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
						</a>
						<div class="overlay">
							<a href="<?php the_permalink(); ?>" class="overlay-view-details button">View Details</a>
							<?php if( ! eddwp_is_external_extension() ) : ?>
								<a href="<?php echo home_url( '/checkout/?edd_action=add_to_cart&download_id=' . get_the_ID() ); ?>" class="overlay-add-to-cart button">Add to Cart</a>
							<?php endif; ?>
						</div>
						<?php
						if ( has_term( '3rd Party', 'download_category', get_the_ID() ) )
							echo '<i class="third-party"></i>';
						?>
					</div>
					<?php
				endwhile;

				eddwp_paginate_links();
				wp_reset_postdata();
				?>
			</div>
		</section><!-- /.edd-downloads-container -->
	</section><!-- /.main -->
		
<?php get_footer(); ?>