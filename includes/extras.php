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
	$output_demo_link = sprintf( '<p class="edd-demo-link"><a class="edd-submit button blue" href="%s">View Demo</a></p>', $get_demo_link );

	// add the link to demo below the content
	echo $output_demo_link;
}
add_filter( 'edd_after_download_content', 'eddwp_demo_link', 9, 1 );


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
 * Add Security Info to the Checkout
 */
function eddwp_add_security_info() {
	?>
	<a href="https://www.PositiveSSL.com" id="ssl-seal" title="SSL Certificate Authority" style="font-family: arial; font-size: 10px; text-decoration: none;"><img src="https://www.positivessl.com/images/seals/PositiveSSL_tl_trans.gif" alt="SSL Certificate Authority" title="SSL Certificate Authority" border="0"><br>SSL Certificate Authority</a>
	<?php
}
add_action( 'edd_after_cc_expiration', 'eddwp_add_security_info' );


/**
 * Shows the final purchase total at the bottom of the checkout page
 */
remove_action( 'edd_purchase_form_before_submit', 'edd_checkout_final_total', 999 );
remove_action( 'edd_purchase_form_after_cc_form', 'edd_checkout_submit', 9999 );


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
 * Renders the Checkout Submit section
 *
 * @since 1.3.3
 * @return void
 */
function eddwp_checkout_submit() {
?>
	<fieldset id="edd_purchase_submit">
		<?php do_action( 'edd_purchase_form_before_submit' ); ?>

		<?php edd_checkout_hidden_fields(); ?>

		<p id="edd_final_total_wrap">
			<strong><?php _e( 'Purchase Total:', 'edd' ); ?></strong>
			<span class="edd_cart_amount" data-subtotal="<?php echo edd_get_cart_subtotal(); ?>" data-total="<?php echo edd_get_cart_subtotal(); ?>"><?php edd_cart_total(); ?></span>

			<?php echo edd_checkout_button_purchase(); ?>
		</p>

		<?php do_action( 'edd_purchase_form_after_submit' ); ?>

		<?php if ( edd_is_ajax_disabled() ) { ?>
			<p class="edd-cancel"><a href="javascript:history.go(-1)"><?php _e( 'Go back', 'edd' ); ?></a></p>
		<?php } ?>
	</fieldset>
<?php
}
add_action( 'edd_purchase_form_after_cc_form', 'eddwp_checkout_submit', 9999 );


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
 * Filter the admin reply links to remove extra &nbsp; add by bbPress
 */
function eddwp_get_reply_admin_links( $retval, $r, $args ) {
	$retval = str_replace("&nbsp;", '', $retval);
	echo trim($retval);
}
add_filter( 'bbp_get_reply_admin_links', 'eddwp_get_reply_admin_links', 10, 3 );


/**
 * Change the bbPress Login Widget if the user is logged in or out
 */
function eddwp_bbp_login_widget_title( $title, $instance, $id_base ) {
	if ( ! is_user_logged_in() ) {
		return $title;
	} else {
		return __( 'Logged in as', 'eddwp' );
	}
}
add_filter( 'bbp_login_widget_title', 'eddwp_bbp_login_widget_title', 10, 3 );


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

	if ( eddwp_edd_is_activated() ) {
		$cart_contents = edd_get_cart_contents();
		if ( empty( $cart_contents ) ) {
			$classes[] = 'edd-checkout-cart-empty';
		}
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
