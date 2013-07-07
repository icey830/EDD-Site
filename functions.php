<?php
/**
 * Easy Digital Downloads
 *
 * This file adds all the core features of the Easy Digital Downloads theme.
 *
 * /\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\
 * 
 * 1. Theme Setup
 * 2. Stylesheets and JavaScript Files
 * 3. Comments Template
 * 4. Features
 * 5. Custom Actions/Filters
 * 6. Widgets
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

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
	add_image_size( 'featured-showcase', 460, 330, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'edd' ),
	) );
}
add_action( 'after_setup_theme', 'edd_theme_setup' );

/* ----------------------------------------------------------- *
 * 2. Stylesheets and JavaScript Files
 * ----------------------------------------------------------- */

/**
 * Enqueue scripts and styles
 */
function edd_register_theme_scripts() {
	$deps = array( 'roboto-font' );

	if ( function_exists( 'is_bbpress' ) && is_bbpress() || is_page( 'support' ) ) {
		$deps[] = 'bbp-default-bbpress';
	}

	wp_register_style( 'roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:400,300,500' );
	wp_register_style( 'edd-style', get_stylesheet_directory_uri() . '/style.css', $deps, '1.0' );
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
		
	wp_dequeue_style( 'bbp-default-bbpress' );
	wp_dequeue_style( 'bbp_private_replies_style' );
	wp_dequeue_style( 'staff-list-custom-css' );
	wp_dequeue_style( 'notifications' );
	wp_dequeue_style( 'sharedaddy' );
	wp_dequeue_style( 'edd-styles' );

	if ( function_exists( 'is_bbpress' ) && is_bbpress() || is_page( 'support' ) ) {
		wp_enqueue_style( 'bbp-default-bbpress', trailingslashit( bbPress()->themes_url . 'default' ) . 'css/bbpress.css', array(), bbp_get_version(), 'screen' );
	}
	
	if ( is_page( 'your-account' ) ) {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/lib/bootstrap.min.css', array( ), '1.0', false );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/lib/bootstrap.min.js', array( 'jquery' ), '1.0', false );
	}
}
add_action( 'wp_enqueue_scripts', 'edd_register_theme_scripts' );

/* ----------------------------------------------------------- *
 * 3. Comments Template
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
		 	</div>
	
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="alert"><?php echo apply_filters( 'eddwp_comment_awaiting_moderation', __( 'Your comment is awaiting moderation.', 'edd' ) ); ?></p>
			<?php endif; ?>

			<?php
			
			comment_text();
			
			comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<p>Reply</p>' ) ) );
			
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

	comment_form( array( 'fields' => apply_filters( 'comment_form_default_fields', $fields ) ) );
}

/* ----------------------------------------------------------- *
 * 4. Features
 * ----------------------------------------------------------- */

/**
 * Register widgetized area and update sidebar with default widgets
 */
function edd_register_theme_sidebars() {
	register_sidebar( array(
		'name'		  => __( 'Blog Sidebar', 'edd' ),
		'id'			  => 'blog-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	  => '</h3>'
	) );

	register_sidebar( array(
		'name'		  => __( 'Forums Sidebar', 'edd' ),
		'id'			  => 'forum-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	  => '</h3>',
	) );

	register_sidebar( array(
		'name'		  => __( 'Documentation Sidebar', 'edd' ),
		'id'			  => 'documentation-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'	  => '</h3>',
	) );
}
add_action( 'widgets_init', 'edd_register_theme_sidebars' );

/* ----------------------------------------------------------- *
 * 5. Custom Actions/Filters
 * ----------------------------------------------------------- */

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function edd_wp_title( $title, $sep ) {
	global $paged, $page, $post;

	$title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );

	if ( is_search() || isset( $_GET['extension_s'] ) ) {
		if ( is_search() ) $search_term = get_query_var( 's' );
		
		if ( isset( $_GET['extension_s'] ) ) $search_term = $_GET['extension_s'];

		$title = __( 'Search Results For' , 'edd' ) . ' ' . $search_term . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_home() || is_front_page() ) {
		$title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
	} elseif ( is_page() ) {
		$title = strip_tags( htmlspecialchars_decode( get_the_title( $post->ID ) ) ) . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_404() ) {
		$title = __( '404 - Nothing Found', 'edd' ) . ' | ' . get_bloginfo( 'name' );
	} elseif ( is_author() ) {
		$title = get_userdata( get_query_var( 'author' ) )->display_name . ' | ' . __( 'Author Archive', 'edd' )	. ' | ' . get_bloginfo( 'name' );
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
	$query = new WP_Query( array( 'posts_per_page' => 1 ) );

	while ( $query->have_posts() ) {
		$query->the_post();
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
		printf( '<h4>%s</h4>', get_the_title() );
		the_excerpt();
		printf( '<a href="%1$s">%2$s</a>', get_permalink(), __( 'Read More...', 'edd' ) );
		add_filter( 'the_excerpt', 'sharing_display', 19 );
	}
}

function eddwp_get_footer_nav() {  }

/**
 * Extensions shortcode callback function
 */
function eddwp_extensions_cb() {
	echo '<div class="extensions clearfix">';
	$extensions =	new WP_Query( array( 'post_type' => 'extension', 'nopaging' => true, 'orderby' => 'rand' ) );
	while ( $extensions ->have_posts() ) {
		$extensions->the_post();
		?>
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
		<?php
	}
	?>
	
	<?php
	echo '</div>';
}
add_shortcode( 'extensions', 'eddwp_extensions_cb' );

/**
 * Add the rewrite tag for the extensions search
 */
function eddwp_add_rewrite_tags() {
	add_rewrite_tag( '%extension_s%', '([^/]+)' );
}
add_action( 'init', 'eddwp_add_rewrite_tags' );

/**
 * Process the rewrite rules added for the extension search and make sure that the
 * correct template is loaded when the extension search is initiated.
 */
function eddwp_process_rewrites() {
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

	if ( isset( $_GET['extension_s'] ) ) {
		$classes[] = 'extension-search';
	}

	if ( is_page( 'support' ) ) {
		$classes[] = 'bbpress';
	}
	
	if ( is_single() && 'post' == get_post_type( $post->ID ) ) {
		$classes[] = 'blog';
	}
	
	if ( is_page( 'your-account' ) && ! is_user_logged_in() ) {
		$classes[] = 'login';
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

	$wp_admin_bar->add_node(
		array(
			'id'	 =>	'eddwp_support',
			'title'	 =>	__( 'Support Tickets' ),
			'href'	 =>	'/support/dashboard/'
		)
	);

	$args = array(
		'post_type'  => 'topic',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key'   => '_bbps_topic_status',
				'value' => '1',
			),
			array(
				'key'   => 'bbps_topic_assigned',
				'value' => $user_ID,
			)
		),
		'posts_per_page' => -1
	);
	
	$assigned_tickets = new WP_Query( $args );

	$wp_admin_bar->add_node(
		array(
			'id'	 =>	'assigned_tickets',
			'parent' => 'eddwp_support',
			'title'	 =>	__( 'Assigned Tickets (' . $assigned_tickets->post_count . ')' ),
			'href'	 =>	'/support/dashboard/#your_tickets'
		)
	);

	wp_reset_postdata();

	$args = array(
		'post_type'  => 'topic',
		'meta_key'   => '_bbps_topic_status',
		'meta_value' => '1',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);

	$o = new WP_Query( $args );

	$wp_admin_bar->add_node(
		array(
			'id'	 =>	'unresolved_tickets',
			'parent' => 'eddwp_support',
			'title'	 =>	__( 'Unresolved Tickets (' . $o->post_count . ')' ),
			'href'	 =>	'/support/dashboard/'
		)
	);
	
	wp_reset_postdata();
}
add_action( 'admin_bar_menu', 'eddwp_support_admin_bar', 999 );

/* ----------------------------------------------------------- *
 * 6. Widgets
 * ----------------------------------------------------------- */

/**
 * This class registers and handles the display of the newsletter signup form
 * widget in the sidebar.
 */
class SR_Newsletter_Signup_Form extends WP_Widget {
	public function __construct() {
		parent::WP_Widget( false, __( 'MailChimp Signup Form (Customized for EDD)', 'edd' ) );
	}
	
	public function widget($args, $instance) {	
		extract( $args, EXTR_SKIP );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$list_id = strip_tags( $instance['list_id'] );
		$message = esc_attr( $instance['message'] );
		
		global $post;
		
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo sr_mc_form('', $list_id, $message);

		echo $after_widget;
	}

	public function update($new_instance, $old_instance) {		
		$instance = $old_instance;

		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['list_id'] = strip_tags( $new_instance['list_id'] );
		$instance['message'] = esc_attr( $new_instance['message'] );

		return $instance;
	}

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

function eddwp_is_extension_third_party() {
	global $post;
	
	$terms = get_the_terms( $post->ID, 'extension_category' );

	if ( has_term( '3rd Party', 'extension_category', $post->ID ) ) {
		return false;
	} else {
		return true;
	}
}

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
 * Toggles
 */
function eddwp_shortcode_toggle( $atts, $content = null ) {		
	$last = '';

	if ( isset( $atts[0] ) && trim( $atts[0] ) == 'last') $last = ' changelog-last';

	$default = array(
        'title' => ''
    );

    extract( shortcode_atts( $default, $atts ) );

    $content = wpautop( do_shortcode( stripslashes( $content ) ) );

	$output  = '<div class="changelog' . $last . '">';
	$output .= sprintf( '<h2>%s</h2>', $title );
	$output .= '<div class="changelog-content">' . $content . '</div>';
	$output .= '</div>';

    return $output;
}
add_shortcode( 'toggle', 'eddwp_shortcode_toggle' );