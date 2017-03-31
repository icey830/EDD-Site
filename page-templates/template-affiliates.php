<?php
/* Template Name: Affiliate Area
 *
 * AffiliateWP dashboard area
 */

get_header();

if ( is_user_logged_in() ) : ?>

	<div class="affiliate-dashboard-area page-section-white full-width">
		<div class="inner">
			<div class="affiliate-dashboard-content clearfix">
				<?php
					the_title( '<h2 class="section-title-alt">', '</h2>');
					echo do_shortcode( '[affiliate_area]' );
				?>
			</div>
		</div>
	</div>
	<?php

else : ?>

	<div id="landing-page-area" class="full-width clearfix">
		<div class="inner">
			<section class="page-content">
				<article class="content clearfix">
					<div class="entry-header">
						<h3 class="entry-title">The affiliate area is available only for registered affiliates.</h3>
						<p>If you are already an affiliate, use the form below to log into your affiliate area. If you would like to become an affiliate, please visit our <a href="<?php echo home_url( 'affiliates' ); ?>">affiliates page</a>.</p>
					</div>
					<?php eddwp_login_form(); ?>
				</article>
			</section>
		</div>
	</div>
	<?php

endif;
get_footer();
