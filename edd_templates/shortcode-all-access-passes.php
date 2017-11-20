<?php
if ( is_user_logged_in() ):

	//Get the customer
	$customer = new EDD_Customer( get_current_user_id(), true );

	// Get the All Access passes saved to this customer meta
	$customer_all_access_passes = $customer->get_meta( 'all_access_passes' );

	$at_least_one_pass_to_show = false;

	if ( $customer_all_access_passes ) :
		?>

		<h3>Manage your All Access Passes</h3>
		<p>Below you will find your purchased All Access Passes. Use the <strong>View full details</strong> link to see the details for a specific purchase.</p>

		<table id="edd_user_history">
			<thead>
			<tr class="edd_purchase_row">
				<th><?php _e( 'Product', 'edd-all-access' ); ?></th>
				<th><?php _e( 'Status', 'edd-all-access' ); ?></th>
				<th><?php _e( 'Start Date', 'edd-all-access' ); ?></th>
				<th><?php _e( 'Expiration Date', 'edd-all-access' ); ?></th>
				<th><?php _e( 'Actions', 'edd-all-access' ); ?></th>
			</tr>
			</thead>
			<?php foreach( $customer_all_access_passes as $purchased_download_id_price_id => $purchased_aa_data ){

				if ( empty( $purchased_download_id_price_id ) ){
					continue;
				}

				// Double check all variables we need exist
				if ( !isset( $purchased_aa_data['payment_id'] ) || ! isset( $purchased_aa_data['download_id'] ) || ! isset( $purchased_aa_data['price_id'] ) ){
					continue;
				}

				$all_access_pass = new EDD_All_Access_Pass( $purchased_aa_data['payment_id'], $purchased_aa_data['download_id'], $purchased_aa_data['price_id'] );

				if ( $all_access_pass->status == 'invalid' ){
					continue;
				}

				$at_least_one_pass_to_show = true;

				?>
				<tr>
					<td>
						<span class="edd_all_access_pass_name"><?php echo get_the_title( $all_access_pass->download_id ); ?></span>
					</td>
					<td>
						<?php
							$pass_status = edd_all_access_get_status_label( $all_access_pass->status );
							$status_label = '<span class="edd-aa-' . lcfirst( $pass_status ) . '-status">' . $pass_status . '</span>';
						?>
						<span class="edd_all_access_pass_status"><?php echo $status_label; ?></span>
					</td>
					<td>
						<span class="edd_all_access_pass_start_date"><?php echo date( 'M d, Y', $all_access_pass->start_time ); ?></span>
					</td>
					<td>
						<span class="edd_all_access_pass_expiration_date"><?php echo $all_access_pass->expiration_time == 'never' ? __( 'Never Expires', 'edd-all-access' ) : date( 'M d, Y', $all_access_pass->expiration_time ); ?></span>
					</td>
					<td>
							<span class="edd_all_access_pass_actions"><?php

								// Create the URL which will link to this single pass's details.
								$view_single_aa_pass_url = add_query_arg( array(
									'action' => 'view_all_access_pass',
									'payment_id' => $all_access_pass->payment_id,
									'download_id' => $all_access_pass->download_id,
									'price_id' => $all_access_pass->price_id,
								), home_url( 'your-account/#tab-all-access' ) );

								echo '<a href="' . esc_url( $view_single_aa_pass_url ) . '">' . __( 'View full details', 'edd-all-access' ) . '</a>';

								?></span>
					</td>
				</tr>
			<?php } ?>
		</table>

	<?php endif; //end if customer has all access passes

	// If there was not at least 1 valid pass to show
	if ( ! $at_least_one_pass_to_show ){ ?>
		<p class="edd-no-purchases"><?php _e( 'You have not made any of this type of purchase.', 'edd-all-access' ); ?></p>
	<?php } ?>

<?php endif; //end is_user_logged_in() ?>