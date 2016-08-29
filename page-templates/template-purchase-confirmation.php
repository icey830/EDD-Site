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
								<p>You will be sent an email within a few minutes containing download links to the items you purchased. You may also access your license keys and download your purchases from <a href="https://easydigitaldownloads.com/your-account/">your account</a>.</p>
								<p>Your purchase means a lot to us! If you'd like to tell your friends about us, use the buttons below to share Easy Digital Downloads with the world.</p>
								<div class="social-buttons">
									<div>
										<script type="text/javascript">
											// <![CDATA[
											!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
											// ]]>
										</script>
									</div>
									<div>
										<a class="twitter-share-button" href="https://twitter.com/share" data-url="https://easydigitaldownloads.com/extensions" data-text="I've just purchased extensions from @eddwp for #WordPress">Tweet</a>
										<a class="twitter-follow-button" href="https://twitter.com/eddwp" data-show-count="false">Follow @eddwp</a>
									</div>
									<div>
										<div class="g-plusone" data-size="tall" data-annotation="none" data-href="https://easydigitaldownloads.com"></div>
										<script type="text/javascript">
											// <![CDATA[
											(function() { var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/plusone.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s); })();
											// ]]>
										</script>
									</div>
									<div>
										<iframe style="border: none; overflow: hidden; width: 450px; height: 21px;" src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Feasydigitaldownloads.com%2F&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=411242818920331" width="300" height="150" frameborder="0" scrolling="no"></iframe>
									</div>
								</div>
								<?php echo do_shortcode('[edd_receipt]'); ?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane documentation-tab-pane" id="documentation-tab">
								<h3>Easy Digital Downloads Documentation</h3>
								<p>Thanks again for your purchase. Now it's time for the fun part. We understand the building an eCommerce site takes a lot of work. We encourage you to use our documentation to assist with getting the most out of your plugins.</p>
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
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

<?php get_footer();
