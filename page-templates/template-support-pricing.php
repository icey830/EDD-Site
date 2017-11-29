<?php
/**
 * Template Name: Support Pricing
 *
 * the template for displaying the Support Pricing page
 */

get_header(); ?>

	<div id="support-pricing-table-area" class="features-page-section page-section-white full-width">
		<div class="inner">
			<div class="support-pricing-table-content clearfix">
				<div class="support-pricing-options-container flex-container">
					<div class="support-type-information support-type flex-three">
						<h1>Priority Support</h1>
						<p>Always be at the front of the support queue with Priority Support. Expect faster response times over free support, allowing you run your business more efficiently.</p>
						<p>Sign up for yearly or 45-day access to Priority Support and we'll help you take your business to the next level.</p>
					</div>
					<div class="yearly-support support-type flex-three">
						<h2 class="support-type-title">Yearly Access</h2>
						<div class="support-type-price">
							<span class="recommended-price">Recommended</span>
							<span class="support-price">$299</span>
						</div>
						<div class="support-type-description">
							<ul class="pricing-column-list">
								<li>Always ahead of free support</li>
								<li>Yearly access</li>
								<li>60% savings over 45-day support</li>
							</ul>
						</div>
						<div class="support-type-cta">
							<a class="button edd-submit darkblue" href="<?php echo home_url( '/support/register/?level=1' ); ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Get </span>yearly priority support</a>
						</div>
					</div>
					<div class="fortyfive-day-support support-type flex-three">
						<h2 class="support-type-title">45-Day Access</h2>
						<div class="support-type-price">
							<span class="support-price">$99</span>
						</div>
						<div class="support-type-description">
							<ul class="pricing-column-list">
								<li>Always ahead of free support</li>
								<li>45-day access</li>
							</ul>
						</div>
						<div class="support-type-cta">
							<a class="button edd-submit blue" href="<?php echo home_url( '/support/register/?level=2' ); ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Get </span>45-day priority support</a>
						</div>
					</div>
				</div>
				<div class="pricing-table-notes">
					<p><i class="fa fa-info-circle"></i> Priority Support does not give you access to custom development services. The primary purpose of Priority Support is to provide faster assistance over free support.</p>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
