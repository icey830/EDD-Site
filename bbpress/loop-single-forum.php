<?php
/**
 * Forums Loop - Single Forum
 *
 * @author    Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>
<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>
	<li class="bbp-forum-info clearfix">
		<?php do_action( 'bbp_theme_before_forum_title' ); ?>
		<a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>
		<?php
		do_action( 'bbp_theme_after_forum_title' );
		do_action( 'bbp_theme_before_forum_description' );
		?>
		<div class="bbp-forum-content"><?php bbp_forum_content(); ?></div>

		<?php
		do_action( 'bbp_theme_after_forum_description' );
		do_action( 'bbp_theme_before_forum_sub_forums' );
		bbp_list_forums( array(
			'show_reply_count'	=> false,
			'show_topic_count'	=> false
		) );
		do_action( 'bbp_theme_after_forum_sub_forums' );
		bbp_forum_row_actions();
		?>
	</li>
	<div class="clear"></div>
</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->