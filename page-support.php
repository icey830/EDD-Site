<?php
/**
 * bbPress forums index
 */

get_header(); ?>

	<div class="site-container">
		<section class="content">

			<section class="content">
				<?php while ( have_posts() ) { the_post(); ?>
				<article class="entry">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
			</section>
			<?php get_sidebar( 'forums' ); ?>

		</section>
	</div>

<?php get_footer(); ?>