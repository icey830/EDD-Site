<?php
/*
Plugin Name: Theme Blvd Shortcodes
Plugin URI: 
Description: This plugin works in conjuction with the Theme Blvd framework to create shortcodes for many of the framework's internal elements.
Version: 1.0.6
Author: Jason Bobich
Author URI: http://jasonbobich.com
License: GPL2

    Copyright 2012  Jason Bobich

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/
define( 'TB_SHORTCODES_PLUGIN_VERSION', '1.0.6' );
define( 'TB_SHORTCODES_PLUGIN_DIR', dirname( __FILE__ ) ); 
define( 'TB_SHORTCODES_PLUGIN_URI', plugins_url( '' , __FILE__ ) );

/**
 * Run Shortcodes
 *
 * @since 1.0.0
 */
 

		include_once( 'shortcodes/shortcodes.php' );
		
			remove_filter( 'the_content', 'wptexturize' );
			remove_filter( 'the_content', 'wpautop' );
			remove_filter( 'the_content', 'shortcode_unautop' );
			add_filter( 'the_content', 'themeblvd_content_formatter', 9 );

			remove_filter( 'themeblvd_the_content', 'wptexturize' );
			remove_filter( 'themeblvd_the_content', 'wpautop' );
			remove_filter( 'themeblvd_the_content', 'shortcode_unautop' );
			add_filter( 'themeblvd_the_content', 'themeblvd_content_formatter', 9 ); // Framework uses themeblvd_the_content in some areas so 		
		// Columns
		add_shortcode( 'one_sixth', 'themeblvd_shortcode_column' ); 		// 1/6
		add_shortcode( 'one-sixth', 'themeblvd_shortcode_column' );			// 1/6 (depricated)
		add_shortcode( 'one_fourth', 'themeblvd_shortcode_column' ); 		// 1/4
		add_shortcode( 'one-fourth', 'themeblvd_shortcode_column' );		// 1/4 (depricated)
		add_shortcode( 'one_third', 'themeblvd_shortcode_column' );			// 1/3
		add_shortcode( 'one-third', 'themeblvd_shortcode_column' );			// 1/3 (depricated)
		add_shortcode( 'one_half', 'themeblvd_shortcode_column' );			// 1/2
		add_shortcode( 'one-half', 'themeblvd_shortcode_column' );			// 1/2 (depricated)
		add_shortcode( 'two_third', 'themeblvd_shortcode_column' );			// 2/3
		add_shortcode( 'two-third', 'themeblvd_shortcode_column' );			// 2/3 (depricated)
		add_shortcode( 'three_fourth', 'themeblvd_shortcode_column' );		// 3/4
		add_shortcode( 'three-fourth', 'themeblvd_shortcode_column' );		// 3/4 (depricated)
		add_shortcode( 'one_fifth', 'themeblvd_shortcode_column' );			// 1/5
		add_shortcode( 'one-fifth', 'themeblvd_shortcode_column' );			// 1/5 (depricated)
		add_shortcode( 'two_fifth', 'themeblvd_shortcode_column' );			// 2/5
		add_shortcode( 'two-fifth', 'themeblvd_shortcode_column' );			// 2/5 (depricated)
		add_shortcode( 'three_fifth', 'themeblvd_shortcode_column' );		// 3/5
		add_shortcode( 'three-fifth', 'themeblvd_shortcode_column' );		// 3/5 (depricated)
		add_shortcode( 'four_fifth', 'themeblvd_shortcode_column' );		// 4/5
		add_shortcode( 'four-fifth', 'themeblvd_shortcode_column' );		// 4/5 (depricated)
		add_shortcode( 'three_tenth', 'themeblvd_shortcode_column' );		// 3/10
		add_shortcode( 'three-tenth', 'themeblvd_shortcode_column' );		// 3/10 (depricated)
		add_shortcode( 'seven_tenth', 'themeblvd_shortcode_column' );		// 7/10
		add_shortcode( 'seven-tenth', 'themeblvd_shortcode_column' );		// 7/10 (depricated)
		add_shortcode( 'clear', 'themeblvd_shortcode_clear' );				// Clear row
		
		// Components
		add_shortcode( 'icon_list', 'themeblvd_shortcode_icon_list' );
		add_shortcode( 'button', 'themeblvd_shortcode_button' );
		add_shortcode( 'box', 'themeblvd_shortcode_box' );
		add_shortcode( 'alert', 'themeblvd_shortcode_alert' );
		add_shortcode( 'divider', 'themeblvd_shortcode_divider' );
		add_shortcode( 'progress_bar', 'themeblvd_shortcode_progress_bar' );
		add_shortcode( 'popup', 'themeblvd_shortcode_popup' );
		
		// Inline Elements
		add_shortcode( 'icon', 'themeblvd_shortcode_icon' );
		add_shortcode( 'icon_link', 'themeblvd_shortcode_icon_link' );
		add_shortcode( 'highlight', 'themeblvd_shortcode_highlight' );
		add_shortcode( 'dropcap', 'themeblvd_shortcode_dropcap' );
		add_shortcode( 'label', 'themeblvd_shortcode_label' );
		add_shortcode( 'vector_icon', 'themeblvd_shortcode_vector_icon' );
		
		// Tabs, Toggles, and Accordion
		add_shortcode( 'tabs', 'themeblvd_shortcode_tabs' );
		add_shortcode( 'accordion', 'themeblvd_shortcode_accordion' );
		add_shortcode( 'toggle', 'themeblvd_shortcode_toggle' );
		
		// Sliders
		add_shortcode( 'post_grid_slider', 'themeblvd_shortcode_post_grid_slider' );
		add_shortcode( 'post_list_slider', 'themeblvd_shortcode_post_list_slider' );
		
		// Display Posts
		add_shortcode( 'post_grid', 'themeblvd_shortcode_post_grid' );
		add_shortcode( 'post_list', 'themeblvd_shortcode_post_list' );
		add_shortcode( 'mini_post_grid', 'themeblvd_shortcode_mini_post_grid' );
		add_shortcode( 'mini_post_list', 'themeblvd_shortcode_mini_post_list' );
	

/**
 * Display warning telling the user they must have a 
 * theme with Theme Blvd framework v2.2+ installed in 
 * order to run this plugin.
 *
 * @since 1.0.0
 */

function themeblvd_shortcodes_warning() {
	global $current_user;
	// DEBUG: delete_user_meta( $current_user->ID, 'tb_shortcode_no_framework' )
	if( ! get_user_meta( $current_user->ID, 'tb_shortcode_no_framework' ) ){
		echo '<div class="updated">';
		echo '<p>'.__( 'You currently have the "Theme Blvd Shortcodes" plugin activated, however you are not using a theme with Theme Blvd Framework v2.2+, and so this plugin will not do anything.', 'themeblvd_shortcodes' ).'</p>';
		echo '<p><a href="?tb_nag_ignore=tb_shortcode_no_framework">'.__('Dismiss this notice', 'themeblvd').'</a> | <a href="http://www.themeblvd.com" target="_blank">Visit ThemeBlvd.com</a></p>';
		echo '</div>';
	}
}

/**
 * Dismiss an admin notice.
 *
 * An admin notice could be setup something like this:
 *
 * function my_admin_notice(){
 *		global $current_user;
 * 		if( ! get_user_meta( $current_user->ID, 'example_message' ) ){
 * 			echo '<div class="updated">';
 *			echo '<p>Some message to the user.</p>';
 * 			echo '<p><a href="?tb_nag_ignore=example_message">Dismiss this notice</a></p>';
 *			echo '</div>';
 * 		}
 * }
 * add_action( 'admin_notices', 'my_admin_notice' );
 *
 * @since 1.0.6
 */

function themeblvd_shortcodes_disable_nag() {
	global $current_user;
    if ( isset( $_GET['tb_nag_ignore'] ) )
         add_user_meta( $current_user->ID, $_GET['tb_nag_ignore'], 'true', true );
}

/**
 * Content formatter.
 *
 * @since 1.0.0
 *
 * @param sting $content Content
 */

function themeblvd_content_formatter( $content ) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );
	foreach( $pieces as $piece ) {
		if( preg_match( $pattern_contents, $piece, $matches ) )
			$new_content .= $matches[1];
		else
			$new_content .= shortcode_unautop( wpautop( wptexturize( $piece ) ) );
	}
	return $new_content;
}

/**
 * Display divider.
 *
 * @since 2.0.0
 *
 * @param array $type style of divider
 * @return string $output HTML output for divider
 */

if( ! function_exists( 'themeblvd_divider' ) ) {
	function themeblvd_divider( $type ) {
		$output = '<div class="divider divider-'.$type.'"></div>';
		return $output;
	}
}

/**
 * Get additional classes for elements.
 *
 * @since 2.0.3
 *
 * @param string $element Element to get classes for
 * @param boolean $start_space Whether there should be a space at start
 * @param boolean $end_space Whether there should be a space at end
 * @param string $type Type of element (only relevant if there is a filter added utilizing it)
 * @param array $options Options for element (only relevant if there is a filter added utilizing it)
 * @return array $classes Classes for element.
 */
 
if( ! function_exists( 'themeblvd_get_classes' ) ) {
	function themeblvd_get_classes( $element, $start_space = false, $end_space = false, $type = null, $options = array() ) {
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
		$all_classes = apply_filters( 'themeblvd_element_classes', $all_classes, $type, $options );
		if( isset( $all_classes[$element] ) && $all_classes[$element] ) {
			if( $start_space ) $classes .= ' ';
			$classes .= $all_classes[$element];
			if( $end_space ) $classes .= ' ';
		}
		return $classes;
	}
}

/**
 * Display post list or post grid
 *
 * @since 2.0.0
 *
 * @param array $options all options for posts
 * @param string $type Type of posts, grid or list
 * @param string $current_location Current location of element, featured or primary
 */

if( ! function_exists( 'themeblvd_posts' ) ) {
	function themeblvd_posts( $options, $type, $current_location ) {
		global $content; // $options['content']
		global $size; // $options['thumbs']
		global $counter;
		global $columns;
		global $location;
		global $post;
		global $more;
		
		$custom_query = '';
		$location = $current_location;
		
		// Setup query args
		if( isset( $options['query'] ) && $options['query'] ) {
			// Custom query string
			$custom_query = html_entity_decode( $options['query'] );
			$args = $custom_query;
		} else {
			// Generated query args
			$args = themeblvd_get_posts_args( $options, $type );
		}

		// Config before query string
		if( $type == 'grid' ) {
			$columns = $options['columns'];
			$rows = $options['rows'];
			$size = themeblvd_grid_class( $columns );
		} else {
			$options['content'] == 'default' ? $content = themeblvd_get_option( 'blog_content', null, 'content' ) : $content = $options['content'];
			$options['thumbs'] == 'default' ? $size = themeblvd_get_option( 'blog_thumbs', null, 'small' ) : $size = $options['thumbs'];
		}
		
		if ( $options['include'] ) {
			$args['include'] = $options['include'];
		}
		
		// Apply filters
		$args = apply_filters( 'themeblvd_posts_args', $args, $options, $type, $current_location );
		
		// Get posts
		$posts = get_posts( $args );
		
		// Adjust offset if neccesary
		if( ! $custom_query ) {
			if( $args['numberposts'] == -1 && $args['offset'] > 0 ) {
				$i = 0;
				while ( $i < $args['offset'] ) {
					unset( $posts[$i] );
					$i++;
				}
			}
		}

		// Start the loop
		echo '<div class="post_'.$type.'">';
		if ( ! empty( $posts ) ) {
			if( $type == 'grid' ) {
				// Loop for post grid (i.e. Portfolio)
				$counter = 1;
				$number_of_posts = count( $posts );
				foreach ( $posts as $post ) {
					setup_postdata( $post );
					if( $counter == 1 ) themeblvd_open_row();
					get_template_part( 'content', 'grid' );
					if( $counter % $columns == 0 ) themeblvd_close_row();
					if( $counter % $columns == 0 && $number_of_posts != $counter ) themeblvd_open_row();
					$counter++;
				}
				wp_reset_postdata();
				if( $number_of_posts % $columns != 0 ) themeblvd_close_row();
			} else {
				// Loop for post list (i.e. Blog)
				foreach ( $posts as $post ) { 
					setup_postdata( $post );
					$more = 0;
					get_template_part( 'content', 'list' );
				}
				wp_reset_postdata();
			}
		} else {
			echo '<p>'.themeblvd_get_local( 'archive_no_posts' ).'</p>';
		}
		echo '</div><!-- .post_'.$type.' (end) -->';
		// Show link
		if( $options['link'] )
			echo '<a href="'.$options['link_url'].'" target="'.$options['link_target'].'" title="'.$options['link_text'].'" class="lead-link">'.$options['link_text'].'</a>';
			
	}
}

/**
 * Setup arguement to pass into get_posts()
 *
 * @since 2.0.0
 *
 * @param array $options All options for query string
 * @param string $type Type of posts setup, grid or list
 * @param boolean $slider Whether or no this is a slider
 * @return array $args Arguments to get passed into get_posts()
 */

if( ! function_exists( 'themeblvd_get_posts_args' ) ) { 
	function themeblvd_get_posts_args( $options, $type, $slider = false ) {
		$args = array();
		
		// Number of posts
		if( $type == 'grid' && ! $slider ) {
			if( $options['rows'] )
				$args['numberposts'] = $options['rows']*$options['columns'];
		} else {
			if( $options['numberposts'] ) 
				$args['numberposts'] = $options['numberposts'];
		}
		if( ! isset( $args['numberposts'] ) )
			$args['numberposts'] = -1;
	
		// Additional args
		if( isset( $options['orderby'] ) ) $args['orderby'] = $options['orderby'];
		if( isset( $options['order'] ) ) $args['order'] = $options['order'];
		if( isset( $options['offset'] ) ) $args['offset'] = intval( $options['offset'] );

		return $args;
	}
}

/**
 * Get posts per page for grid of posts.
 *
 * @since 2.0.0
 *
 * @param string $type Type of grid, template or builder
 * @param string $columns Number of columns to use
 * @param string $columns Number of rows to use
 * @return int $posts_per_page The number of posts per page for a grid.
 */

if( ! function_exists( 'themeblvd_posts_page_page' ) ) {
	function themeblvd_posts_page_page( $type, $columns = null, $rows = null ) {
		if( $type == 'template' ) {
			global $post;
			$possible_column_nums = array( 1, 2, 3, 4, 5 );
			$posts_per_page = null;
			// Columns
			$columns = get_post_meta( $post->ID, 'columns', true );
			if( ! in_array( intval($columns), $possible_column_nums ) )
				$columns = apply_filters( 'themeblvd_default_grid_columns', 3 );
			// Rows
			$rows = get_post_meta( $post->ID, 'rows', true );
			if( ! $rows )
				$rows = apply_filters( 'themeblvd_default_grid_columns', 4 );
		}
		// Posts per page
		$posts_per_page = $columns * $rows;
		return $posts_per_page;
	}
}

/**
 * Get the class to be used for a grid column.
 *
 * @since 2.0.0
 *
 * @param int $columns Number of columns
 * @return string $class class for each column of grid
 */

if( ! function_exists( 'themeblvd_grid_class' ) ) {
	function themeblvd_grid_class( $columns ) {
		$class = 'grid_3'; // default
		if( $columns == 1 )
			$class = 'grid_12';
		else if( $columns == 2 )
			$class = 'grid_6';
		else if( $columns == 3 )
			$class = 'grid_4';
		else if( $columns == 4 )
			$class = 'grid_3';
		else if( $columns == 5 )
			$class = 'grid_fifth_1';
		return $class;
	}
}

/**
 * Open a row in a post grid
 *
 * @since 2.0.0
 */

if( ! function_exists( 'themeblvd_open_row' ) ) {
	function themeblvd_open_row() {
		echo apply_filters( 'themeblvd_open_row', '<div class="grid-row">' );
	}
}

/**
 * Close a row in a post grid
 *
 * @since 2.0.0
 */

if( ! function_exists( 'themeblvd_close_row' ) ) {
	function themeblvd_close_row() {
		echo apply_filters( 'themeblvd_close_row', '<div class="clear"></div></div><!-- .grid-row (end) -->' );
	}
}
