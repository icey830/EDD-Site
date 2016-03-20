<?php
/* Template Name: My Account
 *
 * "my account" page template
 */

global $rcp_load_css, $rcp_load_scripts, $current_user;
$rcp_load_css = $rcp_load_scripts = true;

get_header();

if ( is_user_logged_in() ) : ?>

	<div class="my-account-area page-section-white full-width">
		<div class="inner">
			<div class="my-account-content">
				<div id="account-page" class="clearfix">

					<div class="my-account-tabs">
						<div class="my-account-info">
							<span class="my-account-welcome">
								<?php
									echo '<h5>Welcome';
									echo $current_user->user_firstname ? ', ' . $current_user->user_firstname . '!</h5>' : ', ' . $current_user->user_login . '!</h5>';
									echo 'Use the links below to navigate your account information.';

									// get logged in user information
									get_currentuserinfo();

									// disply wallet balance if it is about $0
									$wallet_value = edd_wallet()->wallet->balance( $current_user->ID );
									if ( class_exists( 'EDD_Wallet' ) ) :
										if ( $wallet_value > 0 ) :
											echo '<span class="edd-wallet-container"> You currently have <span class="edd-wallet-value">' . edd_currency_filter( edd_format_amount( $wallet_value ) ) . '</span> in your account wallet.</span>';
										endif;
									endif;
								?>
							</span>
						</div>
						<ul class="nav nav-tabs nav-append-content">
							<li class="active"><a href="#license-keys-tab" data-toggle="tab"><i class="fa fa-key"></i>License Keys</a></li>
							<li><a href="#tab1" data-toggle="tab"><i class="fa fa-usd"></i>Purchases</a></li>
							<li><a href="#downloads-tab" data-toggle="tab"><i class="fa fa-cloud-download"></i>Downloads</a></li>
							<li><a href="#tab2" data-toggle="tab"><i class="fa fa-user"></i>Profile</a></li>
							<?php if ( eddc_user_has_commissions() ) { ?>
								<li><a href="#tab3" data-toggle="tab"><i class="fa fa-money"></i>Commissions</a></li>
							<?php } // end if ?>
							<li><a href="#tab5" data-toggle="tab"><i class="fa fa-wrench"></i>Support Subscription</a></li>
						</ul>
					</div>

					<div class="my-account-tab-content">
						<div class="tab-content">
							<div class="tab-pane active license-keys-tab-pane" id="license-keys-tab">
								<h3>Manage Your License Keys</h3>
								<p>Below you will find all license keys for you previous purchases. Use the <strong>Manage Sites</strong> links to authorize specific URLs for your license keys. Use the <strong>Extend License</strong> or <strong>Renew License</strong> links to adjust the terms of your license keys.</p>
								<?php echo do_shortcode( '[edd_license_keys]' ); ?>
							</div><!-- /.tab-pane -->
							<div class="tab-pane purchases-tab-pane" id="tab1">
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
					<h1 class="entry-title">You must be logged-in to access your account information.</h1>
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
