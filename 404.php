<?php
/**
 * The template for displaying 404 pages.
 */

get_header(); ?>

<div class="error-404-header-area page-section-blue full-width">
	<div class="inner">
		<div class="error-404-header clearfix">
			<div class="section-header">
				<h2 class="section-title">Bummer. It looks like this link is broken.</h2>
				<p class="section-subtitle">Try using the search form below to find what you were looking for.</p>
				<div class="error-404-search-form">
					<div id="google-search-form">
						<?php eddwp_google_custom_search(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="error-404-area" class="error-404-area page-section-white full-width">
	<div class="inner">

		<div class="content-404 clearfix">
			<div class="post" id="post-0">
				<div class="resources-404 clearfix">
					<img class="sad-edd" src="<?php echo get_template_directory_uri(); ?>/images/mascot/edd-sad.png" />
					<div class="links-404 col-404">
						<h2 class="widgettitle">Helpful Resources</h2>
						<p>Looking for assistance with EDD? Try reading the documentation for general EDD instructions, extension and theme configuration resources, and much more.</p>
						<p><a href="http://docs.easydigitaldownloads.com/">EDD Documentation</a></p>
						<p>Still have unanswered questions? No worries. We love our customers and we're always glad to help you out if you have any problems with the plugin.</p>
						<p><a href="<?php echo esc_url( '/support/' ); ?>">Open a support ticket</a></p>
					</div>
					<div class="extensions-404 col-404">
						<h2 class="widgettitle">Featured Extensions</h2>
						<?php
							$extensions = new WP_Query(
								array(
									'post_type'      => 'download',
									'posts_per_page' => 4,
									'post_status'    => 'publish',
									'orderby'        => 'menu_order',
									'order'          => 'ASC',
									'tax_query'      => array(
										array(
											'taxonomy' => 'download_tag',
											'field'    => 'slug',
											'terms'    => 'featured'
										)
									)
								)
							);

							while ( $extensions->have_posts() ) :
								$extensions->the_post();
								?>
									<li class="extension-404 clearfix">
										<div class="preview-image">
											<?php the_post_thumbnail( 'theme-showcase' ); ?>
										</div>
										<?php the_title( '<a href="' . get_the_permalink() . '">', '</a> - ' ); ?>
										<?php echo apply_filters( 'the_excerpt', get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ) ); ?>
									</li>
								<?php
							endwhile;
							wp_reset_postdata();
						?>
						<p class="view-all-extensions-404"><a class="edd-submit button blue" href="<?php echo esc_url( '/downloads/' ); ?>"><i class="fa fa-plug"></i>View All Extensions</a></p>
					</div>
					<div class="recent-posts-404 col-404">
						<?php the_widget( 'WP_Widget_Recent_Posts', array( 'title'=> 'Latest Blog Posts', 'number' => 5 ) ); ?>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>
