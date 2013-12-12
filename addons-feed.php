<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		echo '<div class="edd-extension">';
			echo '<h3 class="edd-extension-title">' . get_the_title() . '</h3>';
			echo '<a href="' . add_query_arg('ref', '1', get_permalink() ) . '" title="' . get_the_title() . '">';
				the_post_thumbnail('showcase', array('title' => get_the_title()));
			echo '</a>';
			echo '<p>' . get_post_meta(get_the_ID(), 'ecpt_shortdescription', true) . '</p>';
			echo '<a href="' . add_query_arg('ref', '1', get_permalink() ). '" title="' . get_the_title() . '" class="button-secondary">Get this Add On</a>';
		echo '</div>';
	}
}
exit;
?>