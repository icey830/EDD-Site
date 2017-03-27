<?php
/* Template Name: Affiliates Landing Page
 *
 * Main affiliates landing page
 */

get_header();
?>

<div class="affiliates-hero-area page-section-blue full-width">
	<div class="inner">
		<div class="affiliates-hero clearfix">
			<div class="featured-download-info">
				<span class="featured-download-label">Featured Theme</span>
				<?php
				the_title( '<h1 class="featured-download-title">', '</h1>' );
				the_excerpt();

				echo edd_get_purchase_link( array( 'id' => get_the_ID() ) );
				?>
				or <a class="featured-download-secondary-link" href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">see more information</a>
			</div>
			<div class="featured-download-thumb">
				<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
					<?php
					if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'featured-download', array( 'class' => 'featured-download-img' ) );
					endif;
					?>
				</a>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
