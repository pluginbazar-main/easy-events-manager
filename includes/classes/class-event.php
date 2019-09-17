<?php
/**
 * Event Class
 */

if ( ! class_exists( 'EEM_Event' ) ) {
	class EEM_Event extends EEM_Item_data {

		function __construct( $event_id = false ) {
			parent::__construct( $event_id );
		}


		function get_template_id() {

			return apply_filters( 'eem_filters_event_template', $this->get_meta( '_event_template' ), $this->get_id() );
		}

		function get_event_datetime( $datetime_for = '', $format = 'jS M, Y - g:i A' ) {

			$start_date      = $this->get_meta( '_event_start_date' );
			$start_time      = $this->get_meta( '_event_start_time' );
			$end_date        = $this->get_meta( '_event_end_date' );
			$end_time        = $this->get_meta( '_event_end_time' );
			$strtotime_start = strtotime( $start_date . ' ' . $start_time );
			$strtotime_end   = strtotime( $end_date . ' ' . $end_time );

			if ( $datetime_for == 'start' ) {
				$return = date( $format, $strtotime_start );
			} elseif ( $datetime_for == 'end' ) {
				$return = date( $format, $strtotime_end );
			} else {
				$return = sprintf( '%s - %s', date( $format, $strtotime_start ), date( $format, $strtotime_end ) );
			}

			return apply_filters( 'eem_filters_event_datetime', $return, $datetime_for, $format, $this->get_id() );
		}


		function get_endpoint_url( $endpoint_for = '' ) {

			if ( empty( $endpoint_for ) || ! in_array( $endpoint_for, eem()->get_custom_endpoints() ) ) {
				return '';
			}

			return apply_filters( 'eem_filters_endpoint_url', sprintf( '%s%s', $this->get_permalink(), $endpoint_for ) );
		}


		function get_location() {

			return apply_filters( 'eem_filters_event_location', $this->get_meta( '_event_location' ) );
		}

		function get_sponsors() {

			$sponsors = $this->get_meta( '_event_sponsors', array() );

			return apply_filters( 'eem_filters_event_sponsors', $sponsors );
		}


		function get_speakers() {

			$speakers = $this->get_meta( '_event_speakers', array() );

			foreach ( $speakers as $speaker_id => $speaker ) {
				if ( ! isset( $speaker['user_id'] ) || empty( $speaker['user_id'] ) ) {
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