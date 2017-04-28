<?php
/**
 * Template Name: Thank You
 *
 * Template used for thanking the user for something
 */
get_header();
the_post();
?>

	<div class="gray-edd-headshot-area page-section-gray full-width">
		<div class="inner">
			<div class="gray-edd-headshot-content clearfix">
				<h2 class="section-title-alt">Thank you!</h2>
				<div class="gray-edd-headshot-text">

					<?php if ( is_page( 'free-download-thanks' ) ) { ?>

						<p>For your personal records, you will receive a confirmation email to the address you provided. If you have any issues with your download, please feel free to <a href="<?php echo home_url( '/support/' ); ?>">contact our support</a> for assistance. You may also use the <a href="http://docs.easydigitaldownloads.com/">documentation</a> to assist with setup and configuration. Enjoy!</p>

					<?php } elseif ( is_page( 'thank-you-for-subscribing' ) ) { ?>

						<p>Your subscription has been confirmed. Be sure to whitelist the <strong>support@easydigitaldownloads.com</strong> email address to make sure none of our emails go to your spam folder. Also, please consider using the buttons below to join our communities on Twitter, Google+, and Facebook. See you there!</p>
						<?php eddwp_social_networking_follow(); ?>

					<?php } ?>

				</div>
				<div class="gray-edd-headshot-media">
				</div>
			</div>
		</div>
	</div>

	<?php if ( is_page( 'free-download-thanks' ) ) {

		if ( function_exists( 'edd_rp_get_suggestions' ) ) {
			?>

			<div id="recommended-products-thanks-area" class="recommended-products-thanks-area page-section-white full-width">
				<div class="inner">
					<div class="recommended-products-thanks clearfix">
						<h2 class="section-title-alt">Don't leave just yet! There's more.</h2>
						<p class="recommended-products-thanks-intro">Based on your past activity, we've created a list of extensions that you may find useful. Have a look! If you're just getting started, we also have a handy tool for building a <a href="<?php echo home_url( '/starter-package/' ); ?>">custom starter package</a>.</p>
						<?php echo eddwp_rp_shortcode( 6 ); ?>
					</div>
				</div>
			</div>
			<?php
		}

	} elseif ( is_page( 'thank-you-for-subscribing' ) ) { ?>

		<div class="blog-posts-display-area page-section-white full-width">
			<div class="inner">
				<div class="blog-posts-display-content clearfix">

					<h2 class="section-title-alt">Browse categories</h2>

					<div class="continue-search-form">
						<?php get_search_form(); ?>
					</div>

					<?php eddwp_blog_categories(); ?>

					<section class="recent-blog-posts download-grid three-col clearfix">

						<?php
						$args = array(
							'post_type'      => 'post',
							'posts_per_page' => 9,
						);
						$show_posts = new WP_Query( $args );
						?>

						<?php while ( $show_posts->have_posts() ) : $show_posts->the_post(); ?>
							<div <?php post_class( 'download-grid-item' ); ?> id="post-<?php echo get_the_ID(); ?>">

								<div class="entry-header">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="download-grid-thumb-wrap">
											<a href="<?php echo get_permalink(); ?>" title="<?php get_the_title(); ?>">
												<?php the_post_thumbnail( 'full', array( 'class' => 'download-grid-thumb' ) ); ?>
											</a>
										</div>
									<?php } ?>
								</div>

								<div class="download-grid-item-info entry-content">
									<?php
									eddwp_post_byline_lite();
									the_title( sprintf( '<h1 class="entry-title download-grid-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h1>' );
									?>
								</div>

							</div>
						<?php endwhile; wp_reset_postdata(); ?>
						<div class="download-grid-item flex-grid-cheat"></div>
						<div class="download-grid-item flex-grid-cheat"></div>

					</section>

					<a class="visit-the-blog" href="<?php echo home_url( 'blog' ); ?>">Visit the blog</a>

				</div>
			</div>
		</div>

	<?php } ?>

<?php
get_footer();