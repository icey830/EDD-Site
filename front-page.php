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
 * Extensions
 * ----------------------------- */
?>
<section class="featureset clearfix feature-extensions">
	<div class="feature clearfix">
		<div class="clearfix">
			<div id="extensions-intro-box">
				<h2>Dozens of Extensions <a href="#">See All Extensions</a></h2>
				<p>With over 100 extensions, customizing your store is super easy. From disabling admin notifications all the way to creating your own marketplace, as well as everything in between!</p>
			</div><!-- /#extensions-intro-box -->
			<div class="extensions-grid">
				<ul>
				
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
<?php get_footer(); ?>