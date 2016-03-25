<?php
/* Template Name: Features
 *
 * theme Features page
 */

get_header();
the_post();
?>

<div id="features-page-intro-area" class="features-page-intro-section page-section-gray full-width">
	<div class="inner">
		<div class="features-page-intro">
			<div class="section-header">
				<h2 class="section-title">Easy Digital Downloads <strong>Core Features</strong></h2>
				<p class="section-subtitle">Easy Digital Downloads is a full-featured eCommerce platform with all the tools and features you need to turn your WordPress website into a a digital store. Check out the features below and see for yourself.</p>
			</div>
		</div>
	</div>
</div>

<div id="shopping-cart-area" class="features-page-section page-section-white full-width">
	<div class="inner">
		<div class="shopping-cart-content clearfix">
			<div class="features-content">
				<h6><i class="fa fa-shopping-cart"></i>Shopping Cart</h6>
				<ul>
					<li>choose Buy Now or Add to Cart buttons</li>
					<li>customize action button text</li>
					<li>allow potential customer cart saving</li>
					<li>support registered user or guest checkout</li>
					<li>require agreement of terms before purchase</li>
				</ul>
			</div>
			<div class="features-screenshot">
				<img class="features-image" src="<?php echo get_template_directory_uri() . '/images/features-page/edd-discounts-screenshot.png'; ?>">
			</div>
		</div>
	</div>
</div>

<div id="customer-management-area" class="features-page-section page-section-gray full-width">
	<div class="inner">
		<div class="customer-management-content clearfix">
			<div class="features-screenshot">
				<img class="features-image" src="<?php echo get_template_directory_uri() . '/images/features-page/edd-discounts-screenshot.png'; ?>">
			</div>
			<div class="features-content">
				<h6><i class="fa fa-shopping-cart"></i>Customer Management</h6>
				<ul>
					<li>maintain a separate record for each customer</li>
					<li>view, edit, or delete any customer record</li>
					<li>track customer lifetime value and activity</li>
					<li>link customer records to user profiles</li>
					<li>create customer account page</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div id="discount-codes-area" class="features-page-section page-section-white full-width">
	<div class="inner">
		<div class="discount-codes-content clearfix">
			<div class="features-content">
				<h6><i class="fa fa-tag"></i>Discount Codes</h6>
				<ul>
					<li>choose flat rate or percentage based</li>
					<li>specify products to include or exclude</li>
					<li>set automated start and end dates</li>
					<li>require minimum cart total for discount use</li>
					<li>limit discount usage by count or user</li>
				</ul>
			</div>
			<div class="features-screenshot">
				<img class="features-image" src="<?php echo get_template_directory_uri() . '/images/features-page/edd-discounts-screenshot.png'; ?>">
			</div>
		</div>
	</div>
</div>

<div id="data-reporting-area" class="features-page-section page-section-gray full-width">
	<div class="inner">
		<div class="data-reporting-content clearfix">
			<div class="features-screenshot">
				<img class="features-image" src="<?php echo get_template_directory_uri() . '/images/features-page/edd-discounts-screenshot.png'; ?>">
			</div>
			<div class="features-content">
				<h6><i class="fa fa-tag"></i>Data Reporting</h6>
				<ul>
					<li>view earnings by date range and category</li>
					<li>filter reports by specific product</li>
					<li>track collected taxes by year</li>
					<li>export store data to <abbr title="Comma Separate Values">CSV</abbr> file</li>
					<li>monitor download, sales, & API request logs</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div id="testimonials-area" class="testimonials-section page-section-white full-width">
	<div class="inner">
		<div class="testimonials-content clearfix">
			<div class="testimonials-grid flex-container">
				<?php
					$args = array(
						'post_type'      => 'testimonials',
						'post_status'    => 'publish',
						'post__in'       => array( 1887, 2590 ),
						'posts_per_page' => 2,
						'orderby'        => 'rand',
					);
					$testimonials = new WP_Query( $args );
					while ( $testimonials->have_posts() ) : $testimonials->the_post();
						?>
						<div class="testimonial-item flex-two">
							<h2 class="testimonial-title"><?php the_title(); ?></h2>
							<div class="testimonial-content"><?php the_content(); ?></div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</div>

<div id="download-edd-area" class="download-edd-section page-section-blue full-width">
	<div class="inner">
		<div class="download-edd-content clearfix">
			<h3>Get Started with Easy Digital Downloads</h3>
			<p>Download now to start using the world's easiest way to sell digital downloads through WordPress.</p>
			<div class="download-edd-cta">
				<a class="edd-submit button darkblue" href="http://downloads.wordpress.org/plugin/easy-digital-downloads.latest-stable.zip?utm_source=home&utm_medium=button_2&utm_campaign=Download+Button"><i class="fa fa-cloud-download"></i>Download</a>
			</div>
		</div>
	</div>
</div>

<div id="features-page-features" class="features-grid-two page-section-white full-width">
	<div class="inner">
		<div class="features-grid-two-content">
			<h2 class="section-title-alt gears">Additional Features</h2>
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
					<p>Monitor all therr is to know about how your product files are being downloaded by your customers. Easily track date, time, and even IP address of all purchased and downloaded files.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-database"></i>REST API</h6>
					<p>Developers and external applications can take advantage of a complete RESTful API that provides easy access to sales and product information in either jSON or XML format.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-line-chart"></i>Full Data Reporting</h6>
					<p>No business is complete without detailed bookkeeping. Easy Digital Downloads has a built-in reporting platform for easily viewing stats, making custom reports, and much more.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-download"></i>Unlimited File Downloads</h6>
					<p>There are no limitations when it comes to distributing your digital products. Allow customers to download their purchased files endlessly or restrict file downloads by time and/or attempt.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-bar-chart"></i>Download Activity Tracking</h6>
					<p>Monitor all therr is to know about how your product files are being downloaded by your customers. Easily track date, time, and even IP address of all purchased and downloaded files.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-database"></i>REST API</h6>
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

<?php get_footer(); ?>