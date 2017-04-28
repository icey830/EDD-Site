<?php
/**
 * Template Name: Subscribe
 *
 * The template for displaying newsletter subscription form
 */
get_header();
the_post();
?>

<div id="subscription-header-area" class="subscription-header-area page-section-white full-width">
	<div class="inner">
		<div class="subscription-header clearfix">
			<div class="subscription-info">
				<div class="subscription-content">
					<h3 class="subscription-title">Stay Connected With Easy Digital Downloads</h3>
					<p>By signing up to the newsletter, you will be the first to know about the latest <strong>updates and exclusive promotions</strong> for Easy Digital Downloads and its extensions and themes.</p>
					<h3 class="section-title-alt">Updates That Matter</h3>
					<p>Interested in learning new ways to get the most out of your eCommerce business? Subscribe to the <strong>Blog Post Updates</strong> where we publish helpful information about eCommerce and Easy Digital Downloads.</p>
					<p>Are you building an extension or theme for Easy Digital Downloads? Perhaps you've done custom work for your site? Our <strong>Developer Updates</strong> list is an absolute must to follow.</p>
				</div>
			</div>
			<div class="subscription-form-wrap subscription-form-container">
				<div class="subscription-form">
					<div class="subscription-mobile">
						<h3>Stay Connected With Easy Digital Downloads</h3>
						<p>By signing up to the newsletter, you will be the first to know about the latest <strong>updates and exclusive promotions</strong> for Easy Digital Downloads and its extensions and themes.</p>
					</div>
					<p>Enter your best email address, your name, and selections for any additional updates you would like to receive.</p>
					<?php
						$args = array(
							'heading'     => false,
							'description' => false
						);
						eddwp_newsletter_form( $args );
					?>
				</div>
				<img class="subscription-sitting-edd" src="<?php echo get_template_directory_uri(); ?>/images/mascot/edd-sitting.png" />
			</div>
		</div>
	</div>
</div>

<?php
get_footer();