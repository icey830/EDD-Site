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

			<aside class="sidebar">
				<div class="newsletter">
					<h3>Email Newsletter</h3>
					<p>Sign up to receive regular updates from Easy Digital Downloads.</p>
					<form id="pmc_mailchimp" action="" method="post">
						<div>
							<input name="pmc_fname" id="pmc_fname" type="text" placeholder="<?php _e('Name'); ?>"/>
						</div>
						<div>
							<input name="pmc_email" id="pmc_email" type="text" placeholder="<?php _e('Enter your email address'); ?>"/>
						</div>
						<div>
							<input type="hidden" name="redirect" value="<?php echo 'https://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; ?>"/>
							<input type="hidden" name="action" value="pmc_signup"/>
							<input type="hidden" name="pmc_list_id" value="<?php echo $list_id; ?>"/>
							<input type="submit" value="<?php _e( 'Sign Up' ); ?>"/>
						</div>
					</form>
				</div>
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</aside><!-- /.sidebar -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>