<?php
/**
 * Search 
 *
 * @author    Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>
<form role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
	<div>
		<input type="hidden" name="action" value="bbp-search-request" />
		<input placeholder="Search..." tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" />
		<input tabindex="<?php bbp_tab_index(); ?>" class="submit-button" type="submit" id="bbp_search_submit" value="Search" />
	</div>
</form>