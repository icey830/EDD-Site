<?php
// This is the pre-1.9 feed with small images
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		$url = add_query_arg( array( 
			'utm_source'   => 'plugin-addons-page',
			'utm_medium'   => 'plugin',
			'utm_campaign' => 'EDD Addons Page',
			'utm_content'  => get_the_title()
		), get_permalink() );

		echo '<div class="edd-extension">';
			echo '<h3 class="edd-extension-title">' . get_the_title() . '</h3>';
			echo '<a href="' . esc_url( $url ) . '" title="' . get_the_title() . '">';
				the_post_thumbnail('extension', array('title' => get_the_title()));
			echo '</a>';
			echo '<p>' . get_post_meta(get_the_ID(), 'ecpt_shortdescription', true) . '</p>';
			echo '<a href="' . add_query_arg('ref', '1', get_permalink() ). '" title="' . get_the_title() . '" class="button-secondary">Get this Add On</a>';
		echo '</div>';
	}
}
?>