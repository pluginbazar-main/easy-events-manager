<?php
/**
 * Archive Event - Thumbnail
 *
 * @package loop/thumb.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $wp_query;

if ( in_array( 'title', $wp_query->get( 'hide_item_parts' ) ) ) {
	return;
}


?>
<h2><a href="<?php echo esc_url( $event->get_permalink() ); ?>"><?php echo esc_html( $event->get_name() ); ?></a></h2>
