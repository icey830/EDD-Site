<?php
/* Template Name: Affiliates Landing Page
 *
 * Main affiliates landing page
 */

get_header(); ?>

<div class="affiliates-hero-area hero-area page-section-blue full-width">
	<div class="inner">
		<div class="affiliates-hero hero-content clearfix">
			<div class="hero-info">
				<div class="hero-headline">
					<span class="hero-subtitle">Refer customers and earn cash with the</span>
					<h1 class="hero-title">Easy Digital Downlaods Affiliate Program</h1>
				</div>
				<p class="hero-cta">
					<a class="hero-primary-cta-button" href="<?php echo get_theme_mod( 'eddwp_download_core' ); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i>Start Earning</a><br>
					or <a class="hero-secondary-cta-link" href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">see more information</a>
				</p>
			</div>
			<div class="hero-thumb">
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
