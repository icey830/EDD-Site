<?php
/**
 * The template for displaying the front page.
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */

get_header();
?>

<div id="front-page-hero" class="front-page-section full-width">
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

<div id="front-page-about-edd" class="front-page-section full-width">
	<div class="inner">
		<div class="front-page-about-edd-content">
			<div class="front-page-about-edd-content-header">
				<h2 class="front-page-section-title"><strong>Things to Know</strong> About Easy Digital Downloads</h2>
				<p class="front-page-section-description">Easy Digital Downloads is built to be quick and simple to set up. After installation, you're ready to go in just a couple of minutes! Simply enter your payment information and add your products. The rest is all a dream.</p>
			</div>
			<div class="front-page-about-edd-content-sections">
				<div class="edd-feature">
					<img class="edd-feature-image" src="<?php echo get_template_directory_uri() ?>/images/best-reporting.png" alt="Reporting" />
					<h6>Elegant Reporting</h6>
					<p>You want to be able to see all of your sales and earnings presented neatly and in a way that is easy to analyse. We have done exactly that with beautiful graphs and simple data tables.</p>
				</div>
				<div class="edd-feature">
					<img class="edd-feature-image" src="<?php echo get_template_directory_uri() ?>/images/welcome-developers.png" alt="Developer Friendly" />
					<h6>Developer Friendly</h6>
					<p>Not only does Easy Digital Downloads closely follow the WordPress Coding Standards and provide a myriad of hooks and filters for developers, it's also 100% open-source and welcomes contributors.</p>
				</div>
				<div class="edd-feature">
					<img class="edd-feature-image" src="<?php echo get_template_directory_uri() ?>/images/create-discounts.png" alt="Discount Codes" />
					<h6>Discount Codes</h6>
					<p>Celebrating something? Or maybe you just woke up in a good mood! Whatever it is, we have a complete discount system built in, so when you want to provide an offer, it won't even take a minute.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="front-page-data-export" class="front-page-section full-width">
	<div class="inner">
		<div class="front-page-data-export-content clearfix">
			<div class="front-page-data-export-right">
				<h2 class="front-page-section-title">Easily <strong>Export Store Data</strong></h2>
				<p>Easy Digital Downloads will never lock your data in. With our simple export options, you can easily send all sales, earnings, and customer data to Excel, Google Docs, or any other reporting system of your choice.</p>
				<p>You also have the freedom to be as specific as you need when exporting your data. Choose a custom start date as well as a custom end date to get just the necessary data for your reporting.</p>
				<p><a class="secondary-cta-button" href="http://downloads.wordpress.org/plugin/easy-digital-downloads.latest-stable.zip?utm_source=home&utm_medium=button_2&utm_campaign=Download+Button"><i class="fa fa-cloud-download"></i>Get Easy Digital Downloads</a></p>
			</div>
			<div class="front-page-data-export-left">
				<img style="border-right: 1px solid #f1f1f1;" src="<?php echo get_template_directory_uri() ?>/images/export-store-data.png" alt="Data Export" />
			</div>
		</div>
	</div>
</div>

<div id="front-page-extensions" class="front-page-section full-width">
	<div class="inner">
		<div class="front-page-extensions-header">
			<div class="front-page-about-edd-content-header">
				<h2 class="front-page-section-title">Easy Digital Downloads <strong>Tailored to Your Business</strong></h2>
				<p class="front-page-section-description">With over 190 extensions, Easy Digital Downloads can be customized to function the way you need. From payment processors to newsletter signup forms, EDD has extensions to fill the needs of almost every user.</p>
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

				while ( $extensions->have_posts() ) {
					$extensions->the_post();
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
				}
				wp_reset_postdata();
				?>
			</div><!-- /.extensions-grid -->
		</div>
	</div>
</div>

<div id="front-page-gateways" class="front-page-section full-width">
	<div class="inner">
		<div class="front-page-payment-gateways-content">
			<h4 class="front-page-section-title">Easy Digital Downloads integrates with several Payment Gateways including:</h4>
			<img class="front-page-payment-gateways-image" src="<?php echo get_template_directory_uri() ?>/images/front-page-payment-gateways.png" alt="Payment Gateways" />
			<p class="view-all-extensions"><a href="<?php echo home_url( '/downloads/' ); ?>">view all extensions</a></p>
		</div>
	</div>
</div>

<div id="front-page-support" class="front-page-section full-width">
	<div class="inner">
		<div class="support-content clearfix">
			<h2 class="front-page-section-title"><strong>Best Support</strong> in the Industry</h2>
			<p>We love our customers and we're always glad to help you out if you have any problems with the plugin or official extensions. We provide exceptional support and in-depth documentation to alleviate your issues as quickly as possible.</p>
			<p>Our Support Team will always do their absolute best to help you with your debug and you'll be on your way in no time. Our Support Team comprises of people who work with and understand Easy Digital Downloads to the core.</p>
		</div>
	</div>
</div>

<div id="front-page-testimonials" class="front-page-section full-width">
	<div class="inner">
		<div class="testimonial-content clearfix">
			<div class="front-page-testimonial-content-header">
				<h2 class="front-page-section-title">Over <strong>700,000 Downloads</strong> and Counting</h2>
				<p>Have a look at what some of our users have to say about their experience with Easy Digital Downloads.</p>
			</div>
			<div class="front-page-testimonial-content">
				<?php
					$testimonials = new WP_Query(
						array(
							'posts_per_page' => 4,
							'post_type' => 'testimonials',
							'orderby' => 'rand',
							'post_status' => 'publish',
						)
					);
					while ( $testimonials->have_posts() ) {
						$testimonials->the_post(); ?>
						<div class="testimonials">
							<blockquote>
								<cite><i class="fa fa-quote-left"></i><?php echo get_post_meta( get_the_ID(), 'ecpt_author', true ); ?></cite>
								<?php the_content(); ?>
							</blockquote>
						</div>
					<?php
					}
					wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</div>

<div id="front-page-newsletter" class="front-page-section full-width">
	<div class="inner">
		<div class="newsletter-content clearfix">
			<h3 class="front-page-section-title">Easy Digital Downloads <strong>Email Newsletter</strong></h3>
			<p>Be the first to know about the latest updates and exclusive promotions from Easy Digital Downloads.</p>
			<form id="pmc_mailchimp" class="clearfix" action="" method="post">
				<div class="nl-name clearfix">
					<input class="newsletter-name nl-first-name" name="pmc_fname" id="pmc_fname" type="text" placeholder="First name">
					<input class="nl-last-name" name="pmc_lname" id="pmc_lname" type="text" placeholder="Last name">
				</div>
				<div class="nl-email">
					<input class="newsletter-email" name="pmc_email" id="pmc_email" type="email" placeholder="Email address">
					<input class="newsletter-submit" type="submit" value="Sign me up!">
				</div>
				<input type="hidden" name="redirect" value="https://easydigitaldownloads.com/">
				<input type="hidden" name="action" value="pmc_signup">
				<input type="hidden" name="pmc_list_id" value="be2b495923">
			</form>
		</div>
	</div>
</div>

<?php get_footer(); ?>
