<?php
/**
 * display extensions by authors
 */

global $post, $wp_query;
get_header();

$extension_args = array(
	'post_type'      => 'download',
	'author'         => get_userdata( get_query_var( 'author' ) )->ID,
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

// popular extensions query when the author has no results
$pop_query = array(
	'post_type'      => 'download',
	'posts_per_page' => 23,
	'order'          => 'ASC',
	'paged'          => get_query_var( 'paged' ),
	'tax_query' => array(
		'relation'     => 'AND',
		array(
			'taxonomy' => 'download_category',
			'field'    => 'slug',
			'terms'    => 'extensions',
		),
		array(
			'taxonomy' => 'download_category',
			'field'    => 'slug',
			'terms'    => 'popular',
		),
	),
);
$popular = new WP_Query( $pop_query ); ?>

<div class="author-header-area page-section-blue full-width">
	<div class="inner">
		<div class="extensions-header author-header clearfix">
			<div class="section-header">
				<h2 class="section-title">Extensions by <strong><?php echo get_userdata( get_query_var( 'author' ) )->display_name; ?></strong></h2>
			</div>
		</div>
	</div>
</div>

<?php if ( ! $extensions->have_posts() ) : ?>
	<div class="edd-no-search-results-area full-width">
		<div class="inner">
			<div class="edd-no-search-results">
				Oops! <strong><?php echo get_userdata( get_query_var( 'author' ) )->display_name; ?></strong> has no extensions. Try browsing the popular add-ons below.
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="edd-downloads-area page-section-white full-width">
	<div class="inner">
		<div class="edd-downloads">

				<section class="download-grid three-col clearfix">

					<?php echo eddwp_download_gird_promotions(); ?>

					<?php if ( $extensions->have_posts() ) : ?>

						<?php while ( $extensions->have_posts() ) : $extensions->the_post(); ?>
							<div class="download-grid-item">
								<div class="download-grid-thumb-wrap">
									<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
										<?php eddwp_downloads_grid_thumbnail(); ?>
									</a>
								</div>
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
						<?php endwhile; wp_reset_postdata(); ?>
						<div class="download-grid-item flex-grid-cheat"></div>
						<div class="download-grid-item flex-grid-cheat"></div>

					<?php else :

						while ( $popular->have_posts() ) : $popular->the_post();
							?>
							<div class="download-grid-item">
								<div class="download-grid-thumb-wrap">
									<a href="<?php echo home_url( '/downloads/' . $post->post_name ); ?>" title="<?php get_the_title(); ?>">
										<?php eddwp_downloads_grid_thumbnail(); ?>
									</a>
								</div>
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
							<?php
						endwhile; wp_reset_postdata(); ?>
						<div class="download-grid-item flex-grid-cheat"></div>
						<div class="download-grid-item flex-grid-cheat"></div>

					<?php endif; ?>

				</section>

				<?php if ( $extensions->have_posts() ) :
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
				<?php endif; ?>

		</div>
	</div>
</div>
<?php

get_footer();
