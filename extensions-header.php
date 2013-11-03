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
	<div class="notice info" style="margin-bottom: -20px;">
		<p>Purchase 3 or more extensions at once and save an automatic 10% off your purchase</p>
	</div>
	<div class="clearfix"></div>
	<?php echo eddwp_extenstion_cats_shortcode(); ?>
	<a href="<?php echo home_url( '/?extension=core-extensions-bundle&ref=1' ); ?>">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/banner-ceb.png" title="Core Extensions Bundle" alt="Core Extensions Bundle banner"/>
	</a>
</section><!-- /.content -->