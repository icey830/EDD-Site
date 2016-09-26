<?php
/**
 * Easy Digital Downloads core features
 */


/* ----------------------------------------------------------- *
 * Theme Setup
 * ----------------------------------------------------------- */
define( 'EDD_SITE_VERSION', '2.3.7-beta1' );
define( 'EDD_INC', dirname(__FILE__) . '/includes/' );


/**
 * Set the content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function edd_theme_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

		// used for all uniform product images (all sizes) and single downloads
		add_image_size( 'download-grid-thumb', 540, 270, true );

		// featured extension/theme display
		add_image_size( 'featured-download', 880, 575, array( 'center', 'top' ) );

	// theme menus
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'edd' ),
		'footer'  => __( 'Footer Menu', 'edd' ),
	) );
}
add_action( 'after_setup_theme', 'edd_theme_setup' );


/**
 * Enqueue scripts and styles
 */
function edd_register_theme_scripts() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	$deps = array( 'roboto-font' );

	if ( function_exists( 'is_bbpress' ) ) {
		if ( is_bbpress() ) {
			$deps[] = 'bbp-default-bbpress';
		}
	}

	// 635 My Account
	// 65892 bbPress Support Dashboard
	if ( is_page( 635 ) || is_page( 65892 ) ) {
		$deps[] = 'bootstrap';
	}

	// Google fonts
	wp_register_style( 'roboto-font', '//fonts.googleapis.com/css?family=Roboto:300,400,500' );

	// main stylesheet (loaded last)
	wp_register_style( 'edd-style', get_stylesheet_directory_uri() . '/style.css', $deps, filemtime( get_stylesheet_directory() . '/style.css' ) );

	// Font Awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/lib/font-awesome/css/font-awesome.min.css',  array( 'edd-style' ), '3.2.1' );

	// load normalize stylesheet
	wp_enqueue_style( 'normalize',    get_template_directory_uri() . '/assets/css/lib/normalize.css',     array( ),             '2.1.2' );

	// register bootstrap stylesheet
	wp_register_style( 'bootstrap',    get_template_directory_uri() . '/assets/css/lib/bootstrap.min.css', array( ),             '1.0' );

	// load JS resources
	wp_enqueue_script( 'edd-js',         get_template_directory_uri() . '/assets/js/theme.min.js',          array( 'jquery' ), EDD_SITE_VERSION,   false );
	wp_enqueue_script( 'modernizr-js',   get_template_directory_uri() . '/assets/js/lib/modernizr.min.js',  array( 'jquery' ), '2.6.2', false );
	wp_register_script( 'bootstrap-js',   get_template_directory_uri() . '/assets/js/lib/bootstrap.min.js',  array( 'jquery' ), '1.0',   false );
	wp_enqueue_script( 'jquery' );

	// Comment reply behavior
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// remove unneeded resources
	wp_dequeue_style( 'bbp-default-bbpress' );
	wp_dequeue_style( 'bbp_private_replies_style' );
	wp_dequeue_style( 'staff-list-custom-css' );
	wp_dequeue_style( 'sharedaddy' );
	wp_dequeue_style( 'edd-styles' );

	// load support page bbPress resources
	if ( class_exists( 'bbPress' ) && is_bbpress() ) {
		wp_enqueue_style( 'bbp-default-bbpress', trailingslashit( bbPress()->themes_url . 'default' ) . 'css/bbpress.css', array(), bbp_get_version(), 'screen' );
		wp_enqueue_script( 'bootstrap-select' );
	}

	// 635 My Account
	// 65892 bbPress Support Dashboard
	if ( is_page( 635 ) || is_page( 65892 ) || is_singular( 'download' ) || is_page_template( 'page-templates/template-download-directory.php' ) || is_page_template( 'page-templates/template-purchase-confirmation.php' ) ) {
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
		'name'          => __( 'Forums Sidebar', 'edd' ),
		'id'            => 'forum-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'edd_register_theme_sidebars' );

/* ----------------------------------------------------------- *
 * Additional Functions
 * ----------------------------------------------------------- */
include( EDD_INC . 'template-tags.php' );
include( EDD_INC . 'extras.php' );
include( EDD_INC . 'customizer.php' );
include( EDD_INC . 'query-filters.php' );
include( EDD_INC . 'class-fragment-cache.php' );
include( EDD_INC . 'simple-notices-pro.php' );
include( EDD_INC . 'shortcodes.php' );
include( EDD_INC . 'feed-rss.php' );