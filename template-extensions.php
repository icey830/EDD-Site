<?php
/* Template Name: Extensions */
get_header();
the_post();
?>
	<section class="main clearfix">
		<section class="content clearfix">
			<h1><?php the_title(); ?></h1>
			<form id="extensions_searchform" class="clearfix" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
				<fieldset>
					<input type="search" name="extension_s" value="" />
					<input type="submit" value="Search" />
					<input type="hidden" name="action" value="extension_search" />
				</fieldset>
			</form><!-- /#extensions_searchform -->
			<div class="clearfix"></div>
			<?php echo eddwp_extenstion_cats_shortcode(); ?>
			<div class="extensions clearfix">
				<?php
				$extensions =  new WP_Query( array( 'post_type' => 'extension', 'posts_per_page' => 30, 'paged' => get_query_var( 'paged' ) ) );
				$c = 0; while ( $extensions ->have_posts() ) {
					$extensions->the_post();
					$c++;
					?>
					<div class="extension <?php if ( 0 == $c%3 ) echo ' extension-clear'; ?>">
					<?php
					
					?>
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
							<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
						</a>
						<a class="overlay" href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>"></a>
						<?php
						if ( has_term( '3rd Party', 'extension_category', get_the_ID() ) ) {
							echo '<i class="third-party"></i>';
						}
						?>
					</div>
					<?php
				}
				
				$big = 999999999;
				
				$links = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $extensions->max_num_pages
				));
				?>
				<div class="clear"></div>
				<div class="pagination">
					<?php echo $links; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			</div>
		</section><!-- /.content -->
	</section><!-- /.main -->
<?php get_footer(); ?>