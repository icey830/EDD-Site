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

	$notice_args = array(
		'post_type'      => 'notices',
		'posts_per_page' => 1,
		'meta_key'       => '_enabled',
		'meta_value'     => '1',
	);
	$notices = get_posts( $notice_args );

	if ( $notices ) :
		foreach ( $notices as $notice ) {

			$icon = strtolower( str_replace(' ', '_', get_post_meta( $notice->ID, '_icon', true ) ) );
			$logged_in_only = get_post_meta( $notice->ID, '_notice_for_logged_in_only', true );

			$can_view = false;
			if ( $logged_in_only == 'All' ) {
				$can_view = true;
			} else if ( $logged_in_only == 'Logged In' && is_user_logged_in() ) {
				$can_view = true;
			} else if ( $logged_in_only == 'Logged Out' && !is_user_logged_in() ) {
				$can_view = true;
			}

			if ( $can_view ) {
				if ( pippin_check_notice_is_read( $notice->ID, $user_ID ) != true ) {
					?>
					<div id="notification-area" class="snp-hidden full-width">
						<div class="inner">

							<div class="notice-content clearfix">

								<?php
								$get_icon = get_post_meta( $notice->ID, 'ecpt_fa_icon', true );
								$the_icon = $get_icon ? $get_icon : 'bullhorn';
								?>
								<i class="fa fa-<?php echo $the_icon; ?>" aria-hidden="true"></i>

								<?php echo do_shortcode( wpautop( $notice->post_content ) ); ?>
							</div>

							<?php if ( ! get_post_meta( $notice->ID, '_hide_close', true ) ) { ?>
								<a class="remove-notice" href="#" id="remove-notice" rel="<?php echo $notice->ID; ?>" title="Dismiss notice">
									<i class="fa fa-times" aria-hidden="true"></i>
								</a>
							<?php } ?>

						</div>
					</div>
					<?php
				}
			}
		}
	endif;
}
remove_action( 'wp_footer', 'pippin_display_notice' );
add_action( 'eddwp_body_start', 'eddwp_display_notice' );