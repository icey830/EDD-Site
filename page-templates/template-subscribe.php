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
			<div class="subscription-form">
				<?php
				if ( function_exists( 'mailchimp_subscriber_count' ) && mailchimp_subscriber_count()->subscriber_count() ) {
					$count = mailchimp_subscriber_count()->subscriber_count();
					$newsletter_title = "Join <span class='subscriber-count'>$count</span> newsletter subscribers today.";
				} else {
					$newsletter_title = 'Never miss a deal by signing up today.';
				}
				?>
				<div id="mc_embed_signup">
					<div class="subscription-mobile">
						<h3>Stay Connected With Easy Digital Downloads</h3>
						<p>By signing up to the newsletter, you will be the first to know about the latest <strong>updates and exclusive promotions</strong> for Easy Digital Downloads and its extensions and themes.</p>
					</div>
					<p>Enter your best email address, your name, and selections for any additional updates you would like to receive.</p>
					<form action="//easydigitaldownloads.us4.list-manage.com/subscribe/post?u=cc040f2c2c0250c8ae7effbc7&amp;id=be2b495923" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div id="mc_embed_signup_scroll">
							<div class="subscription-input-fields clearfix">
								<div class="mc-field-group email-wrap">
									<label for="mce-EMAIL">Email Address</label>
									<input type="email" placeholder="Email Address *" name="EMAIL" class="required email" id="mce-EMAIL">
								</div>
								<div class="subscription-name-fields">
									<div class="mc-field-group first-name-wrap">
										<label for="mce-FNAME">First Name</label>
										<input type="text" placeholder="First Name" name="FNAME" class="" id="mce-FNAME">
									</div>
									<div class="mc-field-group last-name-wrap">
										<label for="mce-LNAME">Last Name</label>
										<input type="text" placeholder="Last Name" name="LNAME" class="" id="mce-LNAME">
									</div>
								</div>
							</div>
							<div class="subscription-groups">
								<div class="mc-field-group input-group subscription-group blog-updates">
									<span class="subscription-group-title">Additional Newsletter Preferences:</span>
									<ul>
										<label for="mce-group[22361]-22361-0">
											<input type="radio" value="1" name="group[22361]" id="mce-group[22361]-22361-0">I'd like to receive Blog Post updates.
										</label>
										<label for="mce-group[22361]-22361-1">
											<input type="radio" value="2" name="group[22361]" id="mce-group[22361]-22361-1">I'd like to receive Developer updates.
										</label>
									</ul>
								</div>
								<!--
								<div class="mc-field-group input-group subscription-group developer-updates">
									<span class="subscription-group-title">Developer Updates</span>
									<ul>
										<label for="mce-group[22365]-22365-0">
											<input type="radio" value="4" name="group[22365]" id="mce-group[22365]-22365-0">I want to receive developer updates
										</label>
										<label for="mce-group[22365]-22365-1">
											<input type="radio" value="8" name="group[22365]" id="mce-group[22365]-22365-1">I do not want to receive developer updates
										</label>
									</ul>
								</div>
								-->
							</div>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_cc040f2c2c0250c8ae7effbc7_be2b495923" tabindex="-1" value=""></div>
							<?php
								$submit_value = ! empty( $count ) ? 'Join ' . $count . ' Subscribers!' : 'Sign me up!';
							?>
							<div class="subscription-submit clear">
								<input type="submit" value="<?php echo $submit_value; ?>" name="subscribe" id="mc-embedded-subscribe" class="edd-submit button darkblue">
							</div>
							<div class="subscription-notes">
								<i class="fa fa-lock"></i>Your email address is secure. We will never send you spam. You may unsubscribe at any time.
							</div>
						</div>
					</form>
				</div>
				<img class="subscription-sitting-edd" src="<?php echo get_template_directory_uri(); ?>/images/mascot/edd-sitting.png" />
			</div>
		</div>
	</div>
</div>

<?php
get_footer();