<?php
/**
 * The template for displaying bbPress pages.
 *
 * @package EDD
 */

get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<?php while ( have_posts() ) { the_post(); ?>
				<div class="bbp-discussion-meta clearfix">
					<div class="left">
						<a href="<?php echo get_permalink( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?>">&larr; Back to <?php echo get_the_title( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?></a>
					</div>
					<div class="right">
						<span class="posted-in">Posted In: <a href="<?php echo get_permalink( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?>"><?php echo get_the_title( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?></a></span>
						<?php if ( 2 == get_post_meta( bbp_get_topic_id(), '_bbps_topic_status', true ) ) { ?>
						<span class="status resolved"><i class="icon-ok"></i> Resolved</span>
						<?php } // end if ?>
					</div>
				</div>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php } ?>
			</section><!-- /.content -->
			<?php get_sidebar( 'forums' ); ?>
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>