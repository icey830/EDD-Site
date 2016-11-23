<?php

/**
 * Fire specific GA events on certain page templates
 */
function edd_analytics_events() {
	global $post, $edd_options;
	$actions = array();

	if ( is_page() ) {
		$page_template = get_page_template_slug( get_queried_object_id() );
		switch ( $page_template ) {
			case 'page-templates/template-free-downloads-upsell.php':
				$actions[] = array(
					'type'     => 'event',
					'category' => 'ecommerce',
					'action'   => 'free_downloads',
					'label'    => 'Free Downloads Upsell',
				);
				break;
		}

		if ( (int) $post->ID === (int) $edd_options['success_page'] ) {
			$actions[] = array(
				'type'     => 'event',
				'category' => 'ecommerce',
				'action'   => isset( $_GET[ 'payment_key' ] ) ? 'view_receipt' : 'purchase_confirmation',
				'label'    => isset( $_GET[ 'payment_key' ] ) ? 'View Receipt' : 'Purchase Confirmation',
			);
		}

		foreach ( $actions as $action ) {
			?>
			<script>if (typeof ga !== 'undefined') {
					ga('send', {
						hitType      : "<?php echo $action['type']; ?>",
						eventCategory: "<?php echo $action['category']; ?>",
						eventAction  : "<?php echo $action['action']; ?>",
						eventLabel   : "<?php echo $action['label']; ?>",
					});
				}</script>
			<?php
		}

	}

}
add_action( 'wp_footer', 'edd_analytics_events', 9999 );