<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
				<?php while ( have_posts() ) { the_post(); ?>
				<article class="entry">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</article>
				<?php } ?>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>