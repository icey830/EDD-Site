<?php
/**
 * The template for displaying the front page.
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */
?>
<?php get_header(); ?>

<?php
/* ----------------------------- *
 * Hero
 * ----------------------------- */
?>
<div class="hero-container clearfix">
	<section class="hero clearfix">
		<div class="hero-inside">
			<div class="hero-text">
				<h1>Say hello to the world's easiest way to sell digital downloads through WordPress</h1>
				<h2>for free</h2>
				<p><a href="http://downloads.wordpress.org/plugin/easy-digital-downloads.latest-stable.zip" class="download-button"><i class="icon-cloud-download"></i> Download</a> <a href="https://easydigitaldownloads.com/demo/" class="download-button"><i class="icon-eye-open"></i> Demo</a></p>
			</div><!-- /.hero-text -->
			<img src="<?php echo get_template_directory_uri(); ?>/images/edd-standing.png" />
		</div><!-- .hero-inside -->
		<div id="video-container"></div><!-- #video-container -->
		<div id="video-complete">
			<div id="video-complete-inner">
					<a class="replay-button"><span class="button"></span> Replay</a>
				<a class="close-button"><span class="button"></span> Close</a>
			</div><!-- #video-complete-inner -->
		</div><!-- /#video-complete -->
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
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
		</div>
	</div><!-- /.feature -->
</section><!-- /.feature-taxes -->

<?php
/* ----------------------------- *
 * Extensions
 * ----------------------------- */
?>
<section class="featureset clearfix feature-extensions">
	<div class="feature clearfix">
		<div class="clearfix">
			<div id="extensions-intro-box">
				<h2>Dozens of Extensions <a href="<?php echo home_url( '/extensions' ); ?>">See All Extensions</a></h2>
				<p>With over 100 extensions, customizing your store is super easy. From disabling admin notifications all the way to creating your own marketplace, as well as everything in between!</p>
			</div><!-- /#extensions-intro-box -->
			<div class="extensions-grid">
				<ul>
				<?php
				$extensions = new WP_Query(
					array(
						'post_type' => 'extension',
						'posts_per_page' => 6,
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
						<a href="<?php get_permalink(); ?>">
							<div class="preview-image">
								<?php the_post_thumbnail( 'showcase' ); ?>
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
				<p>Setting up your site couldn't be easier, with only a few details to enter, you're ready to go. Furthermore, we provide support for multiple sites so it's not a problem if you more than one store.</p>
			</div><!-- /.slide-1-text -->
			<div class="slide-2-text">
				<h4>Beautiful User Interface</h4>
				<p>Easily see how your store is doing by the clean user interface provided. You can even view your earning for multiple websites.</p>
			</div><!-- /.slide-2-text -->
			<div class="slide-3-text">
				<h4>Earnings Tracker</h4>
				<p>Everyone loves seeing how much money they are making, with the built-in earnings filters, you can see how much money was made for certain periods.</p>
			</div><!-- /.slide-3-text -->
		</div><!-- /.left -->
		<div class="iphone">
			<div class="iphone-inside">
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-1.png" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-6.png" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-2.jpg" />
				<img src="<?php echo get_template_directory_uri() ?>/images/edd-ios-3.jpg" />
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
				<p>View one touch, you can get access to all the products you sell as well the number of sales and the earnings of each product. Neat, huh?</p>
			</div><!-- /.slide-5-text -->
			<div class="slide-6-text">
				<h4>Multi-site Support</h4>
				<p>Have more than one store? 50? You're in luck! You can view sales and earnings for an <i>unlimited</i> number of sites and all that data is available with a few touches.</p>
			</div><!-- /.slide-6-text -->
		</div><!-- /.right -->
		<div class="app-store-button clearfix">
			<p><a href=""><img src="<?php echo get_template_directory_uri() ?>/images/app-store.png"></a></p>
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
		<h2>With over 100,000 downloads, we got your back...</h2>
		<p>We have <del>some</del> <ins>a lot</ins> of happy customers and here's what some are saying:</p>

		<div class="testimonials">
		<?php		
		$testimonials = new WP_Query(
			array(
				'posts_per_page' => 6,
				'post_type' => 'testimonials',
				'orderby' => 'rand'
			)
		);

		while ( $testimonials->have_posts() ) {
			$testimonials->the_post(); ?>
			<div class="testimonial">
				<blockquote>
					<p><?php the_content(); ?></p>
					<cite><a href="<?php get_post_meta( get_the_ID(), 'ecpt_url', true ); ?>"><?php echo get_post_meta( get_the_ID(), 'ecpt_author', true ); ?></a></cite>
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