<?php

echo '<div class="edd-extension edd-starter-package">';
	echo '<h3 class="edd-extension-title">Starter Package</h3>';
	echo '<a href="https://easydigitaldownloads.com/starter-package/?utm_source=plugin-addons-page&utm_medium=plugin&utm_campaign=EDD+Addons+Page&utm_content=Starter+Package" title="Starter Package">';
		echo '<img width="320" height="200" src="' . trailingslashit( get_stylesheet_directory_uri() ) . 'images/starter-package.png" class="attachment-showcase wp-post-image" alt="Starter Package" title="Starter Package" />';
	echo '</a>';
	echo '<p>Save 30% on popular extensions with our Starter Package</p>';
	echo '<a href="https://easydigitaldownloads.com/starter-package/?utm_source=plugin-addons-page&utm_medium=plugin&utm_campaign=EDD+Addons+Page&utm_content=Starter+Package" title="Starter Package" class="button-secondary">Get Started!</a>';
echo '</div>';

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		$url = esc_url( add_query_arg( array(
			'utm_source'   => 'plugin-addons-page',
			'utm_medium'   => 'plugin',
			'utm_campaign' => 'EDD Addons Page',
			'utm_content'  => get_the_title()
		), get_permalink() ) );

		echo '<div class="edd-extension">';
			echo '<h3 class="edd-extension-title">' . get_the_title() . '</h3>';
			echo '<a href="' . $url . '" title="' . get_the_title() . '">';
				the_post_thumbnail('showcase', array('title' => get_the_title()));
			echo '</a>';
			echo '<p>' . get_post_meta(get_the_ID(), 'ecpt_shortdescription', true) . '</p>';
			echo '<a href="' . $url . '" title="' . get_the_title() . '" class="button-secondary">Get this Extension</a>';
		echo '</div>';
	}
}
exit;
