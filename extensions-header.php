<section class="content clearfix">
	<h1>Extensions</h1>
	<form id="extensions_searchform" class="clearfix" action="<?php echo home_url( 'extensions' ); ?>" method="get">
		<fieldset>
			<input type="search" name="extension_s" value="" />
			<input type="submit" value="Search" />
			<input type="hidden" name="action" value="extension_search" />
		</fieldset>
	</form><!-- /#extensions_searchform -->
	<div class="clearfix "></div>
	<div class="extensions-offer notice info">
		<p>Purchase 3 or more extensions at once and save an automatic 10% off your purchase</p>
	</div>
	<div class="clearfix"></div>
	<?php echo eddwp_extenstion_cats_shortcode(); ?>
	<?php if( is_tax( 'extension_category', 'affiliates-2' ) ) : ?>
	<a href="http://affiliatewp.com/?utm_source=edd&utm_medium=banner&utm_campaign=Extension%20Category">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/affwp-banner.png" title="AffiliateWP" alt="AffiliateWP - The best affiliate plugin for WordPress"/>
	</a>
	<?php else :
	$banners = array(
		0 => array(
			'url'   => home_url( '/downloads/core-extensions-bundle' ),
			'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/banner-ceb.png',
			'title' => 'Core Extensions Bundle'
		),
		1 => array(
			'url'   => home_url( '/starter-package' ),
			'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/banner-sp.png',
			'title' => 'Starter Package'
		)
	);
	$num = rand( 0, 1 );
	?>
	<a href="<?php echo $banners[ $num ]['url']; ?>">
		<img src="<?php echo $banners[ $num ]['image']; ?>" title="<?php echo $banners[ $num ]['title']; ?>" alt="<?php echo $banners[ $num ]['title']; ?>"/>
	</a>
	<?php endif; ?>
</section><!-- /.content -->