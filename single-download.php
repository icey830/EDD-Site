<?php
/**
 * The template for displaying a download.
 */

global $post;

get_header();
the_post();
$is_payment_gateway   = has_term( 'gateways', 'download_category', get_the_ID() );
?>

	<div class="site-container">
		<section class="content">

			<article class="single-download-entry hentry" id="post-<?php echo get_the_ID(); ?>">
				<div class="entry-header">
					<?php the_title( '<h1 class="entry-title download-entry-title">', '</h1>' ); ?>
				</div>
				<div class="entry-content">
					<?php
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) );
					$old_default = home_url( '/wp-content/uploads/2013/07/defaultpng.png' );
					if ( has_post_thumbnail() && $image[0] !== $old_default ) :
						the_post_thumbnail( 'edd_download_image', array( 'class' => 'featured-img' ) );
					endif;
					if ( $is_payment_gateway ) {
						?>
						<div class="gateway-filter-note download-info-section">
							<span>Need help choosing the right payment gateway for your business? Use our <a href="<?php echo home_url( '/downloads/category/gateways/' ); ?>">payment gateway filter</a>.</span>
						</div>
						<?php
					}
					the_content();
					?>
				</div>
			</article>

		</section>
		<?php
			get_sidebar( 'download' );
			edd_get_template_part( 'single_recommendations' );
		?>
	</div>

<?php get_footer(); ?>