<?php
/**
 * Topics Loop
 *
 * @author    Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

do_action( 'bbp_template_before_topics_loop' );
?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics">
	<li class="bbp-header">
		<ul class="forum-titles">
			<li class="bbp-topic-title">Topic</li>
			<li class="bbp-topic-freshness">Freshness</li>
		</ul>
	</li><!-- /.bbp-header -->
	<li class="bbp-body">
		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>
			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>
		<?php endwhile; ?>
	</li><!-- /.bbp-body -->
	<li class="bbp-footer">
		<div class="tr">
			<p><span class="td colspan<?php echo ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</span></p>
		</div><!-- /.tr -->
	</li><!-- /.bbp-footer -->
</ul><!-- /#bbp-forum-<?php bbp_forum_id(); ?> -->
<?php do_action( 'bbp_template_after_topics_loop' ); ?>