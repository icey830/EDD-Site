<?php $search = isset( $_GET['doc_s'] ) ? $_GET['doc_s'] : ''; ?>
<aside id="search-wp-widget" class="widget widget_doc_search">
	<div class="search-widet-wrap">
		<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
			<input type="search" class="field" name="doc_s" value="<?php echo esc_attr( $search ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'edd' ); ?>" />
			<input type="hidden" name="s_type" value="doc" />
			<input type="submit" class="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'edd' ); ?>" />
		</form>
	</div>
</aside>