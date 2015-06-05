<?php
$payment_id = absint( $_GET['payment_id' ] );
$user_id    = edd_get_payment_user_id( $payment_id );

if( ! current_user_can( 'edit_shop_payments' ) && $user_id != get_current_user_id() ) {
	return;
}

$color = edd_get_option( 'checkout_color', 'gray' );
$color = ( $color == 'inherit' ) ? '' : $color;

?>
<style type="text/css">.edd_sl_license_status.expired { color: red; }</style>
<script type="text/javascript">jQuery(document).ready(function($){ $(".edd_sl_show_key").on("click", function(e) {e.preventDefault();$(this).next().toggle("fast");});});</script>
<p><a href="<?php echo esc_url( remove_query_arg( array( 'payment_id', 'edd_sl_error' ) ) ); ?>" class="edd-manage-license-back edd-submit button <?php echo esc_attr( $color ); ?>"><?php _e( 'Go back', 'edd_sl' ); ?></a></p>
<?php
// Retrieve all license keys for the specified payment
$keys = edd_software_licensing()->get_licenses_of_purchase( $payment_id );
if ( $keys ) : ?>
	<table id="edd_sl_license_keys" class="edd_sl_table">
		<thead>
			<tr class="edd_sl_license_row">
				<?php do_action('edd_sl_license_header_before'); ?>
				<th class="edd_sl_item"><?php _e( 'Item', 'edd_sl' ); ?></th>
				<th class="edd_sl_key"><?php _e( 'Key', 'edd_sl' ); ?></th>
				<th class="edd_sl_status"><?php _e( 'Status', 'edd_sl' ); ?></th>
				<th class="edd_sl_limit"><?php _e( 'Activations', 'edd_sl' ); ?></th>
				<th class="edd_sl_expiration"><?php _e( 'Expiration', 'edd_sl' ); ?></th>
				<?php if( ! edd_software_licensing()->force_increase() ) : ?>
				<th class="edd_sl_sites"><?php _e( 'Manage Sites', 'edd_sl' ); ?></th>
				<?php endif; ?>
				<?php do_action('edd_sl_license_header_after'); ?>
			</tr>
		</thead>
		<?php foreach ( $keys as $license ) : ?>
			<tr class="edd_sl_license_row">
				<?php do_action( 'edd_sl_license_row_start', $license->ID ); ?>
				<td><?php echo get_the_title( edd_software_licensing()->get_download_id( $license->ID ) ); ?></td>
				<td>
					<span class="view-key-wrapper">
						<a href="#" class="edd_sl_show_key" title="<?php _e( 'Click to view license key', 'edd_sl' ); ?>"><img src="<?php echo EDD_SL_PLUGIN_URL . '/images/key.png'; ?>"/></a>
						<span class="edd_sl_license_key"><?php echo edd_software_licensing()->get_license_key( $license->ID ); ?></span>
					</span>
				</td>
				<td class="edd_sl_license_status <?php echo edd_software_licensing()->get_license_status( $license->ID ); ?>"><?php echo edd_software_licensing()->license_status( $license->ID ); ?></td>
				<td><span class="edd_sl_limit_used"><?php echo edd_software_licensing()->get_site_count( $license->ID ); ?></span><span class="edd_sl_limit_sep">&nbsp;/&nbsp;</span><span class="edd_sl_limit_max"><?php echo edd_software_licensing()->license_limit( $license->ID ); ?></span></td>
				<td>
				<?php if ( method_exists( edd_software_licensing(), 'is_lifetime_license' ) && edd_software_licensing()->is_lifetime_license( $license->ID ) ) : ?>
					<?php _e( 'Lifetime', 'edd_sl' ); ?>
				<?php else: ?>
					<?php echo date_i18n( 'F j, Y', edd_software_licensing()->get_license_expiration( $license->ID ) ); ?>
				<?php endif; ?>
				</td>
				<?php if( ! edd_software_licensing()->force_increase() ) : ?>
				<td><a href="<?php echo esc_url( add_query_arg( 'license_id', $license->ID ) ); ?>"><?php _e( 'Manage Sites', 'edd_sl' ); ?></a></td>
				<?php endif; ?>
				<?php do_action( 'edd_sl_license_row_end', $license->ID ); ?>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else : ?>
	<p class="edd_sl_no_keys"><?php _e( 'There are no license keys for this purchase', 'edd_sl' ); ?></p>
<?php endif;?>
