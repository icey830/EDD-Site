<?php
/**
 * The Sidebar containing the forum widget area.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>
	<aside class="sidebar">
		<aside id="google-search-form-sidebar" class="widget widget_display_search">
			<h3 class="widget-title">Search Forums</h3>
			<?php eddwp_google_custom_search(); ?>
		</aside>
		<?php dynamic_sidebar( 'forum-sidebar' ); ?>
	</aside><!-- /.sidebar -->