<?php
/**
 * EDD functions and definitions
 *
 * @package   EasyDigitalDownloads_v2
 * @category  Core
 * @author    Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

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

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'edd' ),
	) );
}
add_action( 'after_setup_theme', 'edd_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function edd_register_theme_widgets() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'edd' ),
		'id'            => 'blog-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Forums Sidebar', 'edd' ),
		'id'            => 'forum-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Documentation Sidebar', 'edd' ),
		'id'            => 'documentation-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'edd_register_theme_widgets' );

/**
 * Enqueue scripts and styles
 */
function edd_register_theme_scripts() {
	wp_register_style( 'theme', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'theme' );

	wp_enqueue_script( 'jquery' );

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_register_script( 'theme', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme' );
}
add_action( 'wp_enqueue_scripts', 'edd_register_theme_scripts' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function edd_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'edd_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function edd_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'edd' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'edd_wp_title', 10, 2 );