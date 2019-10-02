<?php
/**
 * Template hooks
 */


/**
 * Admin Hooks
 */

add_action( 'pb_settings_attendees', 'eem_pb_settings_attendees' );
add_action( 'pb_settings_eem-extensions', 'eem_pb_display_extensions' );


foreach ( eem()->get_template_sections() as $section_id => $section ) {

	if ( in_array( $section_id, array( 'tickets' ) ) ) {
		continue;
	}

	if ( isset( $section['priority'] ) && ! empty( $section['priority'] ) ) {
		add_action( 'eem_single_event_main', sprintf( 'eem_single_event_main_%s', $section_id ), $section['priority'] );
	}
}


/**
 * Event Archive Page
 */

add_action( 'eem_before_event_archive_loop', 'eem_archive_event_search', 10 );
add_action( 'eem_before_event_archive_loop', 'eem_archive_event_loop_start', 15 );

add_action( 'eem_after_event_archive_loop', 'eem_archive_event_pagination', 998 );
add_action( 'eem_after_event_archive_loop', 'eem_archive_event_loop_end', 999 );


add_action( 'eem_event_archive_item_main_before', 'eem_event_archive_item_main_thumb', 10 );

add_action( 'eem_event_archive_item_main', 'eem_event_archive_item_main_title', 10 );
add_action( 'eem_event_archive_item_main', 'eem_event_archive_item_main_meta', 20 );
add_action( 'eem_event_archive_item_main', 'eem_event_archive_item_main_excerpt', 30 );
add_action( 'eem_event_archive_item_main', 'eem_event_archive_item_main_button', 40 );