<?php
/**
 * let's phase these out and eventually delete this file (review each function thoroughly)
 */


/**
 * Checks if an extension is hosted off site (only used in sidebar-download.php)
 */
function eddwp_is_external_extension( $post_id = 0 ) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	return (bool) get_post_meta( $post_id, 'ecpt_is_external', true );
}
// Gets the external extension URL
function eddwp_get_external_extension_url() {
	return get_post_meta( get_the_ID(), 'ecpt_externalurl', true );
}


/**
 * Extensions shortcode callback function
 */
function eddwp_extensions_cb() {
	echo '<div class="extensions clearfix">';

	$extensions = new WP_Query(
		array(
			'post_type' => 'download',
			'nopaging'  => true,
			'orderby'   => 'rand'
		)
	);

	while ( $extensions ->have_posts() ) : $extensions->the_post();
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
	endwhile;

	echo '</div>';
}
add_shortcode( 'extensions', 'eddwp_extensions_cb' );


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
 * Divider
 */
function eddwp_shortcode_divider( $atts, $content = null ) {
	return '';
}
add_shortcode( 'divider', 'eddwp_shortcode_divider' );


/**
 * Clear Row
 */
function eddwp_shortcode_clear() {
	return '<div class="clear"></div>';
}
add_shortcode( 'clear', 'eddwp_shortcode_clear' );


/**
 * random theme related shortcodes
 */
function eddwp_theme_preview( $atts, $content = null ) {
	return '<div class="theme-preview">' . $content . '</div>';
}
add_shortcode( 'theme-preview', 'eddwp_theme_preview' );

function eddwp_theme_meta( $atts, $content = null ) {
	return '<div class="theme-meta">' . $content . '</div>';
}
add_shortcode( 'theme-meta', 'eddwp_theme_meta' );


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
