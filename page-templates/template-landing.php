<?php
/**
 * Template Name: Landing Page
 *
 * The template for displaying single-column, centered landing pages.
 */

get_header();
the_post();
?>

	<div id="landing-page-area" class="full-width clearfix">
		<div class="inner">
			<section class="page-content">

				<article <?php post_class( 'clearfix' ); ?> id="post-<?php echo get_the_ID(); ?>">
					<div class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>

			</section>
		</div>
	</div>
	<?php

get_footer();