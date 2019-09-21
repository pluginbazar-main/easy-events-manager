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

$event_sponsors = array();
$sponsor_types  = eem()->get_sponsor_types();

foreach ( $event->get_sponsors() as $sponsor ) {
	if ( isset( $sponsor['type'] ) ) {
		$event_sponsors[ $sponsor['type'] ][] = $sponsor;
	}
}

?>
<div <?php eem_print_event_section_classes( 'eem-event-section eem-sponsors-style-1 eem-spacer eem-force-full-width' ); ?>>
    <div class="pb-container">

		<?php
		eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Sponsors', EEM_TD ),
				'sub_heading' => esc_html__( 'Who make this event grateful', EEM_TD ),
				'short_desc'  => esc_html__( 'See the sponsors who helps sponsored this event and give them a big hands', EEM_TD ),
			)
		);

		if ( empty( $event_sponsors ) ) {
			eem_print_event_notice( apply_filters( 'eem_filters_sponsors_not_found_text',
				esc_html__( 'No sponsors confirmed yet. We will announce latter. Stay close !', EEM_TD ) ), 'warning'
			);
		}

		foreach ( $sponsor_types as $type => $label ) {

			$sponsors = isset( $event_sponsors[ $type ] ) ? $event_sponsors[ $type ] : array();

			if ( empty( $sponsors ) || ! is_array( $sponsors ) ) {
				continue;
			}

			if ( $type == 'platinum' ) {
				$grid_items = 2;
			} elseif ( $type == 'gold' ) {
				$grid_items = 3;
			} elseif ( $type == 'silver' ) {
				$grid_items = 4;
			} else {
				$grid_items = 6;
			}

			$sponsors = array_map( function ( $sponsor ) {

				$s_name = isset( $sponsor['name'] ) ? $sponsor['name'] : '';
				$s_url  = isset( $sponsor['url'] ) ? $sponsor['url'] : '';
				$s_logo = isset( $sponsor['logo'] ) ? $sponsor['logo'] : '';
				$s_logo = wp_get_attachment_image_url( $s_logo, 'full' );

				return sprintf( '<div class="pb-grid-col"><div class="sponsors-single"><a href="%s"><img src="%s" alt="%s"></a></div></div>', $s_url, $s_logo, $s_name );
			}, $sponsors );

			printf( '<div class="text-center sponsor-type">%s</div><div class="pb-grid pb-grid-%s pb-justify-content-center">%s</div>', $label, $grid_items, implode( $sponsors ) );
		}

		?>

		<?php if ( ! empty( $event_sponsors ) ) {
			eem_print_button( esc_html__( 'View All Sponsors', EEM_TD ), 'a', 'eem-btn eem-btn-large',
				$event->get_endpoint_url( 'sponsors' ), '<div class="view-more text-center">%</div>' );
		} ?>

    </div>
</div>
