<?php
/**
 * main sidebar
 */
?>
	<aside class="sidebar">
		<?php
			$args = array(
				'tabindex' => 30,
				'description_content' => 'Enter your name and email address below to join <strong>70,000+</strong> subscribers in receiving Easy Digital Downloads news and updates!',
			);
			eddwp_newsletter_form( $args );

			dynamic_sidebar( 'blog-sidebar' );

			eddwp_related_posts_by_tag();
		?>
	</aside><!-- /.sidebar -->