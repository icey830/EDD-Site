<?php get_header(); ?>

	<?php
	$q['s'] = $_GET['extension_s'];
				
	$q['s'] = stripslashes( $q['s'] );
	
	if ( empty( $_GET['s'] ) && $wp_query->is_main_query() )
		$q['s'] = urldecode($q['s']);
		
	$q['c'] = $_GET['category'];
	
	$q['c'] = stripslashes( $q['c'] );
	?>

	<section class="main clearfix">
		<section class="content">
			<h1>Search Results For "<?php echo $_GET['extension_s']; ?>"</h1>
			<form id="extensions_searchform" class="clearfix" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
				<fieldset>
					<input type="search" name="extension_s" value="<?php echo $q['s']; ?>" />
					<input type="submit" value="Search" />
					<input type="hidden" name="action" value="extension_search" />
				</fieldset>
			</form><!-- /#extensions_searchform -->
			<div class="clearfix"></div>
			<?php
			$c = get_terms( 'extension_category' );
			
			if ( $c ) {
				?>
				<div class="filter clearfix">
					<span class="filter-title">Filter Extensions</span>
					<ul class="extension-categories clearfix">
						<li><a href="<?php echo add_query_arg( 'category', 'all' ); ?>">All</a></li>
						<?php foreach ( $c as $o )  { ?>
						<li><a href="<?php echo add_query_arg( 'category', $o->slug ); ?>"><?php echo $o->name; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php	
			}
			?>
			<div class="extensions clearfix">
				<?php

				$query = array(
					's' => $q['s'],
					'post_type' => 'extension',
					'posts_per_page' => 21,
					$tax_query,
					'paged' => isset( $_GET['paged'] ) ? (int) $_GET['paged'] : 1
				);
				
				$tax_query = array(
					'tax_query' => array(
						array(
							'taxonomy' => 'extension_category',
							'field' => 'slug',
							'terms' => $q['c']
						)
					)
				);
					
				$s_query = new WP_Query( $query );
				
				$query = $s_query;
				
				$c = 0; while ( $query->have_posts() ) { $query->the_post(); $c++; ?>
					<div class="extension <?php if ( 0 == $c%3 ) echo ' extension-clear'; ?>">
						<?php if ( has_category( '3rd Party' ) ) { ?>
						<span class="third-party-overlay"></span>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
							<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
						</a>
						<a class="overlay" href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>"></a>
					</div>
				<?php
				}

				$big = 999999999;
				
				$links = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, isset( $_GET['paged'] ) ? (int) $_GET['paged'] : 1 ),
					'total' => $query->max_num_pages
				));
				?>
				<div class="clear"></div>
				<div class="pagination">
					<?php echo $links; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			</div><!-- /.extensions -->
		</section><!-- /.content -->
	</section><!-- /.main -->


<?php get_footer(); ?>