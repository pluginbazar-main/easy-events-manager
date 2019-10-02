<?php
/**
 * Archive Content
 *
 * @package content-archive.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query, $event;

$event = eem_get_event();

?>

<div class="pb-col-lg-<?php echo esc_attr( $wp_query->get( 'posts_per_row' ) ); ?> pb-col-md-6">
    <div class="eem-event-single">

		<?php
		/**
		 * Event Archive Loop Before Main Item
		 *
		 * @see eem_event_archive_item_main_thumb()
		 */
		do_action( 'eem_event_archive_item_main_before' );
		?>

        <div class="eem-event-content">
			<?php
			/**
			 * Event Archive Loop Main Item
			 *
			 * @see eem_event_archive_item_main_title()
			 * @see eem_event_archive_item_main_meta()
			 * @see eem_event_archive_item_main_excerpt()
			 * @see eem_event_archive_item_main_button()
			 */
			do_action( 'eem_event_archive_item_main' );
			?>
        </div>

    </div>
</div>
