<?php
/**
 * Event Class
 */

if ( ! class_exists( 'EEM_Event' ) ) {
	class EEM_Event extends EEM_Item_data {

		function __construct( $event_id = false ) {
			parent::__construct( $event_id );
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