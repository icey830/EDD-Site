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

	<?php if ( ( function_exists( 'edd_is_checkout' ) && ! edd_is_checkout() ) ) : ?>
		<div id="footer-newsletter" class="page-section-darkblue full-width">
			<div class="inner">
				<div class="newsletter-content clearfix">
					<h3 class="footer-section-title">Easy Digital Downloads <strong>Email Newsletter</strong></h3>
					<p>Be the first to know about the latest updates and exclusive promotions from Easy Digital Downloads.</p>
					<form id="pmc_mailchimp" class="clearfix" action="" method="post">
						<div class="nl-name clearfix">
							<input class="newsletter-name nl-first-name" name="pmc_fname" id="pmc_fname" type="text" placeholder="First name">
							<input class="nl-last-name" name="pmc_lname" id="pmc_lname" type="text" placeholder="Last name">
						</div>
						<div class="nl-email">
							<input class="newsletter-email" name="pmc_email" id="pmc_email" type="email" placeholder="Email address">
							<input class="newsletter-submit" type="submit" value="Sign me up!">
						</div>
						<input type="hidden" name="redirect" value="https://easydigitaldownloads.com/">
						<input type="hidden" name="action" value="pmc_signup">
						<input type="hidden" name="pmc_list_id" value="be2b495923">
					</form>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<footer id="colophon" class="footer-area page-section-darkblue full-width" role="contentinfo">
		<div class="inner">
			<div class="site-footer">
				<?php if ( ! is_404() && ( function_exists( 'edd_is_checkout' ) && ! edd_is_checkout() ) ) : ?>
					<img class="sitting-edd" src="<?php echo get_template_directory_uri(); ?>/images/edd-sitting.png" />
				<?php endif; ?>
				<?php if ( ( function_exists( 'edd_is_checkout' ) && ! edd_is_checkout() ) && ! is_page( array( 130 ) ) ) : ?>
					<div class="footer-columns flex-container clearfix">
						<div class="footer-latest-posts flex-three">
							<?php eddwp_get_latest_post( 5 ); ?>
						</div>

						<div class="footer-support flex-three">
							<h4>Need help?</h4>
							<p>If you ever need help with EDD, you are encouraged to use our <a href="<?php echo home_url( '/support/' ); ?> ">support system</a> where you can always get your support questions answered. If you'd like to report a bug or have ideas for how to improve the plugin, please post it to our <a href="http://github.com/easydigitaldownloads/Easy-Digital-Downloads/issues">GitHub Issue Tracker</a>.</p>
						</div>

						<div class="footer-consultants flex-three">
							<h4>Trusted Consultants</h4>
							<p>We maintain a list of consultants that we recommend working with when it comes to managed support, customization, and setup help. If you are looking for additional help with EDD, consider these <a href="<?php echo home_url( '/consultants/' ); ?>">trusted consultants</a>.</p>
						</div>
					</div>
				<?php endif; ?>

				<div class="footer-site-details flex-container clearfix">
					<div class="copyright flex-two">
						<?php if ( ( function_exists( 'edd_is_checkout' ) && ! edd_is_checkout() ) ) : ?>
							<h4>Additional Resources</h4>
						<?php endif; ?>
						<p><span class="edd-copyright">Copyright &copy; <?php echo date( 'Y' ); ?> &middot; Easy Digital Downloads</span>
							<?php

								// do not show on checkout
								if ( ( function_exists( 'edd_is_checkout' ) && ! edd_is_checkout() ) ) :
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
					</div>
					<?php if ( ( function_exists( 'edd_is_checkout' ) && ! edd_is_checkout() ) ) : ?>
					<div class="site-info flex-two">
						<?php if ( has_nav_menu( 'footer' ) ) : ?>
							<h4>Additional Resources</h4>
							<nav id="footer-menu" class="navigation-footer">
								<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
							</nav>
						<?php endif; ?>

						<a class="godaddy-partner" href="https://garage.godaddy.com/wordpress-plugin-partner-program/directory/?cvosrc=advocacy.evangelism.WP3" rel="nofollow">
							<img src="https://garage.godaddy.com/wp-content/uploads/badges/godaddy-plugin-partner-program-badge.svg" title="GoDaddy Plugin Program Partner" alt="GoDaddy Plugin Program Partner"/>
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>