<?php
/**
 * The template for displaying the download category archives.
 */
global $wp_query;
get_header();
?>
	<section class="main clearfix">
		
		<?php $download_term = $wp_query->get_queried_object();	?>
		
		<section class="content clearfix">
			<h1 class="edd-download-tax-title">Category: <?php echo $download_term->name; ?></h1>
			<?php if ( ! empty( $download_term->description ) ) : ?>
				<p class="edd-download-tax-description"><?php echo $download_term->description; ?></p>
			<?php endif; ?>
			<div class="clearfix"></div>
		</section><!-- /.content -->

		<section class="edd-downloads-container">
			<div class="edd-downloads clearfix">
				<?php $c = 0; while ( have_posts() ) { the_post(); $c++; ?>
					<div class="edd-download <?php if ( 0 == $c%3 ) echo ' edd-download-clear'; ?> <?php if ( has_term( '3rd Party', 'download_category', get_the_ID() ) ) echo ' third-party-edd-download'; ?>">
						<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
							<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
						</a>
						<div class="overlay">
							<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" class="overlay-view-details button">View Details</a>
							<?php if( ! eddwp_is_external_extension() ) : ?>
								<a href="<?php echo home_url( '/checkout/?edd_action=add_to_cart&download_id=' . get_post_meta( get_the_ID(), 'ecpt_downloadid', true ) ); ?>" class="overlay-add-to-cart button">Add to Cart</a>
							<?php endif; ?>
						</div>
						<?php
						if ( has_term( '3rd Party', 'download_category', get_the_ID() ) ) {
							echo '<i class="third-party"></i>';
						}
						?>
					</div>
					<?php
				}

				eddwp_paginate_links();
				?>
			</div>
		</section><!-- /.edd-downloads-container -->
	</section><!-- /.main -->
<?php get_footer(); ?>
