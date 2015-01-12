<?php
/**
 * The template for displaying 404 pages.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">
			<div class="content-404">
				<div class="post" id="post-0">
					<div class="message-404 clearfix">
						<div class="sad-edd-404">
							<img src="<?php echo get_template_directory_uri(); ?>/images/sad-edd.png" />
						</div>
						<div class="search-404">
							<h3 class="title-404">Bummer. It looks like this link is broken.</h3>
							<p class="subtext-404">Try using the search form below to find what you were searching for.</p>
							<div id="google-search-form">
								<?php eddwp_google_custom_search(); ?>
							</div>
							<p class="subtext-404">No luck? There's still hope. Use the resources below to navigate the site.</p>
						</div>
					</div>
					<div class="resources-404">
						<div class="links-404 col-404">
							<h2 class="widgettitle">Helpful Resources</h2>
							<p>Looking for assistance with EDD? Try reading the documentation for general EDD instructions, extension and theme configuration resources, and much more.</p>
							<p><a href="<?php echo esc_url( '/documentation/' ); ?>">EDD Documentation</a></p>
							<p>Still have unanswered questions? No worries. We love our customers and we're always glad to help you out if you have any problems with the plugin.</p>
							<p><a href="<?php echo esc_url( '/support/' ); ?>">Open a support ticket</a></p>
						</div>
						<div class="extensions-404 col-404">
							<h2 class="widgettitle">Featured Extensions</h2>
							<?php
								$extensions = new WP_Query(
									array(
										'post_type' => 'extension',
										'posts_per_page' => 4,
										'post_status' => 'publish',
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'tax_query' => array(
											array(
												'taxonomy' => 'extension_tag',
												'field' => 'slug',
												'terms' => 'featured'
											)
										)
									)
								);
				
								while ( $extensions->have_posts() ) {
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
								}				
								wp_reset_postdata();
							?>
							<p class="extensions-button-404"><a href="<?php echo esc_url( '/extensions/' ); ?>">View All Extensions</a></p>
						</div>
						<div class="recent-posts-404 col-404">
							<?php the_widget( 'WP_Widget_Recent_Posts', array( 'title'=> 'Latest Blog Posts', 'number' => 5 ) ); ?>
						</div>
					</div>
				</div>
			</div><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>
