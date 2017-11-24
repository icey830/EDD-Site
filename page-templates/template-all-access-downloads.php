<?php
/**
 * Template Name: All Access Downloads
 *
 * The template for displaying all downloads for All Access members
 */

get_header();
the_post();
?>

	<div id="all-access-downloads-area" class="edd-downloads-area page-section-white full-width">
		<div class="inner">
			<div class="edd-downloads all-access-downloads">
				<div class="entry-header">
					<h2 class="section-title-alt"><?php the_title(); ?> &nbsp;<a href="<?php echo home_url( 'subscribe' ); ?>" class="page-title-button"><i class="fa fa-user" aria-hidden="true"></i> Visit your account page</a></h2>
				</div>

				<p class="has-all-access-description">Thanks for being an All Access Pass customer! Below, we've compiled a list of all the extensions you have access to. From here, you can download any extension, view its documentation, or even read its changelog.</p>

				<?php
				/*
				if ( function_exists( 'FWP' ) ) { ?>
					<div class="fwp-filter-wrap clearfix">
						<span class="fwp-filter-help-text">Filter by category</span>
						<div class="fwp-filter-container">
							<div class="fwp-filter">
								<?php echo facetwp_display( 'facet', 'download_categories' ); ?>
							</div>
						</div>
					</div>
					<?php echo facetwp_display( 'template', 'all_access_downloads' );
					echo facetwp_display( 'pager' );
				} else {
					// Where the below code goes when we turn FacetWP back on for this page
				}
				*/
				$aa_downloads = array(
					"post_type"        => "download",
					"post_status"      => "publish",
					'paged'            => get_query_var( 'paged' ),
					"posts_per_page"   => 24,
					'order'            => isset( $_GET['display'] ) ? 'DESC' : 'ASC',
					'orderby'          => isset( $_GET['display'] ) ? 'date' : 'title',
					"tax_query"        => array(
						'relation'     => 'AND',
						array(
							'taxonomy' => 'download_category',
							'field'    => 'slug',
							'terms'    => array( 'extensions' ),
						),
						array(
							'taxonomy' => 'download_category',
							'field'    => 'slug',
							'terms'    => array( '3rd-party', 'bundles', 'all-access' ),
							'operator' => 'NOT IN',
						),
					)
				);
				$aad = new WP_Query( $aa_downloads );
				?>
				<section class="download-grid three-col">
					<?php
					while ( $aad->have_posts() ) : $aad->the_post();
						// one last time, make sure the user has access to each product
						$aa_check = eddwp_user_has_aa_access( get_the_ID() );
						$aa_has_access = $aa_check[0] ? true : false;
						if ( $aa_has_access ) :
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
						endif;
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
					'total'   => $aad->max_num_pages,
				) );
				?>
				<div class="pagination clearfix">
					<?php echo $links; ?>
				</div>
				<?php
				?>
			</div>
		</div>
	</div>
	<?php

get_footer();