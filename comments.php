<?php
/**
 * The template for displaying comments.
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */
?>

<?php
	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( __( 'This file cannot be loaded directly.', 'edd' ) );
	} // end if
?>

<?php if ( post_password_required() ) { ?>
	<div id="comments">
		<h3 class="nopassword"><?php _e( 'This post is password protected. Enter the password to view comments.', 'edd' ); ?></h3>
	</div><!-- #comments -->
	<?php return; ?>
<?php } // end if	?>


<?php if ( have_comments() ) { ?>
	<div id="comments" class="clearfix">

		<?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
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
		<?php } // end if ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>

		<div id="comment-navigation">
			<nav class="navigation comment-nav" role="navigation">
				<?php previous_comments_link( '<i class="icon-chevron-left"></i>' . __( 'Previous Comments', 'edd' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments', 'edd' ) . '<i class="icon-chevron-right"></i>'); ?>
			</nav><!-- /.comment-nav -->
		</div><!-- /#comment-naviation -->

		<?php } // end if ?>
	</div><!-- /#comments -->

<?php } else { ?>

	<?php if ( comments_open() ) { ?>
		<div id="no-comments" class="clearfix">
			<p class="title"><?php _e( 'No Comments', 'edd' ); ?></p>
			<p><?php _e( 'Be the first to start the conversation.', 'edd' ); ?></p>
		</div><!-- /#no-comments -->
	<?php } // end if ?>

<?php } // end if ?>

<?php eddwp_comment_form(); ?>