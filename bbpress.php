<?php
/**
 * The template for displaying bbPress pages.
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */
?>

<?php get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( bbp_is_single_view() ) : ?>
				<div class="bbp-discussion-meta clearfix">
					<div class="left">
						<a href="<?php echo get_permalink( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?>">&larr; Back to <?php echo get_the_title( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?></a>
					</div><!-- /.left -->
					<div class="right">
						<span class="posted-in">Posted In: <a href="<?php echo get_permalink( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?>"><?php echo get_the_title( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?></a></span>
						<?php if ( 2 == get_post_meta( bbp_get_topic_id(), '_bbps_topic_status', true ) ) : ?>
						<span class="status resolved"><i class="icon-ok"></i> Resolved</span>
						<?php endif; ?>
					</div><!-- /.right -->
				</div><!-- /.bbp-discussion-meta -->
				<?php endif; // end bbp_is_single_view() ?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php endwhile; ?>
			</section><!-- /.content -->

			<?php			
			if ( ! bbp_is_single_user() ) :

				if ( ! current_user_can( 'moderate' ) ) :
					get_sidebar( 'forums' );

				elseif ( current_user_can( 'moderate' ) && bbp_is_single_topic() ) :
					echo '<aside class="sidebar">';
					edd_bbp_d_sidebar();
					echo '</aside><!-- /.sidebar -->';

				else :
					get_sidebar( 'forums' );
				endif;

			endif;
			?>
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>