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

if ( in_array( 'thumb', $wp_query->get( 'hide_item_parts' ) ) || ! $event->has_thumbnail() ) {
	return;
}

?>
<div class="image-wrap">
    <a href="<?php echo esc_url( $event->get_permalink() ); ?>">
        <img src="<?php echo esc_url( $event->get_thumbnail( 'event_post' ) ); ?>"
             alt="<?php echo esc_attr( $event->get_name() ); ?>">
    </a>

    <span class="eem-event-status"><?php echo ucwords( esc_html( str_replace( '_', ' ', $event->get_event_status() ) ) ); ?></span>
</div>
