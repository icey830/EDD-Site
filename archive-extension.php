<?php
/* Template Name: Extensions */

/**
 * The template for displaying all the extensions.
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
		<?php get_template_part( 'extensions', 'header' ); ?>

		<section class="extensions-container">
			<div class="extensions clearfix">
				<?php
				$c = 0; while ( have_posts() ) : the_post(); $c++;
				?>
					<div class="extension <?php if ( 0 == $c%3 ) echo ' extension-clear'; ?> <?php if ( has_term( '3rd Party', 'extension_category', get_the_ID() ) ) echo ' third-party-extension'; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
							<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
						</a>
						<div class="overlay">
							<a href="<?php the_permalink(); ?>" class="overlay-view-details button">View Details</a>
							<?php if( ! eddwp_is_external_extension() ) : ?>
								<a href="<?php echo home_url( '/checkout/?edd_action=add_to_cart&download_id=' . get_post_meta( get_the_ID(), 'ecpt_downloadid', true ) ); ?>" class="overlay-add-to-cart button">Add to Cart</a>
							<?php endif; ?>
						</div>
						<?php
						if ( has_term( '3rd Party', 'extension_category', get_the_ID() ) )
							echo '<i class="third-party"></i>';
						?>
					</div>
					<?php
				endwhile;

				eddwp_paginate_links();
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