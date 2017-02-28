<?php
/**
 * Template Name: Support
 *
 * Template for displaying the support form guarded by docs search functionality
 */
get_header();
the_post();
	?>
	<section class="support-page main clearfix">

		<div class="support-search-area page-section-white full-width">
			<div class="inner">
				<div class="support-search">
					<?php if ( is_page( 'support' ) ) { ?>
						<h2 class="section-title-alt">Questions? Let us help.</h2>
					<?php } elseif ( is_page( 'pre-sale-question' ) ) { ?>
						<h2 class="section-title-alt">Pre-sale Questions</h2>
					<?php } elseif ( is_page( 'refund-request' ) ) { ?>
						<h2 class="section-title-alt">Refund Requests</h2>
					<?php } ?>
					<?php if ( ! is_page( 'pre-sale-question' ) ) { ?>
						<div class="support-section-wrap flex-container">
							<?php if ( is_page( 'support' ) ) { ?>
								<div class="support-section pre-sale-question-section special-section flex-three">
									<a href="<?php echo home_url( '/pre-sale-question/' ); ?>" class="support-section-link">
										<h4 class="support-section-title">Pre-sale Question?</h4>
										<p class="support-section-description">You are more than welcome to ask questions before committing.</p>
									</a>
								</div>
								<div class="support-section flex-three">
									<a href="http://docs.easydigitaldownloads.com/collection/168-getting-started" class="support-section-link">
										<h4 class="support-section-title">Getting Started</h4>
										<p class="support-section-description">Find everything you need to get Easy Digital Downloads up and running.</p>
									</a>
								</div>
								<div class="support-section flex-three">
									<a href="http://docs.easydigitaldownloads.com/collection/171-faqs" class="support-section-link">
										<h4 class="support-section-title">Frequently Asked Questions</h4>
										<p class="support-section-description">Perhaps you've encountered a common issue or have a quick question.</p>
									</a>
								</div>
								<div class="support-section flex-three">
									<a href="http://docs.easydigitaldownloads.com/collection/180-advanced" class="support-section-link">
										<h4 class="support-section-title">Advanced Documention</h4>
										<p class="support-section-description">Familiar with code? Use the advanced docs to dig deeper into Easy Digital Downloads.</p>
									</a>
								</div>
								<div class="support-section flex-three">
									<a href="http://docs.easydigitaldownloads.com/collection/139-extensions-themes" class="support-section-link">
										<h4 class="support-section-title">Extensions & Themes</h4>
										<p class="support-section-description">Everything you need to know about our extensions and themes.</p>
									</a>
								</div>
								<div class="support-section flex-three">
									<a href="http://docs.easydigitaldownloads.com/collection/174-developer-docs" class="support-section-link">
										<h4 class="support-section-title">Developer Documentation</h4>
										<p class="support-section-description">See all of Easy Digital Downloads' functions, classes, actions, filters, etc.</p>
									</a>
								</div>
								<!--
								<div class="support-section flex-three">
									<a href="http://docs.easydigitaldownloads.com/collection/292-server-config" class="support-section-link">
										<h4 class="support-section-title">Server Configuration</h4>
										<p class="support-section-description">View server-specific documentation for setup and configuration guides.</p>
									</a>
								</div>
								-->
							<?php } ?>
							<?php if ( is_page( 'refund-request' ) ) { ?>
								<div class="support-section flex-three">
									<a href="<?php echo home_url( '/support/' ); ?>" class="support-section-link">
										<h4 class="support-section-title">Need support?</h4>
										<p class="support-section-description">We're more than happy to provide assistance if you're having troubles.</p>
									</a>
								</div>
								<div class="support-section flex-three">
									<a href="http://docs.easydigitaldownloads.com/" class="support-section-link">
										<h4 class="support-section-title">Documentation</h4>
										<p class="support-section-description">Perhaps one last look at the documentation can resolve your issue?</p>
									</a>
								</div>
								<div class="support-section special-section flex-three">
									<a href="<?php echo get_theme_mod( 'eddwp_terms_link' ); ?>" class="support-section-link">
										<h4 class="support-section-title">Refund Policy</h4>
										<p class="support-section-description">Be sure your request meets the necessary criteria for a refund.</p>
									</a>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
					<?php if ( is_page( 'support' ) ) { ?>
						<p class="edd-docs-link-wrap">
							<a class="edd-submit button blue" href="http://docs.easydigitaldownloads.com/">View Full Documentation</a><span class="button-break"></span><a class="edd-support-ticket-link edd-submit button gray" href="#">Submit Support Request</a>
						</p>
					<?php } ?>
					<?php
						if ( is_page( 'pre-sale-question' ) ) {
							$form_container_class = ' pre-sale-support-form-container';
						} elseif ( is_page( 'refund-request' ) ) {
							$form_container_class = ' refund-support-form-container';
						} else {
							$form_container_class = ' standard-support-form-container';
						}
					?>
					<section class="support-docs-form-container<?php echo $form_container_class; ?> clearfix">
						<div class="full-width-content clearfix">
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</div>
					</section><!-- /.content -->
				</div>
			</div>
		</div>

	</section>
	<?php
get_footer();
