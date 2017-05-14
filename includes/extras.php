<?php
/**
 * miscellaneous theme functions
 */


/* ----------------------------------------------------------- *
 * Misc
 * ----------------------------------------------------------- */

/**
 * Check to see if EDD is activated
 */
function eddwp_edd_is_activated() {
	return class_exists( 'Easy_Digital_Downloads' );
}


/**
 * Check to see if we're on the checkout page
 */
function eddwp_is_checkout() {
	if ( class_exists( 'Easy_Digital_Downloads' ) && edd_is_checkout() ) {
		return true;
	}
}


/**
 * Separate regular comments from pings
 */
function eddwp_get_comments_only_count( $count ) {
	// Filter the comments count in the front-end only
	if( ! is_admin() ) {
		global $id;
		$status = get_comments('status=approve&post_id=' . absint( $id ) );
		$comments_by_type = separate_comments( $status );
		return count( $comments_by_type['comment'] );
	}

	// When in the WP-admin back end, do NOT filter comments (and pings) count.
	else {
		return $count;
	}
}


/* ----------------------------------------------------------- *
 * Custom Actions/Filters
 * ----------------------------------------------------------- */

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 */
function edd_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'edd' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'edd_wp_title', 10, 2 );


/**
 * Add the rewrite tag for the extensions search
 */
function eddwp_add_rewrite_tags() {
	add_rewrite_tag( '%download_s%', '([^/]+)' );
}
add_action( 'init', 'eddwp_add_rewrite_tags' );


/**
 * Load the correct template for extensions search
 */
function eddwp_extension_search_results() {
	if ( ! empty ( $_GET['download_s'] ) && isset( $_GET['action'] ) && 'download_search' === $_GET['action'] ) {
		load_template( dirname( __DIR__ ) . '/search-downloads-extensions.php' );
		die();
	}
}
add_action( 'template_redirect', 'eddwp_extension_search_results' );


/**
 * Remove the default purchase link that's appended after `the_content`
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );


/**
 * Removes styling from Better Click To Tweet plugin
 */
function eddwp_remove_bctt_styling() {
	remove_action( 'wp_enqueue_scripts', 'bctt_scripts' );
}
add_action( 'template_redirect', 'eddwp_remove_bctt_styling' );

/**
 * Remove card management from user profile editor
 */
remove_action( 'edd_profile_editor_after', 'edd_stripe_manage_cards' );


/**
 * Content formatter
 */
function eddwp_content_formatter( $content ) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= shortcode_unautop( wptexturize( wpautop( $piece ) ) );
		}
	}
	return $new_content;
}
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );
remove_filter( 'the_content', 'shortcode_unautop' );
add_filter( 'the_content', 'eddwp_content_formatter', 9 );


/**
 * Append demo button link to download products
 */
function eddwp_demo_link( $content ) {

	// bail if there is no demo link
	$get_demo_link = get_post_meta( get_the_ID(), 'ecpt_demolink', true );
	if( empty( $get_demo_link ) ) {
		return $content;
	}

	// build link to the demo
	$output_demo_link = sprintf( '<p class="edd-demo-link"><a class="edd-submit button blue" href="%s" target="_blank">View Demo</a></p>', $get_demo_link );

	// add the link to demo below the content
	echo $output_demo_link;
}
add_filter( 'edd_after_download_content', 'eddwp_demo_link', 8, 1 );


/**
 * Add payment gateway information on product page
 */
function eddwp_payment_gateway_terms( $content ) {

	// bail if it's not a gateway
	$is_gateway = has_term( 'gateways', 'download_category' );
	if ( ! $is_gateway ) {
		return $content;
	}

	ob_start();

	// output gateway features
	$features = get_the_terms( get_the_ID(), 'gateway_features' );
	if ( ! empty( $features ) && ! is_wp_error( $features ) ) {
		$the_features = array();
		foreach ( $features as $feature ) {
			$the_features[] = $feature->name;
		}
		$gateway_features = join( ', ', $the_features );
		echo '<h4>Features</h4><p class="gateway-terms">' . $gateway_features . '</p>';
	}

	// output gateway currencies
	$currencies = get_the_terms( get_the_ID(), 'gateway_currencies' );
	if ( ! empty( $currencies ) && ! is_wp_error( $currencies ) ) {
		$the_currencies = array();
		foreach ( $currencies as $currency ) {
			$the_currencies[] = $currency->name;
		}
		$gateway_currencies = join( ', ', $the_currencies );
		echo '<h4>Currencies</h4><p class="gateway-terms">' . $gateway_currencies . '</p>';
	}

	// output gateway countries
	$countries = get_the_terms( get_the_ID(), 'gateway_countries' );
	if ( ! empty( $countries ) && ! is_wp_error( $countries ) ) {
		$the_features = array();
		foreach ( $countries as $country ) {
			$the_countries[] = $country->name;
		}
		$gateway_countries = join( ', ', $the_countries );
		echo '<h4>Countries</h4><p class="gateway-terms">' . $gateway_countries . '</p>';
	}

	echo '<p class="updated-gateway-info">The countries and currencies shown here may not reflect the most up-to-date supported lists of the merchant processor.</p>';

	$all_terms = ob_get_clean();
	$all_gateways = sprintf(
		'<p class="view-all-gateways"><a href="%s">View full list of available gateways</a></p>',
		home_url( '/downloads/category/gateways/' )
	);
	echo do_shortcode( '[toggle title="Supported features, currencies, and countries"]' . $all_terms . $all_gateways . '[/toggle]' );
}
add_filter( 'edd_after_download_content', 'eddwp_payment_gateway_terms', 9, 1 );


/**
 * Site-wide expired license notice
 */
function eddwp_user_has_expired_license() {

	$license_keys = array();

	if ( class_exists( 'edd_software_licensing' ) && is_user_logged_in() ) {

		// check for expired licenses
		$license_args = array(
			'posts_per_page' => -1,
			'post_type' => 'edd_license',
			'post_status' => 'any',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => '_edd_sl_user_id',
					'value' => get_current_user_id(),
					'compare' => '='
				),
				array(
					'relation' => 'OR',
					array(
						'key' => '_edd_sl_status',
						'value' => 'expired',
						'compare' => '='
					),
					array(
						'key' => '_edd_sl_expiration',
						'value' => time(),
						'compare' => '<'
					)
				),
			),
		);
		$license_keys = get_posts($license_args);
	}

	return $license_keys;
}

/**
 * Site-wide subscription payment method update notice
 */
function eddwp_user_must_update_payment_info() {

	$failing_subs = array();

	if ( class_exists( 'EDD_Recurring' ) && is_user_logged_in() ) {
		$subscriber = new EDD_Recurring_Subscriber( get_current_user_id(), true );
		$failing_subs = $subscriber->get_subscriptions( 0, 'failing' );
	}

	return $failing_subs;
}


/**
 * Adjust subscription payment info update URL to target subscriptions tab
 */
function eddwp_add_fragment( $url, $sub_obj ) {
	$url .= '#tab-subscriptions';
	return $url;
}
add_filter( 'edd_subscription_update_url', 'eddwp_add_fragment', 99, 2 );


/**
 * Append the changelog to the download content
 */
function eddwp_product_changelog( $content ) {
	global $post;

	// make sure we're on a download
	if ( 'download' === $post->post_type ) {
		$post_type = true;
	} else {
		$post_type = false;
	}

	// see of the download has a category of "bundles"
	if ( has_term( 'bundles', 'download_category', get_the_ID() ) ) {
		$bundles = true;
	} else {
		$bundles = false;
	}

	// If not a download, or has download category of "bundles," bail.
	if ( ! $post_type || $bundles ) {
		return $content;
	}

	return $content;
}
add_filter( 'the_content', 'eddwp_product_changelog' );


/**
 * Override the default image quality and make sure when images are uploaded that
 * the quality doesn't get degraded.
 */
function edd_image_full_quality( $quality ) {
	return 100;
}
add_filter( 'jpeg_quality', 'edd_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'edd_image_full_quality' );


/**
 * Place checkout login form behind a toggle link
 */
function eddwp_checkout_login_toggle() {
	$show_login_form = edd_get_option( 'show_register_form', 'none' ) ;
	if ( !is_user_logged_in() && ( 'login' === $show_login_form || 'both' === $show_login_form ) ) {
		?>
		<div class="edd-show-login-wrap">
			<p id="edd-show-login">
				<span class="edd-checkout-login-title">Do you already have an account?</span>
				<span class="edd-checkout-login-toggle"><a href="#" class="edd-checkout-show-login-form">Click to log in</a></span>
			</p>
		</div>
		<?php
	}
}
add_action( 'edd_checkout_form_top', 'eddwp_checkout_login_toggle', 1 );
remove_action( 'edd_purchase_form_login_fields', 'edd_get_login_fields' );
add_action( 'edd_checkout_form_top', 'edd_get_login_fields', 2 );


/**
 * Add Security Info to the Checkout
 */
function eddwp_add_security_info() {
	?>
	<a href="https://www.PositiveSSL.com" id="ssl-seal" title="SSL Certificate Authority" style="font-family: arial; font-size: 10px; text-decoration: none;"><img src="https://www.positivessl.com/images/seals/PositiveSSL_tl_trans.gif" alt="SSL Certificate Authority" title="SSL Certificate Authority" border="0"><br>SSL Certificate Authority</a>
	<?php
}
add_action( 'edd_after_cc_expiration', 'eddwp_add_security_info' );


/**
 * Add heading to checkout form submit button
 */
function eddwp_complete_purchase_heading() {
	?>
	<h3 class="complete-purchase-title">Complete Purchase</h3>
	<?php
}
add_action( 'edd_purchase_form_before_submit', 'eddwp_complete_purchase_heading', 1 );


/**
 * Adds all Downloads to the Extension drop down in the new ticket form
 *
 */
function edd_wp_gravity_form_download_options( $form ) {

	foreach ( $form['fields'] as &$field ) {

		if ( $field->type != 'select' || strpos( $field->cssClass, 'extension-list' ) === false ) {
			continue;
		}

		$downloads = get_posts( array( 'posts_per_page' => -1, 'post_type' => 'download', 'orderby' => 'post_title', 'order' => 'ASC' ) );

		$choices = array();

		foreach ( $downloads as $download ) {
			$choices[] = array( 'text' => $download->post_title, 'value' => $download->post_title );
		}

		// update 'Select a Post' to whatever you'd like the instructive option to be
		$field->placeholder = 'Select extension';
		$field->choices = $choices;

	}

	return $form;
}
add_filter( 'gform_pre_render_11', 'edd_wp_gravity_form_download_options' );
add_filter( 'gform_pre_validation_11', 'edd_wp_gravity_form_download_options' );
add_filter( 'gform_pre_submission_filter_11', 'edd_wp_gravity_form_download_options' );
add_filter( 'gform_admin_pre_render_11', 'edd_wp_gravity_form_download_options' );
add_filter( 'gform_pre_render_16', 'edd_wp_gravity_form_download_options' );
add_filter( 'gform_pre_validation_16', 'edd_wp_gravity_form_download_options' );
add_filter( 'gform_pre_submission_filter_16', 'edd_wp_gravity_form_download_options' );
add_filter( 'gform_admin_pre_render_16', 'edd_wp_gravity_form_download_options' );


/**
 * Facebook tracking pixel
 */
function eddwp_facebook_conversion_pixel() {
	if ( function_exists( 'edd_is_success_page' ) && ! edd_is_success_page() ) {
		return;
	}
	if ( function_exists( 'edd_get_purchase_session' ) && ! edd_get_purchase_session() ) {
		return;
	}

	$payment_id = edd_get_purchase_id_by_key( $session['purchase_key'] );
	$total = edd_get_payment_amount( $payment_id );
?>
<!-- Facebook Conversion Code for EDD Checkout Success -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
	var fbds = document.createElement('script');
	fbds.async = true;
	fbds.src = '//connect.facebook.net/en_US/fbds.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(fbds, s);
	_fbq.loaded = true;
  }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6023481255100', {'value':'<?php echo $total; ?>','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6023481255100&amp;cd[value]=<?php echo $total; ?>&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
<?php
}
add_action( 'wp_footer', 'eddwp_facebook_conversion_pixel' );


/**
 * Get ID of Gravity Forms newsletter form
 */
function eddwp_newsletter_form_id() {
	if ( ! class_exists( 'RGFormsModel' ) ) {
		return;
	}
	return RGFormsModel::get_form_id( 'Newsletter Subscribe' );
}


/**
 * Filter the submit button on the dedicated subscription form (Gravity Forms)
 */
function eddwp_newsletter_form_submit_button( $content ) {
	if ( function_exists( 'mailchimp_subscriber_count' ) && mailchimp_subscriber_count()->subscriber_count() ) {
		$count = mailchimp_subscriber_count()->subscriber_count();
		$button_text = 'Join ' . $count . ' subscribers!';
		$content = str_replace( 'Sign me up!', $button_text, $content );
		return $content;
	} else {
		return $content;
	}
}
add_filter( 'gform_submit_button_' . eddwp_newsletter_form_id(), 'eddwp_newsletter_form_submit_button' );


/**
 * Prevent newsletter form from jumping to anchor when submitted
 *
 * thanks, Andrew
 */
add_filter( 'gform_confirmation_anchor_' . eddwp_newsletter_form_id(), '__return_false' );


/**
 * remove Gravity Forms validation message on newsletter form
 *
 * thanks, Andrew
 */
function eddwp_newsletter_form_validation_message( $validation_message, $form ) {
	return '<p class="newsletter-validation-error"><i class="fa fa-exclamation-triangle"></i> Please enter your email address below.</p>';
}
add_filter( 'gform_validation_message_' . eddwp_newsletter_form_id(), 'eddwp_newsletter_form_validation_message', 10, 2 );


/**
 * Gravity Forms - change spinner
 *
 * thanks, Andrew
 */
function eddwp_newsletter_form_gform_ajax_spinner_url( $uri, $form ) {
	return get_stylesheet_directory_uri() . '/assets/svgs/loading.svg';
}
add_filter( 'gform_ajax_spinner_url', 'eddwp_newsletter_form_gform_ajax_spinner_url', 10, 2 );


/**
 * Limit 'Gravity Forms - Multiple Forms Instances' to only where it's needed
 * Watch for real fixes: https://github.com/tyxla/Gravity-Forms-Multiple-Form-Instances
 */
function eddwp_selective_gf_multiple_instances() {
	if ( ! is_single() ) { // only allow plugin to run on single posts
		global $gravity_forms_multiple_form_instances;
		remove_filter( 'gform_get_form_filter', array( $gravity_forms_multiple_form_instances, 'gform_get_form_filter' ), 10, 2 );
	}
}
add_action( 'wp', 'eddwp_selective_gf_multiple_instances' );


/**
 * Adds custom body classes based on the page the user is browsing.
 */
function eddwp_body_class( $classes ) {
	global $post;

	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	if ( preg_match( '/Firefox/i', $user_agent ) ) {
		$classes[] = 'firefox';
	}

	if ( isset( $_GET['download_s'] ) ) {
		$classes[] = 'download-search';
	}

	if ( ( is_single() && 'post' == get_post_type( $post->ID ) ) || is_search() ) {
		$classes[] = 'blog';
	}

	if ( is_page( 'your-account' ) && ! is_user_logged_in() ) {
		$classes[] = 'login';
	}

	if ( is_category() || is_tag() || is_author() || is_day() || is_month() || is_year() ) {
		$classes[] = 'blog';
	}

	if ( is_home() ) {
		$classes[] = 'blog-home';
	}

	if ( is_page_template( 'page-templates/template-support.php' ) ) {
		$classes[] = 'template-support';
	}

	if ( is_page_template( 'page-templates/template-themes-archive.php' ) ) {
		$classes[] = 'template-themes';
	}

	if ( is_page_template( 'page-templates/template-site-showcase.php' ) ) {
		$classes[] = 'template-site-showcase';
	}

	if ( is_page_template( 'page-templates/template-starter-package.php' ) ) {
		$classes[] = 'template-starter-package';
	}

	if ( is_page_template( 'page-templates/template-account.php' ) ) {
		$classes[] = 'template-account';
	}

	if ( is_page_template( 'page-templates/template-download-directory.php' ) ) {
		$classes[] = 'template-product-info';
	}

	if ( is_page_template( 'page-templates/template-subscribe.php' ) ) {
		$classes[] = 'template-subscribe';
	}

	if ( is_page_template( 'page-templates/template-barebones.php' ) ) {
		$classes[] = 'template-barebones';
	}

	if ( eddwp_edd_is_activated() ) {
		$cart_contents = edd_get_cart_contents();
		if ( empty( $cart_contents ) ) {
			$classes[] = 'edd-checkout-cart-empty';
		}
	}

	if ( ! empty( eddwp_user_has_expired_license() ) ) {
		$classes[] = 'edd-sl-user-has-expired-license';
	}

	if ( ! empty( eddwp_user_must_update_payment_info() ) ) {
		$classes[] = 'edd-user-must-update-payment-info';
	}

	if ( eddwp_theme_sale_notice_active() ) {
		$classes[] = 'eddwp-notice-is-sale';
	}

	return $classes;
}
add_filter( 'body_class', 'eddwp_body_class' );


/**
 * Add second bio Textarea to user profile page for The Crew page
 */
/**
 * Show custom user profile fields
 * @param  obj $user The user object.
 * @return void
 */
function eddwp_crew_enhanced_bio( $user ) {
	$user_id =  ! empty( $user->ID ) ? $user->ID : 0;
?>
<table class="form-table">
	<tr>
		<th>
			<label for="edd-bio">EDD Crew Bio</label>
		</th>
		<td>
			<textarea rows="5" name="enhanced_bio" id="enhanced_bio" class="regular-text" ><?php echo esc_attr( get_the_author_meta( 'enhanced_bio', $user_id ) ); ?></textarea><br />
			<span class="description">This enhanced bio appears on the EDD Crew page. This is <em>not</em> your single blog post footer.</span>
		</td>
	</tr>
</table>
<?php
}
add_action( 'show_user_profile', 'eddwp_crew_enhanced_bio' );
add_action( 'edit_user_profile', 'eddwp_crew_enhanced_bio' );

add_action( 'personal_options_update', 'save_crew_enhanced_bio' );
add_action( 'edit_user_profile_update', 'save_crew_enhanced_bio' );

function save_crew_enhanced_bio( $user_id ) {
	update_user_meta( $user_id, 'enhanced_bio', esc_textarea( $_POST['enhanced_bio'] ) );
}


/**
 * AffiliateWP - notice before registration form
 */
function eddwp_affwp_login_link() {
	echo '<p>Already an affiliate? <a href="#affwp-login-form">Log into your account</a>.</p>';
}
add_action( 'affwp_affiliate_register_form_top', 'eddwp_affwp_login_link' );


/**
 * AffiliateWP - text before creatives
 */
function eddwp_affwp_creatives_description() {
	echo '<p>Use the graphics below to promote Easy Digital Downloads on your website.</p>';
}
add_action( 'affwp_before_creatives', 'eddwp_affwp_creatives_description' );


/**
 * affiliate related redirects
 */
function eddwp_affiliate_redirects() {

	if ( function_exists( 'affwp_is_affiliate' ) ) {

		// from the affiliate area,  redirect non-affiliate registered users to affiliates page
		if ( is_user_logged_in() && ! affwp_is_affiliate() ) {

			if ( is_page( 'your-account/affiliate-area' ) ) {
				wp_redirect( site_url( 'affiliates' ) );
				exit;
			}
		}

		// from affiliates page, redirect logged in affiliates to the affiliate area
		if ( is_user_logged_in() && affwp_is_affiliate() && affwp_is_active_affiliate() ) {

			if ( is_page( 'affiliates' ) ) {
				wp_redirect( site_url( 'your-account/affiliate-area' ) );
				exit;
			}
		}
	}
}
add_action( 'template_redirect', 'eddwp_affiliate_redirects' );


/**
 * used in template-free-downloads-upsell.php to get the downloads
 * from the customer's last two purchases
 */
function eddwp_alter_purchased_products_payment_count( $count ) {
	return 2;
}


/**
 * show 3 recommendations per product on Free Downloads Thanks page
 */
function eddwp_rp_results_count( $number ) {
	if ( is_page( array( 'free-download-thanks', 'purchase-confirmation' ) ) ) {
		$number = 3;
	}
	return $number;
}
add_filter( 'edd_rp_single_recommendation_count', 'eddwp_rp_results_count' );


/**
 * adjust Recommended Products thumbnail size on Free Downloads Thanks page
 */
function eddwp_rp_thumbnail_size( $size ) {
	if ( is_page( array( 'free-download-thanks', 'purchase-confirmation' ) ) ) {
		$size = array( 540,270 );
	}
	return $size;
}
add_filter( 'edd_checkout_image_size', 'eddwp_rp_thumbnail_size' );


/**
 * add short description to Recommended Products output on Free Downloads Thanks page
 */
function eddwp_rp_move_title() {
	if ( is_page( array( 'free-download-thanks', 'purchase-confirmation' ) ) ) {
		?>
		<div class="edd-rp-item-title-wrap">
			<?php the_title( '<a href="' . get_permalink() . '" class="edd-rp-item-title-alt">', '</a>' ); ?>
		</div>
		<?php
	}
}
add_action( 'edd_rp_item_after_thumbnail', 'eddwp_rp_move_title', 10 );


/**
 * move Recommended Products title location on Free Downloads Thanks page
 */
function eddwp_rp_add_short_description() {
	if ( is_page( array( 'free-download-thanks', 'purchase-confirmation' ) ) ) {
		?>
		<div class="rp-short-description">
			<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
		</div>
		<?php
	}
}
add_action( 'edd_rp_item_after_thumbnail', 'eddwp_rp_add_short_description', 20 );


/**
 * adjust Recommended Products purchase link text on Free Downloads Thanks page
 */
function eddwp_rp_purchase_link_text( $purchase_link_args ) {
	if ( is_page( array( 'free-download-thanks', 'purchase-confirmation' ) ) || is_single( 'download' ) ) {
		$new_args = array(
			'text' => 'Add to Cart'
		);
		$purchase_link_args = array_merge( $new_args, $purchase_link_args );
		return $purchase_link_args;
	}
}
add_filter( 'edd_rp_purchase_link_args', 'eddwp_rp_purchase_link_text' );


/**
 * wrap embedded videos in HTML for styling
 */
function eddwp_video_embed_wrapper( $html ) {
	return '<div class="edd-embedded-video-wrapper">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'eddwp_video_embed_wrapper', 10, 3 );
add_filter( 'video_embed_html', 'eddwp_video_embed_wrapper' ); // Jetpack


/*
 * Ouput Perfect Audience conversion tracking script
 */
function eddwp_perfect_audience_tracking() {
?>
<script type="text/javascript">
  (function() {
    window._pa = window._pa || {};
    <?php if( $session = edd_get_purchase_session() ) : $payment_id = edd_get_purchase_id_by_key( $session['purchase_key'] ); ?>
    _pa.orderId = "<?php echo $payment_id; ?>";
    _pa.revenue = "<?php echo edd_get_payment_amount( $payment_id ); ?>";
    <?php endif; ?>
    var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
    pa.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + "//tag.marinsm.com/serve/59022fbfb8627951df0000a1.js";
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(pa, s);
  })();
</script>
<?php
}
add_action( 'wp_footer', 'eddwp_perfect_audience_tracking' );
