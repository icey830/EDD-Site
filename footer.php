<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package EDD
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/images/edd-sitting.png" />
			<div class="columns clearfix">
				<div class="dev-blog col">
					<?php eddwp_get_latest_post(); ?>
				</div>

				<div class="forum col">
					<h4>Need help?</h4>
					<p>If you ever need help with EDD, there is a complete <a href="">Support Forum</a> available where you can get your support questions answered. If you'd like to report a bug or have ideas for how to improve the plugin, please post it to our <a href="">GitHub Issue Tracker</a>.</p>
				</div>

				<div class="consultants col">
					<h4>Trusted Consultants</h4>
					<p>We maintain a list of consultants that we recommend working with when it comes to managed support, customization, and setup help. </p>
					<p><a href="">View Consultants...</a></p>
				</div>
			</div>

			<div class="social clearfix">
				<ul>
					<li class="facebook"><a href="#"></a></li>
					<li class="twitter"><a href="#"></a></li>
					<li class="gplus"><a href="#"></a></li>
					<li class="github"><a href="#"></a></li>
				</ul>
			</div>

			<?php
			eddwp_get_footer_nav();
			?>
			<p class="copyright">Copyright &copy; 2013, Easy Digital Downloads. A project by <a href="<?php echo esc_url( '/team/' ); ?>">Pippin Williamson and Friends</a>.</p>
		</div><!-- .container -->
	</footer><!-- #colophon -->

	<?php wp_footer(); ?>
</body>
</html>