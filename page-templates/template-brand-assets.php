<?php
/**
 * Template Name: Brand Assets
 */

get_header();
the_post();
?>

	<section id="full-width-page" class="full-width-page clearfix">
		<div class="the-content clearfix">

			<article class="entry">
				<div class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<p>Thanks for your interest in Easy Digital Downloads!</p>
				<p>Below are a few guidelines for using our brand resources, please take a moment to familiarize yourself with them. <br/>You can download individual assets in each section, or you can download everything all at once below.</p>
				<p>
					<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/edd-brand-assets.zip'; ?>" class="button">Download all assets</a>
				</p>
				<section class="brand-assets">
					<h2>Colors</h2>
					<p>These are the brand colors for Easy Digital Downloads. Copy the HEX codes below.</p>
					<div class="color">
						<div class="color-1">
							<p>#1d2428</p>
						</div>
					</div>
					<div class="color">
						<div class="color-2">
							<p>#2794da</p>
						</div>
					</div>
					<div class="color">
						<div class="color-3">
							<p>#eeeeee</p>
						</div>
					</div>
				</section>
				<section class="brand-assets">
					<h2>Logos</h2>
					<p>You can use our logo in either a horizontal or vertical layout. Shown below are the possible variations you may use.</p>
					<div id="logos">
						<div class="logo">
							<div class="logo-1">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-dark.svg'; ?>" />
							</div>
							<p>
								Download <a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-dark.ai'; ?>" target="_blank">.ai</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-dark.eps'; ?>" target="_blank">.eps</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-dark.svg'; ?>" target="_blank">.svg</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-dark.png'; ?>" target="_blank">.png</a>
							</p>
						</div>
						<div class="logo">
							<div class="logo-2">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-light.svg'; ?>" />
							</div>
							<p>
								Download <a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-light.ai'; ?>" target="_blank">.ai</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-light.eps'; ?>" target="_blank">.eps</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-light.svg'; ?>" target="_blank">.svg</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/horizontal/logo-edd-light.png'; ?>" target="_blank">.png</a>
							</p>
						</div>
						<div class="logo">
							<div class="logo-3">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-dark.svg'; ?>" />
							</div>
							<p>
								Download <a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-dark.ai'; ?>" target="_blank">.ai</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-dark.eps'; ?>" target="_blank">.eps</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-dark.svg'; ?>" target="_blank">.svg</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-dark.png'; ?>" target="_blank">.png</a>
							</p>
						</div>
						<div class="logo">
							<div class="logo-4">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-light.svg'; ?>" />
							</div>
							<p>
								Download <a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-light.ai'; ?>" target="_blank">.ai</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-light.eps'; ?>" target="_blank">.eps</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-light.svg'; ?>" target="_blank">.svg</a>,
								<a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/logos/vertical/logo-edd-light.png'; ?>" target="_blank">.png</a>
							</p>
						</div>
					</div>
				</section>
				<section class="brand-assets">
					<h2>Meet Ed</h2>
					<p>Ed is the mascot for Easy Digital Downloads. Treat him with care!</p>
					<div class="mascots">
						<div class="mascot">
							<p><a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/mascots/ed-1-large.png'; ?>" class="button" target="_blank">Download</a></p>
							<div class="mascot-1">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/mascots/ed-1.png'; ?>" />
							</div>
						</div>
						<div class="mascot">
							<p><a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/mascots/ed-2-large.png'; ?>" class="button" target="_blank">Download</a></p>
							<div class="mascot-1">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/mascots/ed-2.png'; ?>" />
							</div>
						</div>
						<div class="mascot">
							<p><a href="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/mascots/ed-3-large.png'; ?>" class="button" target="_blank">Download</a></p>
							<div class="mascot-1">
								<img src="<?php echo get_stylesheet_directory_uri() . '/assets/brand-assets/mascots/ed-3.png'; ?>" />
							</div>
						</div>
					</div>
				</section>
			</article>

		</div>
	</section>
	<?php

get_footer();
