<?php get_header(); ?>

<?php
/* ----------------------------- *
 * Hero
 * ----------------------------- */
?>
<div class="hero-container clearfix">
	<section class="hero clearfix">
		<div class="hero-inside">
			<div class="hero-text">
				<h1>Say hello to the world's easiest way to sell digital downloads through WordPress</h1>
				<h2>for free</h2>
				<p><a href="http://downloads.wordpress.org/plugin/easy-digital-downloads.latest-stable.zip" class="download-button"><i class="icon-cloud-download"></i> Download</a> <a href="https://easydigitaldownloads.com/demo/" class="download-button"><i class="icon-eye-open"></i> Demo</a></p>
			</div><!-- /.hero-text -->
			<img src="<?php echo get_template_directory_uri(); ?>/images/edd-standing.png" />
		</div><!-- .hero-inside -->
		<div id="video-container"></div><!-- #video-container -->
		<div id="video-complete">
			<div id="video-complete-inner">
					<a class="replay-button"><span class="button"></span> Replay</a>
				<a class="close-button"><span class="button"></span> Close</a>
			</div><!-- #video-complete-inner -->
		</div><!-- /#video-complete -->
	</section><!-- /.hero -->
</div><!-- /.hero-container -->

<?php get_footer(); ?>