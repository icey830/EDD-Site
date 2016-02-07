<?php
/**
 * Template Name: Landing Page
 *
 * The template for displaying single-column, centered landing pages.
 */
get_header();
the_post();
?>

	<section id="landing-page" class="landing clearfix">
		<article class="full-width-content clearfix">

			<div class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>

		</article>
	</section>
	<?php

get_footer();