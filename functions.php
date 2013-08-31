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
 * 1. Theme Setup
 * 2. Includes
 * 3. Stylesheets and JavaScript Files
 * 4. Comments Template
 * 5. Features
 * 6. Custom Actions/Filters
 * 7. Widgets
 * 8. Shortcodes
 * 9. Extensions feed
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
	add_image_size( 'featured-showcase', 460, 330, true );
	add_image_size( 'extension', 180, 150, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'edd' ),
	) );
}
add_action( 'after_setup_theme', 'edd_theme_setup' );

/* ----------------------------------------------------------- *
 * 2. Includes
 * ----------------------------------------------------------- */

include( dirname(__FILE__) . '/includes/class-fragment-cache.php' );


/* ----------------------------------------------------------- *
 * 3. Stylesheets and JavaScript Files
 * ----------------------------------------------------------- */

/**
 * Enqueue scripts and styles
 */
function edd_register_theme_scripts() {
	$deps = array( 'roboto-font' );

	if( function_exists( 'is_bbpress' ) ) {
		if ( is_bbpress() || is_page( 'support' ) ) {
			$deps[] = 'bbp-default-bbpress';
		}
	}

	if ( is_page( 'your-account' ) ) {
		$deps[] = 'bootstrap';
	}

	wp_register_style(  'roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:400,300,500' );
	wp_register_style(  'edd-style',    get_stylesheet_directory_uri() . '/style.css',                 $deps,                '1.0'   );
	wp_register_style(  'font-awesome', get_template_directory_uri()   . '/css/lib/font-awesome.css',  array( 'edd-style' ), '3.2.1' );
	wp_register_style(  'normalize',    get_template_directory_uri()   . '/css/lib/normalize.css',     array( ),             '2.1.2' );
	wp_register_style(  'bootstrap',    get_template_directory_uri()   . '/css/lib/bootstrap.min.css', array( ),             '1.0'   );

	wp_enqueue_style(   'normalize'    );
	wp_enqueue_style(   'roboto-font'  );
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

	wp_dequeue_style( 'bbp-default-bbpress' );
	wp_dequeue_style( 'bbp_private_replies_style' );
	wp_dequeue_style( 'staff-list-custom-css' );
	wp_dequeue_style( 'sharedaddy' );
	wp_dequeue_style( 'edd-styles' );

	if ( function_exists( 'is_bbpress' ) && is_bbpress() || is_page( 'support' ) ) {
		wp_enqueue_style( 'bbp-default-bbpress', trailingslashit( bbPress()->themes_url . 'default' ) . 'css/bbpress.css', array(), bbp_get_version(), 'screen' );
	}

	if ( is_page( 'your-account' ) ) {
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_script( 'bootstrap-js' );
	}

	global $wp_styles;
	array_unshift( $wp_styles->queue, 'edd-styles' );

	// Load the main stylesheet at the end so overrides are easier
	wp_enqueue_style( 'edd-style' );
}
add_action( 'wp_enqueue_scripts', 'edd_register_theme_scripts' );

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
			'fields' => apply_filters( 'comment_form_default_fields', $fields )
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
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function edd_wp_title( $title, $sep ) {
	global $paged, $page, $post;

	/* Default title */
	$title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );

	/* Search */
	if ( is_search() || isset( $_GET['extension_s'] ) ) :
		if ( is_search() )
			$search_term = get_query_var( 's' );

		if ( isset( $_GET['extension_s'] ) )
			$search_term = sanitize_text_field( trim( stripslashes( $_GET['extension_s'] ) ) );

		$title = __( 'Search Results For' , 'edd' ) . ' ' . $search_term . ' | ' . get_bloginfo( 'name' );
	/* Homepage */
	elseif ( is_home() || is_front_page() ) :
		$title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
	/* Single page */
	elseif ( is_page() ) :
		$title = strip_tags( htmlspecialchars_decode( get_the_title( $post->ID ) ) ) . ' | ' . get_bloginfo( 'name' );
	/* 404 Page */
	elseif ( is_404() ) :
		$title = __( '404 - Nothing Found', 'edd' ) . ' | ' . get_bloginfo( 'name' );
	/* Author Archive */
	elseif ( is_author() ) :
		$title = get_userdata( get_query_var( 'author' ) )->display_name . ' | ' . __( 'Author Archive', 'edd' )	. ' | ' . get_bloginfo( 'name' );
	/* Category Archive */
	elseif ( is_category() ) :
		$title = single_cat_title( '', false ) . ' | ' . __( 'Category Archive', 'edd' ) . ' | ' . get_bloginfo( 'name' );
	/* Tag Archive */
	elseif ( is_tag() ) :
		$title = single_tag_title( '', false ) . ' | ' . __( 'Tag Archive', 'edd' ) . ' | ' . get_bloginfo( 'name' );
	/* Single Blog Post */
	elseif ( is_single() ) :
		$post_title = the_title_attribute( 'echo=0' );

		if ( ! empty( $post_title ) )
			$title = $post_title . ' | ' . get_bloginfo( 'name' );
	endif;

	/* Feed (RSS|Atom) */
	if ( is_feed() )
		return $title;

	/* Pagination */
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

	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	if ( preg_match( '/Firefox/i', $user_agent ) ) {
		$classes[] = 'firefox';
	}

	if ( isset( $_GET['extension_s'] ) )
		$classes[] = 'extension-search';

	if ( is_page( 'support' ) )
		$classes[] = 'bbpress';

	if ( ( is_single() && 'post' == get_post_type( $post->ID ) ) || is_search() )
		$classes[] = 'blog';

	if ( is_page( 'your-account' ) && ! is_user_logged_in() )
		$classes[] = 'login';

	if ( is_category() || is_tag() || is_author() || is_day() || is_month() || is_year() )
		$classes[] = 'blog';

	if ( function_exists( 'bbp_is_single_user' ) && bbp_is_single_user() )
		$classes[] = 'full-width no-sidebar';

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
 * Remove the default purchase link that's appended after `the_content`
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );

/**
 * Disable WordPress Admin Bar on Mobile
 */
if ( wp_is_mobile() ) {
	show_admin_bar( false );
}

/**
 * Send a Pushover Notification when a moderator is assigned to a topic
 */
function eddwp_send_pushover_notification_on_assignment() {
	if ( isset( $_POST['bbps_support_topic_assign'] ) ) {

		if( ! function_exists( 'ckpn_send_notification' ) )
			return;

		$user_id  = absint( $_POST['bbps_assign_list'] );
		$topic    = bbp_get_topic( $_POST['bbps_topic_id'] );

		if ( $user_id > 0 && $user_id != get_current_user_id() ) {
			$title = __( 'Easy Digital Downloads: A forum topic has been assigned to you', 'eddwp' );
			$message = sprintf( __( 'You have been assigned to %1$s by another moderator', 'eddwp' ), $topic->post_title );
			$user_push_key = get_user_meta( $user_id, 'ckpn_user_key', true );

			if( $user_push_key ) {
				$url       = $topic->guid;
				$url_title = __( 'View Topic', 'eddwp' );

				$args = array(
					'title' => $title,
					'message' => $message,
					'user' => $user_push_key,
					'url' => $url,
					'url_title' => $url_title
				);

				ckpn_send_notification( $args );
			}
		}
	}
}
add_action( 'init', 'eddwp_send_pushover_notification_on_assignment' );


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

	if( empty( $post_id ) )
		$post_id = get_the_ID();

	return (bool) get_post_meta( $post_id, 'ecpt_is_external', true );
}

/**
 * Gets the external extension URL
 */
function eddwp_get_external_extension_url() {
	return get_post_meta( get_the_ID(), 'ecpt_externalurl', true );
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
 * Content formatter.
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

function eddwp_register_extensions_feed() {
	add_feed( 'extensions', 'eddwp_extensions_feed' );
}
add_action( 'init', 'eddwp_register_extensions_feed' );

function eddwp_extensions_feed() {
	load_template( STYLESHEETPATH . '/extension-feed.php');
}
add_action( 'do_feed_extensions', 'eddwp_extensions_feed', 10, 1 );

function eddwp_feed_rewrite( $wp_rewrite ) {
	$feed_rules = array(
		'feed/(.+)' => 'index.php?feed=' . $wp_rewrite->preg_index( 1 ),
		'(.+).xml'  => 'index.php?feed=' . $wp_rewrite->preg_index( 1 )
	);

	$wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}
add_filter( 'generate_rewrite_rules', 'eddwp_feed_rewrite' );

function eddwp_feed_request($qv) {
	if ( isset( $qv['feed'] ) && 'extensions' == $qv['feed'] )
		$qv['post_type'] = 'extension';

	return $qv;
}
add_filter( 'request', 'eddwp_feed_request' );

function eddwp_feed_query( $query ) {
	if ( $query->is_feed && $query->query_vars['feed'] == 'extensions' ) {
		$query->set( 'posts_per_page', 200 );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'eddwp_feed_query', 999 );


/**
 * Creates the toggle for the action links dropdown
 */
function edd_bbp_action_links_dropdown() {
	$reply_id = bbp_get_reply_id();

	// If post is not a reply, return
	if ( ! bbp_is_reply( $reply_id ) && ! bbp_is_topic( $reply_id ) )
		return;

	// Make sure user can edit this reply
	if ( ! current_user_can( 'edit_reply', $reply_id ) )
		return;

	// If topic is trashed, do not show admin links
	if ( bbp_is_topic_trash( bbp_get_reply_topic_id( $reply_id ) ) )
		return;

?>
	<button class="bbp-action-links-dropdown-toggle" data-toggle="dropdown"><span class="filter-option pull-left">Actions</span> <i class="icon icon-angle-down"></i></button>
	<i class="icon-caret-up icon"></i>
	<?php
}
add_action( 'bbp_theme_before_reply_admin_links', 'edd_bbp_action_links_dropdown' );