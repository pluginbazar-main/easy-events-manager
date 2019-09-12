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

			add_action( 'init', array( $this, 'register_post_types' ) );

			add_filter( 'archive_template', array( $this, 'display_event_archive' ) );
			add_filter( 'single_template', array( $this, 'display_single_event' ) );

			add_action( 'wp_ajax_eem_add_new_day', array( $this, 'ajax_add_new_day' ) );
			add_action( 'wp_ajax_eem_add_new_session', array( $this, 'ajax_add_new_session' ) );
			add_action( 'wp_ajax_eem_add_new_speaker', array( $this, 'ajax_add_new_speaker' ) );
		}

		/**
		 * Display Archive template for Event
		 *
		 * @param $archive_template
		 *
		 * @return string
		 */
		function display_event_archive( $archive_template ) {

			if ( is_post_type_archive( 'event' ) ) {
				$archive_template = EEM_PLUGIN_DIR . 'templates/archive-event.php';
			}

			return $archive_template;
		}


		function display_single_event( $single_template ) {

			if ( is_singular( 'event' ) ) {
				$single_template = EEM_PLUGIN_DIR . 'templates/single-event.php';
			}

			return $single_template;
		}


		function ajax_add_new_speaker() {

			$unique_id = isset( $_POST['unique_id'] ) ? sanitize_text_field( $_POST['unique_id'] ) : current_time( 'timestamp' );

			wp_send_json_success( eem_print_event_speaker( array( 'id' => $unique_id ), false ) );
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


		/**
		 * Register Post types
		 */
		function register_post_types() {

			eem()->PB()->register_post_type( 'event', array(
				'singular'      => esc_html__( 'Event', EEM_TD ),
				'plural'        => esc_html__( 'All Events', EEM_TD ),
				'menu_icon'     => 'dashicons-nametag',
				'has_archive'   => true,
				'menu_position' => 15,
				'supports'      => array( 'title', 'thumbnail' ),
			) );

			do_action( 'eem_register_post_types', $this );
		}
	}

	new EEM_Hooks();
}