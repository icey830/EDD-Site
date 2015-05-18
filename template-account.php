<?php
/* Template Name: My Account */

/**
 * The template displaying the "My Account" page
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
global $rcp_load_css, $rcp_load_scripts;
$rcp_load_css = $rcp_load_scripts = true;

get_header();

if ( is_user_logged_in() ) { ?>

	<section id="account-page" class="main clearfix">
		<div class="container clearfix">

			<?php while ( have_posts() ) { the_post(); ?>
			<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
				<h1>My Account</h1>
			</article><!-- /#post-<?php echo get_the_ID(); ?> -->
			<?php } ?>

			<ul class="nav nav-tabs nav-append-content">
				<li class="active"><a href="#tab1" data-toggle="tab">Purchases</a></li>
				<li><a href="#downloads-tab" data-toggle="tab">Downloads</a></li>
				<li><a href="#tab2" data-toggle="tab">Profile</a></li>
				<?php if ( eddc_user_has_commissions() ) { ?>
				<li><a href="#tab3" data-toggle="tab">Commissions</a></li>
				<?php } // end if ?>
				<li><a href="#tab5" data-toggle="tab">Support Subscription</a></li>
			</ul><!-- /.nav-tabs -->

			<div class="tab-content">

				<div class="tab-pane active purchases-tab-pane" id="tab1">
					<?php echo apply_filters( 'the_content', do_shortcode( '[purchase_history]' ) ); ?>
				</div><!-- /.tab-pane -->

				<div class="tab-pane downloads-tab-pane" id="downloads-tab">
					<?php echo apply_filters( 'the_content', do_shortcode( '[download_history]' ) ); ?>
				</div><!-- /.tab-pane -->


				<div class="tab-pane profile-editor-tab-pane" id="tab2">
					<?php edd_get_template_part( 'shortcode', 'profile-editor' ); ?>
				</div><!-- /.tab-pane -->

				<div class="tab-pane commissions-tab-pane" id="tab3">
					<h3>Next Payout</h3>
					<p id="next-payout"><?php if( function_exists( 'eddc_get_upcoming_commissions' ) ) { echo eddc_get_upcoming_commissions(); } ?></p>
					<?php if( function_exists( 'eddc_user_product_list' ) ) { echo eddc_user_product_list(); } ?>
					<?php if( function_exists( 'eddc_user_commissions' ) ) { echo eddc_user_commissions(); } ?>
				</div><!-- /.tab-pane -->

				<div class="tab-pane support-subscription-tab-pane" id="tab5">

					<?php
					echo do_shortcode( '[subscription_details]' );
					echo do_shortcode( '[card_details]' );
					?>
				</div><!-- /.tab-pane -->

				<div class="tab-pane download-history-tab-pane" id="tab6">
					<?php
					echo do_shortcode( '[download_history]' );
					?>
				</div><!-- /.tab-pane -->

			</div><!-- /.tab-content -->
		</div><!-- /.container -->
	</section><!-- /.main -->
	<?php
		
} else { ?>

	<section id="landing-page" class="landing main clearfix">
		<article class="content clearfix">
			<h1>You must be logged-in to access your account information.</h1>
			<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
				<fieldset>
					<div class="row">
						<input type="text" placeholder="Username" id="user_login" size="20" value="" name="log" />
					</div><!-- /.row -->

					<div class="row">
						<input type="password" placeholder="Password" id="user_pass" size="20" value="" name="pwd" />
					</div><!-- /.row -->
				</fieldset>

				<div class="row clearfix">
					<input type="checkbox" name="rememberme" id="rememberme" value="forever" checked="checked" />
					<label for="rememberme">Remember my password</label>
					<input type="submit" name="wp-submit" value="Sign In" />
					<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
				</div>
			</form><!-- /#loginform -->
		</article>
	</section>
	<?php

} // end if

get_footer();
