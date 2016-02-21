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
	<div class="integrations-wrap page-section-gray">
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
			<div class="features-grid-content-header">
				<h2 class="features-grid-section-title">Essential <strong>Features and Functionality</strong></h2>
				<div class="small-divider"></div>
			</div>
			<div class="features-grid-content-sections">
				<div class="edd-feature">
					<h6><i class="fa fa-tag"></i>Discount Codes</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature">
					<h6><i class="fa fa-shopping-cart"></i>Full Shopping Cart</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature">
					<h6><i class="fa fa-download"></i>Unlimited File Downloads</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature">
					<h6><i class="fa fa-bar-chart"></i>Download Activity Tracking</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature">
					<h6><i class="fa fa-database"></i>WordPress REST API</h6>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique erat ac felis accumsan efficitur. Nam quis lorem et quam scelerisque sodales. Integer id ullamcorper magna.</p>
				</div>
				<div class="edd-feature">
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
			<div class="front-page-extensions-header page-section">
				<div class="page-section-header">
					<h2 class="page-section-title">Easy Digital Downloads <strong>Tailored to Your Business</strong></h2>
					<div class="small-divider centered"></div>
					<p>With over 190 extensions, Easy Digital Downloads can be customized to function the way you need. From payment processors to newsletter signup forms, EDD has extensions to fill the needs of almost every user.</p>
				</div>
			</div>
			<div class="front-page-extensions-content edd-downloads">
				<div class="download-grid three-col clearfix">
					<?php
					$extensions = new WP_Query(
						array(
							'post_type'      => 'download',
							'posts_per_page' => 6,
							'post_status'    => 'publish',
							'orderby'        => 'menu_order',
							'order'          => 'ASC',
							'tax_query'      => array(
								'relation'   => 'AND',
								array(
									'taxonomy' => 'download_category',
									'field'    => 'slug',
									'terms'    => 'extensions'
								),
								array(
									'taxonomy' => 'download_tag',
									'field'    => 'slug',
									'terms'    => 'featured'
								)
							)
						)
					);
					while ( $extensions->have_posts() ) : $extensions->the_post();
						?>
						<div class="download-grid-item">
							<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
								<?php eddwp_downloads_grid_thumbnail(); ?>
							</a>
							<div class="download-grid-item-info">
								<?php
									the_title( '<h4 class="download-grid-title"><a href="' . home_url( '/downloads/' . $post->post_name ) . '" title="' . get_the_title() . '">', '</a></h4>' );
									$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
									echo $short_desc;
								?>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
					<div class="download-grid-item flex-grid-cheat"></div>
					<div class="download-grid-item flex-grid-cheat"></div>
				</div><!-- /.extensions-grid -->
				<div class="view-all-extensions">
					<p>EDD offers a complete eCommerce solution right out of the box. Use extensions to tailor EDD to your business needs.</p>
					<a class="edd-submit button blue" href="<?php echo home_url( '/downloads/' ); ?>"><i class="fa fa-plug"></i>view all extensions</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
