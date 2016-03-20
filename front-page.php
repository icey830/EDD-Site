<?php
/**
 * The template for displaying the front page.
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */

get_header(); ?>

<div id="front-page-hero" class="front-page-section page-section-blue full-width">
	<div class="inner">
		<div class="front-page-intro">
			<div class="site-headline">
				<span class="hero-subtitle">Say hello to the world's easiest way to</span>
				<h1 class="hero-title">Sell Digital Downloads Through WordPress</h1>
			</div>
			<p class="hero-cta">
				<a class="hero-primary-cta-button" href="http://downloads.wordpress.org/plugin/easy-digital-downloads.latest-stable.zip?utm_source=home&utm_medium=button_2&utm_campaign=Download+Button"><i class="fa fa-cloud-download"></i>Download</a><br>
				or <a class="hero-secondary-cta-link" href="https://easydigitaldownloads.com/demo/">view the demo</a>
			</p>
			<img class="hero-screenshot" src="<?php echo get_template_directory_uri() . '/images/edd-reports-screenshot-edd.png'; ?>">
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
				'affilaitewp'   => array(
					'name'      => 'AffiliateWP',
					'url'       => 'https://affiliatewp.com',
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
						<img src="<?php echo get_template_directory_uri() . '/images/' . strtolower( $item['name'] ) . '-integration-logo.png' ?>" alt="<?php echo $item['name']; ?> Integration" />
					</a>
				</div>
				<?php
			endforeach;
		?>
	</div>
</div>

<div id="front-page-features" class="features-grid-two page-section-white full-width">
	<div class="inner">
		<div class="features-grid-two-content">
			<h2 class="section-title-alt gears">Key Features & Highlights</h2>
			<div class="features-grid-content-sections flex-container">
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-tag"></i>Discount Codes</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-shopping-cart"></i>Full Shopping Cart</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-download"></i>Unlimited File Downloads</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-bar-chart"></i>Download Activity Tracking</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-database"></i>WordPress REST API</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-line-chart"></i>Full Data Reporting</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="front-page-extensions-area" class="front-page-section page-section-gray full-width">
	<div class="inner">
		<div class="front-page-extensions-area">
			Testing
		</div>
	</div>
</div>

<?php get_footer(); ?>
