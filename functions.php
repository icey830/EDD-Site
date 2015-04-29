<?php
/**
 * Easy Digital Downloads
 *
 * This file adds all the core features of the Easy Digital Downloads theme.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

/* ------------------------------------------------------------------------------- *
 *
 * /\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\
 *
 * 1.  Theme Setup
 * 2.  Includes
 * 3.  Stylesheets and JavaScript Files
 * 4.  Comments Template
 * 5.  Features
 * 6.  Custom Actions/Filters
 * 7.  Widgets
 * 8.  Shortcodes
 * 9.  Extensions feed
 * 10. Misc
 * 11. bbPress
 * 12. Commissions
 *
 * ------------------------------------------------------------------------------- */

/* ----------------------------------------------------------- *
 * 1. Theme Setup
 * ----------------------------------------------------------- */

/**
 * Set the content width.
 */
if ( ! isset( $content_width ) )
	$content_width = 680;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function edd_theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	add_editor_style( 'css/editor-style.css' );

	add_image_size( 'showcase', 320, 200, true );
	add_image_size( 'theme-showcase', 460, 280, true );
	add_image_size( 'featured-showcase', 460, 330, true );
	add_image_size( 'extension', 180, 150, true );
	add_image_size( 'edd_download_image', 840, 575, true );
	add_image_size( 'download-grid-thumb', 600, 400, true );
	add_image_size( 'featured-download', 760, 507, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'edd' ),
	) );
}
add_action( 'after_setup_theme', 'edd_theme_setup' );

/* ----------------------------------------------------------- *
 * 2. Includes
 * ----------------------------------------------------------- */

include( dirname(__FILE__) . '/includes/class-fragment-cache.php' );
include( dirname(__FILE__) . '/includes/query-filters.php' );
include( dirname(__FILE__) . '/includes/simple-notices-pro.php' );

/* ----------------------------------------------------------- *
 * 3. Stylesheets and JavaScript Files
 * ----------------------------------------------------------- */

/**
 * Enqueue scripts and styles
 */
function edd_register_theme_scripts() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	$deps = array( 'roboto-font' );

	if( function_exists( 'is_bbpress' ) ) {
		if ( is_bbpress() || is_page( 'support' ) ) {
			$deps[] = 'bbp-default-bbpress';
		}
	}

	if ( is_page( 635 ) || is_page( 65892 ) ) {
		$deps[] = 'bootstrap';
	}

	wp_register_style(  'roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500' );
	wp_register_style(  'edd-style',    get_stylesheet_directory_uri() . '/style.css',                 $deps,                filemtime( get_stylesheet_directory() . '/style.css' )   );
	wp_register_style(  'font-awesome', get_template_directory_uri()   . '/css/lib/font-awesome/css/font-awesome.min.css',  array( 'edd-style' ), '3.2.1' );
	wp_register_style(  'normalize',    get_template_directory_uri()   . '/css/lib/normalize.css',     array( ),             '2.1.2' );
	wp_register_style(  'bootstrap',    get_template_directory_uri()   . '/css/lib/bootstrap.min.css', array( ),             '1.0'   );

	wp_enqueue_style(   'normalize'    );
	wp_enqueue_style(   'lato-font'  );
	wp_enqueue_style(   'font-awesome' );

	wp_register_script( 'edd-js',         get_template_directory_uri() . '/js/theme.min.js',          array( 'jquery' ), '1.0',   false );
	wp_register_script( 'modernizr-js',   get_template_directory_uri() . '/js/lib/modernizr.min.js',  array( 'jquery' ), '2.6.2', false );
	wp_register_script( 'nivo-slider-js', get_template_directory_uri() . '/js/lib/nivoslider.min.js', array( 'jquery' ), '3.2',   false );
	wp_register_script( 'bootstrap-js',   get_template_directory_uri() . '/js/lib/bootstrap.min.js',  array( 'jquery' ), '1.0',   false );

	wp_enqueue_script(  'jquery'       );
	wp_enqueue_script(  'edd-js'       );
	wp_enqueue_script(  'modernizr-js' );

	if ( is_front_page() )
		wp_enqueue_script( 'nivo-slider-js' );

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	if( is_singular( 'extension' ) && defined( 'EDD_WL_PLUGIN_URL' ) ) {
		wp_enqueue_script( 'edd-wl', EDD_WL_PLUGIN_URL . 'includes/js/edd-wl' .  $suffix . '.js', array( 'jquery' ), EDD_WL_VERSION, true );
		wp_enqueue_script( 'edd-wl-validate', EDD_WL_PLUGIN_URL . 'includes/js/jquery.validate' .  $suffix . '.js', array( 'jquery' ), EDD_WL_VERSION, true );
		wp_enqueue_script( 'edd-wl-modal', EDD_WL_PLUGIN_URL . 'includes/js/modal' .  $suffix . '.js', array( 'jquery' ), EDD_WL_VERSION, true );
	}

	wp_dequeue_style( 'bbp-default-bbpress' );
	wp_dequeue_style( 'bbp_private_replies_style' );
	wp_dequeue_style( 'staff-list-custom-css' );
	wp_dequeue_style( 'sharedaddy' );
	wp_dequeue_style( 'edd-styles' );

	if ( function_exists( 'is_bbpress' ) && is_bbpress() || is_page( 'support' ) ) {
		wp_enqueue_style( 'bbp-default-bbpress', trailingslashit( bbPress()->themes_url . 'default' ) . 'css/bbpress.css', array(), bbp_get_version(), 'screen' );
		wp_enqueue_script( 'bootstrap-select' );
	}

	if ( is_page( 635 ) || is_page( 65892 ) ) {
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_script( 'bootstrap-js' );
	}

	global $wp_styles;
	array_unshift( $wp_styles->queue, 'd4p-bbattachments-css');
	array_unshift( $wp_styles->queue, 'edd-styles' );

	// Load the main stylesheet at the end so overrides are easier
	wp_enqueue_style( 'edd-style' );
}
add_action( 'wp_enqueue_scripts', 'edd_register_theme_scripts', 9999 );

/* ----------------------------------------------------------- *
 * 4. Comments Template
 * ----------------------------------------------------------- */

/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function edd_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class( 'clearfix' ); ?> id="comment-<?php comment_ID(); ?>">
		<div id="div-comment-<?php the_ID(); ?>" class="comment-body">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, $args['avatar_size'] );?>
				<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
		 	</div><!-- /.comment-author -->

		 	<div class="comment-meta commentmetadata">
				<a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ); ?></a>
				<?php edit_comment_link( __( '(Edit)' ), '' ); ?>
		 	</div><!-- /.comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="alert"><?php echo apply_filters( 'eddwp_comment_awaiting_moderation', __( 'Your comment is awaiting moderation.', 'edd' ) ); ?></p>
			<?php endif; ?>

			<?php
			comment_text();

			comment_reply_link(
				array_merge(
					$args,
					array(
						'depth'      => $depth,
						'max_depth'  => $args['max_depth'],
						'reply_text' => '<p>Reply</p>'
					)
				)
			);
			?>
		</div>
<?php
}

function eddwp_comment_form() {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="Name*" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" placeholder="Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url">' . '<input id="url" placeholder="Website" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	comment_form(
		array(
			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_notes_after' => '<p class="comments-support-notice notice">For support, please open a ticket in the <a href="https://easydigitaldownloads.com/support/">Support Forums</a>.</p><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		)
	);
}

/* ----------------------------------------------------------- *
 * 5. Features
 * ----------------------------------------------------------- */

/**
 * Register widgetized area and update sidebar with default widgets
 */
function edd_register_theme_sidebars() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'edd' ),
		'id'            => 'blog-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'		    => __( 'Forums Sidebar', 'edd' ),
		'id'			=> 'forum-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Documentation Sidebar', 'edd' ),
		'id'            => 'documentation-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'edd_register_theme_sidebars' );

/* ----------------------------------------------------------- *
 * 6. Custom Actions/Filters
 * ----------------------------------------------------------- */

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
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
 * Override the default image quality and make sure when images are uploaded that
 * the quality doesn't get degraded.
 */
function edd_image_full_quality( $quality ) {
	return 100;
}
add_filter( 'jpeg_quality', 'edd_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'edd_image_full_quality' );

/**
 * This function is used in the footer template to get the latest blog post.
 */
function eddwp_get_latest_post() {
	$items = get_posts( array( 'posts_per_page' => 1 ) );
	foreach( $items as $item ) {
		printf( '<h4>%s</h4>', $item->post_title );
		echo wpautop( wp_trim_words( $item->post_content, 50 ) );
		printf( '<a href="%1$s">%2$s</a>', get_permalink( $item->ID ), __( 'Read More...', 'edd' ) );
	}
}

/**
 * Modify Author archive query to display extensions only
 */
function eddwp_author_archive_query( $query ) {
	if ( $query->is_author ) {
		$query->set( 'post_type', 'extension' );
	}
	remove_action( 'pre_get_posts', 'eddwp_author_archive_query' );
}
add_action( 'pre_get_posts', 'eddwp_author_archive_query' );

/**
 * Extensions shortcode callback function
 */
function eddwp_extensions_cb() {
	echo '<div class="extensions clearfix">';

	$extensions = new WP_Query(
		array(
			'post_type' => 'extension',
			'nopaging'  => true,
			'orderby'   => 'rand'
		)
	);

	while ( $extensions ->have_posts() ) : $extensions->the_post(); ?>

		<div class="extension">
			<?php
			if ( has_category( '3rd Party' ) )
				echo '<i class="icon-third-party"></i>';
			elseif ( has_category( 'Free' ) )
				echo '<i class="icon-free"></i>';
			?>

			<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
				<?php the_post_thumbnail( 'showcase' ); ?>
				<h2><?php the_title(); ?></h2>
				<?php the_excerpt(); ?>
			</a>
		</div>

	<?php endwhile; ?>

	<?php echo '</div>';
}
add_shortcode( 'extensions', 'eddwp_extensions_cb' );


function eddwp_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'link' 	 => '',
			'target' => '_blank',
		),
		$atts, 'eddwp_button' )
	);

	return '<a href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '" class="edd-submit button blue">' . $content . '</a>';
}
add_shortcode( 'button', 'eddwp_button' );

function eddwp_theme_preview( $atts, $content = null ) {
	return '<div class="theme-preview">' . $content . '</div>';
}
add_shortcode( 'theme-preview', 'eddwp_theme_preview' );

function eddwp_theme_meta( $atts, $content = null ) {
	return '<div class="theme-meta">' . $content . '</div>';
}
add_shortcode( 'theme-meta', 'eddwp_theme_meta' );

/**
 * Setup pagination
 */
function eddwp_paginate_links() {
	global $wp_query;

	$big = 999999999;

	if( ! function_exists( 'edd_get_current_page_url' ) ) {
		return;
	}

	$url = edd_get_current_page_url();

	if( false === strpos( $url, '?' ) ) {
		$sep = '?';
	} else {
		$sep = '&';
	}

	echo '<div class="pagination clearfix">' . paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => $sep . 'paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
	) ) . '</div>';
}

/**
 * Add the rewrite tag for the extensions search
 */
function eddwp_add_rewrite_tags() {
	add_rewrite_tag( '%download_s%', '([^/]+)' );
	add_rewrite_tag( '%extension_s%', '([^/]+)' );
}
add_action( 'init', 'eddwp_add_rewrite_tags' );

/**
 * Process the rewrite rules added for the extension search and make sure that the
 * correct template is loaded when the extension search is initiated.
 */
function eddwp_process_rewrites() {
	if ( isset( $_GET[ 'download_s' ] ) && ! empty ( $_GET['download_s'] ) && isset( $_GET['action'] ) && $_GET['action'] == 'download_search' ) {
		load_template( dirname( __FILE__ ) . '/search-downloads-extensions.php' );
		die();
	}
	if ( isset( $_GET[ 'extension_s' ] ) && ! empty ( $_GET['extension_s'] ) && isset( $_GET['action'] ) && $_GET['action'] == 'extension_search' ) {
		load_template( dirname( __FILE__ ) . '/search-extensions.php' );
		die();
	}
}
add_action( 'init', 'eddwp_process_rewrites' );

/**
 * Adds custom body classes based on the page the user is browsing.
 */
function eddwp_body_class( $classes ) {
	global $post;

	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	if ( preg_match( '/Firefox/i', $user_agent ) ) {
		$classes[] = 'firefox';
	}

	if ( isset( $_GET['extension_s'] ) )
		$classes[] = 'extension-search';

	if ( isset( $_GET['download_s'] ) )
		$classes[] = 'download-search';

	if ( is_page( 'support' ) )
		$classes[] = 'bbpress';

	if ( ( is_single() && 'post' == get_post_type( $post->ID ) ) || is_search() )
		$classes[] = 'blog';

	if ( is_page( 'your-account' ) && ! is_user_logged_in() )
		$classes[] = 'login';

	if ( is_category() || is_tag() || is_author() || is_day() || is_month() || is_year() )
		$classes[] = 'blog';

	if ( isset( $_GET['s_type'] ) && isset( $_GET['doc_s'] ) ) {
		unset( $classes['blog'] );
		$classes[] = 'search';
		$classes[] = 'documentation';
		$classes[] = 'documentation-search';
	}
	
	if ( is_page_template( 'template-themes-archive.php' ) ) {
		$classes[] = 'template-themes';
	}
	
	if ( is_page_template( 'template-extensions-archive.php' ) ) {
		$classes[] = 'template-extensions';
	}
	
	if ( is_page_template( 'template-site-showcase.php' ) ) {
		$classes[] = 'template-site-showcase';
	}

	return $classes;
}
add_filter( 'body_class', 'eddwp_body_class' );

/**
 * Override the default forum freshness link that bbPress provides.
 *
 */
function eddwp_bbp_get_forum_freshness_link( $anchor, $forum_id, $time_since, $link_url, $title, $active_id ) {
	if ( ! empty( $time_since ) && ! empty( $link_url ) )
		$anchor = '<a href="' . $link_url . '" title="' . esc_attr( $title ) . '">' . 'Last response ' . $time_since . '</a>';
	else
		$anchor = __( 'No Topics', 'edd' );

	return $anchor;
}
add_filter( 'bbp_get_forum_freshness_link', 'eddwp_bbp_get_forum_freshness_link', 10, 6 );

/**
 * Add the custom admin bar menu for the support moderators.
 */
function eddwp_support_admin_bar( $wp_admin_bar ) {
	global $user_ID;

	if ( ! current_user_can( 'moderate' ) )
		return;

	$wp_admin_bar->add_node(
		array(
			'id'	 =>	'eddwp_support',
			'title'	 =>	__( 'Support Tickets' ),
			'href'	 =>	'/support/dashboard/'
		)
	);

}
add_action( 'admin_bar_menu', 'eddwp_support_admin_bar', 999 );

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
 * Filter the admin reply links to remove extra &nbsp; add by bbPress
 */
function eddwp_get_reply_admin_links( $retval, $r, $args ) {
	$retval = str_replace("&nbsp;", '', $retval);
	echo trim($retval);
}
add_filter( 'bbp_get_reply_admin_links', 'eddwp_get_reply_admin_links', 10, 3 );

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
 * Remove the default purchase link that's appended after `the_content`
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );


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

function eddwp_display_extensions() {
	$query = new WP_Query( array(
		'post_type' => 'extension',
		'posts_per_page' => 3,
		'orderby' => 'rand',
		'tax_query' => array(
			array(
				'taxonomy' => 'extension_category',
				'field' => 'slug',
				'terms' => 'popular'
			)
		)
	) );

	?>
	<div class="clearfix">
	<?php
	$c = 0; while ( $query->have_posts() ) {
		$query->the_post(); $c++;

		?>
		<div class="extension <?php if ( 0 == $c%3 ) echo ' extension-clear'; ?><?php if ( has_term( '3rd Party', 'extension_category', get_the_ID() ) ) echo ' third-party-extension'; ?><?php if ( eddwp_is_extension_free() ) echo ' free-extension'; ?>">
				<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
				<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
				<h3><?php the_title(); ?></h3>
			</a>
			<div class="overlay">
				<a href="<?php the_permalink(); ?>" class="overlay-view-details button">View Details</a>
				<?php if( ! eddwp_is_external_extension() ) : ?>
					<a href="<?php echo home_url( '/checkout/?edd_action=add_to_cart&download_id=' . get_post_meta( get_the_ID(), 'ecpt_downloadid', true ) ); ?>" class="overlay-add-to-cart button">Add to Cart</a>
				<?php endif; ?>
			</div>
			<?php
			if ( has_term( '3rd Party', 'extension_category', get_the_ID() ) )
				echo '<i class="third-party"></i>';
			?>
		</div>
		<?php
	}
	?>
	</div>
	<?php
}

function eddwp_display_themes() {
	?>
	<?php
	$query = new WP_Query( array(
		'post_type' => 'theme',
		'posts_per_page' => 3,
		'orderby' => 'rand'
	) );

	?>
	<div class="clearfix">
	<?php
	$c = 0; while ( $query->have_posts() ) {
		$query->the_post(); $c++;

		?>
		<div class="theme <?php if ( 0 == $c % 3 ) echo ' theme-clear'; ?>">
			<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
				<div class="thumbnail-holder"><?php the_post_thumbnail( 'theme-showcase' ); ?></div>
				<h3 class="theme-name"><?php the_title(); ?></h3>
			</a>
		</div>
		<?php
	}
	?>
	</div>
	<?php
}

/**
 * Append demo button link to download products
 */
function eddwp_demo_link( $content ) {
	global $post;

	// bail if there is no demo link
	$demo_link = get_post_meta( get_the_ID(), 'ecpt_demolink', true );
	if( empty( $demo_link ) )
		return $content;

	// build link to the demo
	$output_demo_link = sprintf( '<p class="edd-demo-link"><a class="edd-submit button blue" href="%s">View Demo</a></p>', $demo_link );

	// add the link to demo below the content
	$content = $content . $output_demo_link;

	return $content;
}
add_filter( 'the_content', 'eddwp_demo_link' );

/**
 * Append the changelog to the extension or download content
 */
function eddwp_product_changelog( $content ) {   
	global $post;

	// make sure we're on an extension or a download
	if( 'extension' === $post->post_type || 'download' === $post->post_type ) {
		$post_type = true;
	} else {
		$post_type = false;
	}

	// see of the CPT has a category of "bundles"
	if( has_term( 'bundles', 'extension_category', get_the_ID() ) || has_term( 'bundles', 'download_category', get_the_ID() ) ) {
		$bundles = true;
	} else {
		$bundles = false;
	}

	// If not an extension or download, or has extension/download category of "bundles," bail.
	if( !$post_type || $bundles )
		return $content;
	
	// check to see if it's an extension we're dealing with and act accordingly
	if( 'extension' === $post->post_type ) {
		
		// for extensions, get the ID of the associated download post type
		$download_id = get_post_meta( get_the_ID(), 'ecpt_downloadid', true );

		// bail if there's no associated download
		if( empty( $download_id ) ) {
			return $content;
		}
		
		// get the changelog data of the associated download
		$changelog = get_post_meta( $download_id, '_edd_sl_changelog', true );
		
	} elseif ( 'download' === $post->post_type ) {

		// get the changelog data of the download
		$changelog = get_post_meta( get_the_ID(), '_edd_sl_changelog', true );
	}
	
	// if it exists, append the changelog (from either source) to the relevent content output
	if( !empty( $changelog ) ) {
		$content = $content . do_shortcode( '[toggle title="Changelog"]' . $changelog . '[/toggle]' );
	}
	
	return $content;
}
add_filter( 'the_content', 'eddwp_product_changelog' );

/**
 * Append link to support forums at bottom of documentation content
 */
function eddwp_docs_support_forum_link( $content ) {
	global $post;

	// bail if this is not a documentation post type
	if( 'docs' !== $post->post_type )
		return $content;

	// build link to the support forums
	$support_forums = sprintf( '<p class="docs-support-link">For assistance, please open a ticket in the <a href="%s">support forums</a>.</p>',
		get_option( 'siteurl' ) . '/support/'
	);

	// add the link to support forums below the doc content
	$content = $content . $support_forums;

	return $content;
}
add_filter( 'the_content', 'eddwp_docs_support_forum_link' );

/* ----------------------------------------------------------- *
 * 7. Widgets
 * ----------------------------------------------------------- */

/**
 * This class registers and handles the display of the newsletter signup form
 * widget in the sidebar.
 */
class SR_Newsletter_Signup_Form extends WP_Widget {
	/**
	 * Constructor Function
	 *
	 * @since 1.0
	 * @access protected
	 * @see WP_Widget::__construct()
	 */
	public function __construct() {
		parent::__construct(
			false,
			'MailChimp Signup Form (Customized for EDD)',
			array(
				'description' => 'Display a MailChimp newsletter list signup form'
			)
		);
	}

	/**
	 * Widget API Function
	 *
	 * @since 1.0
	 * @access public
	 * @return void
	 */
	public function widget($args, $instance) {
		extract( $args, EXTR_SKIP );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$list_id = strip_tags( $instance['list_id'] );
		$message = esc_attr( $instance['message'] );

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo sr_mc_form('', $list_id, $message);

		echo $after_widget;
	}

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @since 1.0
	 * @access public
	 * @return void
	 */
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['list_id'] = strip_tags( $new_instance['list_id'] );
		$instance['message'] = esc_attr( $new_instance['message'] );

		return $instance;
	}

	/**
	 * Generates the administration form for the widget
	 *
	 * @since 1.0
	 * @access public
	 * @param array $instance The array of keys and values for the widget
	 * @return void
	 */
	public function form( $instance ) {
		$title       = isset( $instance['title']       ) ? esc_attr( $instance['title']       ) : '';
		$description = isset( $instance['description'] ) ? esc_attr( $instance['description'] ) : '';
		$list_id     = isset( $instance['list_id']     ) ? esc_attr( $instance['list_id']     ) : '';
		$message     = isset( $instance['message']     ) ? esc_attr( $instance['message']     ) : '';
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'edd' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:', 'edd' ); ?></label> <br />
				<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'list_id' ); ?>"><?php _e( 'Choose a List', 'edd' ); ?></label>
				<select name="<?php echo $this->get_field_name( 'list_id' ); ?>" id="<?php echo $this->get_field_id( 'list_id' ); ?>" class="widefat">
				<?php
					$lists = pmc_get_lists();
					foreach ( $lists as $id => $list ) {
						echo '<option value="' . $id . '"' . selected( $list_id, $id, false ) . '>' . $list . '</option>';
					}
				?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'message' ); ?>"><?php _e( 'Success Message:', 'edd' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'message' ); ?>" name="<?php echo $this->get_field_name( 'message' ); ?>" type="text" value="<?php echo $message; ?>" />
			</p>
		<?php
	}
}

/**
 * Checks whether the extension currently stored in the loop has been categorized as
 * Third Party.
 */
function eddwp_is_extension_third_party() {
	global $post;

	$terms = get_the_terms( $post->ID, 'extension_category' );

	if ( has_term( '3rd Party', 'extension_category', $post->ID ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Checks if an extension is hosted off site
 */
function eddwp_is_external_extension( $post_id = 0 ) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	return (bool) get_post_meta( $post_id, 'ecpt_is_external', true );
}

/**
 * Gets the external extension URL
 */
function eddwp_get_external_extension_url() {
	return get_post_meta( get_the_ID(), 'ecpt_externalurl', true );
}

/**
 * Checks if an extension is free
 */
function eddwp_is_extension_free( $post_id = 0 ) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	if ( has_term( 'Free', 'extension_category', $post_id ) || get_post_meta( $post_id, 'edd_price,', true ) == 'Free' || (bool) get_post_meta( $post_id, 'ecpt_is_external', true ) == true ) {
		return true;
	}
}

/* ----------------------------------------------------------- *
 * 8. Shortcodes
 * ----------------------------------------------------------- */

/**
 * Info Boxes
 */
function eddwp_shortcode_box( $atts, $content = null ) {
	$output = '';

	$default = array(
        'style' => 'alert'
    );

    extract( shortcode_atts( $default, $atts ) );

    $output = '<div class="info-box info-box-'.$style.'"><div class="icon">'.do_shortcode( $content ).'</div></div>';

    return $output;
}
add_shortcode( 'box', 'eddwp_shortcode_box' );

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
 * Clear Row
 */
function eddwp_shortcode_clear() {
	return '<div class="clear"></div>';
}
add_shortcode( 'clear', 'eddwp_shortcode_clear' );

/**
 * Divider
 */
function eddwp_shortcode_divider( $atts, $content = null ) {
    return '';
}
add_shortcode( 'divider', 'eddwp_shortcode_divider' );

/**
 * Tabs
 */
function eddwp_shortcode_tabs( $atts, $content = null ) {
    $default = array(
        'style'  => 'framed',
        'height' => ''
    );

    extract( shortcode_atts( $default, $atts ) );

    if ( isset( $atts['style'] ) )  unset( $atts['style'] );
    if ( isset( $atts['height'] ) ) unset( $atts['height'] );

    $id = uniqid( 'tabs_'.rand() );
    $num = count( $atts ) - 1;
	$i = 1;
	$options = array(
    	'setup' => array(
    		'num'   => $num,
    		'style' => $style,
    		'names' => array()
    	),
    	'height' => $height
    );

    if ( is_array( $atts ) && ! empty( $atts ) ) {
		foreach ( $atts as $key => $tab ) {
			$options['setup']['names']['tab_'.$i] = $tab;
			$tab_content = explode( '[/'.$key.']', $content );
			$tab_content = explode( '['.$key.']', $tab_content[0] );
			$options['tab_'.$i] = array(
				'type' => 'raw',
				'raw' => $tab_content[1],
			);
			$i++;
		}
		$output = '<div class="element element-tabs' . eddwp_get_classes( 'element_tabs', true ) . '">' . eddwp_tabs( $id, $options ) . '</div><!-- /.element-tabs -->';
	}

    return $output;
}

/**
 * Toggles
 */
function eddwp_shortcode_toggle( $atts, $content = null ) {
	$last = '';
	if ( isset( $atts[0] ) && trim( $atts[0] ) == 'last') $last = ' tb-toggle-last';
	$default = array(
        'title' => ''
    );
    extract( shortcode_atts( $default, $atts ) );
    $content = wpautop( do_shortcode( stripslashes( $content ) ) );
	$output  = '<div class="tb-toggle'.$last.'">';
	$output .= '<a href="#" title="'.$title.'" class="toggle-trigger"><span></span>'.$title.'</a>';
	$output .= '<div class="toggle-content">'.$content.'</div>';
	$output .= '</div>';
    return $output;
}
add_shortcode( 'toggle', 'eddwp_shortcode_toggle' );

/**
 * Get additional classes for elements.
 */
function eddwp_get_classes( $element, $start_space = false, $end_space = false, $type = null, $options = array() ) {
	$classes = '';

	$all_classes = array(
		'element_columns' 				=> '',
		'element_content' 				=> '',
		'element_divider' 				=> '',
		'element_headline' 				=> '',
		'element_post_grid_paginated' 	=> '',
		'element_post_grid' 			=> '',
		'element_post_grid_slider' 		=> '',
		'element_post_list_paginated' 	=> '',
		'element_post_list' 			=> '',
		'element_post_list_slider' 		=> '',
		'element_slider' 				=> '',
		'element_slogan' 				=> '',
		'element_tabs' 					=> '',
		'element_tweet' 				=> '',
		'slider_standard'				=> '',
		'slider_carrousel'				=> '',
	);

	$all_classes = apply_filters( 'eddwp_element_classes', $all_classes, $type, $options );

	if ( isset( $all_classes[ $element ] ) && $all_classes[ $element ] ) {
		if ( $start_space ) $classes .= ' ';

		$classes .= $all_classes[$element];

		if ( $end_space ) $classes .= ' ';
	}

	return $classes;
}

/**
 * Post Grid
 */
function eddwp_post_grid( $atts ) {
	$default = array(
        'categories'    => '',
        'cat'           => '',
        'category_name' => '',
        'tag'           => '',
        'columns' 		=> 3,
        'rows' 			=> 3,
        'orderby' 		=> 'date',
        'order' 		=> 'DESC',
        'offset' 		=> 0,
        'query' 		=> '',
        'crop'			=> '',
        'link' 			=> 0,
        'link_text' 	=> 'View All Posts',
        'link_url' 		=> 'http://google.com',
        'link_target' 	=> '_self'
    );

    shortcode_atts( $default, $atts );

	$post__in = explode( ',', $atts['include'] );

	$args = array(
		'orderby'   => $atts['orderby'],
		'order'     => $atts['order'],
		'post__in'  => $post__in,
		'post_type' => 'any'
	);

	$query = new WP_Query( $args );

	ob_start();
	?>

	<?php if ( $query->have_posts() ) : ?>
		<div class="post-grid">
			<?php $counter = 0; while ( $query->have_posts() ) { $query->the_post(); $counter++; ?>
			<div class="grid-item column <?php if( $counter%3 == 0 ) echo ' last'; ?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_post_thumbnail(); ?>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
				</article><!-- /#post-<?php the_ID(); ?> -->
			</div><!-- /.grid-item (end) -->
			<?php } // end while ?>
		</div><!-- /.post-grid -->
	<?php endif; ?>

	<?php
	wp_reset_postdata();

	return ob_get_clean();
}
add_shortcode( 'post_grid', 'eddwp_post_grid' );


/* ----------------------------------------------------------- *
 * 9. Extensions Feed
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
		$qv['post_type'] = 'extension';

	if ( isset( $qv['feed'] ) && 'addons' == $qv['feed'] )
		$qv['post_type'] = 'extension';

	return $qv;
}
add_filter( 'request', 'eddwp_feed_request' );

/**
 * Alter the WordPress Query for the feed
 */
function eddwp_feed_query( $query ) {
	if ( $query->is_feed && ( $query->query_vars['feed'] == 'extensions' || $query->query_vars['feed'] == 'addons' ) ) {

		$query->set( 'posts_per_page', 50 );

		if( isset( $_GET['display'] ) && 'new' == $_GET['display'] ) {

			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'extension_category',
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
					'taxonomy' => 'extension_category',
					'field'    => 'slug',
					'terms'    => array( '3rd-party' ),
					'operator' => 'NOT IN'
				),
				array(
					'taxonomy' => 'extension_category',
					'field'    => 'slug',
					'terms'    => 'popular'
				)
			);

			$query->set( 'tax_query', $tax_query );
			$query->set( 'orderby', 'menu_order' );

		}

	}
	return $query;
}
add_filter( 'pre_get_posts', 'eddwp_feed_query', 99999999 );

/* ----------------------------------------------------------- *
 * 10. Misc
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
 * Removes styling from Better Click To Tweet plugin
 */
function eddwp_remove_bctt_styling() {
	remove_action('wp_enqueue_scripts', 'bctt_scripts');
}
add_action( 'template_redirect', 'eddwp_remove_bctt_styling' );


/**
 * Alter the WordPress query when displaying themes
 */
function eddwp_themes_pre_get_posts( $query ) {
	if ( $query->is_archive() && $query->is_main_query() && $query->query_vars['post_type'] == 'theme' ) {
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'eddwp_themes_pre_get_posts', 999 );

/**
 * Modal purchase link for single theme
 */
function eddwp_modal() {
	if ( is_singular( 'theme' ) ) {
		ob_start();
		?>
		<div id="modal-overlay"></div><!-- /#overlay -->
		<div id="modal">
			<div id="content"></div><!-- /#content -->
			<a href="#" id="close-modal"><i class="fa fa-times-circle-o"></i></a>
		</div><!-- /#modal -->
		<?php
		$modal = ob_get_clean();
		echo $modal;
	}
}

/**
 * Post Meta
 */
function eddwp_post_meta() {
	?>
	<div class="post-meta">
		<ul>
			<?php
			if ( is_single() ) eddwp_author_box();

			$categories = get_the_category_list( __( ', ', 'edd' ) );

			if ( $categories ) {
			?>
			<li><i class="fa fa-list-ul"></i> <?php echo $categories; ?></li>
			<?php
			} // end if

			$tags = get_the_tag_list( '', __( ', ', 'edd' ) );
			if ( $tags ) {
			?>
			<li><i class="fa fa-tag"></i> <?php echo get_the_tag_list( '', __( ', ', 'edd' ) ); ?></li>
			<?php } ?>
			<?php if ( comments_open() && ! is_single() ) { ?>
			<li><i class="fa fa-comments-o"></i> <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'edd' ), __( '1 Comment', 'edd' ), __( '% Comments', 'edd' ), '', ''); ?></span></li>
			<?php } // end if ?>
		</ul>
	</div><!-- /.post-meta-->
	<?php
}

/**
 * Single post author box
 */
function eddwp_author_box() {
	$author_url = get_the_author_meta( 'user_url' );
	?>
		<div class="edd-author-box clearfix">
			<div class="edd-author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 85, '', get_the_author_meta( 'display_name' ) ); ?>
			</div>
			<div class="edd-author-bio">
				<h4 class="edd-author-title">Written by <?php echo get_the_author_meta( 'display_name' ); ?></h4>
				<?php if ( $author_url ) { ?>
					<span class="edd-author-url"><a href="<?php echo esc_url( $author_url ); ?>" target="_blank"><i class="fa fa-link"></i></a></span>
				<?php } ?>
				<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
			</div>
		</div>
	<?php
}

/**
 * Universal Newsletter Sign Up Form
 */
function eddwp_newsletter_form() {
	?>
	<div class="newsletter">
		<h3 class="newsletter-title"><span>Subscribe to the Easy Digital Downloads </span>Email Newsletter</h3>
		<div class="edd-newsletter-content-wrap">
			<p class="newsletter-description">Be the first to know about the latest updates and exclusive promotions from Easy Digital Downloads by submitting your information below.</p>
			<form class="newsletter-form" id="pmc_mailchimp" action="" method="post">
				<div class="newsletter-name-container">
					<input class="newsletter-name" name="pmc_fname" id="pmc_fname" type="text" placeholder="First Name"/>
				</div>
				<div class="newsletter-email-container">
					<input class="newsletter-email" name="pmc_email" id="pmc_email" type="text" placeholder="Email Address"/>
				</div>
				<div class="newsletter-submit-container">
					<input type="hidden" name="redirect" value="<?php echo 'https://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; ?>"/>
					<input type="hidden" name="action" value="pmc_signup"/>
					<input type="hidden" name="pmc_list_id" value="be2b495923"/>
					<input type="submit" class="newsletter-submit edd-button button blue" value="Sign Up"/>
				</div>
			</form>
			<p class="newsletter-note"><i class="fa fa-lock"></i>We will never send you spam. Your email address is secure.</p>
		</div>
	</div>
	<?php
}

/**
 * Google Custom Search
 */
function eddwp_google_custom_search() {
	?>
	<script>
	  (function() {
	    var cx = '013364375160530833496:u0gpdnp1z-8';
	    var gcse = document.createElement('script');
	    gcse.type = 'text/javascript';
	    gcse.async = true;
	    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
	        '//www.google.com/cse/cse.js?cx=' + cx;
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(gcse, s);
	  })();
	</script>
	<gcse:search></gcse:search>
	<?php
}

/**
 * Connections for downloads post type
 *
 * Add these connections to the Custom Functions Plugin for EDD Site (then delete)
 */
function temporary_eddwp_connection_types() {
	p2p_register_connection_type( array(
		'name' => 'downloads_to_docs',
		'from' => 'download',
		'to' => 'docs',
		'reciprocal' => true
	) );
	p2p_register_connection_type( array(
		'name' => 'downloads_to_forums',
		'from' => 'download',
		'to' => 'forum',
		'reciprocal' => true
	) );
}
add_action( 'p2p_init', 'temporary_eddwp_connection_types' );

/**
 * Featured image for downloads grid output
 */
function eddwp_downloads_grid_thumbnail() {
	
	// replace old featured image programmatically until fully removed
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
	$old_default = 'https://easydigitaldownloads.com/wp-content/uploads/2013/07/defaultpng.png';
	
	if( has_post_thumbnail() && $image[0] !== $old_default ) {
		the_post_thumbnail( 'download-grid-thumb', array( 'class' => 'download-grid-thumb' ) );
	} else {
		echo '<img class="download-grid-thumb wp-post-image" src="' . get_template_directory_uri() . '/images/featured-image-default.png" alt="' . get_the_title() . '" />';
	}
}

/**
 * Check to see if EDD is activated
 */
function eddwp_edd_is_activated() {
	return class_exists( 'Easy_Digital_Downloads' );
}


/* ----------------------------------------------------------- *
 * 12. Next Commissions Payout Amount
 * ----------------------------------------------------------- */
function eddc_get_upcoming_commissions(){
	global $user_ID;

	if( ! is_user_logged_in() ) {
		return;
	}

	$day    = date( 'd', strtotime( 'today' ));
	$month  = date( 'm', strtotime( 'today' ));
	$year   = date( 'Y', strtotime( 'today' ));
	$from   = '';
	$to     = '';
	if ( $day > 15 ){
	    if ( $month == 1 ){
	        $year_last = $year - 1;
	        $from      = '12/15/'.$year_last;
	        $to        = '01/15/'.$year;
	    } else {
	        $last_month = $month - 1;
	        $from       = $last_month.'/15/'.$year;
	        $to         =   $month.'/15/'.$year;
	    }

	} else {

	    if ( $month == 2 ){
	        $year_last = $year - 1;
	        $from      = '12/15/'.$year_last;
	        $to        = '01/15/'.$year;
	    } else if ( $month == 1 ){
	        $year_last = $year - 1;
	        $from      = '11/15/'.$year_last;
	        $to        = '12/15/'.$year_last;
	    } else {
	        $last_month = $month - 1;
	        $two_months = $month - 2;
	        $from       = $two_months.'/15/'.$year;
	        $to         = $last_month.'/15/'.$year;
	    }
	}
	$from = explode( '/', $from );
	$to   = explode( '/', $to );

	$query = array(
		'post_type'      => 'edd_commission',
		'nopaging'		 => true,
		'date_query' => array(
			'after'       => array(
				'year'    => $from[2],
				'month'   => $from[0],
				'day'     => $from[1],
			),
			'before'      => array(
				'year'    => $to[2],
				'month'   => $to[0],
				'day'     => $to[1],
			),
			'inclusive' => true
		),
		'meta_key' => '_user_id',
		'meta_value' => $user_ID,
		'tax_query'      => array(
			array(
				'taxonomy' => 'edd_commission_status',
				'terms'    => 'unpaid',
				'field'    => 'slug'
			)
		),
		'fields'        => 'ids'
	);
	$commissions = new WP_Query( $query );
	$total = (float) 0;
	if ( $commissions->have_posts() ) {
		foreach ( $commissions->posts as $id ) {
			$commission_info = get_post_meta( $id, '_edd_commission_info', true );
			$total += $commission_info['amount'];
		}
	}

	$total = edd_sanitize_amount( $total );
	$from = implode( '/', $from );
	$to   = implode( '/', $to );

	return 'Next payout for Commissions earned from '.  date( 'm/d/Y', strtotime( $from ) ) .' to '. date( 'm/d/Y', strtotime( $to ) ) . ' will be: <strong>' . edd_currency_filter( edd_format_amount( $total ) ) . '</strong>';
}

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

function eddwp_facebook_conversion_pixel() {

	if( function_exists( 'edd_is_success_page' ) && ! edd_is_success_page() ) {
		return;
	}

	if( ! edd_get_purchase_session() ) {
		return;
	}
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
window._fbq.push(['track', '6023481255100', {'value':'0.00','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6023481255100&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
<?php
}
add_action( 'wp_footer', 'eddwp_facebook_conversion_pixel' );
