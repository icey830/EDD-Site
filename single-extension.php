<?php
/**
 * The template for displaying the blog index page.
 *
 * @package EDD
 */

get_header();
the_post();
?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<h1><?php the_title(); ?></h2>
				<?php the_content(); ?>
				
			</section><!-- /.content -->
			
			<aside class="sidebar">
				<div class="box">
					<h3>Extension Details</h3>
					<div class="author clearfix">
						<p><span>Developer:</span> <span><?php echo get_post_meta( get_the_ID(), 'ecpt_developer', true ); ?></span></p>
					</div>
					<div class="version clearfix">
						<p><span>Version:</span> <span><?php echo get_post_meta( get_the_ID(), 'ecpt_version', true ); ?></span></p>
					</div>
					<div class="price clearfix">
						<p><span>Price:</span> <span><?php echo get_post_meta( get_the_ID(), 'ecpt_price', true ); ?></span></p>
					</div>
					<div class="pricing">
						<h4>Pricing</h4>
						<?php echo edd_get_purchase_link( array( 'download_id' => get_post_meta( get_the_ID(), 'ecpt_downloadid', true ) ) ); ?>
					</div>
				</div>
			</aside><!-- /.sidebar -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>