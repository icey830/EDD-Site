<?php
/**
 * The template for displaying the Author Archives
 *
 * This is used to displayed extensions by authors.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>

<?php
global $post, $wp_query;
get_header();
?>

	<section class="main clearfix">
		<section class="extensions-container">
			<h1>Extensions by <?php echo get_userdata( get_query_var( 'author' ) )->display_name; ?></h1>
			<div class="extensions clearfix">
				<?php
				$c = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); $c++;
				?>
					<div class="extension <?php if ( 0 == $c%3 ) echo ' extension-clear'; ?> <?php if ( has_term( '3rd Party', 'download_category', get_the_ID() ) ) echo ' third-party-extension'; ?>">
						<a href="<?php echo home_url( '/extensions/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
							<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
						</a>
						<div class="overlay">
							<a href="<?php echo home_url( '/extensions/' . $post->post_name ); ?>" class="overlay-view-details button">View Details</a>
							<?php if( ! eddwp_is_external_extension() ) : ?>
								<a href="<?php echo home_url( '/checkout/?edd_action=add_to_cart&download_id=' . get_post_meta( get_the_ID(), 'ecpt_downloadid', true ) ); ?>" class="overlay-add-to-cart button">Add to Cart</a>
							<?php endif; ?>
						</div>
						<?php
						if ( has_term( '3rd Party', 'download_category', get_the_ID() ) )
							echo '<i class="third-party"></i>';
						?>
					</div>
					<?php
				endwhile;

				$big = 999999999;

				$links = paginate_links(
					array(
						'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'  => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total'   => $wp_query->max_num_pages
					)
				);
				?>
				<div class="clear"></div>
				<div class="pagination">
					<?php echo $links; ?>
				</div>

				<?php else : ?>
					<p>Sorry, no extensions were found.</p>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</section><!-- /.extensions-container -->
	</section><!-- /.main -->

<?php get_footer(); ?>