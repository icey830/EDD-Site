<?php
/**
 * The template for displaying the Checkout.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2014, Sunny Ratilal.
 */

get_header(); ?>

	<section class="main clearfix">
		<div class="container clearfix">
			<section class="content<?php if ( ! edd_get_cart_contents() ) echo ' checkout-cart-empty'; ?>">
				<?php while ( have_posts() ) { the_post(); ?>
					<?php if ( edd_get_cart_contents() ) { ?>
						<article class="entry">
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</article>
					<?php } else { ?>
						<article class="entry">
							<h1>Your cart is empty!</h1>
							<h2 class="tagline">Here are some extensions you may be interested in.</h2>
							<?php eddwp_display_extensions(); ?>

							<h2 class="tagline">Or maybe you're interested in some themes?</h2>
							<?php eddwp_display_themes(); ?>
						</article>
					<?php } ?>
				<?php } ?>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</section><!-- /.main -->

<?php get_footer(); ?>