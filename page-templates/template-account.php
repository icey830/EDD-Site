<?php
/* Template Name: My Account
 *
 * "my account" page template
 */

global $rcp_load_css, $rcp_load_scripts, $current_user;
$rcp_load_css = $rcp_load_scripts = true;

get_header();

if ( is_user_logged_in() ) :

	// check for expired licenses
	$args = array(
		'posts_per_page' => -1,
		'post_type'      => 'edd_license',
		'post_status'    => 'any',
		'meta_query'     => array(
			'relation' => 'AND',
			array(
				'key'     => '_edd_sl_user_id',
				'value'   => get_current_user_id(),
				'compare' => '='
			),
			array(
				'relation' => 'OR',
				array(
					'key'     => '_edd_sl_status',
					'value'   => 'expired',
					'compare' => '='
				),
				array(
					'key'     => '_edd_sl_expiration',
					'value'   => time(),
					'compare' => '<'
				)
			),
		),
	);
	$license_keys  = get_posts( $args );

	// how many expired licenses are there?
	$expired_qty = count( $license_keys );

	// get rid of the default license renewal form
	remove_action( 'edd_sl_license_keys_before', array( $edd_sl_renew_all, 'renew_all_button' ) );
	?>

	<div class="my-account-area page-section-white full-width">
		<div class="inner">
			<div class="my-account-content">
				<h2 class="section-title-alt">Your Account</h2>
				<div id="account-page" class="clearfix">

					<div class="my-account-tabs">
						<div class="my-account-info">
							<div class="my-account-welcome">
								<?php
									$the_user_title = $current_user->user_firstname ? $current_user->user_firstname  : $current_user->user_login;
									$is_affiliate = function_exists( 'affwp_is_affiliate' ) && affwp_is_affiliate( $current_user->ID ) ? ' is-affiliate' : '';
								?>
								<h4>Welcome, <?php echo $the_user_title; ?>!</h4>
								<p>Use the links below to navigate your account information.</p>
								<h6>Account Information</h6>
								<?php
									// user email address
									echo '<div class="edd-account-info"><span class="account-info-label">Email:</span>' . $current_user->user_email . '</div>';

									// get logged in user information
									get_currentuserinfo();

									// disply wallet balance if it is about $0
									$wallet_value = edd_wallet()->wallet->balance( $current_user->ID );
									if ( class_exists( 'EDD_Wallet' ) ) :
										if ( $wallet_value > 0 ) :
											$balance = edd_currency_filter( edd_format_amount( $wallet_value ) );
											echo '<div class="edd-account-info"><span class="account-info-label">Wallet:</span><span class="edd-wallet-value">' . $balance . '</span></div>';
										endif;
									endif;
								?>
							</div>
						</div>
						<ul class="nav nav-tabs nav-append-content<?php echo $is_affiliate; ?>">
							<li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-usd"></i>Purchases</a></li>
							<?php $has_expired_licenses = ! empty( $license_keys ) ? ' class="has-expired-licenses"' : ''; ?>
							<li><a href="#license-keys-tab" data-toggle="tab"<?php echo $has_expired_licenses; ?>><i class="fa fa-key"></i>License Keys</a></li>
							<li><a href="#subscriptions-tab" data-toggle="tab"><i class="fa fa-repeat"></i>Subscriptions</a></li>
							<li><a href="#downloads-tab" data-toggle="tab"><i class="fa fa-cloud-download"></i>Downloads</a></li>
							<li><a href="#tab2" data-toggle="tab"><i class="fa fa-user"></i>Profile</a></li>
							<?php if ( eddc_user_has_commissions() ) { ?>
								<li><a href="#tab3" data-toggle="tab"><i class="fa fa-money"></i>Commissions</a></li>
							<?php } ?>
							<li><a href="#tab5" data-toggle="tab"><i class="fa fa-wrench"></i>Support Subscription</a></li>
						</ul>
						<?php if ( ! empty( $is_affiliate ) ) { ?>
							<ul class="affiliates-list">
								<li><a class="affiliates-tab" href="<?php echo home_url( '/your-account/affiliate-area/' ); ?>"><i class="fa fa-thumbs-o-up"></i>Affiliates</a></li>
							</ul>
						<?php } ?>
					</div>

					<div class="my-account-tab-content">
						<div class="tab-content">
							<div class="tab-pane active purchases-tab-pane" id="tab1">
								<h3>Your Purchase History</h3>
								<p>All purchases below were completed with the following email address: <strong><?php echo $current_user->user_email; ?></strong>. If you have trouble locating purchases, please <a href="<?php echo home_url( 'support' ); ?>">contact support</a> for assistance.</p>
								<?php
								if ( isset( $_GET['payment_id'] ) && is_numeric( $_GET['payment_id'] ) ) {
									echo apply_filters( 'the_content', do_shortcode( '[purchase_history]' ) );
								} else {
									echo do_shortcode( '[purchase_history]' );
								}
								?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane license-keys-tab-pane" id="license-keys-tab">
								<?php if ( ! empty( $license_keys ) ) { ?>
									<div class="license-key-notice">
										<h4 class="section-title-alt"><i class="fa fa-exclamation-triangle"></i>You have <?php echo $expired_qty; ?> expired license key<?php echo $expired_qty > 1 ? 's' : ''; ?></h4>
										<div class="expired-keys">
											<div class="flex-container">
												<?php
													// get the first two license keys
													$i = 0;
													foreach ( $license_keys as $index => $key ) {
														$i++;

														if ( $i > 2 ) {
															break;
														}

														// get the product title
														$post_title = explode( "-", $key->post_title, 2 );
														$the_title = $post_title[0];

														// get the license key
														$the_key = get_post_meta( $key->ID, '_edd_sl_key', true );
														?>
														<div class="expired-key-item flex-two">
															<span class="licensed-product-title"><?php echo $the_title; ?></span><br>
															<div class="license-actions">
																<span class="licensed-product-key"><?php echo $the_key; ?></span><br>
																<a href="<?php echo home_url( '/checkout/?edd_license_key=' ) . $the_key; ?>">Renew license</a>
															</div>
														</div>
														<?php
														unset( $license_keys[ $index ] );
													}
												?>
											</div>
											<?php
												// get the rest of the license keys
												if ( $i > 2 ) {
													?>
													<div class="toggle-keys-container">
														<div class="flex-container">
															<?php
															foreach ( $license_keys as $key ) {

																// get the product title
																$post_title = explode( "-", $key->post_title, 2 );
																$the_title = $post_title[0];

																// get the license key
																$the_key = get_post_meta( $key->ID, '_edd_sl_key', true );
																?>
																<div class="expired-key-item flex-two">
																	<span class="licensed-product-title"><?php echo $the_title; ?></span><br>
																	<div class="license-actions">
																		<span class="licensed-product-key"><?php echo $the_key; ?></span><br>
																		<a href="<?php echo home_url( '/checkout/?edd_license_key=' ) . $the_key; ?>">Renew license</a>
																	</div>
																</div>
																<?php
															}
															?>
														</div>
													</div>
													<a class="expired-key-toggle" href="#">Click here to view all expired license keys</a>
													<?php
												}
											?>
										</div>
									</div>
								<?php } ?>
								<?php if ( class_exists( 'edd_software_licensing' ) && false != edd_software_licensing()->get_license_keys_of_user() ) {
									$no_expired = empty( $license_keys ) ? ' no-expired' : '';
									?>
									<div class="renew-all-licenses<?php echo $no_expired; ?>">
										<?php if ( ! empty( $license_keys ) ) { ?>
											<p>You may also renew license keys in bulk using the form below.</p>
										<?php } else { ?>
											<h4 class="section-title-alt"><i class="fa fa-thumbs-up"></i>You do not have any expired license keys</h4>
											<p>If you would like to renew all of your licenses now, you may do so using the form below.</p>
										<?php } ?>
										<?php echo $edd_sl_renew_all->renew_all_button(); ?>
									</div>
								<?php } ?>
								<h3>Manage Your License Keys</h3>
								<p>Below you will find all license keys for you previous purchases. Use the <strong>Manage Sites</strong> links to authorize specific URLs for your license keys. Use the <strong>Extend License</strong> or <strong>Renew License</strong> links to adjust the terms of your license keys.</p>
								<?php echo do_shortcode( '[edd_license_keys]' ); ?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane subscriptions-tab-pane" id="subscriptions-tab">
								<h3>Manage Your Subscriptions</h3>
								<p>Use the tools below to view subscription details, manage all of your product subscriptions, and view invoices.</p>
								<?php echo do_shortcode( '[edd_subscriptions]' ); ?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane downloads-tab-pane" id="downloads-tab">
								<h3>Your Download History</h3>
								<p>Below you will find a complete history of your file downloads.</p>
								<?php echo do_shortcode( '[download_history]' ); ?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane profile-editor-tab-pane" id="tab2">
								<h3>Edit Your Profile Information</h3>
								<p>Use the form below to edit the information saved in your user profile. Select information will be used to auto-complete the checkout form for your next purchase.</p>
								<?php edd_get_template_part( 'shortcode', 'profile-editor' ); ?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane commissions-tab-pane" id="tab3">
								<h3>Next Payout</h3>
								<p id="next-payout"><?php if( function_exists( 'eddc_get_upcoming_commissions' ) ) { echo eddc_get_upcoming_commissions(); } ?></p>
								<?php if( function_exists( 'eddc_user_product_list' ) ) { echo eddc_user_product_list(); } ?>
								<?php if( function_exists( 'eddc_user_commissions' ) ) { echo eddc_user_commissions(); } ?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane support-subscription-tab-pane" id="tab5">
								<h3>Your Support Subscription</h3>
								<p>See the details of your support subscription below.</p>
								<?php
									echo do_shortcode( '[subscription_details]' );
									echo do_shortcode( '[card_details]' );
								?>
							</div><!-- /.tab-pane -->
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<?php

else : ?>

	<div id="landing-page-area" class="full-width clearfix">
		<div class="inner">
			<section class="page-content">
				<article class="content clearfix">
					<div class="entry-header">
						<h3 class="entry-title">Please log in to access your account information.</h3>
					</div>
					<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
						<fieldset>
								<input type="text" placeholder="Username" id="user_login" size="20" value="" name="log" />
								<input type="password" placeholder="Password" id="user_pass" size="20" value="" name="pwd" />
						</fieldset>

						<div class="clearfix">
							<input type="checkbox" name="rememberme" id="rememberme" value="forever" checked="checked" />
							<label for="rememberme">Remember my password</label>
							<input type="submit" class="edd-submit button blue" name="wp-submit" value="Sign In" />
							<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
						</div>
					</form><!-- /#loginform -->
				</article>
			</section>
		</div>
	</div>
	<?php

endif;

get_footer();
