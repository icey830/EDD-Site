<?php $search = isset( $_GET['doc_s'] ) ? $_GET['doc_s'] : ''; ?>
<aside id="google-search-form-sidebar" class="widget widget_doc_search">
	<div class="search-widet-wrap">
		<?php eddwp_google_custom_search(); ?>
	</div>
</aside>