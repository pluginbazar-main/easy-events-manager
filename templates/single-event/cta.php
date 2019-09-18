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

?>
<div class="eem-event-section eem-cta-style-1 eem-force-full-width">
    <div class="pb-container">
        <div class="eem-cta-wrap">
            <div class="eem-cta-content">

				<?php eem_print_event_section_heading(
					array(
						'heading'     => esc_html__( 'Speakers', EEM_TD ),
						'sub_heading' => esc_html__( 'Who will deliver speeches', EEM_TD ),
						'short_desc'  => esc_html__( 'Meet our speakers who will continue with their discussion', EEM_TD ),
					)
				); ?>

            </div>
            <div class="eem-cta-button">
                <a href="#">Get Ticket Now!</a>
            </div>
        </div>
    </div>
</div>
