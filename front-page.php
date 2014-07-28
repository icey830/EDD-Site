<?php
/**
 * The template for displaying the front page.
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */

get_header();

/* ----------------------------- *
 * Hero
 * ----------------------------- */
?>
<div class="hero-container clearfix">
	<section class="hero clearfix">
		<div class="hero-inside">
			<div class="hero-text">
				<h1>
				<?php
				$text = "Say hello to the world's easiest way to sell digital downloads through WordPress";
				echo $text;
				?>
				</h1>
				<h2>for free</h2>
				<p>
					<a href="http://downloads.wordpress.org/plugin/easy-digital-downloads.latest-stable.zip?utm_source=home&utm_medium=button_2&utm_campaign=Download+Button" class="download-button"><i class="icon-cloud-download"></i> 
					<?php
					$text = 'Download';
					echo $text;
					?></a>&nbsp;
					<a href="https://easydigitaldownloads.com/demo/" target="_blank" class="download-button demo-button"><i class="icon-eye-open"></i> Demo</a>
				</p>
			</div><!-- /.hero-text -->
			<img src="<?php echo get_template_directory_uri(); ?>/images/edd-standing.png" />
		</div><!-- .hero-inside -->
		<!-- <div id="video-container"></div> --><!-- #video-container -->
		<!--
<div id="video-complete">
			<div id="video-complete-inner">
					<a class="replay-button"><span class="button"></span> Replay</a>
				<a class="close-button"><span class="button"></span> Close</a>
			</div><!-- #video-complete-inner -->
		<!--</div>--><!-- /#video-complete -->
	</section><!-- /.hero -->
</div><!-- /.hero-container -->

<?php
/* ----------------------------- *
 * Features
 * ----------------------------- */

?>
<section class="featureset clearfix feature-overview">
	<div class="feature">
		<h2>Features overview...</h2>
		<div class="feature-content">
			<div class="inner-feature clearfix">
				<div class="inside">
					<h3>Quick Setup</h3>
					<p>Easy Digital Downloads is built to be quick and simple to setup. After installation, you're ready to go in just a couple of minutes! Simply enter your payment information, add your products and the rest is all a dream... </p>
				</div>
			</div>
			<div class="inner-feature clearfix" id="inner-feature-elegant-reporting">
				<div class="inside">
					<h3>Elegant Reporting</h3>
					<p>You want to be able to see all of your sales and earnings presented neatly and in a way that is easy to analyse. We have done exactly that with beautiful graphs and simple data tables.</p>
				</div>
				<img src="<?php echo get_template_directory_uri() ?>/images/earnings.png" alt="Elegant Reporting" />
			</div>
			<div class="inner-feature inner-feature-left clearfix">
				<img style="position: relative; top: 40px;" src="<?php echo get_template_directory_uri() ?>/images/developer-friendly.png" alt="Developer Friendly" />
				<div class="inside">
					<h3>Developer Friendly</h3>
					<p>At Easy Digital Downloads, we closely follow the WordPress Coding Standards and provide a myriad of hooks and filters so that when it comes to making changes to the codebase, it's really easy.</p>
				</div>
			</div>
			<div class="inner-feature inner-feature-right clearfix">
				<img style="position: relative; margin-left: 10%; box-shadow: 0 0 3px #f8f8f8" src="<?php echo get_template_directory_uri() ?>/images/discount-codes.png" alt="Discount Codes" />
				<div class="inside">
					<h3>Discount Codes</h3>
					<p>Celebrating something? Or maybe you just woke up in a good mood! Whatever it is, we have a complete discount system built in, so when you want to provide an offer, it won't even take a minute.</p>
				</div>
			</div>
			<div class="inner-feature clearfix" id="inner-feature-payment-gateways">
				<div class="inside">
					<h3>Payment Gateways</h3>
					<p>Accept payments through a huge number of different payment processors, including Stripe and PayPal. Add-on gateways are being constantly developed to make it easy for everyone to get paid.</p>
				</div>
				<img src="<?php echo get_template_directory_uri() ?>/images/paypal-stripe.png" alt="Payment Gateways" />
			</div>
			<div class="inner-feature clearfix" id="inner-feature-data-export">
				<div class="inside">
					<h3>Data Export</h3>
					<p>Easy Digital Downloads will never lock your data in. With our simple export options, you can easily send all sales, earnings, and customer data to Excel, Google Docs, or any other reporting system of your choice.</p>
				</div>
				<img src="<?php echo get_template_directory_uri() ?>/images/data-export.png" alt="Data Export" />
			</div>
			<div class="inner-feature">
				<div class="inside">
					<h3 style="text-align: center">Start your online store now</h3>
					<p style="text-align: center">
						<?php
						$text = '<a href="http://downloads.wordpress.org/plugin/easy-digital-downloads.latest-stable.zip?utm_source=home&utm_medium=button_2&utm_campaign=Download+Button" class="download-button"><i class="icon-cloud-download"></i> Download</a>';
						if( function_exists( 'ab_press_optimizer' ) ) {
							//echo ab_press_optimizer( 2, $text );
						//if( function_exists( 'ab_press_optimizer' ) ) {
						//	echo ab_press_optimizer( 2, $text );
						//} else {
							echo $text;
						} else {
							echo $text;
						}
						?>
					</p>
				</div>
			</div>
		</div>
	</div><!-- /.feature -->
</section><!-- /.feature-taxes -->


<?php
/* ----------------------------- *
 * Extensions
 * ----------------------------- */
$extension_cache = new CWS_Fragment_Cache( 'edd-homepage-extensions', 7200 );
if ( ! $extension_cache->output() ) : ob_start();
?>
<section class="featureset clearfix feature-extensions">
	<div class="feature clearfix">
		<div class="clearfix">
			<div id="extensions-intro-box">
				<h2>Dozens of Extensions <a href="<?php echo home_url( '/extensions' ); ?>">See All Extensions</a></h2>
				<p>With over 190 extensions, Easy Digital Downloads can be tailored to your exact needs. From payment processors to newsletter signup forms, EDD has extensions to fill the needs of almost every user.</p>
			</div><!-- /#extensions-intro-box -->
			<div class="extensions-grid">
				<ul>
				<?php
				$extensions = new WP_Query(
					array(
						'post_type' => 'extension',
						'posts_per_page' => 6,
						'post_status' => 'publish',
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'tax_query' => array(
							array(
								'taxonomy' => 'extension_tag',
								'field' => 'slug',
								'terms' => 'featured'
							)
						)
					)
				);

				while ( $extensions->have_posts() ) {
					$extensions->the_post();
					?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<div class="preview-image">
								<?php the_post_thumbnail( 'theme-showcase' ); ?>
							</div>
							<?php
							the_title();
							echo apply_filters( 'the_excerpt', get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ) );
							?>
						</a>
					</li>
					<?php
				}

				wp_reset_postdata();
				?>
				</ul>
			</div><!-- /.extensions-grid -->
		</div><!-- /.clearfix -->
	</div><!-- /.feature -->
</section><!-- /.feature-extensions -->

<?php
echo ob_get_clean();
$extension_cache->store();
endif;

/* ----------------------------- *
 * iOS App
 * ----------------------------- */
?>
<section class="featureset clearfix feature-ios">
	<div class="feature">
		<h2>Have Easy Digital Downloads in your pocket...</h2>
		<div class="left">
			<div class="slide-1-text">
				<h4>Simple Setup</h4>
				<p>Setting up your site couldn't be easier, with only a few details to enter, you're ready to go in minutes.</p>
			</div><!-- /.slide-1-text -->
			<div class="slide-2-text">
				<h4>Beautiful User Interface</h4>
				<p>Easily see how your store is doing with the clean user interface. With just a few clicks, see the earnings, sales, and customer stats from any of your websites.</p>
			</div><!-- /.slide-2-text -->
			<div class="slide-3-text">
				<h4>Earnings Tracker</h4>
				<p>Quickly view earnings for the current month, today, yesterday, last month, last year, or any custom time period in just a few clicks.</p>
			</div><!-- /.slide-3-text -->
		</div><!-- /.left -->
		<div class="iphone">
			<div class="iphone-inside">
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-1.png" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-6.png" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-2.jpg" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-3.png" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-4.jpg" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-5.jpg" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-7.png" />
			</div><!-- /.iphone-inside -->
		</div><!-- /.iphone -->
		<div class="right clearfix">
			<div class="slide-4-text">
				<h4>Sales Tracker</h4>
				<p>Getting a lot of sales and seeing all of those at once can be tedious at times. Our interface means you can easily see all your sales at once.</p>
			</div><!-- /.slide-4-text -->
			<div class="slide-5-text">
				<h4>Priceless Products</h4>
				<p>With one touch, you can get access to all of your products including sales/earnings stats and even monthly averages for each product. Neat, huh?</p>
			</div><!-- /.slide-5-text -->
			<div class="slide-6-text">
				<h4>Multi-site Support</h4>
				<p>Have more than one store? 50? You're in luck! You can view sales and earnings for an <i>unlimited</i> number of sites and all that data is available with a few touches.</p>
			</div><!-- /.slide-6-text -->
		</div><!-- /.right -->
		<div class="app-store-button clearfix">
			<p><a href="https://itunes.apple.com/us/app/easy-digital-downloads/id625303275?ls=1&mt=8"><img src="<?php echo get_template_directory_uri() ?>/images/app-store.png"></a></p>
		</div><!-- /.app-store-button -->
	</div><!-- /.feature -->
</section><!-- /.feature-ios -->

<?php
/* ----------------------------- *
 * Support
 * ----------------------------- */
?>
<section class="featureset clearfix feature-support">
	<div class="feature">
		<div class="feature-content">
			<h2>Best support in the industry...</h2>
			<p>At Easy Digital Downloads, we love our customers and we're always glad to help you out if you have any problems with the plugin.</p>
			<p>We provide exceptional support and in-depth documentation to alleviate your issues as soon as possible.</p>
			<p>Our Support Team will always do their absolute best to help you with your debug and you'll be on your way in no time. Our Support Team comprises of people who work with and understand Easy Digital Downloads; who can serve you better?</p>
		</div>
		<i class="icon-group"></i>
	</div><!-- /.feature -->
</section><!-- /.feature-support -->
<?php
/* ----------------------------- *
 * >100k downloads
 * ----------------------------- */
?>
<section class="featureset clearfix feature-customers">
	<div class="feature">
		<h2>With over 300,000 downloads, we got your back...</h2>
		<p>We have <del>some</del> <ins>a lot</ins> of happy customers and here's what some are saying:</p>

		<div class="testimonials">
		<?php
		$testimonials = new WP_Query(
			array(
				'posts_per_page' => 6,
				'post_type' => 'testimonials',
				'orderby' => 'rand',
				'post_status' => 'publish',
			)
		);

		while ( $testimonials->have_posts() ) {
			$testimonials->the_post(); ?>
			<div class="testimonial">
				<blockquote>
					<p><?php the_content(); ?></p>
					<cite><?php echo get_post_meta( get_the_ID(), 'ecpt_author', true ); ?></cite>
				</blockquote>
			</div>
		<?php
		}

		wp_reset_postdata();
		?>
		</div><!-- /.testimonials -->
	</div><!-- /.feature -->
</section><!-- /.feature-customers -->

<?php
/* ----------------------------- *
 * Newsletter
 * ----------------------------- */
?>
<section class="featureset clearfix feature-newsletter">
	<div class="feature">
		<h2>Sign up for our newsletter now.</h2>
		<h3>Be amongst the first to know about important news and upcoming features.</h3>
		<form id="pmc_mailchimp" action="" method="post">
			<div class="names clearfix">
				<input name="pmc_fname" id="pmc_fname" type="text" placeholder="Enter your first name">
				<input name="pmc_lname" id="pmc_lname" type="text" placeholder="Enter your last name">
			</div>
			<div>
				<input name="pmc_email" id="pmc_email" type="email" placeholder="Enter your email address">
				<input type="submit" value="Subscribe">
			</div>
			<input type="hidden" name="redirect" value="https://easydigitaldownloads.com/">
			<input type="hidden" name="action" value="pmc_signup">
			<input type="hidden" name="pmc_list_id" value="be2b495923">
		</form>
	</div><!-- /.feature -->
</section><!-- /.feature-newsletter -->

<?php get_footer(); ?>
