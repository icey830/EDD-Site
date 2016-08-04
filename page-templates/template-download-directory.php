<?php
/**
 * Template Name: Download Directory
 *
 * Display quick information about all products
 */

get_header(); ?>

<div id="product-info-area" class="product-info-area page-section-gray full-width">
	<div class="inner">
		<div class="product-info-content page-section">
			<h2 class="section-title-alt">Download Directory</h2>
			<h4 id="extensions">Extensions</h4>
			<ul class="product-info-list flex-container">
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
						<li class="product-info-list-item flex-three">
							<div class="product-meta">
								<?php the_title( '<span class="product-title"><a href="' . home_url( '/downloads/' . $post->post_name ) . '" title="' . get_the_title() . '">', '</a></span>' ); ?>
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
							</div>
							<span class="product-version">
								<?php
									$product_id = get_the_ID();
									$version    = get_post_meta( $product_id, '_edd_sl_version', true );
									$changelog  = stripslashes( get_post_meta( $product_id, '_edd_sl_changelog', true ) );

									if ( ! empty( $version ) ) :
										if ( ! empty( $changelog ) ) :
											echo '<a href="#" class="changelog-link" title="View Changelog" data-toggle="modal" data-target="#show-changelog-' . $product_id . '">' . $version . '</a>';
											?>
											<!-- Changelog Modal -->
											<div class="changelog-modal modal fade" id="show-changelog-<?php echo $product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-<?php echo $product_id; ?>">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h5 class="modal-title" id="myModalLabel"><?php the_title(); ?> Changelog</h5>
														</div>
														<div class="modal-body">
															<?php echo wpautop( $changelog ); ?>
														</div>
														<div class="modal-footer">
															<a href="#" data-dismiss="modal">Close</a>
														</div>
													</div>
												</div>
											</div>
											<?php
										else :
											echo '<span>empty changelog</span>';
										endif;
									else :
										echo '<span>not versioned</span>';
									endif;
								?>
							</span>
						</li>
						<?php
					endwhile;
					wp_reset_postdata();
				?>
				<li class="flex-grid-cheat flex-three"></li>
				<li class="flex-grid-cheat flex-three"></li>
			</ul>
			<h4 id="themes">Themes</h4>
			<ul class="product-info-list flex-container">
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
								array(
									'taxonomy' => 'download_category',
									'field'    => 'slug',
									'terms'    => '3rd-party',
									'operator' => 'NOT IN',
								),
							)
						)
					);

					while ( $products->have_posts() ) : $products->the_post();
						?>
						<li class="product-info-list-item flex-three">
							<div class="product-meta">
								<?php the_title( '<span class="product-title"><a href="' . home_url( '/downloads/' . $post->post_name ) . '" title="' . get_the_title() . '">', '</a></span>' ); ?>
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
							</div>
							<span class="product-version">
								<?php
								$product_id = get_the_ID();
								$version    = get_post_meta( $product_id, '_edd_sl_version', true );
								$changelog  = get_post_meta( $product_id, '_edd_sl_changelog', true );

								if ( ! empty( $version ) ) :
									if ( ! empty( $changelog ) ) :
										echo '<a href="#" class="changelog-link" title="View Changelog" data-toggle="modal" data-target="#show-changelog-' . $product_id . '">' . $version . '</a>';
										?>
										<!-- Changelog Modal -->
										<div class="changelog-modal modal fade" id="show-changelog-<?php echo $product_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-<?php echo $product_id; ?>">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h5 class="modal-title" id="myModalLabel"><?php the_title(); ?> Changelog</h5>
													</div>
													<div class="modal-body">
														<?php echo wpautop( $changelog ); ?>
													</div>
													<div class="modal-footer">
														<a href="#" data-dismiss="modal">Close</a>
													</div>
												</div>
											</div>
										</div>
									<?php
									else :
										echo 'empty changelog';
									endif;
								else :
									echo 'not versioned';
								endif;
								?>
							</span>
						</li>
						<?php
					endwhile;
					wp_reset_postdata();
				?>
				<li class="flex-grid-cheat flex-three"></li>
				<li class="flex-grid-cheat flex-three"></li>
			</ul>
		</div>
	</div>
</div>

<?php get_footer(); ?>