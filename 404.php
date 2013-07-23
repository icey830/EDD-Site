<?php
/**
 * The template for displaying 404 pages.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<article class="post" id="post-0">
					<h1>Oops! That page can&rsquo;t be found.</h1>
					<p>It looks like nothing was found at this location. Maybe try one of the links below or a search?</p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
				</article>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>
