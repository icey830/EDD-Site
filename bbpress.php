<?php
/**
 * The template for displaying bbPress pages.
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
				<?php if ( bbp_is_single_view() ) { ?>
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
				<?php } // end if ?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php } ?>
			</section><!-- /.content -->
			<?php
			
			if ( ! current_user_can( 'moderate' ) && ! bbp_is_single_user() ) {
				get_sidebar( 'forums' );
			} elseif ( current_user_can( 'moderate' ) && bbp_is_single_topic() && ! bbp_is_single_user() ) {
				echo '<aside class="sidebar">';
				edd_bbp_d_sidebar();
				echo '</aside><!-- /.sidebar -->';
			} else {
				get_sidebar( 'forums' );
			}
			
			?>
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>