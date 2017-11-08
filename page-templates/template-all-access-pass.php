<?php
/**
 * Template Name: All Access Pass
 *
 * The template for displaying all downloads for All Access Pass members
 */

get_header();
the_post();

// check for All Access access to this product
$aa_has_access['success'] = false;
if ( class_exists( 'EDD_All_Access' ) ) {
	$aa_has_access = edd_all_access_check( array( 'download_id' => get_the_ID() ) );
}
?>

	<div id="all-access-downloads-area" class="edd-downloads-area page-section-white full-width">
		<div class="inner">
			<div class="edd-downloads all-access-downloads">
				<div class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				
				<?php if ( is_user_logged_in() && $aa_has_access['success'] ) : ?>
				
					<section class="download-grid three-col">
						<?php
						$all_extensions_args = array(
							'post_type'      => 'download',
							'paged'          => get_query_var( 'paged' ),
							'posts_per_page' => 9,
							'order'          => isset( $_GET['display'] ) ? 'DESC' : 'ASC',
							'orderby'        => isset( $_GET['display'] ) ? 'date' : 'title',
							'tax_query'      => array(
								'relation'   => 'AND',
								array(
									'taxonomy' => 'download_category',
									'field'    => 'slug',
									'terms'    => array( 'extensions' ),
								),
								array(
									'taxonomy' => 'download_category',
									'field'    => 'slug',
									'terms'    => '3rd-party',
									'operator' => 'NOT IN',
								),
							),
						);
						$all_extensions = new WP_Query( $all_extensions_args );
	
						while ( $all_extensions->have_posts() ) : $all_extensions->the_post();
							?>
							<div class="download-grid-item">
								<div class="download-grid-item-info">
									<?php
									$version = get_post_meta( get_the_ID(), '_edd_sl_version', true );
									the_title( sprintf(
										'<h4 class="download-grid-title"><a href="%s">',
										home_url( '/downloads/' . $post->post_name ) ),
										' <small>' . $version . '</small></a></h4>'
									);
									$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
									echo $short_desc;
									?>
								</div>
								<div class="download-grid-item-actions">
									<?php
										$download_button = edd_get_purchase_link( array( 'download_id' => get_the_ID(), 'style' => 'plain' ) );
										$doc_url = get_post_meta( get_the_ID(), 'ecpt_documentationlink', true );
									?>
									<?php echo $download_button; ?><?php echo $version ? ' | <a href="#" class="changelog-link" title="View Changelog" data-toggle="modal" data-target="#show-changelog-' . get_the_ID() . '">Changelog</a>' : ''; echo $doc_url ? ' | <a href="' . $doc_url . '">Documentation</a>' : ''; ?>
									<?php $changelog  = stripslashes( get_post_meta( get_the_ID(), '_edd_sl_changelog', true ) ); ?>
									<!-- Changelog Modal -->
									<div class="changelog-modal modal fade" id="show-changelog-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-<?php echo get_the_ID(); ?>">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h5 class="modal-title" id="myModalLabel"><?php the_title(); ?> Changelog</h5>
												</div>
												<div class="modal-body">
													<?php echo wpautop( $changelog ); ?>
												</div>
												<div class="modal-footer">
													<a href="#" data-dismiss="modal">Close</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
						<div class="download-grid-item flex-grid-cheat"></div>
						<div class="download-grid-item flex-grid-cheat"></div>
					</section>
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
				
				<?php else :  ?>
				
					<?php
						echo do_shortcode( '[edd_aa_all_access id="1006666"]' );	
					?>
				
				<?php endif;  ?>
			</div>
		</div>
	</div>
	<?php

get_footer();