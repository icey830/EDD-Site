<?php
/* Template Name: Features
 *
 * theme Features page
 */

get_header();
the_post();
?>

<div id="features-page-intro-area" class="features-page-intro-section page-section-gray full-width">
	<div class="inner">
		<div class="features-page-intro">
			<div class="section-header">
				<h2 class="section-title">Easy Digital Downloads <strong>Core Features</strong></h2>
				<p class="section-subtitle">Easy Digital Downloads is a full-featured eCommerce platform with all the tools and features you need to turn your WordPress website into a a digital store. Check out the features below and see for yourself.</p>
			</div>
		</div>
	</div>
</div>

<div id="features-page-area" class="features-page-section page-section-white full-width">
	<div class="inner">
		<div class="features-page-content clearfix">
			<div class="features-content">
				<h6><i class="fa fa-tag"></i>Discount Codes</h6>
				<ul>
					<li>choose flat rate or percentage based</li>
					<li>specify products to include or exclude</li>
					<li>set automated start and end dates</li>
					<li>require minimum cart total for discount use</li>
					<li>limit discount usage by count or user</li>
				</ul>
			</div>
			<div class="features-screenshot">
				<img class="features-image" src="<?php echo get_template_directory_uri() . '/images/features-page/edd-discounts-screenshot.png'; ?>">
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>