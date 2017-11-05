<?php
/**
 * Template Name: All Access Pass
 *
 * The template for displaying all downloads for All Access Pass members
 */

get_header();
the_post();
?>

	<div id="all-access-downloads-area" class="edd-downloads-area page-section-white full-width">
		<div class="inner">
			<div class="edd-downloads all-access-downloads">
				<div class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<section class="download-grid two-col clearfix">
					<?php
					$extension_args = array(
						'post_type'      => 'download',
						'paged'          => get_query_var( 'paged' ),
						'posts_per_page' => 45,
						'order'          => isset( $_GET['display'] ) ? 'DESC' : 'ASC',
						'orderby'        => isset( $_GET['display'] ) ? 'date' : 'menu_order',
						'tax_query'      => array(
							'relation'   => 'AND',
							array(
								'taxonomy' => 'download_category',
								'field'    => 'slug',
								'terms'    => array( 'extensions', 'bundles' ),
							),
							array(
								'taxonomy' => 'download_category',
								'field'    => 'slug',
								'terms'    => '3rd-party',
								'operator' => 'NOT IN',
							),
						),
					);
					$extensions = new WP_Query( $extension_args );

					while ( $extensions->have_posts() ) : $extensions->the_post();
						?>
						<div class="download-grid-item">
							<div class="download-grid-thumb-wrap">
								<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
									<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'all-access-download-thumb' ) ); ?>
								</a>
							</div>
							<div class="download-grid-item-info">
								<?php
								the_title( sprintf(
									'<h4 class="download-grid-title"><a href="%s">',
									home_url( '/downloads/' . $post->post_name ) ),
									'</a></h4>'
								);
								$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
								echo $short_desc;
								?>
							</div>
							<div class="download-grid-item-actions">
								Download!
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
					<div class="download-grid-item flex-grid-cheat"></div>
					<div class="download-grid-item flex-grid-cheat"></div>
				</section><!-- .download-grid three-col -->
				<?php
				$big = 999999999;
				$links = paginate_links( array(
					'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'  => '?&page=%#%',
					'current' => max( 1, get_query_var( 'paged' ) ),
					'total'   => $extensions->max_num_pages,
				) );
				?>
				<div class="pagination clearfix">
					<?php echo $links; ?>
				</div>
				<?php wp_reset_postdata(); ?>
				<div class="third-party-extensions-section">
					<p>View more extensions built by talented developers from the EDD community.</p>
					<a class="edd-submit button blue" href="<?php echo home_url( '3rd-party-extensions' ); ?>"><i class="fa fa-plug"></i>3rd Party Extensions</a>
				</div>
			</div>
		</div>
	</div>
	<?php

get_footer();