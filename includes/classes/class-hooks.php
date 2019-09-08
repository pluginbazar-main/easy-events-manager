<?php
/**
 * EEM - Class - Hooks
 *
 * @see EEM_Hooks
 */

if ( ! class_exists( 'EEM_Hooks' ) ) {
	class EEM_Hooks {

		/**
		 * EEM_Hooks constructor.
		 */
		function __construct() {
			add_filter( 'single_template', array( $this, 'display_single_event' ) );
			add_action( 'wp_ajax_eem_add_new_day', array( $this, 'ajax_add_new_day' ) );
			add_action( 'wp_ajax_eem_add_new_session', array( $this, 'ajax_add_new_session' ) );
		}

		function display_single_event( $single_template ) {

			if ( is_singular( 'event' ) ) {
				$single_template = EEM_PLUGIN_DIR . 'templates/single-event.php';

			}

			return $single_template;
		}


		function ajax_add_new_session() {

			$unique_id   = isset( $_POST['unique_id'] ) ? sanitize_text_field( $_POST['unique_id'] ) : date( 'U' );
			$schedule_id = isset( $_POST['schedule_id'] ) ? sanitize_text_field( $_POST['schedule_id'] ) : 0;

			wp_send_json_success( eem_print_session_content( $schedule_id, array( 'id' => $unique_id ), false ) );
		}

		function ajax_add_new_day() {

			$unique_id = isset( $_POST['unique_id'] ) ? sanitize_text_field( $_POST['unique_id'] ) : date( 'U' );
			$index_id  = isset( $_POST['index_id'] ) ? sanitize_text_field( $_POST['index_id'] ) : 0;

			wp_send_json_success( array(
				'day_nav'     => eem_print_event_schedule_day_nav( array(
					'id'    => $unique_id,
					'index' => $index_id,
				), false ),
				'day_content' => eem_print_event_schedule_day_content( array(
					'id'    => $unique_id,
					'index' => $index_id,
				), false ),
			) );
		}
	}

	new EEM_Hooks();
}