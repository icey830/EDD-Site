<?php
/**
 * The template for displaying the download category archives.
 */
global $wp_query;
get_header();
?>
	<section class="main clearfix">
		
		<?php $download_term = $wp_query->get_queried_object();	?>

		<div class="extensions-header-area full-width">
			<div class="inner">
				<div class="extensions-header clearfix">
					<div class="section-header">
						<h2 class="section-title">Category: <strong><?php echo $download_term->name; ?></strong></h2>
						<?php if ( ! empty( $download_term->description ) ) : ?>
							<p class="section-subtitle"><?php echo $download_term->description; ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="edd-downloads-area full-width">
			<div class="inner">
				<div class="edd-downloads">
					<section class="download-grid three-col clearfix">
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="download-grid-item">
								<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
									<?php
										the_post_thumbnail( 'download-grid-thumb', array(
											'class' => 'download-grid-thumb' )
										);
									?>
								</a>
								<div class="download-grid-item-info">
									<?php
										the_title( '<h4 class="download-grid-title">', '</h4>' );
										$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
										echo $short_desc;
									?>
								</div>
								<div class="download-grid-item-cta">
									<a class="download-grid-item-primary-link button" href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">More Information</a>
								</div>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</section><!-- .download-grid three-col -->
					<?php eddwp_paginate_links(); ?>
				</div>
			</div>
		</div>
		
	</section><!-- /.main -->
	<?php
get_footer();