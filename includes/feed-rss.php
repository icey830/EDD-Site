<?php
/**
 * EDD Feed & RSS functions
 */


/* ----------------------------------------------------------- *
 * Extensions Feed
 * ----------------------------------------------------------- */

/**
 * Register the feed
 */
function eddwp_register_extensions_feed() {
	add_feed( 'extensions', 'eddwp_extensions_feed' );
	add_feed( 'addons', 'eddwp_extensions_feed' );
}
add_action( 'init', 'eddwp_register_extensions_feed' );


/**
 * Initialise the feed when requested
 */
function eddwp_extensions_feed() {
	load_template( STYLESHEETPATH . '/extension-feed.php');
}
add_action( 'do_feed_extensions', 'eddwp_extensions_feed', 10, 1 );


/**
 * Initialise the feed when requested
 */
function eddwp_addons_feed() {
	load_template( STYLESHEETPATH . '/addons-feed.php');
}
add_action( 'do_feed_addons', 'eddwp_addons_feed', 10, 1 );


/**
 * Register the rewrite rule for the feed
 */
function eddwp_feed_rewrite( $wp_rewrite ) {
	$feed_rules = array(
		'feed/(.+)' => 'index.php?feed=' . $wp_rewrite->preg_index( 1 ),
		'(.+).xml'  => 'index.php?feed=' . $wp_rewrite->preg_index( 1 )
	);

	$wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}
add_filter( 'generate_rewrite_rules', 'eddwp_feed_rewrite' );


/**
 * Alter the WordPress Query for the feed
 */
function eddwp_feed_request($qv) {
	if ( isset( $qv['feed'] ) && 'extensions' == $qv['feed'] )
		$qv['post_type'] = 'download';

	if ( isset( $qv['feed'] ) && 'addons' == $qv['feed'] )
		$qv['post_type'] = 'download';

	return $qv;
}
add_filter( 'request', 'eddwp_feed_request' );


/**
 * Alter the WordPress Query for the feed
 */
function eddwp_feed_query( $query ) {
	if ( $query->is_feed && ( $query->query_vars['feed'] === 'extensions' || $query->query_vars['feed'] === 'addons' ) ) {

		$query->set( 'posts_per_page', 50 );

		if( isset( $_GET['display'] ) && 'new' === $_GET['display'] ) {

			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'download_category',
					'field'    => 'slug',
					'terms'    => '3rd-party',
					'operator' => 'NOT IN'
				)
			);

			$query->set( 'tax_query', $tax_query );
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'DESC' );

		} else {

			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'download_category',
					'field'    => 'slug',
					'terms'    => array( '3rd-party' ),
					'operator' => 'NOT IN'
				),
				array(
					'taxonomy' => 'download_category',
					'field'    => 'slug',
					'terms'    => 'popular'
				)
			);

			$query->set( 'tax_query', $tax_query );
			$query->set( 'orderby', 'menu_order' );

		}

	}
}
add_action( 'pre_get_posts', 'eddwp_feed_query', 99999999 );


/* ----------------------------------------------------------- *
 * RSS
 * ----------------------------------------------------------- */

/**
 * Add RSS image
 */
function eddwp_rss_featured_image() {
	global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		$thumbnail = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		$mime_type = get_post_mime_type( get_post_thumbnail_id( $post->ID ) );
		?>
		<media:content url="<?php echo $thumbnail; ?>" type="<?php echo $mime_type; ?>" medium="image" width="600" height="300"></media:content>
	<?php }
}
add_filter( 'rss2_item', 'eddwp_rss_featured_image' );


/**
 * Add rss namespaces
 */
function eddwp_rss_namespace() {
	echo 'xmlns:media="http://search.yahoo.com/mrss/"
	xmlns:georss="http://www.georss.org/georss"';
}
add_filter( 'rss2_ns', 'eddwp_rss_namespace' );


/**
 * RSS
 * Get an array of excluded category IDs
 */
function eddwp_rss_get_excluded_categories() {

	$excluded_categories = array(
		'exclude-from-rss'
	);

	$ids = array();

	if ( $excluded_categories ) {
		foreach ( $excluded_categories as $category ) {
			$category = get_category_by_slug( $category );
			if ( is_object( $category ) && property_exists( $category, 'cat_ID' ) ) {
				$ids[] = $category->cat_ID;
			}
		}
	}

	return $ids;
}


/**
 * RSS
 * Hide blocked categories from being listed on the site
 */
function eddwp_get_object_terms( $terms, $object_ids, $taxonomies ) {

	if ( $terms ) {
		foreach ( $terms as $id => $term ) {

			$term_id = isset( $term->term_id ) ? $term->term_id : '';

			if ( in_array( $term_id, eddwp_rss_get_excluded_categories() ) ) {
				unset( $terms[$id] );
			}
		}
	}

	return $terms;

}
add_filter( 'wp_get_object_terms', 'eddwp_get_object_terms', 10, 3 );
