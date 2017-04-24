<?php
/**
 * custom template tags
 */


/* ----------------------------------------------------------- *
 * Comments
 * ----------------------------------------------------------- */

/**
 * Template for comments and pingbacks.
 */
function edd_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>

	<div <?php comment_class( 'clearfix' ); ?> id="comment-<?php comment_ID(); ?>">
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
							'reply_text' => '<span class="comment-reply-link">Reply</span>',
						)
					)
				);
			?>
		</div>
	<?php
}


/**
 * custom comment form
 */
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
			'comment_notes_after' => '<p class="comments-support-notice notice">If you need assistance, please open a <a href="https://easydigitaldownloads.com/support/">support ticket</a>.</p><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		)
	);
}


/* ----------------------------------------------------------- *
 * Singulars
 * ----------------------------------------------------------- */

/**
 * post top byline
 */
function eddwp_post_byline() {
	global $post;
	?>
	<div class="post-meta post-meta-byline clearfix">

		<?php
			printf( '<span class="entry-author author vcard"><span class="author-avatar">%1$s</span> by <strong>%2$s</strong></span> &middot; ',
				get_avatar( get_the_author_meta( 'ID', $post->post_author ), 25, null ),
				esc_html( get_the_author() )
			);


			?>
			<span class="entry-date">published on <span><?php echo get_the_date(); ?></span></span>
			<?php

		?>

	</div><!-- /.post-meta-->
	<?php
}

/**
 * post byline just date
 */
function eddwp_post_byline_lite() {
	?>
	<div class="post-meta post-meta-lite clearfix">
		<span class="entry-date">published on <span><?php echo get_the_date(); ?></span></span>
	</div>
	<?php
}

/**
 * post terms
 */
function eddwp_post_terms() {
	if ( is_single() ) :
		eddwp_author_box();
	endif;
	?>
	<div class="post-meta post-terms clearfix">

		<?php

			echo '<span class="entry-terms">';

				$categories = get_the_category_list( __( ', ', 'edd' ) );
				$tags = get_the_tag_list( '', __( ', ', 'edd' ) );

				if ( $categories ) :
					?>
					<span class="entry-categories">Filed under <?php echo $categories; echo $tags ? '' : '.'; ?></span>
					<?php
				endif;

				if ( $tags ) :
					?>
					<span class="entry-tags"> with focus on <?php echo $tags; ?></span>.
					<?php
				endif;

			echo '</span>';
		?>
	</div>
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
			<div class="edd-author-bio vcard author post-author">
				<h4 class="edd-author-title">Written by <span class="fn"><?php echo get_the_author_meta( 'display_name' ); ?></span></h4>
				<?php if ( $author_url ) { ?>
					<span class="edd-author-url"><a class="url" href="<?php echo esc_url( $author_url ); ?>" target="_blank"><i class="fa fa-link"></i></a></span>
				<?php } ?>
				<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
			</div>
		</div>
	<?php
}


/**
 * blog pagination
 */
function eddwp_blog_paginate_links() {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>
		<div id="page-nav">
			<ul class="paged">
				<?php
				if ( get_next_posts_link() ) :
					?>
					<li class="previous">
						<?php next_posts_link( __( '<span class="nav-previous meta-nav">&larr; Older Posts</span>', 'edd' ) ); ?>
					</li>
					<?php
				endif;

				if ( get_previous_posts_link() ) :
					?>
					<li class="next">
						<?php previous_posts_link( __( '<span class="nav-next meta-nav">Newer Posts &rarr;</span>', 'edd' ) ); ?>
					</li>
					<?php
				endif;
				?>
			</ul>
		</div>
		<?php
	endif;
}


/* ----------------------------------------------------------- *
 * Product Display
 * ----------------------------------------------------------- */

/**
 * Featured image for downloads grid output
 */
function eddwp_downloads_grid_thumbnail() {
	global $post;

	// replace old featured image programmatically until fully removed
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
	$old_default = home_url( '/wp-content/uploads/2013/07/defaultpng.png' );

	if( has_post_thumbnail() && $image[0] !== $old_default ) {
		the_post_thumbnail( 'download-grid-thumb', array( 'class' => 'download-grid-thumb' ) );
	} else {
		echo '<img class="download-grid-thumb wp-post-image" src="' . get_template_directory_uri() . '/images/featured-image-default.png" alt="' . get_the_title() . '" />';
	}
}


/**
 * product pagination
 */
function eddwp_paginate_links() {
	global $wp_query;

	$big = 999999999;

	if ( ! function_exists( 'edd_get_current_page_url' ) ) {
		return;
	}

	$url = edd_get_current_page_url();

	if ( false === strpos( $url, '?' ) ) {
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
 * adjusted product titles (mainly to respect branding)
 */
function eddwp_adjust_product_title( $title, $id = 0 ) {
	global $post;

	if ( ! is_object( $post ) ) {
		return $title;
	}

	if( is_page( array( 160, 161 ) ) ) {
		return $title;
	}

	switch ( $title ) {

		case 'EDD Dropbox File Store' :
			$title = 'File Store for Dropbox';
			break;

		case 'Dropbox Sync' :
			$title = 'Sync for Dropbox';
			break;

		case 'Mail Chimp' :
			$title = 'MailChimp';
			break;
	}

	return $title;
}
add_filter( 'the_title', 'eddwp_adjust_product_title', 9, 2 );


/**
 * Recommended Products shortcode
 */
function eddwp_rp_shortcode( $count = 6 ) {
	if ( is_user_logged_in() ) :

		// adjust/readjust the returned results
		add_filter( 'edd_users_purchased_products_payments', 'eddwp_alter_purchased_products_payment_count', 10, 1 );
		$downloads = edd_get_users_purchased_products();
		remove_filter( 'edd_users_purchased_products_payments', 'eddwp_alter_purchased_products_payment_count', 10, 1 );

		if ( ! empty( $downloads ) ) {

			// list the product IDs for the returned purchases
			$purchased = array();
			foreach ( $downloads as $ids ) {
				$purchased[] = $ids->ID;
			}

			// pad results with Stripe, Recurring Payments, FES, Software Licensing, MailChimp
			$ids = array_unique( array_merge( $purchased, array( 167,28530,54874,4916,746 ) ) );
			$ids = implode( ',', $ids );
		} else {

			// Stripe, Recurring Payments, FES, Software Licensing, MailChimp
			$ids = '167,28530,54874,4916,746';
		}
	else :
		$ids = '167,28530';
	endif;

	return do_shortcode( '[recommended_products ids="' . $ids . '" user="true" count="' . $count . '"]' );
}


/* ----------------------------------------------------------- *
 * Misc
 * ----------------------------------------------------------- */

/**
 * Universal Newsletter Sign Up Form
 */
function eddwp_newsletter_form( $args = array() ) {

	$args = array(
		'heading'             => isset( $args['heading'] ) ? $args['heading'] : true,
		'heading_content'     => isset( $args['heading_content'] ) ? $args['heading_content'] : 'Email Newsletter',
		'description'         => isset( $args['description'] ) ? $args['description'] : true,
		'description_content' => isset( $args['description_content'] ) ? $args['description_content'] : 'Be the first to know about the latest updates and exclusive promotions from Easy Digital Downloads by submitting your information below.',
		'notes'               => isset( $args['notes'] ) ? $args['notes'] : true,
		'notes_content'       => isset( $args['notes_content'] ) ? $args['notes_content'] : '<i class="fa fa-lock"></i>Your email address is secure. We will never send you spam. You may unsubscribe at any time.',
		'tabindex'            => isset( $args['tabindex'] ) ? $args['tabindex'] : 10,
	);

	?>
	<div class="subscription-form-wrap">
		<?php if ( $args['heading'] ) { ?>
			<h3 class="newsletter-title"><?php echo $args['heading_content']; ?></h3>
		<?php } ?>
		<div class="edd-newsletter-content-wrap">
			<?php if ( $args['description'] ) { ?>
				<p class="newsletter-description"><?php echo $args['description_content']; ?></p>
			<?php } ?>
			<?php gravity_form( eddwp_newsletter_form_id(), false, false, false, '', true, $args['tabindex'] ); ?>
			<?php if ( $args['notes'] ) { ?>
				<div class="subscription-notes">
					<?php echo $args['notes_content']; ?>
				</div>
			<?php } ?>
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
 * query upcoming commissions
 */
function eddc_get_upcoming_commissions() {
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
 * This function is used in the footer template to get the latest blog post.
 */
function eddwp_get_latest_post( $count = 3 ) {
	$items = get_posts( array( 'posts_per_page' => $count ) );
	?>
	<h4>Latest Blog Posts</h4>
	<ul>
		<?php
			foreach ( $items as $item ) :
				printf( '<li class="latest-posts"><a href="%1$s">%2$s</a></li>',
					get_permalink( $item->ID ),
					$item->post_title
				);
			endforeach;
		?>
	</ul>
	<?php
}


/**
 * Output EDD social networking profile icons
 */
function eddwp_social_networking_profiles( $args = array() ) {
	echo $args['wrap'] ? '<div class="edd-social-profiles">' : '';
	$square = $args['square'] ? '-square' : '';
		?>
			<?php if ( $args['title'] ) : ?>
				<span class="edd-social-profiles-title">
					<?php echo $args['title']; ?>
				</span>
			<?php endif; ?>
			<a class="social-icon" href="https://www.facebook.com/eddwp">
				<i class="fa fa-facebook<?php echo $square; ?>"></i>
			</a>
			<a class="social-icon" href="https://twitter.com/eddwp">
				<i class="fa fa-twitter<?php echo $square; ?>"></i>
			</a>
			<a class="social-icon" href="https://plus.google.com/111409933861760783237/posts">
				<i class="fa fa-google-plus<?php echo $square; ?>"></i>
			</a>
			<a class="social-icon" href="https://github.com/easydigitaldownloads/Easy-Digital-Downloads/">
				<i class="fa fa-github<?php echo $square; ?>"></i>
			</a>
		<?php
	echo $args['wrap'] ? '</div>' : '';
}

/**
 * Get the total number of non-third party extensions
 */
function eddwp_get_number_of_downloads() {
 	$total = get_transient( 'eddwp_get_number_of_downloads' );
	if ( empty( $total ) ) {
		$download_count = wp_count_posts( 'download' )->publish;
		$exclude        = 0;

		$bundles    = get_term( 1524, 'download_category' ); // Bundles
		if ( ! empty( $bundles ) && ! is_wp_error( $bundles ) ) {
			$exclude += $bundles->count;
		}

		$thirdparty = get_term( 1536, 'download_category' ); // Third Party
		if ( ! empty( $thirdparty ) && ! is_wp_error( $thirdparty ) ) {
			$exclude += $thirdparty->count;
		}

		$total = $download_count - $exclude;
		set_transient( 'eddwp_get_number_of_downloads', $total, 60 * 60 * 24 );
	}
	return $total;
}

/**
 * standard login form template
 */
function eddwp_login_form() {
	?>
	<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
		<fieldset>
				<input type="text" placeholder="Username" id="user_login" size="20" value="" name="log" />
				<input type="password" placeholder="Password" id="user_pass" size="20" value="" name="pwd" />
		</fieldset>

		<div class="clearfix">
			<input type="checkbox" name="rememberme" id="rememberme" value="forever" checked="checked" />
			<label for="rememberme">Remember my password</label>
			<input type="submit" class="edd-submit button blue" name="wp-submit" value="Sign In" />
			<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
		</div>
		<a class="lost-password-link" href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="Lost Password">Lost Password</a>
	</form><!-- /#loginform -->
	<?php
}


/**
 * blog categories output
 */
function eddwp_blog_categories() {
	?>
	<div class="blog-categories clearfix">

		<ul>
			<li class="cat-item"><a href="<?php echo home_url( 'blog' ); ?>">All Posts</a>
			<?php
			wp_list_categories( array(
				'orderby'    => 'count',
				'order'      => 'DESC',
				'show_count' => 1,
				'title_li'   => '',
				'show_count' => false
			) );
			?>
		</ul>

	</div>
	<?php
}