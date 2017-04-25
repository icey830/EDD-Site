<?php
/**
 * main sidebar
 */
?>
	<aside class="sidebar">
		<?php
			$args = array(
				'tabindex' => 30
			);
			eddwp_newsletter_form( $args );

			dynamic_sidebar( 'blog-sidebar' );
		?>
	</aside><!-- /.sidebar -->