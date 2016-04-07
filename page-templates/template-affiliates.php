<?php
/* Template Name: Affiliate Area
 *
 * AffiliateWP dashboard area
 */

get_header();
?>

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
get_footer();
