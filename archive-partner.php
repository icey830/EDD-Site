<?php
/**
 * The template for displaying all the Partners.
 */

get_header();
the_post();
?>

	<div class="edd-partners-area page-section-white full-width">
		<div class="inner">
			<div class="edd-partners">
				<h2 class="section-title-alt">Easy Digital Downloads Partners</h2>
				<section class="download-grid two-col clearfix">
					<?php
						$partner_args = array(
							'post_type'      => 'partner',
							'paged'          => get_query_var( 'paged' ),
							'posts_per_page' => -1,
							'order'          => isset( $_GET['display'] ) ? 'DESC' : 'ASC',
							'orderby'        => isset( $_GET['display'] ) ? 'date' : 'menu_order',
						);
						$partners = new WP_Query( $partner_args );

						while ( $partners->have_posts() ) : $partners->the_post();
							$url = get_post_meta( get_the_ID(), 'ecpt_partnerurl', true );
							?>
							<div class="download-grid-item">
								<div class="download-grid-thumb-wrap">
									<a href="<?php echo $url; ?>" title="<?php get_the_title(); ?>">
										<?php eddwp_downloads_grid_thumbnail(); ?>
									</a>
								</div>
								<div class="download-grid-item-info">
									<?php
										the_title(
											sprintf(
											'<h4 class="download-grid-title"><a href="%s">',
											$url ),
											'</a></h4>'
										);
										the_content();
									?>
								</div>
								<div class="download-grid-item-cta">
									<a class="download-grid-item-primary-link button" href="<?php echo $url; ?>" title="<?php get_the_title(); ?>">Visit <?php the_title(); ?></a>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					?>
					<div class="download-grid-item flex-grid-cheat"></div>
					<div class="download-grid-item flex-grid-cheat"></div>
				</section><!-- .download-grid two-col -->
				<?php wp_reset_postdata(); ?>
				<div class="become-a-partner-section">
					<p>Interested in becoming an official Easy Digital Downloads Partner?</p>
					<a class="edd-submit button blue" href="<?php echo home_url( 'support' ); ?>"><i class="fa fa-envelope-o"></i>Contact Us</a>
				</div>
			</div>
		</div>
	</div>
	<?php

get_footer();
