<?php
/**
 * single video template
 */

get_header(); ?>

	<div class="site-container">
		<section class="content">

			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
					<div class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>

		</section>
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>