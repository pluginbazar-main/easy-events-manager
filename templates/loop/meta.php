<?php
/**
 * Archive Event - Meta Data(s)
 *
 * @package loop/meta.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $wp_query;

$meta_data = array();

if ( ! in_array( 'date', $wp_query->get( 'hide_item_parts' ) ) && ! empty( $date = $event->get_event_datetime( 'start', 'jS M, Y' ) ) ) {
	$meta_data[] = sprintf( '<span class="event-meta-date"><i class="icofont-calendar"></i> <span>%s</span></span>',
		$date
	);
}

if ( ! in_array( 'location', $wp_query->get( 'hide_item_parts' ) ) && ! empty( $location = $event->get_location() ) ) {
	$meta_data[] = sprintf( '<span class="event-meta-location"><i class="icofont-location-pin"></i> <span>%s</span></span>',
		$location
	);
}

if ( ! empty( $meta_data ) ) {
	printf( '<div class="event-meta">%s</div>', implode( '', $meta_data ) );
}