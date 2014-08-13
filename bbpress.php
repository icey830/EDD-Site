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

global $user_ID;
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
				echo '<aside class="sidebar edd-moderator-sidebar">';
					echo '<div class="edd-moderator-sidebar-inside">';
					?>
						<div class="item">
							<?php
							$args = array(
								'post_type'  => 'topic',
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key'   => '_bbps_topic_status',
										'value' => '1'
									),
									array(
										'key'   => 'bbps_topic_assigned',
										'value' => $user_ID,
									)
								),
								'order' => 'ASC',
								'orderby' => 'meta_value',
								'meta_key' => '_bbp_last_active_time',
								'posts_per_page' => -1,
								'post_parent__not_in' => array( 318 )
							);
							$assigned_tickets = new WP_Query( $args );
							$count = $assigned_tickets->post_count;
							?>

							<?php if ( $count == 0 ) {
								echo '<span class="count count-green">0</span>';
							} else {
								echo '<span class="count count-normal">'. $count .'</span>';
							}
							?>
							<a href="/support/dashboard">Assigned</a>
						</div>

						<div class="item">
							<?php
							$args = array(
								'post_type'  => 'topic',
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key'     => 'bbps_topic_assigned',
										'compare' => 'NOT EXISTS',
										'value'   => '1'
									),
									array(
										'key'   => '_bbps_topic_status',
										'value' => '1',
									),
								),
								'order' => 'ASC',
								'orderby' => 'meta_value',
								'meta_key' => '_bbp_last_active_time',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'post_parent__not_in' => array( 318 )
							);
							$unassigned_tickets = new WP_Query( $args );
							$count = $unassigned_tickets->post_count;
							?>

							<?php if ( $count == 0 ) {
								echo '<span class="count count-green">0</span>';
							} else {
								echo '<span class="count count-normal">'. $count .'</span>';
							}
							?>
							<a href="/support/dashboard">Unassigned</a>
						</div>

						<div class="item">
							<?php
							$args = array(
								'post_type'  => 'topic',
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key'     => '_bbp_voice_count',
										'value'   => '1'
									),
									array(
										'key'   => '_bbps_topic_status',
										'value' => '1',
									),
								),
								'posts_per_page' => -1,
								'post_status' => 'publish'
							);
							$no_reply_tickets = new WP_Query( $args );
							$count = $no_reply_tickets->post_count
							?>

							<?php if ( $count == 0 ) {
								echo '<span class="count count-green">0</span>';
							} else {
								echo '<span class="count count-normal">'. $count .'</span>';
							}
							?>
							<a href="/support/dashboard">No Replies</a>
						</div>

						<div class="item">
							<?php
							$args = array(
								'post_type'  => 'topic',
								'post_parent__not_in' => array( 318 ),
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'order' => 'ASC',
								'orderby' => 'meta_value',
								'meta_key' => '_bbp_last_active_time',
								'meta_query' => array(
									array(
										'key'   => '_bbps_topic_status',
										'value' => '1',
									),
								),
							);
							$unresolved_tickets = new WP_Query( $args );
							$count = $unresolved_tickets->post_count;
							?>

							<?php if ( $count == 0 ) {
								echo '<span class="count count-green">0</span>';
							} else {
								echo '<span class="count count-normal">'. $count .'</span>';
							}
							?>
							<a href="/support/dashboard">Unresolved</a>
						</div>
					<?php
					echo '</div>';

					echo '<div class="edd-moderator-sidebar-inside">';
						edd_bbp_d_sidebar();
					echo '</div>';
				echo '</aside><!-- /.sidebar -->';
			} else {
				get_sidebar( 'forums' );
			}
			?>
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?