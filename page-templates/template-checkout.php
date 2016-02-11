<?php
/**
 * Template Name: Checkout
 *
 * Doesn't have to be a template but useful if we need it.
 */

get_header();
the_post();
	?>

	<div id="checkout-page-area" class="full-width clearfix">
		<div class="inner">
			<section class="checkout-content">

				<article <?php post_class( 'clearfix' ); ?> id="post-<?php echo get_the_ID(); ?>">
					<div class="entry-header">
						<h3 class="entry-title">Checkout Cart</h3>
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