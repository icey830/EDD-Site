<?php
/**
 * Template Name: Free Downloads Upsell
 *
 * Template used for the redirect page after Free Downloads is used
 */
get_header();
the_post();
?>

	<div id="free-downloads-header-area" class="free-downloads-header-area page-section-white full-width">
		<div class="inner">
			<div class="free-downloads-header clearfix">
				<h2 class="section-title-alt">Thanks! Your download will start momentarily!</h2>
				<?php
					if ( is_user_logged_in() ) :

						$purchased_products = edd_get_users_purchased_products();
						//echo '<pre>'; var_dump($purchased_products); echo '</pre>';

						echo do_shortcode('[recommended_products ids="167" user="true" count="10" title="We Also Recommend"]');
					endif;
				?>
			</div>
		</div>
	</div>

<?php
get_footer();