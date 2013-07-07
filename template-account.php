<?php
/**
 * Template Name: My Account
 *
 * @package EDD
 * @version 1.0
 * @since   1.0
 */
?>
<?php get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">			
			<?php if ( is_user_logged_in() ) { ?>
			
			<section class="content clearfix">
				<?php while ( have_posts() ) { the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
					<h1><?php the_title(); ?></h1>
				</article><!-- /#post-<?php echo get_the_ID(); ?> -->
				<?php } ?>
			</section><!-- /.content -->

			<ul class="nav nav-tabs nav-append-content">
				<li class="active"><a href="#tab1" data-toggle="tab">Purchases</a></li>
				<li><a href="#tab2" data-toggle="tab">Profile</a></li>
				<?php if ( eddc_user_has_commissions() ) { ?>
				<li><a href="#tab3" data-toggle="tab">Commissions</a></li>
				<?php } // end if ?>
				<li><a href="#tab4" data-toggle="tab">Support Subscription</a></li>
			</ul><!-- /.nav-tabs -->
			
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<?php edd_get_template_part( 'history', 'purchases' ); ?>
				</div><!-- /.tab-pane -->
				
				<div class="tab-pane" id="tab2">
					<?php edd_get_template_part( 'shortcode', 'profile-editor' ); ?>
				</div><!-- /.tab-pane -->
				
				<div class="tab-pane" id="tab3">
					<?php echo eddc_user_commissions(); ?>
				</div><!-- /.tab-pane -->
				
				<div class="tab-pane" id="tab4">
					<?php
					echo do_shortcode( '[subscription_details]' );
					echo do_shortcode( '[card_details]' );
					?>
				</div><!-- /.tab-pane -->
			</div><!-- /.tab-content -->
			
			<?php } else { ?>
			
			<section class="content clearfix">
				<h1>You must be logged-in to access your account information.</h1>
				<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
					<fieldset>
						<div class="row">
							<input type="text" placeholder="Username" id="user_login" size="20" value="" name="log" />
						</div><!-- /.row -->
						
						<div class="row">
							<input type="password" placeholder="Password" id="user_pass" size="20" value="" name="pwd" />
						</div><!-- /.row -->
					</fieldset>
					
					<div class="row clearfix">
						<input type="checkbox" name="rememberme" id="rememberme" value="forever" checked="checked" />
						<label for="rememberme">Remember my password</label>
						<input type="submit" name="wp-submit" value="Sign In" />
						<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
					</div>
				</form><!-- /#loginform -->
			</div>
			
			<?php } // end if ?>
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>