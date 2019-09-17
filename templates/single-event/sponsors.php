<?php
/**
 * Single Event - Sponsors
 *
 * @package single-event/sponsors.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $template_section;

echo '<pre>'; print_r( $template_section ); echo '</pre>';


?>
<div <?php eem_print_event_section_classes( 'eem-event-section eem-sponsors-style-1 eem-spacer eem-force-full-width' ); ?>>
	<div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Sponsors', EEM_TD ),
				'sub_heading' => esc_html__( 'Who make this event grateful', EEM_TD ),
				'short_desc'  => esc_html__( 'See the sponsors who helps sponsored this event and give them a big hands', EEM_TD ),
			)
		); ?>

		<div class="pb-grid pb-grid-4">
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-12.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-8.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-6.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-1.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-3.png"
							alt="Sponsors Image"></a>
				</div>
			</div>

			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-2.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-11.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-10.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-9.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-7.png"
							alt="Sponsors Image"></a>
				</div>
			</div>

			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-5.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
			<div class="pb-grid-col">
				<div class="sponsors-single">
					<a href="#"><img
							src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-4.png"
							alt="Sponsors Image"></a>
				</div>
			</div>
		</div>

		<?php if ( ! empty( $event_speakers ) ) {
			eem_print_button( esc_html__( 'View All Sponsors', EEM_TD ), 'a', 'eem-btn eem-btn-large',
				$event->get_endpoint_url( 'sponsors' ), '<div class="view-more text-center">%</div>' );
		} ?>

	</div>
</div>
