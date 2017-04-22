<?php
/**
 * theme-wide footer
 */


/**
 * post IDs for conditionals... use IDs for forward compatibility
 *
 * 130 - Support Registration
 * 635 - My Account
 */
?>

	<?php if ( ! is_page_template( 'page-templates/template-checkout.php' ) && ! is_page( 'subscribe' ) && ! is_page_template( 'page-templates/template-barebones.php' ) ) : ?>
		<div id="footer-newsletter" class="page-section-darkblue full-width">
			<div class="inner">
				<div class="newsletter-content clearfix">
					<?php
						$args = array(
							'heading_content'     => 'Easy Digital Downloads Email Newsletter',
							'description_content' => 'Be the first to know about the latest updates and exclusive promotions from Easy Digital Downloads.',
							'secure'              => false
						);
						eddwp_newsletter_form( $args );
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<footer id="colophon" class="footer-area page-section-darkblue full-width" role="contentinfo">
		<div class="inner">
			<div class="site-footer">
				<?php if ( ! is_page_template( 'page-templates/template-checkout.php' ) && ! is_page_template( 'page-templates/template-barebones.php' ) ) : ?>
					<?php if ( ! is_404() && ! is_page( 'subscribe' ) ) : ?>
						<img class="sitting-edd" src="<?php echo get_template_directory_uri(); ?>/images/mascot/edd-sitting.png" />
					<?php endif; ?>
					<?php if ( ! is_page( array( 130 ) ) ) : ?>
						<div class="footer-columns flex-container clearfix">
							<div class="footer-latest-posts flex-three">
								<?php eddwp_get_latest_post( 5 ); ?>
							</div>

							<div class="footer-support flex-three">
								<h4>Need help?</h4>
								<p>We encourage you to contact our <a href="<?php echo home_url( '/support/' ); ?> ">support team</a> where you can always get your questions answered. If you'd like to report a bug or have ideas for how to improve the plugin, please post it to our <a href="http://github.com/easydigitaldownloads/Easy-Digital-Downloads/issues">GitHub Issue Tracker</a>.</p>
								<h6>Trusted Consultants</h6>
								<p>We maintain a list of consultants that we recommend working with when it comes to managed support, customization, and setup help. For additional help with EDD, consider these <a href="<?php echo home_url( '/consultants/' ); ?>">trusted consultants</a>.</p>
							</div>

							<div class="footer-consultants flex-three">
								<h4>Our Friends</h4>
								<h6>AffiliateWP</h6>
								<p>The best affiliate marketing plugin for WordPress. <a href="https://affiliatewp.com/?ref=743">Start your affiliate program today</a>.</p>
								<h6>Restrict Content Pro</h6>
								<p>A full-featured, powerful membership solution for WordPress. <a href="https://restrictcontentpro.com/?ref=4579">Make your content exclusive</a>.</p>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<div class="footer-site-details flex-container clearfix">
					<div class="copyright flex-two">
						<?php if ( ! is_page_template( 'page-templates/template-checkout.php' ) && ! is_page_template( 'page-templates/template-barebones.php' ) ) : ?>
							<h4>Company Information</h4>
						<?php endif; ?>
						<p><span class="edd-copyright">Copyright &copy; <?php echo date( 'Y' ); ?> &middot; Easy Digital Downloads</span>
							<?php

								// do not show on checkout
								if ( ! is_page_template( 'page-templates/template-checkout.php' ) && ! is_page_template( 'page-templates/template-barebones.php' ) ) :
									?>
									&nbsp;&middot;&nbsp;a project by <a href="<?php echo home_url( '/the-crew/' ); ?>">Pippin Williamson and Friends</a>.
									<?php
									// EDD social profiles
									$args = array(
										'title'  => 'Connect with Easy Digital Downloads. ',
										'wrap'   => false,
										'square' => true,
									);
									eddwp_social_networking_profiles( $args );
								endif;
							?>
						</p>
						<?php if ( ! is_page_template( 'page-templates/template-checkout.php' ) && ! is_page_template( 'page-templates/template-barebones.php' ) ) : ?>
							<a class="godaddy-partner" href="https://garage.godaddy.com/wordpress-plugin-partner-program/directory/?cvosrc=advocacy.evangelism.WP3" rel="nofollow">
								<img src="https://garage.godaddy.com/wp-content/uploads/badges/godaddy-plugin-partner-program-badge.svg" title="GoDaddy Plugin Program Partner" alt="GoDaddy Plugin Program Partner"/>
							</a>
						<?php endif; ?>
					</div>
					<?php if ( ! is_page_template( 'page-templates/template-checkout.php' ) && ! is_page_template( 'page-templates/template-barebones.php' ) ) : ?>
						<div class="site-info flex-two">
							<?php if ( has_nav_menu( 'footer' ) ) : ?>
								<h4>Additional Resources</h4>
								<nav id="footer-menu" class="navigation-footer">
									<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
								</nav>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
