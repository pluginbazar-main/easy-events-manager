<?php
/**
 * Event Class
 */

if( ! class_exists( 'EEM_Event' ) ) {
	class EEM_Event extends EEM_Item_data {

		function __construct( $event_id = false ) {
			parent::__construct( $event_id );
		}



	}
}