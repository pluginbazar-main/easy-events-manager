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

			add_action( 'init', array( $this, 'register_post_types_taxs' ) );

			add_filter( 'query_vars', array( $this, 'add_query_vars' ), 10 );
			add_filter( 'init', array( $this, 'add_endpoints' ), 10 );

			add_filter( 'archive_template', array( $this, 'display_event_archive' ) );
			add_filter( 'single_template', array( $this, 'display_single_event' ) );
			add_filter( 'eem_filters_eem_template_sections', array( $this, 'manage_template_sections' ) );

			add_action( 'wp_ajax_eem_add_new_day', array( $this, 'ajax_add_new_day' ) );
			add_action( 'wp_ajax_eem_add_new_session', array( $this, 'ajax_add_new_session' ) );
			add_action( 'wp_ajax_eem_add_new_speaker', array( $this, 'ajax_add_new_speaker' ) );
			add_action( 'wp_ajax_eem_add_section', array( $this, 'ajax_eem_add_section' ) );
		}


		function ajax_eem_add_section() {

			$section_id = isset( $_POST['section_id'] ) ? sanitize_text_field( $_POST['section_id'] ) : '';

			if ( empty( $section_id ) ) {
				wp_send_json_error();
			}

			$section_html = eem_print_template_section( array( 'section_id' => $section_id ), false );

			if ( is_wp_error( $section_html ) ) {
				wp_send_json_error( $section_html->get_error_message() );
			}

			wp_send_json_success( $section_html );
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

		function manage_template_sections( $sections ) {

			echo '<pre>'; print_r( 'ok' ); echo '</pre>';

			$event = eem_get_event();

			if ( ! $event instanceof EEM_Event ) {
				return $sections;
			}

			$priority = 1000;
			foreach ( eem()->get_meta( '_sections', $event->get_template_id(), array() ) as $section_id => $section ) {
				$sections[ $section_id ]['priority'] = $priority --;
			}

//			return $sections;
		}


		function display_single_event( $single_template ) {

			if ( is_singular( 'event_template' ) ) {
				wp_safe_redirect( home_url() );
			}

			if ( is_singular( 'event' ) ) {
				$single_template = EEM_PLUGIN_DIR . 'templates/single-event.php';
			}

			$event     = eem_get_event();
			$_sections = array_keys( eem()->get_meta( '_sections', $event->get_template_id(), array() ) );

			if ( ! empty( $_sections ) ) {
				foreach ( eem()->get_template_sections() as $section_id => $section ) {
					if ( isset( $section['priority'] ) && ! empty( $section['priority'] ) && ! in_array( $section_id, $_sections ) ) {
						remove_action( 'eem_single_event_main', sprintf( 'eem_single_event_main_%s', $section_id ), $section['priority'] );
					}
				}
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
		 * Add custom endpoint
		 */
		function add_endpoints() {

			foreach ( eem()->get_custom_endpoints() as $endpoint ) {
				add_rewrite_endpoint( $endpoint, EP_PERMALINK | EP_PAGES );
			}
		}

		/**
		 * Add Query Var
		 *
		 * @param $vars
		 *
		 * @return array
		 */
		function add_query_vars( $vars ) {

			foreach ( eem()->get_custom_endpoints() as $endpoint ) {
				$vars[] = $endpoint;
			}

			return $vars;
		}


		/**
		 * Register Post types and taxonomies
		 */
		function register_post_types_taxs() {

			eem()->PB()->register_post_type( 'event', array(
				'singular'      => esc_html__( 'Event', EEM_TD ),
				'plural'        => esc_html__( 'All Events', EEM_TD ),
				'menu_icon'     => 'dashicons-nametag',
				'has_archive'   => true,
				'menu_position' => 15,
				'supports'      => array( 'title', 'thumbnail' ),
			) );

			eem()->PB()->register_taxonomy( 'event_cat', 'event', array(
				'singular' => esc_html__( 'Event Category', EEM_TD ),
				'plural'   => esc_html__( 'Event Categories', EEM_TD ),
			) );

			eem()->PB()->register_post_type( 'event_template', array(
				'singular'     => esc_html__( 'Template', EEM_TD ),
				'plural'       => esc_html__( 'Templates', EEM_TD ),
				'public'       => false,
				'supports'     => array( 'title' ),
				'show_in_menu' => 'edit.php?post_type=event',
			) );

			do_action( 'eem_register_post_types_taxs', $this );
		}
	}

	new EEM_Hooks();
}