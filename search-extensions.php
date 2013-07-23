<?php
/**
 * The template for displaying search results for extensions.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>

<?php get_header(); ?>

	<?php
	$q['s'] = $_GET['extension_s'];

	$q['s'] = sanitize_text_field( stripslashes( $q['s'] ) );

	if ( empty( $_GET['s'] ) && $wp_query->is_main_query() )
		$q['s'] = urldecode( $q['s'] );

	$q['c'] = $_GET['category'];

	$q['c'] = stripslashes( $q['c'] );
	?>

	<section class="main clearfix">
		<section class="content">
			<h1>Search Results For "<?php echo sanitize_text_field( stripslashes( $_GET['extension_s'] ) ); ?>"</h1>
			<form id="extensions_searchform" class="clearfix" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
				<fieldset>
					<input type="search" name="extension_s" value="<?php echo $q['s']; ?>" />
					<input type="submit" value="Search" />
					<input type="hidden" name="action" value="extension_search" />
				</fieldset>
			</form><!-- /#extensions_searchform -->
			<div class="clearfix"></div>
			<?php
			$c = get_terms( 'extension_category' );

			if ( $c ) {
				?>
				<div class="filter clearfix">
					<ul class="extension-categories clearfix">
						<li><a href="<?php echo home_url( 'extensions' ); ?>">All</a></li>
						<?php foreach ( $c as $o )  { ?>
						<li><a href="<?php echo add_query_arg( 'category', $o->slug ); ?>"><?php echo $o->name; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php
			}
			?>
		</section><!-- /.content -->

		<section class="extensions-container">
			<div class="extensions clearfix">
				<?php

				$tax_query = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'extension_category',
							'field' => 'slug',
							'terms' => $q['c']
						)
					)
				);
					
				$query = array(
					's' => $q['s'],
					'post_type' => 'extension',
					'posts_per_page' => 21,
					$tax_query,
					'paged' => isset( $_GET['paged'] ) ? (int) $_GET['paged'] : 1
				);

				$s_query = new WP_Query( $query );

				$query = $s_query;

				$c = 0; while ( $query->have_posts() ) { $query->the_post(); $c++; ?>
					<div class="extension <?php if ( 0 == $c%3 ) echo ' extension-clear'; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
							<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
						</a>
						<div class="overlay">
							<a href="<?php the_permalink(); ?>" class="overlay-view-details button">View Details</a>
							<?php if( ! eddwp_is_external_extension() ) : ?>
								<a href="<?php echo home_url( '/edd-add/' . get_post_meta( get_the_ID(), 'ecpt_downloadid', true ) ); ?>" class="overlay-add-to-cart button">Add to Cart</a>
							<?php endif; ?>
						</div>
						<?php
						if ( has_term( '3rd Party', 'extension_category', get_the_ID() ) ) {
							echo '<i class="third-party"></i>';
						}
						?>
					</div>
				<?php
				}

				$big = 999999999;

				$links = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, isset( $_GET['paged'] ) ? (int) $_GET['paged'] : 1 ),
					'total' => $query->max_num_pages
				));
				?>
				<div class="clear"></div>
				<div class="pagination">
					<?php echo $links; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			</div><!-- /.extensions -->
		</section><!-- /.extensions-container -->
	</section><!-- /.main -->


<?php get_footer(); ?>