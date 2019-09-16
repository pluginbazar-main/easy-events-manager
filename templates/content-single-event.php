<?php
/**
 * Single event content template
 *
 * @package content-single-event.php
 */


global $event;

$event = eem_get_event();


do_action( 'eem_before_single_event' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

?>
    <div id="event-<?php the_ID(); ?>" <?php // eem_single_post_class(); ?>>
		<?php

		if ( ! empty( $current_endpoint = eem_get_current_endpoint() ) ) {

			do_action( 'before_endpoint_page' );

			call_user_func( sprintf( 'eem_single_event_main_%s', $current_endpoint ) );

			do_action( 'after_endpoint_page' );
		} else {

			/**
             * Single Event Content
             *
			 * @see eem_single_event_main_banner()
			 * @see eem_single_event_main_speakers()
			 * @see eem_single_event_main_tickets()
			 * @see eem_single_event_main_schedules()
			 * @see eem_single_event_main_register()
			 * @see eem_single_event_main_attendees()
			 * @see eem_single_event_main_cta()
			 * @see eem_single_event_main_sponsors()
			 * @see eem_single_event_main_gallery()
			 * @see eem_single_event_main_news()
			 */
			do_action( 'eem_single_event_main' );
		}

		?>
    </div>

<?php
do_action( 'eem_after_single_event' );