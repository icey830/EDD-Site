<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EDD
 */
?>

<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'edd' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( is_search() ) {
			printf( '<p>%s</p>', _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'edd' ) );
		} else {
			printf( '<p>%s</p>', _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'edd' ) . get_search_form() );
		}
		?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->
