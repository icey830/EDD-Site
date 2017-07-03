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

	/**
	 * Allow arbitrary HTML controls
	 */
	class EDDWP_Customizer_HTML extends WP_Customize_Control {
		public $content = '';
		public function render_content() {
			if ( isset( $this->label ) ) {
				echo '<hr><h3 class="settings-heading">' . $this->label . '</h3>';
			}
			if ( isset( $this->description ) ) {
				echo '<div class="description customize-control-description settings-description">' . $this->description . '</div>';
			}
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
	 * sales promotion
	 */
	$wp_customize->add_section( 'eddwp_sales_promotion', array(
		'title'         => 'Sales Promotion',
	) );

	// Starter Package settings
	$wp_customize->add_setting( 'eddwp_starter_package_settings', array() );
	$wp_customize->add_control( new EDDWP_Customizer_HTML( $wp_customize, 'eddwp_starter_package_settings', array(
		'section'     => 'eddwp_sales_promotion',
		'priority'    => 10,
		'label'       => 'Starter Package settings',
		'description' => 'Not much is needed as the Starter Package stands alone. But when needed, random settings for the page can be found here.'
	) ) );

	// Starter Package discount percentage
	$wp_customize->add_setting( 'eddwp_starter_package_discount_percentage', array(
		'default'           => '30',
		'sanitize_callback' => 'eddwp_sanitize_integer'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_starter_package_discount_percentage', array(
		'label'     => 'Starter Package Discount Percentage',
		'section'   => 'eddwp_sales_promotion',
		'description' => 'This is just a visual display of the discount percentage applied to the Starter Package products. It\'s here simply so changing this doesn\'t require site updates. Product fields still have to be adjusted manually in the form when this value changes.',
		'priority'  => 11,
	) ) );

	// Active discount adjustments
	$wp_customize->add_setting( 'eddwp_active_discount_adjustment', array() );
	$wp_customize->add_control( new EDDWP_Customizer_HTML( $wp_customize, 'eddwp_active_discount_adjustment', array(
		'section'     => 'eddwp_sales_promotion',
		'priority'    => 20,
		'label'       => 'Active discount adjustments',
		'description' => 'We only run one major promotion at a time. During this period, the presence of an active discount code in the "Active discount code" field below will trigger the settings below it.',
	) ) );

	// Active discount code
	$wp_customize->add_setting( 'eddwp_active_discount_code', array(
		'default'           => null,
		'sanitize_callback' => 'eddwp_sanitize_textarea_lite'
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Text_Control( $wp_customize, 'eddwp_active_discount_code', array(
		'label'       => 'Active discount code',
		'section'     => 'eddwp_sales_promotion',
		'description' => 'The status of this discount code triggers the settings below. As in, if this code is active, the rest of the settings in this section will go into effect. That means a scheduled discount code can be entered here, and its effects will be automated based on start and end dates.',
		'priority'    => 21,
	) ) );

	// Alternate Click to Tweet text
	$wp_customize->add_setting( 'eddwp_alt_ctt_text_purchase_confirmation', array(
		'default'           => 'I just saved big on @eddwp extensions! Check it out! #WordPress',
		'sanitize_callback' => 'eddwp_sanitize_textarea',
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Textarea_Control( $wp_customize, 'eddwp_alt_ctt_text_purchase_confirmation', array(
		'label'         => 'Purchase Confirmation CTT text',
		'section'       => 'eddwp_sales_promotion',
		'description'   => 'This text will override the default "Click To Tweet" text on the Purchase Confirmation page if there is an active discount code in the "Active discount code" setting above.',
		'priority'      => 22,
	) ) );


	/** =============
	 * Purchase Confirmation
	 */
	$wp_customize->add_section( 'eddwp_purchase_confirmation_settings', array(
		'title'         => 'Purchase Confirmation',
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
	 * Support Page
	 */
	$wp_customize->add_section( 'eddwp_support_page_settings', array(
		'title'         => 'Support Page',
	) );

	// Show Customer Notice
	$wp_customize->add_setting( 'eddwp_show_customer_notice_support_page', array(
		'default'           => 0,
		'sanitize_callback' => 'eddwp_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'eddwp_show_customer_notice_support_page', array(
		'label'     => 'Show Customer Notice',
		'section'   => 'eddwp_support_page_settings',
		'priority'  => 10,
		'type'      => 'checkbox',
	) );

	// Notice Text
	$wp_customize->add_setting( 'eddwp_customer_notice_text_support_page', array(
		'default'           => '',
		'sanitize_callback' => 'eddwp_sanitize_textarea',
	) );
	$wp_customize->add_control( new EDDWP_WP_Customize_Textarea_Control( $wp_customize, 'eddwp_customer_notice_text_support_page', array(
		'label'         => 'Text for the customer notice',
		'section'       => 'eddwp_support_page_settings',
		'description'   => 'Display a notice to customers on the support page alerting them of known issues or relevant information.',
		'priority'      => 80,
	) ) );

	// Notice class
	$wp_customize->add_setting( 'eddwp_customer_notice_class_support_page', array(
		'default'           => '',
	) );
	$wp_customize->add_control( 'eddwp_customer_notice_class_support_page', array(
		'label'         => 'Class for the notice to use.',
		'section'       => 'eddwp_support_page_settings',
		'description'   => 'Choose from one of the base EDD Alert classes.',
		'priority'      => 80,
		'type'          => 'select',
		'choices'       => array( 'error' => 'Error (Red)', 'success' => 'Success (Green)', 'warn' => 'Warning (Yellow)', 'info' => 'Info (Blue)' ),
	) );
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
		#customize-controls #customize-theme-controls .description.settings-description { margin-bottom: 0; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'eddwp_customizer_styles' );