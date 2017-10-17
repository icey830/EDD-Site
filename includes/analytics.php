<?php

/**
 * Fire specific GA events on certain page templates
 */
function edd_analytics_events() {
	global $post, $edd_options;
	$actions = array();

	if ( is_page() ) {
		$page_template = get_page_template_slug( get_queried_object_id() );

		// Setup Google Analtyics tracking
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
			<script>if (typeof __gaTracker !== 'undefined') {
					__gaTracker('send', {
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

/**
 * Add specific script tags on certain page templates
 */
function edd_page_header_scripts() {

	if ( is_page() ) {
		$page_template = get_page_template_slug( get_queried_object_id() );

		// Setup page specific scripts tracking
		switch ( $page_template ) {

			case 'page-templates/template-support.php':
				?>
				<!-- Hotjar Tracking Code for https://easydigitaldownloads.com -->
				<script>
					(function(h,o,t,j,a,r){
						h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
						h._hjSettings={hjid:593923,hjsv:5};
						a=o.getElementsByTagName('head')[0];
						r=o.createElement('script');r.async=1;
						r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
						a.appendChild(r);
					})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
				</script>
				<?php
				break;

		}


	}

}
add_action( 'wp_head', 'edd_page_header_scripts', 9999 );