<?php
/**
 * custom theme shortcodes
 */


/**
 * [button]
 */
function eddwp_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'link' 	 => '',
			'color'  => 'blue',
			'target' => '_blank',
		),
		$atts, 'eddwp_button' )
	);

	switch ( $color ) :
		case 'blue' :
			$color = 'blue';
			break;
		case 'darkblue' :
			$color = 'darkblue';
			break;
		case 'gray' :
			$color = 'gray';
			break;
		default :
			$color = 'blue';
	endswitch;

	return '<p><a href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '" class="edd-submit button ' . esc_attr( $color ) . '">' . $content . '</a></p>';
}
add_shortcode( 'button', 'eddwp_button' );


/**
 * [toggle]
 */
function eddwp_shortcode_toggle( $atts, $content = null ) {
	$last = '';
	if ( isset( $atts[0] ) && trim( $atts[0] ) == 'last') $last = ' tb-toggle-last';
	$default = array(
		'title' => ''
	);
	extract( shortcode_atts( $default, $atts ) );
	$content = wpautop( do_shortcode( stripslashes( $content ) ) );
	$output  = '<div class="tb-toggle'.$last.'">';
	$output .= '<a href="#" title="'.$title.'" class="toggle-trigger"><span></span>'.$title.'</a>';
	$output .= '<div class="toggle-content">'.$content.'</div>';
	$output .= '</div>';
	return $output;
}
add_shortcode( 'toggle', 'eddwp_shortcode_toggle' );


/**
 * [box]
 */
function eddwp_shortcode_box( $atts, $content = null ) {
	$output = '';

	$default = array(
		'style' => 'alert'
	);

	extract( shortcode_atts( $default, $atts ) );

	$output = '<div class="info-box info-box-'.$style.'"><div class="icon">'.do_shortcode( $content ).'</div></div>';

	return $output;
}
add_shortcode( 'box', 'eddwp_shortcode_box' );