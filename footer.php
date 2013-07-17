<?php
/**
 * The template for displaying the footer.
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/images/edd-sitting.png" />
			<div class="columns clearfix">
				<div class="dev-blog col">
					<?php eddwp_get_latest_post(); ?>
				</div><!-- /.dev-blog -->

				<div class="forum col">
					<h4>Need help?</h4>
					<p>If you ever need help with EDD, there is a complete <a href="">Support Forum</a> available where you can get your support questions answered. If you'd like to report a bug or have ideas for how to improve the plugin, please post it to our <a href="">GitHub Issue Tracker</a>.</p>
				</div><!-- /.forum -->

				<div class="consultants col">
					<h4>Trusted Consultants</h4>
					<p>We maintain a list of consultants that we recommend working with when it comes to managed support, customization, and setup help. </p>
					<p><a href="">View Consultants...</a></p>
				</div><!-- /.consultants -->
			</div><!-- /.columns -->

			<div class="social clearfix">
				<ul>
					<li class="facebook"><a href="https://www.facebook.com/eddwp"></a></li>
					<li class="twitter"><a href="https://twitter.com/eddwp"></a></li>
					<li class="gplus"><a href="https://plus.google.com/111409933861760783237/posts"></a></li>
					<li class="github"><a href="https://github.com/easydigitaldownloads/Easy-Digital-Downloads/"></a></li>
				</ul>
			</div><!-- /.social -->

			<p class="copyright">Copyright &copy; 2013, Easy Digital Downloads. A project by <a href="<?php echo esc_url( '/team/' ); ?>">Pippin Williamson and Friends</a>.</p>
		</div><!-- .container -->
	</footer><!-- #colophon -->

	<?php wp_footer(); ?>
</body>
</html>