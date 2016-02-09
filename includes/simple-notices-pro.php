<?php
/**
 * Custom modifications for simple notices pro plugin
 */


/**
 * Dequeue simple notices pro styling
 */
function eddwp_dequeue_style() {
	wp_dequeue_style( 'notifications' );
}
add_action( 'wp_enqueue_scripts', 'eddwp_dequeue_style' );


/**
 * Custom display notice function
 */
function eddwp_display_notice() {

	/// this displays the notification area if the user has not read it before
	global $user_ID;
	$notice_args = array('post_type' => 'notices', 'posts_per_page' => 1, 'meta_key' => '_enabled', 'meta_value' => '1');
	$notices = get_posts($notice_args);
	if($notices) :
		foreach ($notices as $notice) {

			$icon = strtolower(str_replace(' ', '_', get_post_meta($notice->ID, '_icon', true)));
			$logged_in_only = get_post_meta($notice->ID, '_notice_for_logged_in_only', true);

			$can_view = false;
			if( $logged_in_only == 'All' ) {
				$can_view = true;
			} else if( $logged_in_only == 'Logged In' && is_user_logged_in() ) {
				$can_view = true;
			} else if( $logged_in_only == 'Logged Out' && !is_user_logged_in() ) {
				$can_view = true;
			}

			if($can_view) {
				if(pippin_check_notice_is_read($notice->ID, $user_ID) != true) { ?>
					<div id="notification-area" class="snp-hidden">

							<div class="notice-content">

								<svg id="announcement" width="32px" height="32px">
								   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-announcement'; ?>"></use>
								</svg>

								<?php echo do_shortcode( wpautop( $notice->post_content ) ); ?>
							</div>

							<?php if(!get_post_meta($notice->ID, '_hide_close', true)) { ?>
							<a class="remove-notice" href="#" id="remove-notice" rel="<?php echo $notice->ID; ?>">
								<svg width="24px" height="24px">
								   <use xlink:href="<?php echo get_stylesheet_directory_uri() . '/images/svg-defs.svg#icon-remove'; ?>"></use>
								</svg>
							</a>

							<?php } ?>
					</div>
				<?php }
			}
		}
	endif;
}
remove_action( 'wp_footer', 'pippin_display_notice' );
add_action( 'eddwp_body_start', 'eddwp_display_notice' );