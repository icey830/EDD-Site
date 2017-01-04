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


	/** =============
	 * Purchase Confirmation
	 */
	$wp_customize->add_section( 'eddwp_purchase_confirmation_settings', array(
		'title'         => 'Purchase Confirmation Settings',
	) );

	// show Click to Tweet
	$wp_customize->add_setting( 'eddwp_click_to_tweet_purchase_confirmation', array(
		'default'			=> 0,
		'sanitize_callback'	=> 'eddwp_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'eddwp_click_to_tweet_purchase_confirmation', array(
		'label'     => 'Show Click to Tweet',
		'section'   => 'eddwp_purchase_confirmation_settings',
		'priority'  => 10,
		'type'      => 'checkbox',
	) );

	// Click to Tweet text
	$wp_customize->add_setting( 'eddwp_ctt_text_purchase_confirmation', array(
		'default'           => "I've just purchased extensions from @eddwp for #WordPress!",
		'sanitize_callback' => 'eddwp_sanitize_textarea',
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Textarea_Control( $wp_customize, 'eddwp_ctt_text_purchase_confirmation', array(
		'label'         => 'Click to Tweet Text',
		'section'       => 'eddwp_purchase_confirmation_settings',
		'description'   => 'This is the value of a shortcode attribute. You are not allowed to enter HTML here. Keep it short... tweet size.',
		'priority'      => 20,
	) ) );

	// Click to Tweet tweet URL
	$wp_customize->add_setting( 'eddwp_ctt_url_purchase_confirmation', array(
		'default'           => 'https://easydigitaldownloads.com/downloads/',
		'sanitize_callback' => 'eddwp_sanitize_text'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_ctt_url_purchase_confirmation', array(
		'label'     => 'URL attached to the tweet',
		'section'   => 'eddwp_purchase_confirmation_settings',
		'priority'  => 30,
	) ) );

	// Click to Tweet discount code
	$wp_customize->add_setting( 'eddwp_ctt_discount_code_purchase_confirmation', array(
		'default'           => null,
		'sanitize_callback' => 'eddwp_sanitize_textarea_lite'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_ctt_discount_code_purchase_confirmation', array(
		'label'       => 'Discount Code',
		'section'     => 'eddwp_purchase_confirmation_settings',
		'description' => 'If you want the tweet text to change based on the use of a specific discount code, enter the discount code here. Leave blank to disable.',
		'priority'    => 31,
	) ) );

	// Alternate Click to Tweet text
	$wp_customize->add_setting( 'eddwp_alt_ctt_text_purchase_confirmation', array(
		'default'           => 'I just saved big on @eddwp extensions! Check it out! #WordPress',
		'sanitize_callback' => 'eddwp_sanitize_textarea',
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Textarea_Control( $wp_customize, 'eddwp_alt_ctt_text_purchase_confirmation', array(
		'label'         => 'DISCOUNT: Click to Tweet Text',
		'section'       => 'eddwp_purchase_confirmation_settings',
		'description'   => 'This text will override the above "Click to Tweet Text" if there is a VALID discount code in the "Discount Code" section, meaning it can disable itself if the entered discount is no longer valid.',
		'priority'      => 32,
	) ) );

	// show cross-site promotions
	$wp_customize->add_setting( 'eddwp_cross_site_promotion_purchase_confirmation', array(
		'default'			=> 1,
		'sanitize_callback'	=> 'eddwp_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'eddwp_cross_site_promotion_purchase_confirmation', array(
		'label'     => 'Show Cross-site Promotions',
		'section'   => 'eddwp_purchase_confirmation_settings',
		'priority'  => 40,
		'type'      => 'checkbox',
	) );

	// AffiliateWP title
	$wp_customize->add_setting( 'eddwp_cross_site_affwp_title_purchase_confirmation', array(
		'default'           => 'Need an affiliate program?',
		'sanitize_callback' => 'eddwp_sanitize_textarea_lite'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_cross_site_affwp_title_purchase_confirmation', array(
		'label'     => 'Title for AffiliateWP section',
		'section'   => 'eddwp_purchase_confirmation_settings',
		'priority'  => 50,
	) ) );

	// AffiliateWP text
	$wp_customize->add_setting( 'eddwp_cross_site_affwp_text_purchase_confirmation', array(
		'default'           => 'The best affiliate marketing plugin for WordPress.',
		'sanitize_callback' => 'eddwp_sanitize_textarea',
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Textarea_Control( $wp_customize, 'eddwp_cross_site_affwp_text_purchase_confirmation', array(
		'label'         => 'Text for AffiliateWP section',
		'section'       => 'eddwp_purchase_confirmation_settings',
		'description'   => 'Unless we have a very specific reason, this should probably match the AffiliateWP site tagline.',
		'priority'      => 60,
	) ) );

	// Restrict Content Pro title
	$wp_customize->add_setting( 'eddwp_cross_site_rcp_title_purchase_confirmation', array(
		'default'           => 'How about a membership site?',
		'sanitize_callback' => 'eddwp_sanitize_textarea_lite'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_cross_site_rcp_title_purchase_confirmation', array(
		'label'     => 'Title for Restrict Content Pro section',
		'section'   => 'eddwp_purchase_confirmation_settings',
		'priority'  => 70,
	) ) );

	// Restrict Content Pro text
	$wp_customize->add_setting( 'eddwp_cross_site_rcp_text_purchase_confirmation', array(
		'default'           => 'A full-featured, powerful membership solution for WordPress.',
		'sanitize_callback' => 'eddwp_sanitize_textarea',
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Textarea_Control( $wp_customize, 'eddwp_cross_site_rcp_text_purchase_confirmation', array(
		'label'         => 'Text for Restrict Content Pro section',
		'section'       => 'eddwp_purchase_confirmation_settings',
		'description'   => 'Unless we have a very specific reason, this should probably match the Restrict Content Pro site tagline.',
		'priority'      => 80,
	) ) );


	/** =============
	 * Theme Settings
	 */
	$wp_customize->add_section( 'eddwp_theme_settings', array(
		'title'         => 'Various Theme Settings',
	) );

	// Starter Package discount percentage
	$wp_customize->add_setting( 'eddwp_starter_package_discount_percentage', array(
		'default'           => '30',
		'sanitize_callback' => 'eddwp_sanitize_integer'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_starter_package_discount_percentage', array(
		'label'     => 'Starter Package Discount Percentage',
		'section'   => 'eddwp_theme_settings',
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
 * Enqueue script for custom customize control.
 */
function eddwp_custom_customizer_enqueue() {
	wp_enqueue_script( 'eddwp_custom_customizer', get_template_directory_uri() . '/assets/js/custom-customizer.js', array( 'jquery', 'customize-controls' ), EDD_SITE_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'eddwp_custom_customizer_enqueue' );


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
		#customize-control-eddwp_empty_cart_downloads_count input,
		#customize-control-eddwp_starter_package_discount_percentage input { width: 50px; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'eddwp_customizer_styles' );