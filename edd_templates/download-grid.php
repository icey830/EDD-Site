<div class="download-grid three-col clearfix">
	<?php while ( have_posts() ) : the_post(); ?>
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
</div>