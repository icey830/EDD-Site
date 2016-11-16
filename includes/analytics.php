<?php

/**
 * Fire specific GA events on certain page templates
 */
function edd_analytics_events() {
	if ( is_page() ) {
		$page_template = get_page_template_slug( get_queried_object_id() );
		switch ( $page_template ) {
			case 'page-templates/template-free-downloads-upsell.php':
				?>
				<script>if (typeof ga !== 'undefined') {
						ga('send', {
							hitType      : 'event',
							eventCategory: 'ecommerce',
							eventAction  : 'free_downloads',
							eventLabel   : 'Free Downloads Upsell'
						});
					}</script>
				<?php
				break;
		}
	}
}
add_action( 'wp_footer', 'edd_analytics_events', 9999 );