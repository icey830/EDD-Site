<?php
/**
 * Single Forum Content Part
 *
 * @author    Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>

<div id="bbpress-forums">
	<?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => 'Subscribe to email notifications for new tickets posted to this forum', 'unsubscribe' => 'Unsubscribe from this forum' ) ); ?>
	<?php
	bbp_breadcrumb( array(
		'before' => '<div class="bbp-breadcrumb clearfix"><p>',
	) );

	do_action( 'bbp_template_before_single_forum' );

	if ( post_password_required() ) :
		bbp_get_template_part( 'form', 'protected' );
	else :
		if ( bbp_has_forums() )
			bbp_get_template_part( 'loop', 'forums' );

		if ( ! bbp_is_forum_category() && bbp_has_topics() ) :
			bbp_get_template_part( 'loop',       'topics'    ); 
			bbp_get_template_part( 'pagination', 'topics'    );
			bbp_get_template_part( 'form',       'topic'     );
		elseif ( ! bbp_is_forum_category() ) :
			bbp_get_template_part( 'feedback',   'no-topics' );
			bbp_get_template_part( 'form',       'topic'     );
		endif;
	endif;
	
	do_action( 'bbp_template_after_single_forum' );
	?>

</div>