<?php
/**
 * Single Event - CTA
 *
 * @package single-event/cta.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $template_section;

$button_text = $template_section && isset( $template_section['button_text'] ) ? $template_section['button_text'] : esc_html__('Get Tickets');
$button_url  = $template_section && isset( $template_section['button_url'] ) ? $template_section['button_url'] : '';

?>
<div class="eem-event-section eem-cta-style-1">
    <div class="pb-container">
        <div class="eem-cta-wrap">
            <div class="eem-cta-content">

				<?php eem_print_event_section_heading(
					array(
						'heading'     => esc_html__( 'Purchase your Ticket', EEM_TD ),
						'sub_heading' => esc_html__( 'Why be late!', EEM_TD ),
						'short_desc'  => esc_html__( 'Hurry up! Get your tickets right now. We have only few tickets left.', EEM_TD ),
					)
				); ?>

            </div>

	        <?php eem_print_button( $button_text, 'a', '', $button_url, '<div class="eem-cta-button">%</div>' ); ?>

        </div>
    </div>
</div>
