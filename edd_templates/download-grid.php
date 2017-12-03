<div class="download-grid three-col clearfix">
	<?php
		while ( have_posts() ) : the_post();
			echo eddwp_download_grid_item_markup();
		endwhile; wp_reset_postdata();
	?>
	<div class="download-grid-item flex-grid-cheat"></div>
	<div class="download-grid-item flex-grid-cheat"></div>
</div>