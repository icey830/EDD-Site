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
					<h1 class="hero-title">Easy Digital Downloads Affiliate Program</h1>
				</div>
				<div class="hero-cta">
					<a class="hero-primary-cta-button" href="<?php echo home_url( 'affiliates/join/' ); ?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Become an affiliate</a><br>
					<?php if ( is_user_logged_in() && function_exists( 'affwp_is_affiliate' ) && ! affwp_is_affiliate() ) { ?>
						Read our <a class="hero-secondary-cta-link" href="#" data-toggle="modal" data-target="#affiliate-agreement">affiliate agreement</a>
					<?php } else { ?>
	Already an affiliate? <a class="hero-secondary-cta-link" href="<?php echo home_url( '/your-account/affiliate-area/' ); ?>" title="<?php get_the_title(); ?>">Log in</a>
					<?php } ?>
				</div>
			</div>
			<div class="hero-thumb">
				<img src="<?php echo get_template_directory_uri() . '/images/screenshots/edd-affiliates-graph-screenshot.png'; ?>">
			</div>
		</div>
	</div>
</div>

<div class="affiliate-program-features features-grid-two page-section-white full-width">
	<div class="inner">
		<div class="features-grid-two-content">
			<h2 class="section-title-alt">Why promote Easy Digital Downloads?</h2>
			<div class="features-grid-content-sections flex-container">
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-money" aria-hidden="true"></i>Cash for referrals</h6>
					<p>Earn 10% commission on every single referral that results in a successful sale. With over 100 extensions to promote, there's no limit to how much you can earn by referring others to Easy Digital Downloads.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-paint-brush" aria-hidden="true"></i>Attention-grabbing banners</h6>
					<p>Don't waste time worrying about promotional tools. We provide dozens of high quality banners and HTML snippets complete with your affiliate ID, making setup and promotion a breeze.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-pie-chart" aria-hidden="true"></i>Detailed statistics</h6>
					<p>Fine-tune your marketing strategy based on real data found in your affiliate area. Referral data, conversion statistics, and earnings reports are always up-to-date and easily accessible.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-calendar" aria-hidden="true"></i>30-day cookie lifetime</h6>
					<p>After clicking your referral link, a cookie is stored in a potential customer's browser. This allows 30 days to come back and complete a purchase, increasing the likelihood of a successful conversion.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-link" aria-hidden="true"></i>Direct Link Tracking</h6>
					<p>From your <em>secure</em> site, link directly to Easy Digital Downloads without using your referral URL. Increase the chances of a successful referral using clean, SEO-friendly links.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-bar-chart" aria-hidden="true"></i>Campaign tracking</h6>
					<p>Create your own affiliate campaigns to better track the performance of your referral links. Separated campaign data is provided to help you determine which promotion tactics perform best.</p>
				</div>
			</div>
			<div class="become-an-affiliate-content clearfix">
				<h2 class="become-an-affiliate-title">Start earning cash for referrals!</h2>
				<div class="become-an-affiliate-cta-link">
					<a class="edd-submit button blue" href="<?php echo home_url( 'affiliates/join/' ); ?>"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Become an affiliate</a>
				</div>

				<p class="become-an-affiliate-secondary-links">
					<span>Read our <a href="#" data-toggle="modal" data-target="#affiliate-agreement">affiliate agreement</a></span>
				</p>
			</div>
		</div>
	</div>
</div>

<?php
$args = array(
	'name'           => 'affiliate-agreement',
	'post_type'      => 'page',
	'post_status'    => 'publish',
	'posts_per_page' => 1
);
$affiliate_agreement = get_posts( $args );
?>

<!-- Affiliate Agreement modal -->
<div class="affiliate-agreement-modal modal fade" id="affiliate-agreement" tabindex="-1" role="dialog" aria-labelledby="affiliate-agreement-label">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title" id="affiliate-agreement-label">Easy Digital Downloads <?php echo $affiliate_agreement[0]->post_title; ?></h5>
			</div>
			<div class="modal-body">
				<?php echo wpautop( $affiliate_agreement[0]->post_content ); ?>
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
