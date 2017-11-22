<?php
/* Template Name: My Account
 *
 * "my account" page template
 */

global $rcp_load_css, $rcp_load_scripts, $current_user, $edd_sl_renew_all;
$rcp_load_css = $rcp_load_scripts = true;

// All Access Pass post object
$aap = get_page_by_path( 'all-access-pass', OBJECT, 'download' );

get_header();

if ( is_user_logged_in() ) : ?>
	<div class="my-account-area page-section-white full-width">
		<div class="inner">
			<div class="my-account-content">
				<?php
				if ( ! empty( $_GET['action'] ) && 'manage_licenses' === $_GET['action'] && isset( $_GET['license_id'] ) ) {
					if ( isset( $_GET['license_id'] ) && isset( $_GET['view'] ) && 'upgrades' == $_GET['view'] ) {
						?>
						<h2 class="section-title-alt">Available License Upgrades</h2>
						<div id="account-page" class="clearfix">
							<?php edd_get_template_part( 'licenses', 'upgrades' ); ?>
						</div>
						<?php
					} else {
						?>
						<h2 class="section-title-alt">Manage License Sites</h2>
						<div id="account-page" class="clearfix">
							<?php edd_get_template_part( 'licenses', 'manage-single' ); ?>
						</div>
						<?php
					}
				} elseif ( ! empty( $_GET['action'] ) && 'manage_licenses' === $_GET['action'] && isset( $_GET['payment_id'] ) ) {
					?>
					<h2 class="section-title-alt">License Key Overview</h2>
					<div id="account-page" class="clearfix">
						<?php edd_get_template_part( 'licenses', 'manage-overview' ); ?>
					</div>
					<?php
				} else { // Load the normal view
					// check for expired licenses
					$license_args = array(
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
								'relation' => 'AND',
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
					$license_keys  = get_posts( $license_args );

					// how many expired licenses are there?
					$expired_qty = count( $license_keys );

					// get rid of the default license renewal form
					remove_action( 'edd_sl_license_keys_before', array( $edd_sl_renew_all, 'renew_all_button' ) );
					?>

					<h2 class="section-title-alt">Your Account</h2>

					<?php // TODO: reverse conditional before going live ?>
					<?php if ( edd_has_user_purchased( get_current_user_id(), $aap->ID ) ) { ?>
					<div class="upgrade-to-aa">
						<i class="fa fa-gift" aria-hidden="true"></i> <span class="upgrade-to-aa-message">Upgrade to our <a href="<?php echo get_permalink( $aap->ID ); ?>" class="aa-pass-link"><?php echo get_the_title( $aap->ID ); ?></a> and automatically receive <span class="discount-amount"><?php echo edd_currency_filter( edd_format_amount( eddwp_edd_all_access_upgrade_discount() ) ); ?></span> off your purchase! <a href="#" class="upgrade-to-aa-link">Click here to upgrade!</a></span>
					</div>
					<?php } ?>

					<?php
					$subscriber = new EDD_Recurring_Subscriber( get_current_user_id(), true );
					$failing_subs = $subscriber->get_subscriptions( 0, 'failing' );

					if ( is_array( $failing_subs ) && ! empty( $failing_subs ) ) {
						?>
						<div class="update-subscription-info warning">

							<?php
							if ( count( $failing_subs ) > 1 ) {
								?>
								<div class="failing-subs">
									<span class="failing-sub-header"><i class="fa fa-exclamation-triangle"></i> The following subscriptions could not be renewed:</span>
									<ul>
										<?php foreach ( $failing_subs as $failing_sub ) :
											$product_id = $failing_sub->product_id;
											$sub_id     = $failing_sub->id;
											?>
											<li>
												<?php echo get_the_title( $product_id ); ?> - <a href="<?php echo home_url( 'your-account' ) . '?action=update&amp;subscription_id=' . $sub_id . '#tab-subscriptions'; ?>">update payment information</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>

								<?php
							} else {
								$sub_id = $failing_subs[0]->id;
								?>
								<div class="failing-sub">
									<span class="failing-sub-header">
										<i class="fa fa-exclamation-triangle"></i> Your subscription could not be renewed.
									</span>
									<span>
										Please <a href="<?php echo home_url( 'your-account' ) . '?action=update&amp;subscription_id=' . $sub_id . '#tab-subscriptions'; ?>">update your payment information</a> for <strong><?php echo get_the_title( $failing_subs[0]->product_id ); ?></strong>.
									</span>
								</div>
								<?php
							}
							?>
						</div>
					<?php } ?>

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
										wp_get_current_user();

										// disply wallet balance if it is about $0
										if ( class_exists( 'EDD_Wallet' ) ) :
											$wallet_value = edd_wallet()->wallet->balance( $current_user->ID );
											if ( $wallet_value > 0 ) :
												$balance = edd_currency_filter( edd_format_amount( $wallet_value ) );
												echo '<div class="edd-account-info"><span class="account-info-label">Wallet:</span><span class="edd-wallet-value">' . $balance . '</span></div>';
											endif;
										endif;
									?>
								</div>
							</div>

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

							<ul class="nav nav-tabs nav-append-content<?php echo $is_affiliate; ?>">

								<!-- Purchases -->
								<li class="active"><a href="#purchases" data-toggle="tab"><i class="fa fa-usd" aria-hidden="true"></i>Purchases</a></li>

								<!-- License keys -->
								<?php $has_expired_licenses = ! empty( $license_keys ) ? ' class="account-tab-highlight"' : ''; ?>
								<li><a href="#license-keys" data-toggle="tab"<?php echo $has_expired_licenses; ?>><i class="fa fa-key" aria-hidden="true"></i>License Keys</a></li>

								<!-- All Access -->
								<?php if ( eddwp_aa_is_activated() ) { ?>
								<li><a href="#all-access" data-toggle="tab"><i class="fa fa-gift" aria-hidden="true"></i>All Access Passes</a></li>
								<?php } ?>

								<!-- Subscriptions -->
								<?php if ( eddwp_recurring_is_activated() ) { ?>
								<?php $payment_info_update = ! empty( $failing_subs ) ? ' class="account-tab-highlight"' : ''; ?>
								<li><a href="#subscriptions" data-toggle="tab"<?php echo $payment_info_update; ?>><i class="fa fa-repeat" aria-hidden="true"></i>Subscriptions</a></li>
								<?php } ?>

								<!-- Downloads -->
								<li><a href="#downloads" data-toggle="tab"><i class="fa fa-cloud-download" aria-hidden="true"></i>Downloads</a></li>

								<!-- Profile -->
								<li><a href="#profile" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>

								<!-- Stripe payment methods -->
								<?php
								if ( function_exists( 'edd_stripe_get_existing_cards' ) ) {
									$existing_cards = edd_stripe_get_existing_cards( get_current_user_id() );
								}
								?>
								<?php if ( ! empty( $existing_cards ) ) { ?>
									<li><a href="#payment-methods" data-toggle="tab"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>Payment Methods</a></li>
								<?php } ?>

								<!-- Commissions -->
								<?php if ( defined( 'EDD_COMMISSIONS_VERSION' ) && eddc_user_has_commissions() ) { ?>
									<li><a href="#commissions" data-toggle="tab"><i class="fa fa-money" aria-hidden="true"></i>Commissions</a></li>
								<?php } ?>

								<!-- Support subscription -->
								<li><a href="#support" data-toggle="tab"><i class="fa fa-wrench" aria-hidden="true"></i>Support Subscription</a></li>
							</ul>
							<?php if ( ! empty( $is_affiliate ) ) { ?>
								<ul class="affiliates-list">
									<li><a class="affiliates-tab" href="<?php echo home_url( '/your-account/affiliate-area/' ); ?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Affiliates</a></li>
								</ul>
							<?php } ?>
						</div>

						<div class="my-account-tab-content">
							<div class="tab-content">

								<!-- Purchases -->
								<div class="tab-pane active purchases-tab-pane" id="purchases">
									<h3>Your purchase history</h3>
									<p>All purchases below were completed with the following email address: <strong><?php echo $current_user->user_email; ?></strong>. If you have trouble locating purchases, please <a href="<?php echo home_url( 'support' ); ?>">contact support</a> for assistance.</p>
									<?php
									if ( isset( $_GET['payment_id'] ) && is_numeric( $_GET['payment_id'] ) ) {
										echo apply_filters( 'the_content', do_shortcode( '[purchase_history]' ) );
									} else {
										echo do_shortcode( '[purchase_history]' );
									}
									?>
								</div>

								<!-- License keys -->
								<div class="tab-pane license-keys-tab-pane" id="license-keys">
									<h3>Manage your license keys</h3>
									<?php if ( class_exists( 'edd_software_licensing' ) && edd_software_licensing()->get_license_keys_of_user() ) { ?>
										<p>Below you will find all license keys for you previous purchases. Use the <strong>Manage Sites</strong> links to authorize specific URLs for your license keys. Use the <strong>Extend License</strong> or <strong>Renew License</strong> links to adjust the terms of your license keys.</p>
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
																<span class="licensed-product-title"><?php echo $the_title; ?></span>
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
													$license_keys  = get_posts( $license_args );
													?>
												</div>
											</div>
										<?php } ?>
										<?php if ( class_exists( 'edd_software_licensing' ) && false != edd_software_licensing()->get_license_keys_of_user() ) {
											$no_expired  = empty( $license_keys ) ? ' no-expired' : '';
											$two_or_less = $expired_qty <= 2 ? ' two-or-less' : '';
											?>
											<div class="renew-all-licenses<?php echo $no_expired, $two_or_less; ?>">
												<?php if ( ! empty( $license_keys ) ) { ?>
													<p>You may also renew license keys in bulk using the form below.</p>
												<?php } else { ?>
													<h4 class="section-title-alt"><i class="fa fa-thumbs-up"></i>You do not have any expired license keys</h4>
													<p>If you would like to renew all of your licenses now, you may do so using the form below.</p>
												<?php } ?>
												<?php
												if ( class_exists( 'EDD_SL_Renew_All' ) ) {
													echo $edd_sl_renew_all->renew_all_button();
												}
												?>
											</div>
										<?php } ?>
										<?php echo do_shortcode( '[edd_license_keys]' ); ?>
									<?php } else { ?>
										<p>You currently have no licenses.</p>
									<?php } ?>
								</div>

								<!-- All Access -->
								<?php if ( eddwp_aa_is_activated() ) { ?>
								<div class="tab-pane all-access-tab-pane" id="all-access">
									<?php
										$aa_customer = new EDD_Customer( get_current_user_id(), true );
										$user_has_access_pass = $aa_customer->get_meta( 'all_access_passes' );
										if ( $user_has_access_pass ) {
											echo do_shortcode( '[edd_aa_customer_passes]' );
											?>
											<a class="edd-submit button blue" href="<?php echo home_url( '/your-account/all-access-downloads/' ); ?>"><i class="fa fa-gift"></i>Access your downloads</a>
											<?php
										} else {
											?>
											<div class="no-all-access-account-wrap">
												<h3>Oops! It looks like you don't have access... yet.</h3>
												<p>Perhaps you haven't seen our <em>best</em> deal on Easy Digital Downloads extensions. With a single subscription, you can gain access to every single extension we sell, as well as all future extensions. It's that simple.</p>
												<h3>All extensions. Unlimited sites. No hassle.</h3>
												<p>No more managing multiple extension licenses or trying to decide which extension is the best investment for you or your client. Having access to every extension not only allows you to make better business decisions, but you'll also have the luxury of using a single master license key for every extension.</p>
												<p>Intrigued? Great! Take some time to learn more about <a href="<?php echo get_permalink( $aap->ID ) ?>"><?php echo get_the_title( $aap->ID ); ?></a>. If you've already heard enough, click the button below to gain access now and start downloading extensions within minutes.</p>
												<?php echo edd_get_purchase_link( array( 'download_id' => $aap->ID, 'direct' => true, 'text' => 'Give me access!' ) ); ?>
											</div>
											<?php
										}
									?>
								</div>
								<?php } ?>

								<!-- Subscriptions -->
								<div class="tab-pane subscriptions-tab-pane" id="subscriptions">
									<h3>Manage your subscriptions</h3>
									<p>Use the tools below to view subscription details, manage all of your product subscriptions, and view invoices.</p>
									<?php echo do_shortcode( '[edd_subscriptions]' ); ?>
								</div>

								<!-- Downloads -->
								<div class="tab-pane downloads-tab-pane" id="downloads">
									<h3>Your download history</h3>
									<p>Below you will find a complete history of your file downloads.</p>
									<?php echo do_shortcode( '[download_history]' ); ?>
								</div>

								<!-- Profile -->
								<div class="tab-pane profile-editor-tab-pane" id="profile">
									<h3>Edit your profile information</h3>
									<p>Use the form below to edit the information saved in your user profile. Select information will be used to auto-complete the checkout form for your next purchase.</p>
									<?php edd_get_template_part( 'shortcode', 'profile-editor' ); ?>
								</div>

								<!-- Stripe payment methods -->
								<?php if ( ! empty( $existing_cards ) ) { ?>
									<div class="tab-pane payment-methods-tab-pane" id="payment-methods">
										<h3>Your saved payment methods</h3>
										<p>Manage your saved cards using the tools below. Edit, delete, or set cards as default for use when making purchases.</p>
										<?php if ( function_exists( 'edd_stripe_manage_cards' ) ) { edd_stripe_manage_cards(); } ?>
									</div>
								<?php } ?>

								<!-- Commissions -->
								<div class="tab-pane commissions-tab-pane" id="commissions">
									<h3>Commissions overview</h3>
									<?php if( function_exists( 'eddc_user_commissions_overview' ) ) { echo eddc_user_commissions_overview(); } ?>
									<?php //if( function_exists( 'eddc_user_commissions_graph' ) ) { echo eddc_user_commissions_graph(); } ?>
									<h3>Detailed Commissions Information</h3>
									<p>The information below is a more detailed overview of your commissions data. </p>
									<?php
										if( function_exists( 'eddc_user_product_list' ) ) { echo eddc_user_product_list(); }
										if( function_exists( 'eddc_user_commissions' ) ) { echo eddc_user_commissions(); }
									?>
								</div>

								<!-- Support subscription -->
								<div class="tab-pane support-subscription-tab-pane" id="support">
									<h3>Your support subscription</h3>
									<p>See the details of your support subscription below.</p>
									<?php
										echo do_shortcode( '[subscription_details]' );
										echo do_shortcode( '[card_details]' );
									?>
								</div>
							</div>
						</div>

					</div>
				<?php } // End if check on if doing action or normal view ?>
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
					<?php eddwp_login_form(); ?>
				</article>
			</section>
		</div>
	</div>
	<?php

endif;

get_footer();
