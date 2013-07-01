<?php
/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */
?>

<div id="bbpress-forums">
	<div class="bbp-search-form">
		<?php bbp_get_template_part( 'form', 'search' ); ?>
	</div>

	<?php	
	bbp_breadcrumb( array(
		'before' => '<div class="bbp-breadcrumb clearfix"><p>',
	) );
	
	do_action( 'bbp_template_before_forums_index' );

	if ( bbp_has_forums() )
		bbp_get_template_part( 'loop',     'forums'    );
	else
		bbp_get_template_part( 'feedback', 'no-forums' );

	do_action( 'bbp_template_after_forums_index' );
	?>
</div>