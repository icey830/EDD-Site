<?php
/**
 * Archive Forum Content Part
 *
 * @author    Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>

<div id="bbpress-forums">
	<?php	
	
	do_action( 'bbp_template_before_forums_index' );

	if ( bbp_has_forums() )
		bbp_get_template_part( 'loop',     'forums'    );
	else
		bbp_get_template_part( 'feedback', 'no-forums' );

	do_action( 'bbp_template_after_forums_index' );
	?>
</div>