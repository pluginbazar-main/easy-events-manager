<?php
/**
 * Single Event - Pricing
 *
 * @package single-event/pricing.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div <?php eem_print_event_section_classes( 'eem-event-section eem-pricing-style-1 bg-white eem-spacer eem-force-full-width' ); ?>>
	<div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Pricing', EEM_TD ),
				'sub_heading' => esc_html__( 'How much it costs', EEM_TD ),
				'short_desc'  => esc_html__( 'Look at the features and choose the correct ticket which suits best', EEM_TD ),
			)
		); ?>

		<div class="pb-row">
			<div class="pb-col-md-6 pb-col-lg-4">
				<div class="eem-pricing-plan">
					<div class="pricing-head">
						<div class="price"><span class="currency">$</span>199.99</div>
						<h3 class="pricing-title">Main Conference</h3>
						<h4 class="pricing-duration">1 day</h4>
					</div>
					<div class="pricing-content">
						<div class="pricing-icon"><i class="icofont-aim"></i></div>
						<ul>
							<li>Access to mobile app</li>
							<li>Access to 1000+ talk</li>
							<li class="not-in">Access to exhibition floor</li>
							<li>Access attendee database</li>
							<li class="not-in">Email support</li>
						</ul>
					</div>
					<div class="pricing-footer">
						<a href="#">Get Ticket</a>
					</div>
				</div>
			</div>
			<div class="pb-col-md-6 pb-col-lg-4">
				<div class="eem-pricing-plan is-featured">
					<div class="pricing-head">
						<div class="price"><span class="currency">$</span>299.99</div>
						<h3 class="pricing-title">Conference + Workshops</h3>
						<h4 class="pricing-duration">1 + 1 (2) days</h4>
					</div>
					<div class="pricing-content">
						<div class="pricing-icon"><i class="icofont-space-shuttle"></i></div>
						<ul>
							<li>Access to mobile app</li>
							<li>Access to 1000+ talk</li>
							<li class="not-in">Access to exhibition floor</li>
							<li>Access attendee database</li>
							<li>Email support</li>
						</ul>
					</div>
					<div class="pricing-footer">
						<a href="#">Get Ticket</a>
					</div>
				</div>
			</div>
			<div class="pb-col-md-6 pb-col-lg-4">
				<div class="eem-pricing-plan">
					<div class="pricing-head">
						<div class="price"><span class="currency">$</span>399.99</div>
						<h3 class="pricing-title">Conference + Workshops</h3>
						<h4 class="pricing-duration">1 + 2 (3) days</h4>
					</div>
					<div class="pricing-content">
						<div class="pricing-icon"><i class="icofont-microphone-alt"></i></div>
						<ul>
							<li>Access to mobile app</li>
							<li>Access to 1000+ talk</li>
							<li>Email support</li>
							<li>Access to exhibition floor</li>
							<li>Access attendee database</li>
						</ul>
					</div>
					<div class="pricing-footer">
						<a href="#">Get Ticket</a>
					</div>
				</div>
			</div>
		</div>
		<div class="view-more text-center">
			<a href="#" class="eem-btn eem-btn-large">More Tickets!</a>
		</div>
	</div>
</div>
