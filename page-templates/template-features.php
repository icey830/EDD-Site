<?php
/* Template Name: Features
 *
 * theme Features page
 */

get_header();
the_post();
?>

	<div id="features-page-intro" class="features-page-section page-section-blue full-width">
		<div class="inner">
			<div class="features-page-intro">
				<div class="features-page-header">
					<h2 class="features-page-section-title">Easy Digital Downloads <strong>Core Features</strong></h2>
					<p class="features-page-section-description">Easy Digital Downloads is a full-featured E-Commerce platform with all the tools and features you need to turn your WordPress website into a a digital store. To see for yourself, check out the features below.</p>
				</div>
			</div>
		</div>
	</div>

	<div id="features-page-edd" class="features-page-section page-section-white full-width">
		<div class="inner">
			<div class="features-page-edd-content half-split image-left clearfix">
				<div class="split-text">
					<h2 class="features-page-section-title">Easily <strong>Sell Digital Downloads</strong></h2>
					<p>Easy Digital Downloads is a complete E-Commerce solution for selling digital products in a light, performant, and easy-to-use plugin. Rather that attempting to provide every feature under the sun, Easy Digital Downloads makes selling digital simple and complete by providing just the features you need.</p>
					<p>Designed to get your digital store up and running quickly, Easy Digital Downloads itself is free and includes everything you need to distribute downloads, record transactions, and manage customers, and more.</p>
					<p>Let's have a more detailed look.</p>
				</div>
				<div class="split-image">
					<img class="frame-feature-image" src="<?php echo get_template_directory_uri() ?>/images/edd-display-downloads.png" alt="About Easy Digital Downloads" />
				</div>
			</div>
		</div>
	</div>

	<div id="features-page-downloads" class="features-page-section page-section-gray full-width">
		<div class="inner">
			<div class="features-page-downloads half-split image-right clearfix">
				<div class="split-text">
					<h2 class="features-page-section-title"><strong>Create Products</strong> In Seconds</h2>
					<p>Everything starts with the Download. If you have ever used WordPress, chances are you have created a Post or a Page. Creating a Download follows the same familiar process but adds a few simple options particular to your product.</p>
					<p>You have the ability to create standard, single-price products or give them variable pricing options. Sell products individually or "bundle" them together to be distributed as one product.</p>
					<p>Even choose whether or not you want to attach downloadable files to your product. The choice is yours.</p>
					<p>Please note that while the core functionality allows for a complete E-Commerce solution, you can extend the possibilities with our <a href="<?php echo home_url( '/downloads/' ); ?>">list of extensions</a>.</p>
				</div>
				<div class="split-image">
					<img style="border-radius: 4px;" src="<?php echo get_template_directory_uri() ?>/images/download-prices-files.png" alt="Download Prices and Files" />
				</div>
			</div>
		</div>
	</div>

	<div id="features-page-downloads" class="features-page-section page-section-white full-width">
		<div class="inner">
			<div class="features-page-downloads half-split image-left clearfix">
				<div class="split-text">
					<h2 class="features-page-section-title">Flexible <strong>Shopping Cart</strong> System</h2>
					<p>No E-Commerce platform is complete without a way for potential customers to view, gather, and purchase products. Easy Digital Downloads provides the necessary shortcodes for displaying products as well as the checkout cart.</p>
					<p>After creating your Download entries, use the built-in [downloads] shortcode to display products in a store grid or individually. Each product supports its own "Add to Cart" button that allows customers to add as many products to their shopping cart as they would like.</p>
					<p>Keep in mind, Easy Digital Downloads supports several payment gateways. <a href="<?php echo home_url( '/downloads/category/extensions/gateways/' ); ?>">See all payment gateways here</a>.</p>
				</div>
				<div class="split-image">
					<img class="frame-feature-image" src="<?php echo get_template_directory_uri() ?>/images/edd-checkout-cart.png" alt="Checkout Cart" />
				</div>
			</div>
		</div>
	</div>

	<div id="features-page-confirmation" class="features-page-section page-section-gray full-width">
		<div class="inner">
			<div class="features-page-confirmation half-split image-right clearfix">
				<div class="split-text">
					<h2 class="features-page-section-title">Automated <strong>Purchase Confirmation</strong></h2>
					<p>Once your products are available for purchase, your work is done. Easy Digital Downloads will collect the necessary information, process the transaction, deliver a purchase confirmation, and even send an email to the customer.</p>
					<p>Whether you deliver download links through the Purchase Confirmation page, the email receipt, or both, your product files are always secure. Only the customer will be able to download files, regardless of who has the link.</p>
				</div>
				<div class="split-image">
					<img class="frame-feature-image" src="<?php echo get_template_directory_uri() ?>/images/edd-purchase-confirmation.png" alt="Purchase Confirmation" />
				</div>
			</div>
		</div>
	</div>

	<div class="get-edd-area page-section-blue full-width">
		<div class="inner">
			<div class="get-edd page-section clearfix">
				<h2 class="page-section-title">Get Easy Digital Downloads Now</h2>
				<p>Easy Digital Downloads is a 100% free WordPress plugin. Download your copy now.</p>
				<p class="hero-cta">
					<a class="hero-primary-cta-button" href="http://downloads.wordpress.org/plugin/easy-digital-downloads.latest-stable.zip?utm_source=home&utm_medium=button_2&utm_campaign=Download+Button"><i class="fa fa-cloud-download"></i>Download</a><br>
					or <a class="hero-secondary-cta-link" href="https://easydigitaldownloads.com/demo/">view the demo</a>
				</p>
			</div>
		</div>
	</div>

	<div class="features-grid-three page-section-white full-width">
		<div class="inner">
			<div class="features-grid-three-content">
				<div class="features-grid-content-header">
					<h2 class="features-grid-section-title">But Wait... There's More to Easy Digital Downloads</h2>
					<p class="features-grid-section-description">Creating and distributing products is just the beginning. As a true E-Commerce platform, Easy Digital Downloads manages all of the back-end information you'd expect from a store system.</p>
				</div>
				<div class="features-grid-content-sections">
					<div class="edd-feature">
						<img class="edd-feature-image" src="<?php echo get_template_directory_uri() ?>/images/purchase-history-shortcode.png" alt="Reporting" />
						<h6>Simple Shortcodes</h6>
						<p>Display products, the checkout cart, purchase confirmation data, user purchase history, and much more with built-in shortcodes. No coding is necessary to get your store up and running.</p>
					</div>
					<div class="edd-feature">
						<img class="edd-feature-image" src="<?php echo get_template_directory_uri() ?>/images/customer-management.png" alt="Developer Friendly" />
						<h6>Customer Management</h6>
						<p>Easy Digital Downloads has an intelligent customer management system designed to help you keep payment records and customers linked together, even for guest purchases.</p>
					</div>
					<div class="edd-feature">
						<img class="edd-feature-image" src="<?php echo get_template_directory_uri() ?>/images/best-reporting.png" alt="Discount Codes" />
						<h6>Custom Reporting</h6>
						<p>All store information is at your fingertips with custom reporting. You can export information to CSV or PDF, sorted by product, date, or even more detailed information. Export the reports you need.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="features-page-docs" class="features-page-section page-section-gray full-width">
		<div class="inner">
			<div class="features-page-downloads half-split image-left clearfix">
				<div class="split-text">
					<h2 class="features-page-section-title">Detailed Documentation</h2>
					<p>We understand that not everyone is familiar with WordPress. Easy Digital Downloads makes things as easy as possible in doing the heavy lifting for you. Even then, some things need explaining. We see to it that our documentation makes no assumptions, explain everything relevant to the task at hand.</p>
					<p>We also provide developer documentation for those who want to take matters into their own hands. With top-quality support and detailed documentation, you'll always have the resources you need to manage your store.</p>
				</div>
				<div class="split-image">
					<img class="frame-feature-image" src="<?php echo get_template_directory_uri() ?>/images/edd-docs.png" alt="Documentation" />
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>