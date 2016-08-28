<?php
/* Template Name: Purchase Confirmation
 *
 * enhanced purchase confirmation template
 */

get_header();
?>

	<div class="purchase-confirmation-area page-section-white full-width">
		<div class="inner">
			<div class="purchase-confirmation-content">

				<h2 class="section-title-alt">Purchase Confirmation</h2>
				<div id="purchase-confirmation-page" class="clearfix">

					<div class="tabbed-template-tabs">
						<ul class="nav nav-tabs nav-append-content purchase-confirmation-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i>Purchase Details</a></li>
							<li><a href="#documentation-tab" data-toggle="tab"><i class="fa fa-file-text-o" aria-hidden="true"></i>Documentation</a></li>
						</ul>
						<ul class="your-account-link-list">
							<li><a class="your-account-link" href="<?php echo home_url( '/your-account' ); ?>"><i class="fa fa-user" aria-hidden="true"></i>Your Account</a></li>
						</ul>
					</div>

					<div class="tabbed-template-tab-content">
						<div class="tab-content">
							<div class="tab-pane active purchase-confirmation-tab-pane" id="tab1">
								<h3>Thank you for your purchase!</h3>
								<?php
									while ( have_posts() ) : the_post();
										the_content();
									endwhile;
								?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane documentation-tab-pane" id="documentation-tab">
								<h3>Easy Digital Downloads Documentation</h3>
								<p>Thanks again for your purchase. Now it's time for the fun part. We understand the building an eCommerce site takes a lot of work. We encourage you to use our documentation to assist with getting the most out of your plugins.</p>
								<h5>Getting Started</h5>
								<ul class="documentation-list">
									<li><a href="http://docs.easydigitaldownloads.com/article/844-introduction">Basic Easy Digital Downloads Introduction</a></li>
									<li><a href="http://docs.easydigitaldownloads.com/article/192-how-do-i-install-an-extension">How do I install an extension?</a></li>
									<li><a href="http://docs.easydigitaldownloads.com/article/1002-can-i-upgrade-my-licenses">Can I upgrade my licenses?</a></li>
								</ul>
								<p><a class="edd-submit button blue" href="http://docs.easydigitaldownloads.com/">View Full Documentation</a></p>
							</div><!-- /.tab-pane -->
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

<?php get_footer();
