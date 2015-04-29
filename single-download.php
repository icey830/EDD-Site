<?php
/**
 * The template for displaying a download.
 */

global $post;

get_header();
the_post();

if ( has_term( 'themes', 'download_category', get_the_ID() ) ) {
	$download_type = 'theme';
} else {
	$download_type = 'extension';
}

?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<?php
					the_title( '<h1 class="download-entry-title">', '</h1>' );

					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
					$old_default = 'https://easydigitaldownloads.com/wp-content/uploads/2013/07/defaultpng.png';

					if ( has_post_thumbnail() && $image[0] !== $old_default ) :
						the_post_thumbnail( 'edd_download_image', array( 'class' => 'featured-img' ) );
					endif;

					the_content();
				?>
			</section><!-- /.content -->

			<aside class="sidebar">
				<div class="box">
					<h3><?php echo ucfirst( $download_type ); ?> Details</h3>
					<div class="author clearfix">
						<p><span class="edd-download-detail-label">Developer:</span>&nbsp;
							<?php if ( get_post_meta( get_the_ID(), 'ecpt_developer', true ) ) : ?>
								<span class="edd-download-detail"><?php echo get_post_meta( get_the_ID(), 'ecpt_developer', true ); ?></span>
							<?php else : ?>
								<span class="edd-download-detail"><?php echo get_the_author(); ?></span>
							<?php endif; ?>
						</p>
					</div>
					<?php if( ! has_term( array( '3rd-party', 'bundles' ), 'download_category', get_the_ID() ) ) { ?>
					<div class="version clearfix">
						<?php
							$version = get_post_meta( get_the_ID(), '_edd_sl_version', true );
						?>
						<p><span class="edd-download-detail-label">Version:</span> <span class="edd-download-detail"><?php echo $version; ?></span></p>
					</div>
					<?php } // end if  ?>
					<?php if ( ! eddwp_is_extension_third_party() && ! eddwp_is_external_extension() ) { ?>
					<div class="pricing">
						<h3>Pricing</h3>
						<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
					</div>
					<div class="terms clearfix">
						<p><?php echo ucfirst( $download_type ) . 's'; ?> subject to yearly license for support and updates. <a href="https://easydigitaldownloads.com/docs/extensions-terms-conditions/" target="_blank">View license terms</a>.</p>
					</div>
					<?php } // end if ?>
					<?php if( eddwp_is_external_extension() ) { ?>
						<a href="<?php echo esc_url( eddwp_get_external_extension_url() ); ?>" title="View Details" class="edd-submit button blue">View <?php echo ucfirst( $download_type ); ?></a>
					<?php } ?>
					<?php
						if ( function_exists('p2p_register_connection_type') ) :
		
							$external_doc = get_post_meta( get_the_ID(), 'ecpt_documentationlink', true );

							// Find connected docs
							$docs = new WP_Query( array(
							  'connected_type' => 'downloads_to_docs',
							  'connected_items' => get_queried_object(),
							  'nopaging' => true,
							  'post_status' => 'publish'
							) );
		
							// Find connected forums
							$forums = new WP_Query( array(
							  'connected_type' => 'downloads_to_forums',
							  'connected_items' => get_queried_object(),
							  'nopaging' => true,
							  'post_status' => 'publish'
							) );
		
							if ( $forums->have_posts() || $docs->have_posts() || $external_doc ) {
								echo '<div class="related-items">';
									// Display connected posts
									if ( $external_doc || $docs->have_posts() ) :
										echo '<h3>Documentation</h3>';
										echo '<ul class="related-links">';
										if( empty( $external_doc ) ) :
											while ( $docs->have_posts() ) : $docs->the_post(); ?>
												<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
												<?php
											endwhile;
										else :
											echo '<li><a href="' . esc_url( $external_doc ) . '">View Setup Documentation</a></li>';
										endif;
										echo '</ul>';
										wp_reset_postdata();
									endif;							
									// Display connected posts
									if ( $forums->have_posts() ) :				
										echo '<h3>Support</h3>';
										while ( $forums->have_posts() ) : $forums->the_post(); ?>
											<div>Need help? Visit the <a href="<?php the_permalink(); ?>">Support Forums</a>.</div>
											<?php
										endwhile;
										wp_reset_postdata();
									endif;
								echo '</div>';
							}
						endif;
					?>
				</div>
			</aside><!-- /.sidebar -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>