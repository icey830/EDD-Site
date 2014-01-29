<?php
/**
 * The template for displaying the footer.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>

	<?php
	$footer_cache = new CWS_Fragment_Cache( 'edd-footer', 3600 );
	if ( ! $footer_cache->output() ) : ob_start();
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<img src="<?php echo get_template_directory_uri(); ?>/images/edd-sitting.png" />
			<div class="columns clearfix">
				<div class="dev-blog col">
					<?php eddwp_get_latest_post(); ?>
				</div><!-- /.dev-blog -->

				<div class="forum col">
					<h4>Need help?</h4>
					<p>If you ever need help with EDD, there is a complete <a href="<?php echo home_url( '/support/' ); ?> ">Support Forum</a> available where you can get your support questions answered. If you'd like to report a bug or have ideas for how to improve the plugin, please post it to our <a href="http://github.com/easydigitaldownloads/Easy-Digital-Downloads/issues">GitHub Issue Tracker</a>.</p>
				</div><!-- /.forum -->

				<div class="consultants col">
					<h4>Trusted Consultants</h4>
					<p>We maintain a list of consultants that we recommend working with when it comes to managed support, customization, and setup help. </p>
					<p><a href="<?php echo home_url( '/consultants/' ); ?>">View Consultants...</a></p>
				</div><!-- /.consultants -->
			</div><!-- /.columns -->

			<div class="social clearfix">
				<ul>
					<li class="facebook"><a href="https://www.facebook.com/eddwp"></a></li>
					<li class="twitter"><a href="https://twitter.com/eddwp"></a></li>
					<li class="gplus"><a href="https://plus.google.com/111409933861760783237/posts"></a></li>
					<li class="github"><a href="https://github.com/easydigitaldownloads/Easy-Digital-Downloads/"></a></li>
				</ul>
			</div><!-- /.social -->

			<p class="copyright">Copyright &copy; 2013, Easy Digital Downloads. A project by <a href="<?php echo esc_url( '/the-crew/' ); ?>">Pippin Williamson and Friends</a>.</p>
		</div><!-- .container -->
	</footer><!-- #colophon -->
	<?php
	echo ob_get_clean();
	$footer_cache->store();
	endif;
	?>

	<?php wp_footer(); ?>

<?php if ( current_user_can( 'moderate' ) ) : ?>

<div id="TB_overlay" class="TB_overlayBG"></div>
<div id="TB_window" style="margin-left: -400px; width: 800px; margin-top: -200px;">
	<div id="TB_inner" style="padding: 30px;">
		<h1 style="margin: 0 0 10px;">Assigned Tickets</h1>
		<?php
		global $user_ID;
		$tickets = new WP_Query(
			array(
				'post_type' => 'topic',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => '_bbps_topic_status',
						'value' => 1
					),
					array(
						'key' => 'bbps_topic_assigned',
						'value' => $user_ID
					)
				)
			)
		);
		if ( $tickets->have_posts() ) :
		?>
		<table id="tickets">
			<thead>
				<tr>
					<th>Ticket</th>
					<th>Date Posted</th>
					<th>Last Response</th>
				</tr>
			</thead>
			<tbody>
				<?php do { ?>

					<?php $tickets->the_post(); ?>

					<?php $parent = get_post_field( 'post_parent', get_the_ID() ); ?>

					<tr>
						<td><?php if ( $parent == 499 ) : ?><strong>Priority:</strong> <?php endif; ?> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
						<td><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ?> ago</td>
						<td><?php if ( function_exists( 'bbpress' ) ) { echo bbp_get_topic_freshness_link( $tickets->post_ID ); } ?></td>
					</tr>

				<?php } while ( $tickets->have_posts() ); wp_reset_postdata(); ?>
			</tbody>
		</table>
		<?php else : ?>
			<p>No unresolved tickets, yay! Now go grab some unresolved or unassigned tickets.</p>
		<?php endif; ?>
	</div>
</div>

<?php endif; ?>
</body>
</html>