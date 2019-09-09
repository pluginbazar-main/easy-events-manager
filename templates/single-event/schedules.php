<?php
/**
 * Single Event - Schedules
 *
 * @package single-event/schedules.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


global $event;

echo '<pre>'; print_r( $event->get_schedules() ); echo '</pre>';


?>

<div class="eem-event-section eem-schedules-style-1 eem-spacer bg-white eem-force-full-width">
	<div class="pb-container">

	</div>
</div>
