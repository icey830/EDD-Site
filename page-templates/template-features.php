<?php
/* Template Name: Features
 *
 * theme Features page
 */

get_header();
the_post();
?>

<div id="shopping-cart-area" class="features-page-section content-screenshot page-section-white full-width">
	<div class="inner">
		<div class="shopping-cart-content clearfix">
			<h2 class="section-title-alt">Features, Functionality, and Extensibility</h2>
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
				<img class="features-image" src="<?php echo get_template_directory_uri() . '/images/features-page/edd-checkout-screenshot.png'; ?>">
			</div>
		</div>
	</div>
</div>

<div id="customer-management-area" class="features-page-section screenshot-content page-section-gray full-width">
	<div class="inner">
		<div class="customer-management-content clearfix">
			<div class="features-content">
				<h6><i class="fa fa-user"></i>Customer Management</h6>
				<ul>
					<li>maintain a separate record for each customer</li>
					<li>view, edit, or delete any customer record</li>
					<li>track customer lifetime value and activity</li>
					<li>link customer records to user profiles</li>
					<li>create customer account page</li>
				</ul>
			</div>
			<div class="features-screenshot">
				<img class="features-image" src="<?php echo get_template_directory_uri() . '/images/features-page/edd-customer-screenshot.png'; ?>">
			</div>
		</div>
	</div>
</div>

<div id="discount-codes-area" class="features-page-section content-screenshot page-section-white full-width">
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

<div id="data-reporting-area" class="features-page-section screenshot-content page-section-gray full-width">
	<div class="inner">
		<div class="data-reporting-content clearfix">
			<div class="features-content">
				<h6><i class="fa fa-line-chart"></i>Data Reporting</h6>
				<ul>
					<li>view earnings by date range and category</li>
					<li>filter reports by specific product</li>
					<li>track collected taxes by year</li>
					<li>export store data to <abbr title="Comma Separate Values">CSV</abbr> file</li>
					<li>monitor download, sales, & API request logs</li>
				</ul>
			</div>
			<div class="features-screenshot">
				<img class="features-image" src="<?php echo get_template_directory_uri() . '/images/features-page/edd-reports-screenshot.png'; ?>">
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
			<h2 class="section-title-alt gears">Additional Core Features</h2>
			<div class="features-grid-content-sections flex-container">
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-exchange"></i>Rest API</h6>
					<p>Developers and external applications can take advantage of a complete RESTful API that provides easy access to sales and product information in either jSON or XML format.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-money"></i>Payment History</h6>
					<p>Record payment records of every transaction in your system and use the familiar Payment History interface to see key details about payments, resend purchase receipts, and much more.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-download"></i>File Download Logs</h6>
					<p>View everything there is to know about customer file downloads from your system. You will have access to details such as download dates & times, IP address, and attached payment record.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-times"></i>File Access Control</h6>
					<p>All product files are restricted to authorized customers only. No configurations is required. You may also set the file download limit and download link expiration.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-user"></i>Customer Account Page</h6>
					<p>Through the use of a single shortcode, output an entire purchase history table that is only viewable by logged in customers. Unauthorized users will not have access.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-wrench"></i>Actively Supported</h6>
					<p>An evolving software tool is only as good as its support. Our dedicated team ensures that all customers have access to free, timely support with no strings attached.</p>
				</div>
			</div>
			<h2 class="section-title-alt">Seamless Integrations</h2>
			<div class="features-grid-content-sections flex-container">
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-plug"></i>Extension Catalog</h6>
					<p>While Easy Digital Downloads is a full eCommerce platform, the true power lies in its extensibility. With hundreds of available extensions, you can tailor EDD to your needs. <a href="<?php echo home_url( '/downloads/' ); ?>">View all extensions</a>.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-credit-card"></i>Payment Gateways</h6>
					<p>Payment gateways are an absolute must for eCommerce businesses to securely process payments. EDD supports the industry's most popular payment processors and several more. <a href="<?php echo home_url( '/downloads/category/extensions/gateways/' ); ?>">View payment gateways</a>.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-refresh"></i>Refund Tracking</h6>
					<p>For most online businesses, refunds are inevitable and processing refunds can be a daunting task. With select payment gateways, EDD makes processing refunds a hassle-free experience.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-thumbs-o-up"></i>Affiliate System Integration</h6>
					<p>The limitness nature of digital products makes affiliate integration an attractive component. EDD is <strong>fully supported</strong> by AffiliateWP right out of the box. <a href="https://affiliatewp.com/?ref=743">View AffiliateWP</a>.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-envelope-o"></i>Mailing List Integration</h6>
					<p>Build relationships with your customers by keeping in touch with them after the purchase. Using our newsletter extensions, connect EDD to you favorite email marketing service tool. <a href="<?php echo home_url( '/downloads/category/extensions/newsletters/' ); ?>">View newsletter extensions</a>.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-database"></i>External File Storage</h6>
					<p>For some, WordPress' Media Library is not enough to host product files. For that reason, EDD supports content delivery tools like <a href="<?php echo home_url( '/downloads/amazon-s3/' ); ?>">Amazon S3</a> and <a href="<?php echo home_url( '/downloads/dropbox-file-store/' ); ?>">Dropbox</a> for hosting product files.</p>
				</div>
			</div>
			<h2 class="section-title-alt">Developers & Contributors</h2>
			<div class="features-grid-content-sections flex-container">
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-code"></i>Actively Developed</h6>
					<p>Not a day goes by that EDD is not actively developed. Issue logging, bug fixing, and feature enhancements are a daily occurance for the development team and supporting contributors.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-code-fork"></i>Open Sourced & GPL</h6>
					<p>As a platform built on WordPress, EDD is licensed under <abbr title="GNU General Public License version 3">GPLv3</abbr>. To go a step further, EDD is also an open-source software with a dedicated community of developers and contributors.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-users"></i>Developer Friendly</h6>
					<p>While there are hundreds of <a href="<?php echo home_url( '/downloads/' ); ?>">extensions</a> available for use, being extensible means the options are limitless. Actions, filters, and smart coding make EDD a developer-friendly platform.</p>
				</div>
				<div class="edd-feature flex-two">
					<h6><i class="fa fa-paint-brush"></i>Intelligently Designed</h6>
					<p>The effects of site design on customer behavior are well-known. EDD plays its role by including a base style that looks great as-is, but is also ready to integrate with any WordPress theme.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>