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
		</div>
	</div>
</div>

<div class="integrations-area full-width">
	<div class="integrations-wrap flex-container page-section-gray">
		<?php
			$integrations = array( 'MailChimp', 'Dropbox', 'AffiliateWP', 'Stripe' ,'PayPal' ,'Zapier' ,'Amazon', 'Envato' );
			foreach ( $integrations as $item ) :
				?>
				<div class="integrations-item <?php echo strtolower( $item ); ?>-integration">
					<img src="<?php echo get_template_directory_uri() . '/images/' . strtolower( $item ) . '-integration-logo.png' ?>" alt="<?php echo $item; ?> Integration" />
				</div>
				<?php
			endforeach;
		?>
	</div>
</div>

<div id="front-page-features" class="features-grid-two page-section-white full-width">
	<div class="inner">
		<div class="features-grid-two-content">
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
