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

		<div class="support-header-area full-width">
			<div class="inner">
				<div class="support-header clearfix">
					<div class="section-header">
						<h2 class="section-title">We're here to help!</h2>
						<p class="section-subtitle">Use the features below to search our knowledge base or contact us for support.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="support-search-area full-width">
			<div class="inner">
				<div class="support-search">
					<div class="support-section-wrap">
						<div class="support-section">
							<a href="http://docs.easydigitaldownloads.com/collection/168-getting-started" class="support-section-link">
								<h4 class="support-section-title">Getting Started</h4>
								<p class="support-section-description">Find everything to get Easy Digital Downloads you up and running.</p>
							</a>
						</div>
						<div class="support-section">
							<a href="http://docs.easydigitaldownloads.com/collection/171-faqs" class="support-section-link">
								<h4 class="support-section-title">Frequently Asked Questions</h4>
								<p class="support-section-description">Perhaps you've encountered a common issue or have a quick question.</p>
							</a>
						</div>
						<div class="support-section">
							<a href="http://docs.easydigitaldownloads.com/collection/180-advanced" class="support-section-link">
								<h4 class="support-section-title">Advanced Documention</h4>
								<p class="support-section-description">Familiar with code? Use the advanced docs to dig deeper into Easy Digital Downloads.</p>
							</a>
						</div>
						<div class="support-section">
							<a href="http://docs.easydigitaldownloads.com/collection/139-extensions-themes" class="support-section-link">
								<h4 class="support-section-title">Extensions & Themes</h4>
								<p class="support-section-description">Everything you need to know about our extensions and themes.</p>
							</a>
						</div>
						<div class="support-section">
							<a href="http://docs.easydigitaldownloads.com/collection/174-developer-docs" class="support-section-link">
								<h4 class="support-section-title">Developer Documentation</h4>
								<p class="support-section-description">See all of Easy Digital Downloads' functions, classes, actions, filters, etc.</p>
							</a>
						</div>
						<div class="support-section">
							<a href="http://docs.easydigitaldownloads.com/collection/292-server-config" class="support-section-link">
								<h4 class="support-section-title">Server Configuration</h4>
								<p class="support-section-description">View server-specific documentation for setup and configuration guides.</p>
							</a>
						</div>
					</div>
					<p class="edd-docs-link">
						<a href="http://docs.easydigitaldownloads.com/" class="button">View Full Documentation</a>
					</p>
					<section class="support-docs-form-container clearfix">
						<div class="the-content clearfix">
							<div class="support-header">
								<h1 class="support-title">No luck? No worries. What is your question about?</h1>
							</div>
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