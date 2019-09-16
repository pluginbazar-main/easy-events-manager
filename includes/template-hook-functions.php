<?php
/**
 * Template Functions
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

if ( ! function_exists( 'eem_single_event_main_floating_box' ) ) {
	function eem_single_event_main_floating_box() {
		eem_get_template( 'single-event/floating-box.php' );
	}
}