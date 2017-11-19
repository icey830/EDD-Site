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

					<script type="text/javascript">
						jQuery(function($) {
							// enable link to tab
							var hash = document.location.hash;
							var prefix = "tab-";
							if (hash) {
								$('.nav-tabs a[href="' + hash.replace(prefix, "") + '"]').tab('show');
							}

							// Change hash for page-reload
							$('.nav-tabs a').on('shown.bs.tab', function (e) {
								window.location.hash = e.target.hash.replace("#", "#" + prefix);
							});
						});
					</script>

					<div class="tabbed-template-tabs">
						<ul class="nav nav-tabs nav-append-content purchase-confirmation-tabs">
							<li class="active"><a href="#purchase-details" data-toggle="tab"><i class="fa fa-list" aria-hidden="true"></i>Purchase Details</a></li>
							<li><a href="#documentation" data-toggle="tab"><i class="fa fa-file-text" aria-hidden="true"></i>Documentation</a></li>
							<?php if ( function_exists( 'edd_rp_get_suggestions' ) ) { ?>
								<li><a href="#recommendations" data-toggle="tab"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Recommendations</a></li>
							<?php } ?>
						</ul>
						<ul class="your-account-link-list">
							<li><a class="your-account-link" href="<?php echo home_url( '/your-account' ); ?>"><i class="fa fa-user" aria-hidden="true"></i>Your Account</a></li>
						</ul>
					</div>

					<div class="tabbed-template-tab-content">
						<div class="tab-content">
							<div class="tab-pane active purchase-confirmation-tab-pane" id="purchase-details">
								<h3>Thank you for your purchase!</h3>
								<p>You will be sent an email within a few minutes containing download links to the items you purchased. You may also access your license keys and download your purchases from <a href="https://easydigitaldownloads.com/your-account/">your account</a>.</p>
								<p>Your purchase means a lot to us! If you'd like to tell your friends about us, use the buttons below to share Easy Digital Downloads with the world.</p>
								<?php
									eddwp_social_networking_follow();
									echo do_shortcode('[edd_receipt]');
								?>
							</div><!-- /.tab-pane -->

							<div class="tab-pane documentation-tab-pane" id="documentation">
								<h3>Easy Digital Downloads Documentation</h3>
								<p>Thanks again for your purchase. Now it's time for the fun part. We understand that building an eCommerce site takes a lot of work, so we put together some documentation to assist with getting the most out of your plugins.</p>
								<h5>Helpful Documentation</h5>
								<ul class="documentation-list">
									<?php
										// get the payment key
										$session = edd_get_purchase_session();
										$payment_key = '';
										if ( ! empty( $_GET['payment_key'] ) ) {
											$payment_key = urldecode( $_GET['payment_key'] );
										} else if ( $session && ! empty( $session['purchase_key'] ) ) {
											$payment_key = $session['purchase_key'];
										} elseif ( ! empty ( $edd_receipt_args['payment_key'] ) ) {
											$payment_key = $edd_receipt_args['payment_key'];
										}

										// if payment key exists, output doc links
										if ( ! empty( $payment_key ) ) {
											$payment = new EDD_Payment( $edd_receipt_args['id'] );
											foreach( $payment->downloads as $download ) {
												$title = get_the_title( $download['id'] );
												$doc = get_post_meta( $download['id'], 'ecpt_documentationlink', true );
												if ( $doc ) {
													echo '<li>';
													echo '<a href="' . $doc . '">' . $title . ' documentation</a>';
													echo '</li>';
												}
											}
										}
									?>
									<li><a href="http://docs.easydigitaldownloads.com/article/844-introduction">Basic Easy Digital Downloads Introduction</a></li>
									<li><a href="http://docs.easydigitaldownloads.com/article/192-how-do-i-install-an-extension">How do I install an extension?</a></li>
									<li><a href="http://docs.easydigitaldownloads.com/article/1002-can-i-upgrade-my-licenses">Can I upgrade my licenses?</a></li>
								</ul>
								<p><a class="edd-submit button blue" href="http://docs.easydigitaldownloads.com/">View Full Documentation</a></p>
							</div><!-- /.tab-pane -->

							<div class="tab-pane recommendations-tab-pane" id="recommendations">
								<h3>Extension Recommendations</h3>
								<p>Based on your purchase, we've created a list of extensions that may help you customize your eCommerce business even more. Take a look and <a href="<?php echo home_url( '/support/' ); ?>">let us know</a> if you have any questions.</p>
								<div class="stray-downloads">
									<?php echo eddwp_rp_shortcode( 4 ); ?>
								</div>
							</div><!-- /.tab-pane -->
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

<?php get_footer();
