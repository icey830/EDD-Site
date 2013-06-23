<?php
/* Template Name: Showcase */
get_header();
?>

	<section class="main clearfix">
		<?php
		printf( '<h1>%s</h1>', get_the_title() );
		the_content();
		?>
	</section>

	<section class="showcase clearfix">
		<?php

		// Load showcases

		?>
	</section>

<?php get_footer(); ?>