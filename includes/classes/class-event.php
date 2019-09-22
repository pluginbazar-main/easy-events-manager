<?php
/**
 * Event Class
 */

if ( ! class_exists( 'EEM_Event' ) ) {
	/**
	 * Class EEM_Event
	 */
	class EEM_Event extends EEM_Item_data {


		/**
		 * EEM_Event constructor.
		 *
		 * @param bool $event_id
		 */
		function __construct( $event_id = false ) {
			parent::__construct( $event_id );
		}


		/**
		 * Return current status of this event
		 *
		 * @return mixed|void
		 */
		function get_event_status() {

			$event_start_time = $this->get_event_datetime( 'start', 'U' );
			$event_status     = 'upcoming';

			if ( $event_start_time && $event_start_time < current_time( 'timestamp' ) ) {
				$event_status = 'passed';
			}

			if ( $event_start_time && date( 'ymd', $event_start_time ) == date( 'ymd', current_time( 'timestamp' ) ) ) {
				$event_status = 'happening_today';
			}

			return apply_filters( 'eem_filters_event_status', $event_status );
		}


		/**
		 * Return template ID for this event
		 *
		 * @return mixed|void
		 */
		function get_template_id() {

			return apply_filters( 'eem_filters_event_template', $this->get_meta( '_event_template' ), $this->get_id() );
		}


		/**
		 * Return event Date Time for multiple types of uses for this event
		 *
		 * @param string $datetime_for
		 * @param string $format
		 *
		 * @return mixed|void
		 */
		function get_event_datetime( $datetime_for = '', $format = 'jS M, Y - g:i A' ) {

			$start_date      = $this->get_meta( '_event_start_date' );
			$start_time      = $this->get_meta( '_event_start_time' );
			$end_date        = $this->get_meta( '_event_end_date' );
			$end_time        = $this->get_meta( '_event_end_time' );
			$strtotime_start = empty( $start_date ) ? '' : strtotime( $start_date . ' ' . $start_time );
			$strtotime_end   = empty( $end_date ) ? '' : strtotime( $end_date . ' ' . $end_time );

			if ( $datetime_for == 'start' ) {
				$return = empty( $strtotime_start ) ? '' : date( $format, $strtotime_start );
			} elseif ( $datetime_for == 'end' ) {
				$return = empty( $strtotime_end ) ? '' : date( $format, $strtotime_end );
			} else {
				$return = sprintf( '%s - %s', date( $format, $strtotime_start ), date( $format, $strtotime_end ) );
			}

			return apply_filters( 'eem_filters_event_datetime', $return, $datetime_for, $format, $this->get_id() );
		}


		/**
		 * Generate and return custom endpoints url of this specific event
		 *
		 * @param string $endpoint_for
		 *
		 * @return mixed|string|void
		 */
		function get_endpoint_url( $endpoint_for = '' ) {

			if ( empty( $endpoint_for ) || ! in_array( $endpoint_for, eem()->get_custom_endpoints() ) ) {
				return '';
			}

			return apply_filters( 'eem_filters_endpoint_url', sprintf( '%s%s', $this->get_permalink(), $endpoint_for ) );
		}


		/**
		 * Return location of this event as string
		 *
		 * @return mixed|void
		 */
		function get_location() {

			return apply_filters( 'eem_filters_event_location', $this->get_meta( '_event_location' ) );
		}


		/**
		 * Return attendees as array for this event
		 *
		 * @param int $count
		 *
		 * @return mixed|void
		 */
		function get_attendees( $count = 999 ) {

			$attendees = eem_get_attendees( $this->get_id(), array( 'email' ), 'ARRAY_A', $count );

			return apply_filters( 'eem_filters_event_attendees', $attendees, $this->get_id() );
		}


		/**
		 * Return blog post ids assigned for this event
		 *
		 * @return mixed|void
		 */
		function get_posts() {

			return apply_filters( 'eem_filters_event_posts', $this->get_meta( '_event_posts', array() ), $this->get_id() );
		}


		/**
		 * Return Gallery images for this event as array
		 *
		 * @param string $size
		 * @param int $count
		 *
		 * @return mixed|void
		 */
		function get_gallery_images( $size = 'thumbnail', $count = 999 ) {

			$images = array();
			$index  = 0;

			foreach ( $this->get_meta( '_event_gallery', array() ) as $image_id ) {
				$index ++;

				if ( $index <= $count ) {
					$images[ $image_id ] = wp_get_attachment_image_url( $image_id, $size );
				}
			}

			return apply_filters( 'eem_filters_event_gallery', $images, $this->get_id() );
		}


		/**
		 * Return sponsors of this event as array
		 *
		 * @return mixed|void
		 */
		function get_sponsors() {

			$sponsors = $this->get_meta( '_event_sponsors', array() );

			return apply_filters( 'eem_filters_event_sponsors', $sponsors );
		}


		/**
		 * Return speakers of this event
		 *
		 * @param int $count
		 *
		 * @return mixed|void
		 */
		function get_speakers( $count = 999 ) {

			$index    = 0;
			$speakers = $this->get_meta( '_event_speakers', array() );

			foreach ( $speakers as $speaker_id => $speaker ) {
				$index ++;
				if ( $index > $count || ! isset( $speaker['user_id'] ) || empty( $speaker['user_id'] ) ) {
					unset( $speakers[ $speaker_id ] );
				}
			}

			return apply_filters( 'eem_filters_event_speakers', $speakers );
		}


		/**
		 * Return Schedules of this event
		 *
		 * @return mixed|void
		 */
		function get_schedules() {
			return apply_filters( 'eem_filters_event_schedules', $this->get_meta( '_event_schedules', array() ) );
		}
	}
}