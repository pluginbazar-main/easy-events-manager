<?php
/**
 * Single Event - Attendees
 *
 * @package single-event/attendees.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $template_section;

$count  = $template_section && isset( $template_section['count'] ) ? $template_section['count'] : 8;
$button = $template_section && isset( $template_section['button'] ) && is_array( $template_section['button'] ) ? reset( $template_section['button'] ) : '';

?>
<div class="eem-event-section eem-attendees-style-1 eem-spacer eem-force-full-width bg-white">
    <div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Attendees List', EEM_TD ),
				'sub_heading' => esc_html__( 'Who attend our Event', EEM_TD ),
				'short_desc'  => esc_html__( 'See the peoples are already reserved their seat and ready to attend this event', EEM_TD ),
			)
		); ?>

        <div class="pb-row">
			<?php foreach ( $event->get_attendees( $count ) as $attendee_email ) {

				$attendee      = get_user_by( 'email', $attendee_email );
				$attendee_url  = eem_get_user_profile_url( $attendee->ID );
				$attendee_img  = sprintf( '<div class="eem-attendees-img"><a href="%s">%s</a></div>', $attendee_url, get_avatar( $attendee_email ) );
				$attendee_name = sprintf( '<h3 class="eem-attendees-name"><a href="%s">%s</a></h3>', $attendee_url, $attendee->display_name );

				printf( '<div class="pb-col-md-6 pb-col-lg-3"><div class="eem-attendees-single">%s%s</div></div>', $attendee_img, $attendee_name );
			} ?>
        </div>

		<?php if ( $button !== 'yes' ) {
			eem_print_button( esc_html__( 'All Attendees', EEM_TD ), 'a', 'eem-btn eem-btn-large',
				$event->get_endpoint_url( 'attendees' ), '<div class="view-more text-center">%</div>' );
		} ?>

    </div>
</div>
