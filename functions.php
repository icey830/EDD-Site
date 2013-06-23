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
	$content_width = 640; /* pixels */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function edd_theme_setup() {
	load_theme_textdomain( 'edd', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'edd' ),
	) );

	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
add_action( 'after_setup_theme', 'edd_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function edd_register_theme_widgets() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'edd' ),
		'id'            => 'sidebar-1',
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

	wp_register_script( 'theme', get_template_directory_uri() . '/js/theme.js' );
	wp_enqueue_script( 'theme' );
}
add_action( 'wp_enqueue_scripts', 'edd_register_theme_scripts' );