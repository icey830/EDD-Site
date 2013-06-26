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

	add_editor_style( 'css/editor-style.css' );
	
	add_image_size( 'showcase', 320, 200, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'edd' ),
	) );
}
add_action( 'after_setup_theme', 'edd_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function edd_register_theme_sidebars() {
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
add_action( 'widgets_init', 'edd_register_theme_sidebars' );

/**
 * Enqueue scripts and styles
 */
function edd_register_theme_scripts() {
	wp_register_style( 'roboto-font', 'http://fonts.googleapis.com/css?family=Roboto:400,300,500' );
	wp_register_style( 'edd-style', get_stylesheet_directory_uri() . '/style.css', array( 'roboto-font' ) );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/lib/font-awesome.css', array( 'edd-style' ) );
	wp_register_style( 'normalize', get_template_directory_uri() . '/css/lib/normalize.css' );

	wp_enqueue_style( 'normalize' );
	wp_enqueue_style( 'roboto-font' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'edd-style' );

	wp_register_script( 'edd-js', get_template_directory_uri() . '/js/theme.min.js', array( 'jquery' ) );
	wp_register_script( 'modernizr-js', get_template_directory_uri() . '/js/lib/modernizr.min.js', array( 'jquery' ) );
	wp_register_script( 'nivo-slider-js', get_template_directory_uri() . '/js/lib/nivoslider.min.js', array( 'jquery' ) );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'edd-js' );
	wp_enqueue_script( 'modernizr-js' );

	if ( is_front_page() )
		wp_enqueue_script( 'nivo-slider-js' );

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'edd_register_theme_scripts' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function edd_wp_title( $title, $sep ) {
	global $paged, $page, $post;

	$title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );

	if ( is_search() ) {
		$search_term = get_query_var( 's' );

		$search = new WP_Query( 's=' . $search_term . '&posts_per_page=-1' );

		$title = __( 'Search Results For' , 'edd' ) . ' ' . $search_term . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_page() ) {
		$title = strip_tags( htmlspecialchars_decode( get_the_title( $post->ID ) ) ) . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_404() ) {
		$title = __( '404 - Nothing Found', 'edd' ) . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_author() ) {
		$title = get_userdata( get_query_var( 'author' ) )->display_name . ' | ' . __( 'Author Archive', 'edd' )  . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_category() ) {
		$title = single_cat_title( '', false ) . ' | ' . __( 'Category Archive', 'edd' ) . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false ) . ' | ' . __( 'Tag Archive', 'edd' ) . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_single() ) {
		$post_title = the_title_attribute( 'echo=0' );

		if ( ! empty( $post_title ) )
			$title = $post_title . ' | ' . get_bloginfo( 'name' );
	}

	if ( is_feed() )
		return $title;

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'edd' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'edd_wp_title', 10, 2 );

function edd_image_full_quality( $quality ) {
    return 100;
}
add_filter( 'jpeg_quality', 'edd_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'edd_image_full_quality' );

function eddwp_get_latest_post() {
	$query = new WP_Query( array( 'posts_per_page' => 1 ) );

	while ( $query->have_posts() ) {
		$query->the_post();
		printf( '<h4>%s</h4>', get_the_title() );
		the_excerpt();
		printf( '<a href="%1$s">%2$s</a>', get_permalink(), __( 'Read More...', 'edd' ) );
	}
}

function eddwp_get_footer_nav() {  }