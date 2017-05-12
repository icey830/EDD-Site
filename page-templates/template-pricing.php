<?php
/**
 * Template Name: Pricing
 *
 * the template for displaying EDD pricing information
 */

get_header(); ?>

<div id="pricing-table-area" class="page-section-white full-width">
	<div class="inner">
		<div class="pricing-table-content flex-container">
			<div class="free-column pricing-table-column flex-four">
				<div class="column-heading plain">
					Free
				</div>
			</div>
			<div class="starter-package-column pricing-table-column flex-four">
				<div class="column-heading enhanced-dark">
					Starter Package
				</div>
			</div>
			<div class="core-bundle-column pricing-table-column flex-four">
				<div class="column-heading enhanced">
					Core Bundle
				</div>
			</div>
			<div class="a-la-carte-column pricing-table-column flex-four">
				<div class="column-heading">
					À la carte
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
