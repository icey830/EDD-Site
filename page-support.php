<?php
/**
 * The template for displaying the bbPress forums index.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */

get_header(); ?>

	<section class="main clearfix">
		<div class="site-container clearfix">
			<section class="content">
				<?php while ( have_posts() ) { the_post(); ?>
				<article class="entry">
					<h1><?php the_title(); ?></h1>
					<form role="search" method="get" id="bbp-search-form" class="bbp-main-search" action="<?php bbp_search_url(); ?>">
						<div id="search-intro">
							<h3>Having troubles? Try searching for a solution.</h3>
							<p>Use keywords specific to your inquiry. Other users have likely already encountered your issue. If you cannot find an answer to your issue, feel free to open a new ticket.</p>
						</div>

						<div id="google-search-form">
							<?php eddwp_google_custom_search(); ?>
						</div>
					</form>
					<?php the_content(); ?>
				</article>
				<?php } ?>
			</section><!-- /.content -->
			<?php get_sidebar( 'forums' ); ?>
		</div><!-- /.site-container -->
	</section><!-- /.main -->

<?php get_footer(); ?>