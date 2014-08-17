<?php
/**
 * Single Topic Content Part
 *
 * @author    Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>

<div id="bbpress-forums">
	<?php
	bbp_breadcrumb( array(
		'before' => '<div class="bbp-breadcrumb clearfix"><p>',
	) );

	bbp_topic_favorite_link();
	bbp_topic_subscription_link();

	do_action( 'bbp_template_before_single_topic' );

	if ( post_password_required() ) {
		bbp_get_template_part( 'form', 'protected' );
	} else {
		bbp_topic_tag_list();

		if ( bbp_show_lead_topic() )
			bbp_get_template_part( 'content', 'single-topic-lead' );

		if ( bbp_has_replies() ) {
			bbp_get_template_part( 'loop',       'replies' );
			bbp_get_template_part( 'pagination', 'replies' );
		} // end if

		bbp_get_template_part( 'form', 'reply' );
	} // end if

	do_action( 'bbp_template_after_single_topic' );
	?>
</div>