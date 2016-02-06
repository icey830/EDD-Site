<?php
/**
 * bbPress pages
 */

global $user_ID;
get_header(); ?>

	<div class="site-container">
		<section class="content">

			<?php
				while ( have_posts() ) : the_post();

					if ( bbp_is_single_view() ) :
						?>
						<div class="bbp-discussion-meta clearfix">
							<div class="left">
								<a href="<?php echo get_permalink( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?>">&larr; Back to <?php echo get_the_title( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?></a>
							</div>
							<div class="right">
								<span class="posted-in">Posted In: <a href="<?php echo get_permalink( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?>"><?php echo get_the_title( bbp_get_global_post_field( 'post_parent', 'display', bbp_get_topic_id() ) ); ?></a></span>
								<?php if ( 2 == get_post_meta( bbp_get_topic_id(), '_bbps_topic_status', true ) ) { ?>
								<span class="status resolved"><i class="fa fa-ok"></i> Resolved</span>
								<?php } // end if ?>
							</div>
						</div>
						<?php
					endif;

					the_title( '<h1 class="entry-title">', '</h1>' );
					the_content();

				endwhile;
			?>

		</section>

		<?php
			if ( ! current_user_can( 'moderate' ) && ! bbp_is_single_user() ) :
				get_sidebar( 'forums' );
			elseif ( current_user_can( 'moderate' ) && bbp_is_single_topic() && ! bbp_is_single_user() ) :
				echo '<aside class="sidebar edd-moderator-sidebar">';
					echo '<div class="edd-moderator-sidebar-inside">';
						edd_bbp_d_sidebar();
					echo '</div>';
				echo '</aside>';
			else :
				get_sidebar( 'forums' );
			endif;
		?>
	</div>

<?php get_footer(); ?>