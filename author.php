<?php
/**
 * display extensions by authors
 */

global $post, $wp_query;
get_header();
?>

	<?php $extension_args = array(
		'post_type'      => 'download',
		'paged'          => get_query_var( 'paged' ),
		'posts_per_page' => 23,
		'order'          => isset( $_GET['display'] ) ? 'DESC' : 'ASC',
		'orderby'        => isset( $_GET['display'] ) ? 'date' : 'menu_order',
		'tax_query'      => array(
			array(
				'taxonomy' => 'download_category',
				'field'    => 'slug',
				'terms'    => 'extensions',
			),
		),
	);
	$extensions = new WP_Query( $extension_args );

	if ( have_posts() ) : ?>

		<div class="extensions-header-area page-section-blue full-width">
			<div class="inner">
				<div class="extensions-header clearfix">
					<div class="section-header">
						<h2 class="section-title">Extensions by <strong><?php echo get_userdata( get_query_var( 'author' ) )->display_name; ?></strong></h2>
					</div>
				</div>
			</div>
		</div>

		<div class="edd-downloads-area page-section-white full-width">
			<div class="inner">
				<div class="edd-downloads">
					<section class="download-grid three-col clearfix">
						<div id="extensions-bundle-promotion" class="download-grid-item extensions-bundle-promotion">
							<?php
								$bundle_promotion = array(
									0 => array(
										'url'   => home_url( '/downloads/core-extensions-bundle' ),
										'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/core-extensions-bundle-featured.png',
										'title' => 'Core Extensions Bundle',
										'desc'  => 'With the core extensions bundle, get over $2,000 worth of extensions for only $495.',
									),
									1 => array(
										'url'   => home_url( '/starter-package' ),
										'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/starter-package-featured.png',
										'title' => 'Extension Starter Package',
										'desc'  => 'Build your own extension starter package and automatically save 30% on your order.',
									)
								);
								$num = rand( 0, 1 );
							?>
							<a href="<?php echo $bundle_promotion[ $num ]['url']; ?>" title="<?php echo $bundle_promotion[ $num ]['title']; ?>">
								<img class="download-grid-thumb" src="<?php echo $bundle_promotion[ $num ]['image']; ?>"  alt="<?php echo $bundle_promotion[ $num ]['title']; ?>">
							</a>
							<div class="download-grid-item-info">
								<h4 class="download-grid-title"><?php echo $bundle_promotion[ $num ]['title']; ?></h4>
								<p><?php echo $bundle_promotion[ $num ]['desc']; ?></p>
							</div>
							<div class="download-grid-item-cta">
								<a class="edd-submit button green" href="<?php echo $bundle_promotion[ $num ]['url']; ?>">More Information</a>
							</div>
						</div>
						<?php while ( $extensions->have_posts() ) : $extensions->the_post(); ?>
							<div class="download-grid-item">
								<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
									<?php eddwp_downloads_grid_thumbnail(); ?>
								</a>
								<div class="download-grid-item-info">
									<?php
										the_title( sprintf(
											'<h4 class="download-grid-title"><a href="%s">',
											home_url( '/downloads/' . $post->post_name ) ),
											'</a></h4>'
										);
										$short_desc = get_post_meta( get_the_ID(), 'ecpt_shortdescription', true );
										echo $short_desc;
									?>
								</div>
								<div class="download-grid-item-cta">
									<a class="download-grid-item-primary-link button" href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">More Information</a>
								</div>
							</div>
						<?php endwhile; ?>
					</section>
					<?php
						$big = 999999999;
						$links = paginate_links( array(
							'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'  => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total'   => $extensions->max_num_pages,
						) );
					?>
					<div class="pagination clearfix">
						<?php echo $links; ?>
					</div>
				</div>
			</div>
		</div>
		<?php

	else : ?>

		<section id="landing-page" class="landing clearfix">

			<article class="content clearfix">
				<div class="full-width-content clearfix">
					<div class="entry-header">
						<h1 class="entry-title">
							<?php echo get_userdata( get_query_var( 'author' ) )->display_name; ?> has no downloads.
						</h1>
					</div>
					<div class="entry-content">
						<p>But that's okay! Perhaps you'll find a useful tool for your store in our diverse selection of extensions. <a href="<?php echo home_url( '/downloads/' ); ?>">View All Extensions</a>.</p>
						<p>Need a theme to present your store in logical manner? Have a look at our official themes as well as as our recommendations from the community. <a href="<?php echo home_url( '/themes/' ); ?>">View All Themes</a>.</p>
					</div>
				</div>
			</article>

		</section>
		<?php

	endif;
	wp_reset_postdata();

get_footer();
