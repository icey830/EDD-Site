<?php
/**
 * Template Name: Product Info
 *
 * Display quick information about all products
 */

get_header(); ?>

<div id="product-info-area" class="product-info-area page-section-gray full-width">
	<div class="inner">
		<div class="product-info-content page-section">
			<h2 class="section-title-alt">Download Directory</h2>
			<h4 id="extensions">Extensions</h4>
			<ul class="product-info-list">
				<?php
					$products = new WP_Query(
						array(
							'post_type'      => 'download',
							'posts_per_page' => -1,
							'post_status'    => 'publish',
							'orderby'        => 'title',
							'order'          => 'ASC',
							'tax_query'      => array(
								'relation'   => 'AND',
								array(
									'taxonomy' => 'download_category',
									'field'    => 'slug',
									'terms'    => 'extensions'
								),
							)
						)
					);

					while ( $products->have_posts() ) : $products->the_post();
						?>
							<li class="product-info-list-item">
								<?php the_title( '<span class="product-title"><a href="' . home_url( '/downloads/' . $post->post_name ) . '" title="' . get_the_title() . '">', '</a></span>' ); ?>
								<span class="product-version">
									<?php
										$version = get_post_meta( get_the_ID(), '_edd_sl_version', true );
										if ( ! empty( $version ) ) :
											echo $version;
										else :
											echo 'not versioned';
										endif;
									?>
								</span>
								<span class="product-author">
									<?php
										$dev = get_post_meta( get_the_ID(), 'ecpt_developer', true );
										if ( ! empty( $dev ) ) :
											echo 'by ' . $dev;
										else :
											echo 'no author';
										endif;
									?>
								</span>
							</li>
						<?php
					endwhile;
					wp_reset_postdata();
				?>
			</ul>
			<h4 id="themes">Themes</h4>
			<ul class="product-info-list">
				<?php
					$products = new WP_Query(
						array(
							'post_type'      => 'download',
							'posts_per_page' => -1,
							'post_status'    => 'publish',
							'orderby'        => 'title',
							'order'          => 'ASC',
							'tax_query'      => array(
								'relation'   => 'AND',
								array(
									'taxonomy' => 'download_category',
									'field'    => 'slug',
									'terms'    => 'themes'
								),
							)
						)
					);

					while ( $products->have_posts() ) : $products->the_post();
						?>
							<li class="product-info-list-item">
								<?php the_title( '<span class="product-title"><a href="' . home_url( '/downloads/' . $post->post_name ) . '" title="' . get_the_title() . '">', '</a></span>' ); ?>
								<span class="product-version">
									<?php
										$version = get_post_meta( get_the_ID(), '_edd_sl_version', true );
										if ( ! empty( $version ) ) :
											echo $version;
										else :
											echo 'not versioned';
										endif;
									?>
								</span>
								<span class="product-author">
									<?php
										$dev = get_post_meta( get_the_ID(), 'ecpt_developer', true );
										if ( ! empty( $dev ) ) :
											echo 'by ' . $dev;
										else :
											echo 'no author';
										endif;
									?>
								</span>
							</li>
						<?php
					endwhile;
					wp_reset_postdata();
				?>
			</ul>
		</div>
	</div>
</div>

<?php get_footer(); ?>