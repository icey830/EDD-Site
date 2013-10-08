<?php
/**
 * The template for displaying the header.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri() ?>/images/favicon.png" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/images/touch-icon-iphone.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/images/touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/images/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/images/touch-icon-ipad-retina.png" />

	<?php if ( is_front_page() ) { ?>
	<meta name="apple-itunes-app" content="app-id=625303275">
	<?php } // end if ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="header-outer">
		<header class="header clearfix">
			<div id="logo">
				<a href="<?php echo get_option( 'siteurl' ); ?>" class="logo-image"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="Easy Digital Downloads" /></a>
			</div><!-- #logo -->

			<i class="icon-list"></i>

			<nav id="primary" class="navigation-main" role="navigation">
				<?php
					wp_nav_menu( array( 'theme_location' => 'primary' ) );
				?>
			</nav><!-- /#primary -->
		</header><!-- /.header -->
	</div><!-- /.header-outer -->