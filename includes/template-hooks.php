<?php
/**
 * Template hooks
 */


add_action( 'eem_single_event_main', 'eem_single_event_main_banner', 10 );
add_action( 'eem_single_event_main', 'eem_single_event_main_speakers', 15 );
add_action( 'eem_single_event_main', 'eem_single_event_main_pricing', 20 );
add_action( 'eem_single_event_main', 'eem_single_event_main_register', 25 );
add_action( 'eem_single_event_main', 'eem_single_event_main_attendees', 30 );
add_action( 'eem_single_event_main', 'eem_single_event_main_cta', 35 );
add_action( 'eem_single_event_main', 'eem_single_event_main_sponsors', 40 );
add_action( 'eem_single_event_main', 'eem_single_event_main_gallery', 45 );
add_action( 'eem_single_event_main', 'eem_single_event_main_blog', 50 );