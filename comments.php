<?php
/**
 * The template for displaying comments.
 *
 * @package EDD
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="clearfix">
		<?php if ( have_comments() ) : ?>

		<h3>Comments</h3>
		<div id="comments-list">
			<ol class="comment-list">
				<?php
					$args = array(
						'type'        => 'comment',
						'avatar_size' => 48,
						'callback'    => 'edd_comment',
					);

					wp_list_comments( $args );
				?>
			</ol><!-- /.comment-list -->
		</div><!-- /#comments-list -->
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div id="comment-navigation">
			<nav class="navigation comment-nav" role="navigation">
				<?php previous_comments_link( '<i class="icon-chevron-left"></i>' . __( 'Previous Comments', 'flat' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments', 'flat' ) . '<i class="icon-chevron-right"></i>'); ?>
			</nav><!-- /.comment-nav -->
		</div><!-- /#comment-naviation -->
		<?php endif; ?>
		
		<?php
		endif; // have_comments()
		
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		?>
		<p class="no-comments">Comments are closed.</p>
		<?php
		}
		?>
	</div><!-- /#comments -->

	<?php eddwp_comment_form(); ?>