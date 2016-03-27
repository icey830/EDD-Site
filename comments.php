<?php
/**
 * template for displaying comments
 */

$response_count = get_comments_number();

if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
	die ( __( 'This file cannot be loaded directly.', 'edd' ) );
endif;

if ( post_password_required() ) :
	?>
	<div id="comments">
		<h3 class="nopassword">
			<?php _e( 'This post is password protected. Enter the password to view comments.', 'edd' ); ?>
		</h3>
	</div><!-- #comments -->
	<?php
	return;
endif;


if ( have_comments() && 0 != eddwp_get_comments_only_count( $response_count ) ) :
	?>
	<div id="comments" class="clearfix">

		<h3 class="comments-title">Comments</h3>
		<div id="comments-list" class="clearfix">
			<?php
				$args = array(
					'style'       => 'div',
					'type'        => 'comment',
					'avatar_size' => 48,
					'callback'    => 'edd_comment',
				);
				wp_list_comments( $args );
			?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div id="comment-navigation">
				<nav class="navigation comment-nav" role="navigation">
					<?php
						previous_comments_link( '&larr; ' . __( 'Previous Comments', 'edd' ) );
						next_comments_link( __( 'Newer Comments', 'edd' ) . ' &rarr;');
					?>
				</nav>
			</div>
		<?php endif; ?>
	</div>
	<?php
endif;

eddwp_comment_form();