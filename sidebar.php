<?php
/**
 * main sidebar
 */
?>
	<aside class="sidebar">
		<?php
			$args = array(
				'tabindex' => 30
			);
			eddwp_newsletter_form( $args );

			$post_tags = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );

			$related_posts_args = array(
				'posts_per_page' => 5,
				'tax_query'      => array(
					'taxonomy'            => 'post_tag',
					'field'               => 'term_id',
					'terms'               => $post_tags,
				)
			);
			$related_posts = get_posts( $related_posts_args );
			?>

			<aside id="eddwp-related-posts" class="widget">
				<h3 class="widget-title">Related articles</h3>
				<ul>
					<?php
					foreach ( $related_posts as $post ) :
						printf( '<li class="latest-posts"><a href="%1$s">%2$s</a></li>',
							get_permalink( $post->ID ),
							$post->post_title
						);
					endforeach;
					?>
				</ul>
			</aside>

			<?php dynamic_sidebar( 'blog-sidebar' ); ?>
	</aside><!-- /.sidebar -->