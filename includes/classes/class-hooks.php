<?php
/**
 * EEM - Class - Hooks
 *
 * @see EEM_Hooks
 */

if ( ! class_exists( 'EEM_Hooks' ) ) {
	/**
	 * Class EEM_Hooks
	 */
	class EEM_Hooks {


		/**
		 * EEM_Hooks constructor.
		 */
		function __construct() {

			add_action( 'init', array( $this, 'register_post_types_taxs_pages_shortcode' ) );
			add_action( 'post_submitbox_misc_actions', array( $this, 'publish_box_content' ) );

			add_filter( 'query_vars', array( $this, 'add_query_vars' ), 10 );
			add_filter( 'init', array( $this, 'add_endpoints' ), 10 );

			add_filter( '404_template', array( $this, 'manage_archive_template' ) );
			add_filter( 'archive_template', array( $this, 'display_event_archive' ) );
			add_filter( 'single_template', array( $this, 'display_single_event' ) );

			add_action( 'wp_ajax_eem_add_new_day', array( $this, 'ajax_add_new_day' ) );
			add_action( 'wp_ajax_eem_add_new_session', array( $this, 'ajax_add_new_session' ) );
			add_action( 'wp_ajax_eem_add_new_speaker', array( $this, 'ajax_add_new_speaker' ) );
			add_action( 'wp_ajax_eem_add_section', array( $this, 'ajax_eem_add_section' ) );
			add_action( 'wp_ajax_eem_add_new_sponsor', array( $this, 'ajax_eem_add_sponsor' ) );
			add_action( 'wp_ajax_eem_add_attendees', array( $this, 'ajax_eem_add_attendees' ) );
			add_action( 'wp_ajax_nopriv_eem_add_attendees', array( $this, 'ajax_eem_add_attendees' ) );

			add_action( 'eem_before_event_archive_main', array( $this, 'event_query_start' ), 1 );
			add_action( 'eem_after_event_archive_main', array( $this, 'event_query_end' ), 999 );
		}


		function display_events_archive( $atts = array(), $contnet = null ) {

			global $eem_doing_shortcode;

			$eem_doing_shortcode = true;

			ob_start();

			eem_get_template( 'archive-event.php' );

			return ob_get_clean();
		}


		/**
		 * Archive event query start
		 */
		function event_query_start() {

			global $wp_query, $eem_query_prev;

			if ( get_query_var( 'paged' ) ) {
				$paged = absint( get_query_var( 'paged' ) );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = absint( get_query_var( 'page' ) );
			} else {
				$paged = 1;
			}

			$eem_query_prev          = $wp_query;
			$args['post_type']       = 'event';
			$args['paged']           = $paged;
			$args['posts_per_page']  = eem()->get_option( 'eem_archive_items', 6 );
			$args['posts_per_row']   = (int) ( 12 / eem()->get_option( 'eem_archive_items_per_row', 3 ) );
			$args['hide_item_parts'] = eem()->get_option( 'eem_archive_hide_item_parts', array() );
			$args['show_pagination'] = eem()->get_option( 'eem_archive_show_pagination', 'yes' );
			$args['prev_text']       = eem()->get_option( 'eem_archive_pagination_prev_text', esc_html__( 'Prev', EEM_TD ) );
			$args['next_text']       = eem()->get_option( 'eem_archive_pagination_next_text', esc_html__( 'Next', EEM_TD ) );

			// Search Keyword
			if ( isset( $_GET['k'] ) && ! empty( $keyword = sanitize_text_field( $_GET['k'] ) ) ) {
				$args['s'] = $keyword;
			}

			$wp_query = new WP_Query( apply_filters( 'eem_filters_event_archive_args', $args ) );
		}


		/**
		 * Archive event query end
		 */
		function event_query_end() {

			global $wp_query, $eem_query_prev;

			wp_reset_query();

			$wp_query = $eem_query_prev;
		}


		/**
		 * Add ajax attendees in backend
		 *
		 * @ajax eem_add_attendees
		 */
		function ajax_eem_add_attendees() {

			if ( ! isset( $_POST['form_data'] ) ) {
				wp_send_json_error();
			}

			parse_str( $_POST['form_data'], $form_data );

			$event_id  = isset( $form_data['event_id'] ) ? sanitize_text_field( $form_data['event_id'] ) : '';
			$full_name = isset( $form_data['full_name'] ) ? sanitize_text_field( $form_data['full_name'] ) : '';
			$email_add = isset( $form_data['email_add'] ) ? sanitize_email( $form_data['email_add'] ) : '';

			if ( empty( $event_id ) || $event_id === 0 ) {
				wp_send_json_error( esc_html__( 'Trying invalid event !', EEM_TD ) );
			}

			if ( empty( $email_add ) ) {
				wp_send_json_error( esc_html__( 'Invalid email address provided !', EEM_TD ) );
			}

			$user_id = email_exists( $email_add );

			if ( ! $user_id ) {

				$user_args = array(
					'user_login'   => eem_create_username( $email_add, array( 'full_name' => $full_name ) ),
					'user_email'   => $email_add,
					'display_name' => $full_name,
				);
				$user_id   = wp_insert_user( $user_args );

				if ( is_wp_error( $user_id ) ) {
					wp_send_json_error( $user_id->get_error_message() );
				}
			}

			$ret = eem_insert_attendee( $event_id, $user_id );

			if ( is_wp_error( $ret ) ) {
				wp_send_json_error( $ret->get_error_message() );
			}

			wp_send_json_success( esc_html__( 'Attendee added successfully', EEM_TD ) );
		}


		/**
		 * Add ajax sponsors in backend
		 */
		function ajax_eem_add_sponsor() {

			$unique_id = isset( $_POST['unique_id'] ) ? sanitize_text_field( $_POST['unique_id'] ) : current_time( 'timestamp' );

			wp_send_json_success( eem_print_event_sponsor( array( 'id' => $unique_id ), false ) );
		}


		/**
		 * Add ajax add section in backend
		 */
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
		 * Add ajax speaker in backend
		 */
		function ajax_add_new_speaker() {

			$unique_id = isset( $_POST['unique_id'] ) ? sanitize_text_field( $_POST['unique_id'] ) : current_time( 'timestamp' );

			wp_send_json_success( eem_print_event_speaker( array( 'id' => $unique_id ), false ) );
		}


		/**
		 * Add ajax session in backend
		 */
		function ajax_add_new_session() {

			$unique_id   = isset( $_POST['unique_id'] ) ? sanitize_text_field( $_POST['unique_id'] ) : date( 'U' );
			$schedule_id = isset( $_POST['schedule_id'] ) ? sanitize_text_field( $_POST['schedule_id'] ) : 0;

			wp_send_json_success( eem_print_session_content( $schedule_id, array( 'id' => $unique_id ), false ) );
		}


		/**
		 * Add ajax day in backend
		 */
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


		/**
		 * Manage Archive page template with an issue with 404 template
		 *
		 * @param $template
		 *
		 * @return string
		 * @todo needs improvements in the method used to solve the issue
		 */
		function manage_archive_template( $template ) {

			global $wp_query;

			if ( get_query_var( 'paged' ) ) {
				$paged = absint( get_query_var( 'paged' ) );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = absint( get_query_var( 'page' ) );
			} else {
				$paged = 1;
			}

			if ( $wp_query->get( 'post_type' ) == 'event' && $paged > 1 ) {
				$template = EEM_PLUGIN_DIR . 'templates/archive-event.php';
			}

			return $template;
		}


		/**
		 * Display single template
		 *
		 * @param $single_template
		 *
		 * @return string
		 */
		function display_single_event( $single_template ) {

			if ( is_singular( 'event_template' ) ) {
				wp_safe_redirect( home_url() );
			}

			if ( is_singular( 'event' ) ) {
				$single_template = EEM_PLUGIN_DIR . 'templates/single-event.php';
			}

			$event = eem_get_event();

			if ( $event instanceof EEM_Event ) {

				$_sections = array_keys( eem()->get_meta( '_sections', $event->get_template_id(), array() ) );

				if ( ! empty( $_sections ) ) {
					foreach ( eem()->get_template_sections() as $section_id => $section ) {
						remove_action( 'eem_single_event_main', sprintf( 'eem_single_event_main_%s', $section_id ), $section['priority'] );
					}
				}

				foreach ( $_sections as $index => $section_id ) {
					add_action( 'eem_single_event_main', sprintf( 'eem_single_event_main_%s', $section_id ), 100 + $index );
				}
			}

			return $single_template;
		}


		/**
		 * Add custom endpoint
		 */
		function add_endpoints() {

			foreach ( eem()->get_custom_endpoints() as $endpoint ) {
				add_rewrite_endpoint( $endpoint, EP_PERMALINK | EP_PAGES | EP_ALL );
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
		 * Publish Box content for event Type
		 */
		function publish_box_content() {

			if ( get_post_type() === 'event' ) {
				include EEM_PLUGIN_DIR . 'includes/admin-templates/event-publish-box.php';
			}
		}


		/**
		 * Register Post types and taxonomies
		 */
		function register_post_types_taxs_pages_shortcode() {

			eem()->PB()->register_post_type( 'event', array(
				'singular'      => esc_html__( 'Event', EEM_TD ),
				'plural'        => esc_html__( 'All Events', EEM_TD ),
				'menu_icon'     => 'dashicons-nametag',
				'menu_position' => 15,
				'supports'      => array( 'title' ),
				'has_archive'   => eem()->get_option( 'eem_archive_slug', 'events' ),
				'rewrite'       => array(
					'slug'       => 'event',
					'with_front' => false,
					'pages'      => true,
					'feeds'      => true,
				),
			) );

			eem()->PB()->register_taxonomy( 'event_cat', 'event', array(
				'singular'     => esc_html__( 'Event Category', EEM_TD ),
				'plural'       => esc_html__( 'Event Categories', EEM_TD ),
				'hierarchical' => true,
			) );

			eem()->PB()->register_post_type( 'event_template', array(
				'singular'     => esc_html__( 'Template', EEM_TD ),
				'plural'       => esc_html__( 'Templates', EEM_TD ),
				'public'       => false,
				'supports'     => array( 'title' ),
				'show_in_menu' => 'edit.php?post_type=event',
			) );

			add_image_size( 'event_post', 350, 196, true );
			add_image_size( 'event_nearby', 570, 319, true );
			add_image_size( 'event_gallery', 500, 480, true );

			/**
			 * Register Attendees Admin Page
			 */
			eem()->PB( array(
				'add_in_menu'     => true,
				'menu_type'       => 'submenu',
				'menu_title'      => esc_html__( 'Attendees', EEM_TD ),
				'page_title'      => esc_html__( 'Attendees', EEM_TD ),
				'menu_page_title' => esc_html__( 'View Attendees', EEM_TD ),
				'capability'      => 'manage_options',
				'menu_slug'       => 'attendees',
				'parent_slug'     => "edit.php?post_type=event",
				'show_submit'     => false,
			) );

			eem()->PB( array(
				'add_in_menu'     => true,
				'menu_type'       => 'submenu',
				'menu_title'      => esc_html__( 'Settings', EEM_TD ),
				'page_title'      => esc_html__( 'Settings', EEM_TD ),
				'menu_page_title' => esc_html__( 'Easy Events Manager - Settings', EEM_TD ),
				'capability'      => 'manage_options',
				'menu_slug'       => 'eem-settings',
				'parent_slug'     => "edit.php?post_type=event",
				'pages'           => eem()->get_settings(),
			) );

			eem()->PB( array(
				'add_in_menu'     => true,
				'menu_type'       => 'submenu',
				'menu_title'      => esc_html__( 'Extensions', EEM_TD ),
				'page_title'      => esc_html__( 'Extensions', EEM_TD ),
				'menu_page_title' => esc_html__( 'Easy Events Manager - Extensions', EEM_TD ),
				'capability'      => 'manage_options',
				'menu_slug'       => 'eem-extensions',
				'parent_slug'     => "edit.php?post_type=event",
				'show_submit'     => false,
			) );

			eem()->PB()->register_shortcode( 'events-archive', array( $this, 'display_events_archive' ) );

			do_action( 'eem_post_types_taxs_pages', $this );
		}
	}

	new EEM_Hooks();
}