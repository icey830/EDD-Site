<?php
/**
 * Template Name: Starter Package
 *
 * The template for displaying the Starter Package form (Gravity Forms).
 */
get_header();
the_post();
	?>
	<section id="starter-package" class="main clearfix">
		<article class="content clearfix">
			<div class="the-content clearfix">
				<div class="entry-header">
					<h1 class="entry-title">Jump-start your store with the <strong>EDD <?php the_title(); ?></strong></h1>
					<span class="entry-headline">Let's make this simple.</span>
					<div class="package-details clearfix">
						<p class="package-description">Easy Digital Downloads has over 250 extensions to choose from. Finding the ones you need for your store can be a difficult task. Use the form below to build a Starter Package from some of our most popular extensions.</p>
						<p class="package-discount">Purchase through this form and receive an automatic<span>40% Discount</span></p>
					</div>
				</div>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</article><!-- /.content -->
	</section><!-- /.main -->
	<?php
get_footer();