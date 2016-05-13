<?php
/**
 * Template Name: Subscribe
 *
 * The template for displaying newsletter subscription form
 */
get_header();
the_post();
?>

<div id="subscription-header-area" class="subscription-header-area page-section-blue full-width">
	<div class="inner">
		<div class="subscription-header clearfix">
			<div class="subscription-info">
				<div class="subscription-headline">
					<span class="subscription-subtitle">Keep up with Easy Digital Downloads</span>
					<?php
					if ( function_exists( 'mailchimp_subscriber_count' ) && mailchimp_subscriber_count()->subscriber_count() ) {
						$count = mailchimp_subscriber_count()->subscriber_count();
						$newsletter_title = "Join <span class='footer-subscriber-count'>$count</span> Newsletter Subscribers Today";
					} else {
						$newsletter_title = 'Easy Digital Downloads Email Newsletter';
					}
					?>
					<h3 class="subscription-title"><?php echo $newsletter_title; ?></h3>
				</div>
			</div>
			<div class="subscription-form">

				<div id="mc_embed_signup">
					<form action="//easydigitaldownloads.us4.list-manage.com/subscribe/post?u=cc040f2c2c0250c8ae7effbc7&amp;id=be2b495923" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div id="mc_embed_signup_scroll">
							<div class="subscription-input-fields">
								<div class="mc-field-group">
									<label for="mce-EMAIL">Email Address</label>
									<input type="email" placeholder="Email Address *" name="EMAIL" class="required email" id="mce-EMAIL">
								</div>
								<div class="mc-field-group">
									<label for="mce-FNAME">First Name</label>
									<input type="text" placeholder="First Name" name="FNAME" class="" id="mce-FNAME">
								</div>
								<div class="mc-field-group">
									<label for="mce-LNAME">Last Name</label>
									<input type="text" placeholder="Last Name" name="LNAME" class="" id="mce-LNAME">
								</div>
							</div>
							<div class="mc-field-group input-group">
								<strong>Blog Posts </strong>
								<ul><li><input type="radio" value="1" name="group[22361]" id="mce-group[22361]-22361-0"><label for="mce-group[22361]-22361-0">I want to receive blog post updates</label></li>
									<li><input type="radio" value="2" name="group[22361]" id="mce-group[22361]-22361-1"><label for="mce-group[22361]-22361-1">I do not want to receive blog post updates</label></li>
								</ul>
							</div>
							<div class="mc-field-group input-group">
								<strong>Developer Updates </strong>
								<ul><li><input type="radio" value="4" name="group[22365]" id="mce-group[22365]-22365-0"><label for="mce-group[22365]-22365-0">I want to receive developer updates</label></li>
									<li><input type="radio" value="8" name="group[22365]" id="mce-group[22365]-22365-1"><label for="mce-group[22365]-22365-1">I do not want to receive developer updates</label></li>
								</ul>
							</div>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_cc040f2c2c0250c8ae7effbc7_be2b495923" tabindex="-1" value=""></div>
							<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

<?php
get_footer();