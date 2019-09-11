<?php
/**
 * Event Class
 */

if ( ! class_exists( 'EEM_Event' ) ) {
	class EEM_Event extends EEM_Item_data {

		function __construct( $event_id = false ) {
			parent::__construct( $event_id );
		}


		function get_speakers() {

			$speakers = $this->get_meta( '_event_speakers', array() );

			foreach ( $speakers as $speaker_id => $speaker ) {
				if( ! isset( $speaker['user_id'] ) || empty( $speaker['user_id'] ) ) {
					unset( $speakers[$speaker_id] );
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