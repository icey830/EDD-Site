<?php
/**
 * Template Name: Self Help Support
 *
 * Template for displaying the self help support form
 */
get_header();
the_post();
	?>
	<section class="support-page self-help-support-page main clearfix">

		<div class="support-search-area page-section-white full-width">
			<div class="inner">
				<div class="support-search">
					<?php the_content(); ?>
				</div>
			</div>
		</div>

	</section>
	<?php
get_footer();
