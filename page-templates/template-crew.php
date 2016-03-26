<?php
/**
 * Template Name: The Crew
 *
 * template for the EDD Crew display
 */

get_header();
?>

<div class="the-crew-area page-section-white full-width">
	<div class="inner">
		<div class="the-crew-content">
			<h2 class="section-title-alt">Meet the Team</h2>
			<div class="lead-dev-wrap crew-wrap flex-container">
				<?php
					// all EDD Crew (user role) members
					$args = array(
						'role' => 'edd_crew',
					);
					$user_query = new WP_User_Query( $args );
					$the_crew = $user_query->get_results();
					foreach ( $the_crew as $member ) :
						?>
						<div class="crew-member flex-two">
							<div class="crew-member-name">
								<?php
									echo $member->first_name . ' ' . $member->last_name;
									echo '<span class="crew-member-urls">';
									if ( ! empty( $member->user_url ) ) :
										printf( '&nbsp;<a href="%s"><i class="fa fa-link"></i></a>', $member->user_url );
									endif;
									if ( ! empty( $member->twitter ) ) :
										printf( '&nbsp;&middot;&nbsp;<a href="https://twitter.com/%s"><i class="fa fa-twitter"></i></a>', $member->twitter );
									endif;
									echo '</span>';
								?>
							</div>
							<div class="crew-member-info">
								<?php
									echo get_avatar( $member->ID, 120, '', '', array( 'class' => 'crew-avatar alignright' ) );
									$enhanced_bio = get_user_meta( $member->ID, 'enhanced_bio', true );
									echo wpautop( $enhanced_bio );
								?>
							</div>
						</div>
						<?php
					endforeach;
				?>
			</div>
		</div>
	</div>
</div>
<?php

get_footer();