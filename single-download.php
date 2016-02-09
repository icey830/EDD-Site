<?php
/**
 * The template for displaying a download.
 */

global $post;

get_header();
the_post();
?>

	<div class="site-container">
		<section class="content">

			<article class="single-download-entry hentry" id="post-<?php echo get_the_ID(); ?>">
				<div class="entry-header">
						<?php the_title( '<h1 class="download-entry-title">', '</h1>' ); ?>
				</div>
				<div class="entry-content">
					<?php
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) );
						$old_default = home_url( '/wp-content/uploads/2013/07/defaultpng.png' );
						if ( has_post_thumbnail() && $image[0] !== $old_default ) :
							the_post_thumbnail( 'edd_download_image', array( 'class' => 'featured-img' ) );
						endif;
						the_content();
					?>
				</div>
			</article>

		</section>
		<?php get_sidebar( 'download' ); ?>
	</div>

<?php get_footer(); ?>