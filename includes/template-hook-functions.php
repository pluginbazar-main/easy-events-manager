<?php
/**
 * Template Functions
 */


/**
 * Admin Templates
 */

if ( ! function_exists( 'eem_pb_settings_attendees' ) ) {
	function eem_pb_settings_attendees() {
		require_once( EEM_PLUGIN_DIR . 'includes/admin-templates/attendees.php' );
	}
}

if ( ! function_exists( 'eem_pb_display_extensions' ) ) {
	function eem_pb_display_extensions() {
		require_once( EEM_PLUGIN_DIR . 'includes/admin-templates/extensions.php' );
	}
}


/**
 * Frontend Templates
 */

if ( ! function_exists( 'eem_single_event_main_banner' ) ) {
	function eem_single_event_main_banner() {
		eem_set_template_section( 'banner' );
		eem_get_template( 'single-event/banner.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_speakers' ) ) {
	function eem_single_event_main_speakers() {
		eem_set_template_section( 'speakers' );
		eem_get_template( 'single-event/speakers.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_schedules' ) ) {
	function eem_single_event_main_schedules() {
		eem_set_template_section( 'schedules' );
		eem_get_template( 'single-event/schedules.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_tickets' ) ) {
	function eem_single_event_main_tickets() {
		eem_set_template_section( 'tickets' );
		eem_get_template( 'single-event/tickets.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_register' ) ) {
	function eem_single_event_main_register() {
		eem_set_template_section( 'register' );
		eem_get_template( 'single-event/register.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_attendees' ) ) {
	function eem_single_event_main_attendees() {
		eem_set_template_section( 'attendees' );
		eem_get_template( 'single-event/attendees.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_cta' ) ) {
	function eem_single_event_main_cta() {
		eem_set_template_section( 'cta' );
		eem_get_template( 'single-event/cta.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_sponsors' ) ) {
	function eem_single_event_main_sponsors() {
		eem_set_template_section( 'sponsors' );
		eem_get_template( 'single-event/sponsors.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_gallery' ) ) {
	function eem_single_event_main_gallery() {
		eem_set_template_section( 'gallery' );
		eem_get_template( 'single-event/gallery.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_nearby' ) ) {
	function eem_single_event_main_nearby() {
		eem_set_template_section( 'nearby' );
		eem_get_template( 'single-event/nearby.php' );
	}
}

if ( ! function_exists( 'eem_single_event_main_news' ) ) {
	function eem_single_event_main_news() {
		eem_set_template_section( 'news' );
		eem_get_template( 'single-event/news.php' );
	}
}

if ( ! function_exists( 'eem_archive_event_search' ) ) {
	function eem_archive_event_search() {
		eem_get_template( 'loop/search.php' );
	}
}

if ( ! function_exists( 'eem_archive_event_loop_start' ) ) {
	function eem_archive_event_loop_start() {
		eem_get_template( 'loop/start.php' );
	}
}

if ( ! function_exists( 'eem_archive_event_pagination' ) ) {
	function eem_archive_event_pagination() {
		eem_get_template( 'loop/pagination.php' );
	}
}

if ( ! function_exists( 'eem_archive_event_loop_end' ) ) {
	function eem_archive_event_loop_end() {
		eem_get_template( 'loop/end.php' );
	}
}

if ( ! function_exists( 'eem_event_archive_item_main_thumb' ) ) {
	function eem_event_archive_item_main_thumb() {
		eem_get_template( 'loop/thumb.php' );
	}
}

if ( ! function_exists( 'eem_event_archive_item_main_title' ) ) {
	function eem_event_archive_item_main_title() {
		eem_get_template( 'loop/title.php' );
	}
}

if ( ! function_exists( 'eem_event_archive_item_main_meta' ) ) {
	function eem_event_archive_item_main_meta() {
		eem_get_template( 'loop/meta.php' );
	}
}


if ( ! function_exists( 'eem_event_archive_item_main_excerpt' ) ) {
	function eem_event_archive_item_main_excerpt() {
		eem_get_template( 'loop/excerpt.php' );
	}
}


if ( ! function_exists( 'eem_event_archive_item_main_button' ) ) {
	function eem_event_archive_item_main_button() {
		eem_get_template( 'loop/button.php' );
	}
}

if ( ! function_exists( 'eem_display_loader' ) ) {
	function eem_display_loader() {

		global $current_screen;

		if ( in_array( $current_screen->post_type, array( 'event', 'event_template' ) ) ) {
			printf( '<div class="eem-loader-wrap"><div class="eem-loader"></div></div>' );
		}
	}
}
