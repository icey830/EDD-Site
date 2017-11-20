<section class="download-grid three-col">
	<?php
	while ( have_posts() ) : the_post();
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