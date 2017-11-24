<?php
/**
 * This template is used to display the login form with [edd_login]
 */
global $edd_login_redirect;

if ( ! is_user_logged_in() ) :
	// Show any error messages after form submission
	edd_print_errors(); ?>
	<form id="edd_login_form" class="edd_form" action="" method="post">
		<fieldset>
			<legend><?php _e( 'Log into Your Account', 'easy-digital-downloads' ); ?></legend>
			<?php do_action( 'edd_login_fields_before' ); ?>
			<p class="edd-login-username">
				<input name="edd_user_login" id="edd_user_login" class="edd-required edd-input" type="text" placeholder="Username or Email"/>
			</p>
			<p class="edd-login-password">
				<input name="edd_user_pass" id="edd_user_pass" class="edd-password edd-required edd-input" type="password" placeholder="Password"/>
			</p>
			<p class="edd-login-remember">
				<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'easy-digital-downloads' ); ?></label>
			</p>
			<p class="edd-login-submit">
				<input type="hidden" name="edd_redirect" value="<?php echo esc_url( $edd_login_redirect ); ?>"/>
				<input type="hidden" name="edd_login_nonce" value="<?php echo wp_create_nonce( 'edd-login-nonce' ); ?>"/>
				<input type="hidden" name="edd_action" value="user_login"/>
				<input id="edd_login_submit" type="submit" class="edd_submit edd-submit" value="<?php _e( 'Sign In', 'easy-digital-downloads' ); ?>"/>
			</p>
			<p class="edd-lost-password">
				<a href="<?php echo wp_lostpassword_url(); ?>">
					<?php _e( 'Lost Password?', 'easy-digital-downloads' ); ?>
				</a>
			</p>
			<?php do_action( 'edd_login_fields_after' ); ?>
		</fieldset>
	</form>
<?php else : ?>
	<p class="edd-logged-in"><?php _e( 'You are already logged in', 'easy-digital-downloads' ); ?></p>
<?php endif; ?>