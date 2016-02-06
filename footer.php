<?php
/**
 * The template for displaying the footer.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<?php if ( ! is_404() ) : ?>
				<img class="sitting-edd" src="<?php echo get_template_directory_uri(); ?>/images/edd-sitting.png" />
			<?php endif; ?>
			<?php if ( ! is_page( array( 'checkout', 130, 635 ) ) ) : ?>
				<div class="columns clearfix">
					<div class="dev-blog col">
						<?php eddwp_get_latest_post(); ?>
					</div><!-- /.dev-blog -->

					<div class="forum col">
						<h4>Need help?</h4>
						<p>If you ever need help with EDD, you are encouraged to use our <a href="<?php echo home_url( '/support/' ); ?> ">support system</a> where you can always get your support questions answered. If you'd like to report a bug or have ideas for how to improve the plugin, please post it to our <a href="http://github.com/easydigitaldownloads/Easy-Digital-Downloads/issues">GitHub Issue Tracker</a>.</p>
					</div><!-- /.forum -->

					<div class="consultants col">
						<h4>Trusted Consultants</h4>
						<p>We maintain a list of consultants that we recommend working with when it comes to managed support, customization, and setup help. If you are looking for additional help with EDD, consider these <a href="<?php echo home_url( '/consultants/' ); ?>">trusted consultants</a>.</p>
					</div><!-- /.consultants -->
				</div><!-- /.columns -->

				<div class="site-info">
					<?php if ( has_nav_menu( 'footer' ) ) : ?>
						<nav id="footer-menu" class="navigation-footer">
							<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
						</nav><!-- /#primary -->
					<?php endif; ?>

					<div class="social clearfix">
						<ul>
							<li class="facebook"><a href="https://www.facebook.com/eddwp"></a></li>
							<li class="twitter"><a href="https://twitter.com/eddwp"></a></li>
							<li class="gplus"><a href="https://plus.google.com/111409933861760783237/posts"></a></li>
							<li class="github"><a href="https://github.com/easydigitaldownloads/Easy-Digital-Downloads/"></a></li>
						</ul>
					</div><!-- /.social -->

					<a class="godaddy-partner" href="https://garage.godaddy.com/wordpress-plugin-partner-program/directory/?cvosrc=advocacy.evangelism.WP3" rel="nofollow"><img src="https://garage.godaddy.com/wp-content/uploads/badges/godaddy-plugin-partner-program-badge.svg" title="GoDaddy Plugin Program Partner" alt="GoDaddy Plugin Program Partner"/></a>
				</div>

			<?php endif; ?>

			<p class="copyright">Copyright &copy; <?php echo date( 'Y' ); ?>, Easy Digital Downloads. <?php if( ! is_page( 'checkout' ) ) : ?>A project by <a href="<?php echo home_url( '/the-crew/' ); ?>">Pippin Williamson and Friends</a>.<?php endif; ?></p>
		</div><!-- .container -->
	</footer><!-- #colophon -->

	<?php wp_footer(); ?>
</body>
</html>