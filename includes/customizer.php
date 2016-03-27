<?php
/**
 * Theme Customizer
 */


/**
 * register the customizer settings
 */
function eddwp_customize_register( $wp_customize ) {

	/**
	 * Extends controls class to add textarea with description
	 */
	class EDDWP_WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public $description = '';
		public function render_content() { ?>

			<label>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ) . ' '; ?>
				<span class="eddwp-toggle-wrap">
					<?php if ( ! empty( $this->description ) ) { ?>
						<a href="#" class="eddwp-toggle-description">?</a>
					<?php } ?>
				</span>
			</span>
				<div class="control-description eddwp-control-description"><?php echo esc_html( $this->description ); ?></div>
				<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	/**
	 * Extends controls class to add descriptions to text input controls
	 */
	class EDDWP_WP_Customize_Text_Control extends WP_Customize_Control {
		public $type = 'customtext';
		public $description = '';
		public function render_content() { ?>

			<label>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ) . ' '; ?>
				<span class="eddwp-toggle-wrap">
					<?php if ( ! empty( $this->description ) ) { ?>
						<a href="#" class="eddwp-toggle-description">?</a>
					<?php } ?>
				</span>
			</span>
				<div class="control-description eddwp-control-description"><?php echo esc_html( $this->description ); ?></div>
				<input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
			</label>
			<?php
		}
	}


	/** =============
	 * direct links
	 */
	$wp_customize->add_section( 'eddwp_direct_links', array(
		'title'         => 'Direct Links',
	) );

	// terms & conditions
	$wp_customize->add_setting( 'eddwp_terms_link', array(
		'default'           => null,
		'sanitize_callback' => 'eddwp_sanitize_textarea_lite'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_terms_link', array(
		'label'     => 'Terms & Conditions URL',
		'section'   => 'eddwp_direct_links',
		'priority'  => 10,
	) ) );

	// EDD core download URL
	$wp_customize->add_setting( 'eddwp_download_core', array(
		'default'           => null,
		'sanitize_callback' => 'eddwp_sanitize_textarea_lite'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_download_core', array(
		'label'     => 'EDD Core Download URL',
		'section'   => 'eddwp_direct_links',
		'priority'  => 20,
	) ) );

	// EDD demo URL
	$wp_customize->add_setting( 'eddwp_demo_link', array(
		'default'           => null,
		'sanitize_callback' => 'eddwp_sanitize_textarea_lite'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_demo_link', array(
		'label'     => 'EDD Demo URL',
		'section'   => 'eddwp_direct_links',
		'priority'  => 30,
	) ) );
}
add_action( 'customize_register', 'eddwp_customize_register' );


/**
 * Sanitize checkbox options
 */
function eddwp_sanitize_checkbox( $input ) {
	return 1 == $input ? 1 : 0;
}


/**
 * Sanitize text input
 */
function eddwp_sanitize_text( $input ) {
	return strip_tags( stripslashes( $input ) );
}


/**
 * Sanitize text input to allow anchors
 */
function eddwp_sanitize_link_text( $input ) {
	return strip_tags( stripslashes( $input ), '<a>' );
}


/**
 * Sanitize integer input
 */
function eddwp_sanitize_integer( $input ) {
	return absint( $input );
}


/**
 * Sanitize textarea
 */
function eddwp_sanitize_textarea( $input ) {
	$allowed = array(
		's'         => array(),
		'br'        => array(),
		'em'        => array(),
		'i'         => array(),
		'strong'    => array(),
		'b'         => array(),
		'a'         => array(
			'href'          => array(),
			'title'         => array(),
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
			'target'        => array(),
		),
		'form'      => array(
			'id'            => array(),
			'class'         => array(),
			'action'        => array(),
			'method'        => array(),
			'autocomplete'  => array(),
			'style'         => array(),
		),
		'input'     => array(
			'type'          => array(),
			'name'          => array(),
			'class'         => array(),
			'id'            => array(),
			'value'         => array(),
			'placeholder'   => array(),
			'tabindex'      => array(),
			'style'         => array(),
		),
		'img'       => array(
			'src'           => array(),
			'alt'           => array(),
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
			'height'        => array(),
			'width'         => array(),
		),
		'span'      => array(
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
		'p'         => array(
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
		'div'       => array(
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
		'blockquote' => array(
			'cite'          => array(),
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
	);
	return wp_kses( $input, $allowed );
}


/**
 * Sanitize textarea lite
 */
function eddwp_sanitize_textarea_lite( $input ) {
	$allowed = array(
		'em'        => array(),
		'strong'    => array(),
		'a'         => array(
			'href'          => array(),
			'title'         => array(),
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
			'target'        => array(),
		),
		'span'      => array(
			'class'         => array(),
			'id'            => array(),
			'style'         => array(),
		),
	);
	return wp_kses( $input, $allowed );
}


/**
 * sanitize hex colors
 */
function eddwp_sanitize_hex_color( $color ) {
	if ( '' === $color ) :
		return '';
	endif;
	// 3 or 6 hex digits, or the empty string.
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) :
		return $color;
	endif;
	return null;
}


/**
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function eddwp_customizer_styles() { ?>
	<style type="text/css">
		#customize-controls #customize-theme-controls .description { display: block; color: #666;  font-style: italic; margin: 2px 0 15px; }
		#customize-controls #customize-theme-controls .customize-section-description { margin-top: 10px; }
		textarea, input, select,
		.customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 5px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		.customize-control { margin-bottom: 10px; }
		.eddwp-toggle-wrap { display: inline-block; line-height: 1; margin-left: 2px; }
		.eddwp-toggle-wrap a { display: block; background: rgba(0, 0, 0, .2); color: #fff; padding: 2px 6px; border-radius: 3px; margin-left: 6px; }
		.eddwp-toggle-wrap a:hover,
		.eddwp-toggle-wrap .eddwp-description-opened { background: #555; color: #fff; }
		.control-description { color: #666; font-style: italic; margin-bottom: 6px; }
		.eddwp-control-description { display: none; }
		.customize-control-text + .customize-control-checkbox,
		.customize-control-customtext + .customize-control-checkbox,
		.customize-control-image + .customize-control-checkbox { margin-top: 12px; }
		#customize-control-eddwp_empty_cart_downloads_count input { width: 50px; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'eddwp_customizer_styles' );