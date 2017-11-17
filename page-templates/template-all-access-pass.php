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
				
					<p class="has-all-access-description">Thanks for being an All Access Pass customer! Below, we've compiled a list of all the extensions you have access to. From here, you can download any extension, view its documentation, or even read its changelog. You may also view access pass details on <a href="<?php echo home_url( 'your-account/#tab-all-access' ); ?>">your account page</a>.</p>
				
					<?php
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
						include( 'edd_templates/template-all-access-pass-grid.php' );
						eddwp_paginate_links();
					}
					?>
				
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