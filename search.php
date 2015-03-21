<?php
/**
 * The template for displaying the search results.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>
<?php get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'edd' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php while ( have_posts() ) { the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
					<p class="entry-date"><span><?php the_date(); ?></span></p>
					<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
					<p><a class="edd-button button blue" href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', 'edd' ); ?></a></p>
					<?php eddwp_post_meta(); ?>
				</article><!-- /#post-<?php echo get_the_ID(); ?> -->
				<?php } ?>

				<?php
				global $wp_query;
				if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { ?>
					<div id="page-nav">
						<ul class="paged">
							<?php if( get_next_posts_link() ) { ?>
								<li class="previous">
									<?php next_posts_link( __( '<span class="nav-previous meta-nav"><i class="fa fa-chevron-left"></i> Older</span>', 'edd' ) ); ?>
								</li>
							<?php
							} if( get_previous_posts_link() ) { ?>
								<li class="next">
									<?php previous_posts_link( __( '<span class="nav-next meta-nav">Newer <i class="fa fa-chevron-right"></i></span>', 'edd' ) ); ?>
								</li>
							<?php } ?>
						</ul><!-- /.paged -->
					</div><!-- /#page-nav -->
				<?php } ?>
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
					</form><!-- /#pmc_mailchimp -->
				</div><!-- /.newsletter -->
				<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			</aside><!-- /.sidebar -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>