<?php
/**
 * Archive Event - Read more button
 *
 * @package loop/button.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $wp_query;

if ( in_array( 'button', $wp_query->get( 'hide_item_parts' ) ) ) {
	return;
}

eem_print_button( esc_html__( 'View details', EEM_TD ), 'a', 'eem-btn read-more', $event->get_permalink() );