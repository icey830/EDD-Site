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
		bbp_list_forums();
		do_action( 'bbp_theme_after_forum_sub_forums' );
		bbp_forum_row_actions();
		?>
	</li>
	<div class="clear"></div>
	<li class="bbp-forum-freshness">
		<?php
		do_action( 'bbp_theme_before_forum_freshness_link' );
		bbp_forum_freshness_link();
		do_action( 'bbp_theme_after_forum_freshness_link' );
		do_action( 'bbp_theme_before_topic_author' );
		?>
		<p class="bbp-topic-meta"><span class="bbp-topic-freshness-author">&nbsp;by<?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'size' => 14 ) ); ?></span></p>
		<?php do_action( 'bbp_theme_after_topic_author' ); ?>
	</li>
</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->