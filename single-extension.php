<?php
/**
 * The template for displaying an extension.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

get_header();
the_post();
?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<h1><?php the_title(); ?></h2>
				<?php
				the_content();

				if ( function_exists('p2p_register_connection_type') ) :
					echo '<div class="related-items">';
						echo '<strong>Documentation, Support, and Related Items</strong>';
						// Find connected posts
						$connected = new WP_Query( array(
						  'connected_type' => 'extensions_to_docs',
						  'connected_items' => get_queried_object(),
						  'nopaging' => true,
						) );

						// Display connected posts
						if ( $connected->have_posts() ) :
							while ( $connected->have_posts() ) : $connected->the_post(); ?>
								<div> - <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<?php endwhile;
						wp_reset_postdata();
						endif;

						// Find connected forums
						$connected = new WP_Query( array(
						  'connected_type' => 'extensions_to_forums',
						  'connected_items' => get_queried_object(),
						  'nopaging' => true,
						) );

						// Display connected posts
						if ( $connected->have_posts() ) :
							while ( $connected->have_posts() ) : $connected->the_post(); ?>
								<div> - <a href="<?php the_permalink(); ?>">Support Forum for <?php the_title(); ?></a></div>
							<?php endwhile;
						wp_reset_postdata();
						endif;
					echo '</div>';
				endif;
				?>
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
					<?php if ( ! eddwp_is_extension_third_party() ) { ?>
					<div class="pricing">
						<h4>Pricing</h4>
						<?php echo edd_get_purchase_link( array( 'download_id' => get_post_meta( get_the_ID(), 'ecpt_downloadid', true ) ) ); ?>
					</div>
					<?php } // end if ?>
				</div>
			</aside><!-- /.sidebar -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>