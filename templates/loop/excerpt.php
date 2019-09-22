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

if ( in_array( 'excerpt', $wp_query->get( 'hide_item_parts' ) ) ) {
	return;
}

?>
<div class="event-desc">
	<?php echo wpautop( $event->get_content( 16 ) ); ?>
</div>
