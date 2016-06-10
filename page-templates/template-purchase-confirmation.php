<?php
/**
 * Template Name: Purchase Confirmation
 *
 * template for the Purchase Confirmation page
 */
global $edd_receipt_args;

$payment   = get_post( $edd_receipt_args['id'] );
$cart      = edd_get_payment_meta_cart_details( $payment->ID, true );
echo '<pre>';var_dump($cart);echo '</pre>';

get_header();
the_post();
?>

<div class="purchase-confirmation-area page-section-white full-width">
	<div class="inner">
		<div class="purchase-confirmation">
			<?php the_title( '<h1 class="section-title-alt">', '</h1>' ); ?>
			<div class="purchase-confirmation-content">
				<ul class="nav nav-tabs nav-append-content purchase-confirmation-tabs">
					<li><a href="#tab1" data-toggle="tab"><i class="fa fa-user"></i>Profile</a></li>
					<li><a href="#tab2" data-toggle="tab"><i class="fa fa-wrench"></i>Support Subscription</a></li>
				</ul>
				<div class="purchase-confirmation-tab-content">
					<div class="tab-content purchase-confirmation-data">
						<div class="tab-pane active" id="tab1">
							<?php the_content(); ?>
						</div><!-- /.tab-pane -->
						<div class="tab-pane  purchase-confirmation-docs" id="tab2">
							<?php do_shortcode( '[recommended_products ids="" count="10" title="We Also Recommend"]' ); ?>
						</div><!-- /.tab-pane -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

get_footer();