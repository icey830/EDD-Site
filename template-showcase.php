<?php
/* Template Name: Showcase */
get_header();
the_post();
?>
	<section class="main clearfix">
		<section class="content clearfix">
			<?php
			printf( '<h1>%1$s</h1><p>%2$s</p>', get_the_title(), 'A collection of just <span class="highlight">some</span> of the great websites running Easy Digital Downloads.' );
			?>
		</section><!-- /.content -->

		<section class="showcase clearfix">
			<div class="sites clearfix">
				<?php
				$showcases = new WP_Query( array( 'post_type' => 'showcase', 'nopaging' => true ) );
				
				while ( $showcases->have_posts() ) {
					$showcases->the_post();
					?>
					<div class="site">
						<a href="<?php $array = shortcode_parse_atts( get_the_content() ); echo $array['link']; ?>">
							<?php the_post_thumbnail( 'showcase' ); ?>
						</a>
						<a class="text-overlay" href="<?php echo $array['link'] ?>">
							<?php the_title(); ?>
							<span class="button">Launch Website</span>
						</a><!-- /.text-overlay -->
					</div><!-- /.site -->
					<?php
				}
				
				wp_reset_postdata();
				?>
			</div><!-- /.sites -->
			<div class="clearfix">
				<?php the_content(); ?>
			</div>
		</section><!-- /.showcase -->
	
	</section><!-- /.main -->
<?php get_footer(); ?>