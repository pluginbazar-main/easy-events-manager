<?php
/**
 * EEM - Class - Post Meta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


if ( ! class_exists( 'EEM_Post_meta' ) ) {
	class EEM_Post_meta {

		public $meta_fields = array();

		/**
		 * EEM_Post_meta constructor.
		 */
		function __construct() {

			add_action( 'init', array( $this, 'add_meta_fields' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			add_action( 'save_post', array( $this, 'save_event_meta' ) );
		}


		/**
		 * Save Event Meta Data from Meta Box
		 *
		 * @param $post_id
		 */
		function save_event_meta( $post_id ) {

			if ( ! isset( $_POST['eem_event_meta_nonce_val'] ) || empty( $nonce_val = sanitize_text_field( $_POST['eem_event_meta_nonce_val'] ) ) || ! wp_verify_nonce( $nonce_val, 'eem_event_meta_nonce' ) ) {
				return;
			}


			foreach ( self::__get_general_info_fields() as $field ) {

				if ( isset( $field['id'] ) && ! empty( $field_id = $field['id'] ) ) {

					if ( ! in_array( $field_id, array( 'content' ) ) ) {

						$field_value = isset( $_POST[ $field_id ] ) ? stripslashes_deep( $_POST[ $field_id ] ) : '';
						update_post_meta( $post_id, $field_id, $field_value );
					}
				}
			}


			$_event_schedules = isset( $_POST['_event_schedules'] ) ? stripslashes_deep( $_POST['_event_schedules'] ) : array();
			$_event_speakers  = isset( $_POST['_event_speakers'] ) ? stripslashes_deep( $_POST['_event_speakers'] ) : array();
			$_event_sponsors  = isset( $_POST['_event_sponsors'] ) ? stripslashes_deep( $_POST['_event_sponsors'] ) : array();

			update_post_meta( $post_id, '_event_schedules', $_event_schedules );
			update_post_meta( $post_id, '_event_speakers', $_event_speakers );
			update_post_meta( $post_id, '_event_sponsors', $_event_sponsors );
		}


		/**
		 * Return array of Meta Fields according to Post type
		 *
		 * @param bool $post_type
		 *
		 * @return array|mixed
		 */
		function get_meta_fields( $post_type = false ) {

			if ( ! $post_type ) {
				return array();
			}

			$meta_fields = isset( $this->meta_fields[ $post_type ] ) ? $this->meta_fields[ $post_type ] : array();

			return apply_filters( 'eem_filters_get_meta_fields', $meta_fields, $post_type, $this );
		}


		/**
		 * Display content for Event Meta Box
		 *
		 * @param $post
		 */
		function event_meta_box( $post ) {

			eem_the_event();

			wp_nonce_field( 'eem_event_meta_nonce', 'eem_event_meta_nonce_val' );

			require_once( EEM_PLUGIN_DIR . 'includes/admin-templates/meta-box-event.php' );
		}


		/**
		 * Add Meta Boxes for Post type Event
		 *
		 * @param $post_type
		 */
		function add_meta_boxes( $post_type ) {

			if ( in_array( $post_type, array( 'event' ) ) ) {
				add_meta_box( 'event_meta_box', esc_html__( 'Event Data Box', EEM_TD ), array(
					$this,
					'event_meta_box'
				), $post_type, 'normal', 'high' );
			}
		}


		/**
		 * Add Meta Fields into the Post Meta Box for Event Post Type
		 */
		function add_meta_fields() {

			$this->meta_fields['general-info'] = array( array( 'options' => self::__get_general_info_fields() ) );
		}


		/**
		 * Set General Information Tab Fields
		 *
		 * @return array
		 */
		private function __get_general_info_fields() {

			return apply_filters( 'eem_filters_event_meta_fields', array(

				array(
					'id'    => '_event_template',
					'title' => esc_html__( 'Event Template', EEM_TD ),
					'type'  => 'select',
					'class' => 'nice-select-wrap',
					'args'  => 'POSTS_%event_template%',
				),
				array(
					'id'            => 'content',
					'title'         => esc_html__( 'Event Description', EEM_TD ),
					'details'       => esc_html__( 'Write some details about this Event', EEM_TD ),
					'type'          => 'wp_editor',
					'field_options' => array(
						'media_buttons'    => false,
						'editor_height'    => '120px',
						'drag_drop_upload' => true,
					),
				),
				array(
					'id'            => '_event_start_date',
					'title'         => esc_html__( 'Start Date/Time', EEM_TD ),
					'details'       => esc_html__( 'Specify event start date here', EEM_TD ),
					'type'          => 'datepicker',
					'placeholder'   => date( 'Y-m-d' ),
					'field_options' => array(
						'dateFormat' => 'yy-mm-dd',
					),
				),
				array(
					'id'            => '_event_start_time',
					'details'       => esc_html__( 'Specify event start time here', EEM_TD ),
					'type'          => 'timepicker',
					'placeholder'   => date( 'H:s A' ),
					'field_options' => array(
						'interval' => 15,
						'dynamic'  => true,
					),
				),
				array(
					'id'            => '_event_end_date',
					'title'         => esc_html__( 'End Date/Time', EEM_TD ),
					'details'       => esc_html__( 'Specify event end date here. You can leave it if your event is Single day long.', EEM_TD ),
					'type'          => 'datepicker',
					'placeholder'   => date( 'Y-m-d' ),
					'field_options' => array(
						'dateFormat' => 'yy-mm-dd',
					),
				),
				array(
					'id'            => '_event_end_time',
					'details'       => esc_html__( 'Specify event end time. This means the time of the date when event ends. You can leave empty the end date but can fill this.', EEM_TD ),
					'type'          => 'timepicker',
					'placeholder'   => date( 'H:s A', strtotime( '+2 hours' ) ),
					'field_options' => array(
						'interval' => 15,
						'dynamic'  => true,
					),
				),
				array(
					'id'          => '_event_location',
					'title'       => esc_html__( 'Location', EEM_TD ),
					'details'     => esc_html__( 'Add your event location.', EEM_TD ),
					'type'        => 'text',
					'class'       => 'event-location-field',
					'placeholder' => esc_html( 'International Convention City Bashundhara, Dhaka' ),
				),
				array(
					'id'      => '_event_gallery',
					'title'   => esc_html__( 'Gallery', EEM_TD ),
					'details' => esc_html__( 'Share some images to your users from this or past events', EEM_TD ),
					'type'    => 'gallery',
				),
				array(
					'id'      => '_event_nearby_hotels',
					'title'   => esc_html__( 'Nearby', EEM_TD ),
					'details' => esc_html__( 'Hotels: Select a post where you wrote about nearby hotels around your event location.', EEM_TD ),
					'type'    => 'select2',
					'args'    => 'POSTS_%post%',
				),
				array(
					'id'      => '_event_nearby_transports',
					'details' => esc_html__( 'Transport Services: Select a post where you wrote about nearby transport services around your event location.', EEM_TD ),
					'type'    => 'select2',
					'args'    => 'POSTS_%post%',
				),
				array(
					'id'      => '_event_nearby_places',
					'details' => esc_html__( 'PLaces: Select a post where you wrote about nearby historical places around your event location.', EEM_TD ),
					'type'    => 'select2',
					'args'    => 'POSTS_%post%',
				),
				array(
					'id'       => '_event_posts',
					'title'    => esc_html__( 'Event News', EEM_TD ),
					'details'  => esc_html__( 'Select some posts to display on the news section for this event.', EEM_TD ),
					'type'     => 'select2',
					'multiple' => true,
					'args'     => 'POSTS_%post%',
				),
			) );
		}
	}

	new EEM_Post_meta();
}