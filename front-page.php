<?php
/**
 * The template for displaying the front page.
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */

get_header(); ?>

<div id="front-page-hero" class="front-page-section hero-area page-section-blue full-width">
	<div class="inner">
		<div class="front-page-intro hero-content clearfix">
			<div class="hero-info">
				<div class="site-headline hero-headline">
					<span class="hero-subtitle hero-subtitle">Say hello to the easiest way to</span>
					<h1 class="hero-title hero-title"><?php bloginfo( 'description' ); ?></h1>
				</div>
				<p class="hero-cta">
					<a class="hero-primary-cta-button" href="<?php echo get_theme_mod( 'eddwp_download_core' ); ?>"><i class="fa fa-cloud-download"></i>Download</a><br>
					or <a class="hero-secondary-cta-link" href="<?php echo get_theme_mod( 'eddwp_demo_link' ); ?>">view the demo</a>
				</p>
			</div>
			<div class="hero-thumb">
				<img src="<?php echo get_template_directory_uri() . '/images/front-page/edd-reports-screenshot-home.png'; ?>">
			</div>
		</div>
	</div>
</div>

<div class="integrations-area full-width">
	<div class="integrations-wrap flex-container page-section-gray">
		<?php
			$integrations = array(
				'mailchimp'     => array(
					'name'      => 'MailChimp',
					'slug'      => '/mail-chimp',
				),
				'dropbox'       => array(
					'name'      => 'Dropbox',
					'slug'      => '/dropbox-file-store',
				),
				'affiliatewp'   => array(
					'name'      => 'AffiliateWP',
					'url'       => 'https://affiliatewp.com/?ref=743',
					'slug'      => '',
				),
				'stripe'        => array(
					'name'      => 'Stripe',
					'slug'      => '/stripe-gateway',
				),
				'paypal'        => array(
					'name'      => 'PayPal',
					'slug'      => '?download_s=paypal&action=download_search',
				),
				'zapier'        => array(
					'name'      => 'Zapier',
					'slug'      => '/zapier',
				),
				'amazon'        => array(
					'name'      => 'Amazon',
					'slug'      => '/amazon-s3',
				),
				'envato'        => array(
					'name'      => 'Envato',
					'slug'      => '/edd-envato-integration',
				),
			);
			foreach ( $integrations as $item ) :
				?>
				<div class="integrations-item <?php echo strtolower( $item['name'] ); ?>-integration">
					<a href="<?php echo isset( $item['url'] ) ? $item['url'] : home_url( '/downloads' ) . $item['slug']; ?>">
						<img src="<?php echo get_template_directory_uri() . '/images/front-page/integrations/' . strtolower( $item['name'] ) . '-integration-logo.png' ?>" alt="<?php echo $item['name']; ?> Integration" />
					</a>
				</div>
				<?php
			endforeach;
		?>
	</div>
</div>

<div id="integrations-title-area" class="page-section-white full-width">
	<div class="inner">
		<div class="integrations-title clearfix">
			<h5>Popular Integrations</h5>
		</div>
	</div>
</div>

<div id="front-page-features" class="features-grid-two page-section-white full-width">
	<div class="inner">
		<div class="features-grid-two-content">
			<h2 class="section-title-alt">Key Features & Highlights</h2>
			<div class="features-grid-content-sections flex-container">
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-tag"></i>Discount Codes</h6>
					<p>Easily create discounts codes to encourage customers to buy more. Discounts can be offered at flat or percentage rates and include settings for expiration, maximum uses, and more.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-shopping-cart"></i>Full Shopping Cart</h6>
					<p>Allow your customers to purchase multiple downloads at once using the shopping cart system. With minimum page loads and cleanly designed cart elements, the shopping cart feels seamless.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-download"></i>Unlimited File Downloads</h6>
					<p>There are no limitations when it comes to distributing your digital products. Allow customers to download their purchased files endlessly or restrict file downloads by time and/or attempt.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-bar-chart"></i>Download Activity Tracking</h6>
					<p>Monitor all there is to know about how your product files are being downloaded by your customers. Easily track date, time, and even IP address of all purchased and downloaded files.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-exchange"></i>REST API</h6>
					<p>Developers and external applications can take advantage of a complete RESTful API that provides easy access to sales and product information in either jSON or XML format.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-line-chart"></i>Full Data Reporting</h6>
					<p>No business is complete without detailed bookkeeping. Easy Digital Downloads has a built-in reporting platform for easily viewing stats, making custom reports, and much more.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="social-proof-area" class="social-proof-section page-section-gray full-width">
	<div class="inner">
		<div class="social-proof-content">
			<div class="flex-container">
				<div class="globe-bg flex-two">
					<img class="globe-icon" src="<?php echo get_template_directory_uri() . '/images/front-page/globe-icon.png'; ?>">
				</div>
				<div class="featured-stats flex-two">
					<div class="flex-container">
						<div class="flex-two">
							<div class="featured-stat">
								<p>1,000,000</p>
								<span>Downloads & Counting</span>
							</div>
							<div class="featured-stat">
								<p>4.9/5 <small><i class="fa fa-star"></i></small></p>
								<span>User Reviews</span>
							</div>
						</div>
						<div class="flex-two">
							<div class="featured-stat">
								<p><?php echo eddwp_get_number_of_downloads(); ?></p>
								<span>Extensions & Themes</span>
							</div>
							<div class="featured-stat">
								<p>140 <small><i class="fa fa-plus"></i></small></p>
								<span>Project Contributors</span>
							</div>
						</div>
					</div>
					<p>While Easy Digital Downloads' primary focus is the distribution of digital downloads, feedback from users and selfless developers from around the world drive the open-source project to many facets of eCommerce.</p>
					<div class="featured-stats-cta-link">
						<a class="edd-submit button blue" href="<?php echo get_theme_mod( 'eddwp_download_core' ); ?>"><i class="fa fa-cloud-download"></i>Get Easy Digital Downloads</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="front-page-extensions-area" class="front-page-extensions-section page-section-white full-width">
	<div class="inner">
		<div class="front-page-extensions-content">
			<h2 class="section-title-alt">Extended Functionality</h2>
			<div class="front-page-extensions flex-container">
				<div class="front-page-extensions-display flex-two">
					<div class="featured-extensions flex-container">
						<div class="flex-two">
							<div class="featured-extension featured-extension-stripe">
								<a href="<?php echo home_url( '/downloads/stripe-gateway/' ); ?>">
									<img src="<?php echo get_template_directory_uri() . '/images/front-page/featured-extensions/stripe.png'; ?>">
								</a>
							</div>
							<div class="featured-extension featured-extension-software-licensing">
								<a href="<?php echo home_url( '/downloads/software-licensing/' ); ?>">
									<img src="<?php echo get_template_directory_uri() . '/images/front-page/featured-extensions/software-licensing.png'; ?>">
								</a>
							</div>
							<div class="featured-extension featured-extension-recurring-payments">
								<a href="<?php echo home_url( '/downloads/recurring-payments/' ); ?>">
									<img src="<?php echo get_template_directory_uri() . '/images/front-page/featured-extensions/recurring-payments.png'; ?>">
								</a>
							</div>
						</div>
						<div class="flex-two">
							<div class="featured-extension featured-extension-mailchimp">
								<a href="<?php echo home_url( '/downloads/mail-chimp/' ); ?>">
									<img src="<?php echo get_template_directory_uri() . '/images/front-page/featured-extensions/mailchimp.png'; ?>">
								</a>
							</div>
							<div class="featured-extension featured-extension-frontend-submissions">
								<a href="<?php echo home_url( '/downloads/frontend-submissions/' ); ?>">
									<img src="<?php echo get_template_directory_uri() . '/images/front-page/featured-extensions/frontend-submissions.png'; ?>">
								</a>
							</div>
							<div class="featured-extension featured-extension-free-downloads">
								<a href="<?php echo home_url( '/downloads/free-downloads/' ); ?>">
									<img src="<?php echo get_template_directory_uri() . '/images/front-page/featured-extensions/free-downloads.png'; ?>">
								</a>
							</div>
						</div>
					</div>
					<span class="view-all-extensions"><a href="<?php echo home_url( '/downloads/' ); ?>">view all extensions</a></span>
				</div>
				<div class="front-page-extension-info flex-two">
					<h4>Make it work for you.</h4>
					<p>Without a doubt, Easy Digital Downloads is a complete eCommerce solution for WordPress. Right out of the box, it is prepared to power your online business without the need of any other dependencies.</p>
					<p>However, we believe that your  system should be tailored to your needs without the added weight of unwanted functionality. We strive to perfect this balance with our add-ons, referred to as extensions.</p>
					<h4>Need help choosing?</h4>
					<p>If you are looking for a hassle-free way to get the extensions you need, try using our custom <a href="<?php echo home_url( '/starter-package/' ); ?>">Starter Package</a> builder as a guide.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
