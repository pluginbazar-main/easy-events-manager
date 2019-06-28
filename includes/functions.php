<?php
/**
 * EEM - Functions
 */


if ( ! function_exists( 'eem_print_event_schedule_day_nav' ) ) {
	/**
	 * Print Event Schedule Day Nav label
	 *
	 * @param array $schedule
	 */
	function eem_print_event_schedule_day_nav( $schedule = array() ) {

		$schedule_id    = isset( $schedule['id'] ) ? $schedule['id'] : time( 'H:s' );
		$schedule_label = isset( $schedule['label'] ) ? $schedule['label'] : esc_html__( 'Day 1', EEM_TD );

		echo "<pre>"; print_r( $schedule_id ); echo "</pre>";

		printf( '<div class="eem-side-nav-item" target="day-%s">%s</div>', $schedule_id, $schedule_label );
	}
}


if ( ! function_exists( 'eem_get_meta' ) ) {
	/**
	 * Return Meta Value
	 *
	 * @param bool $meta_key
	 * @param bool $post_id
	 * @param string|array $default
	 *
	 * @return string|mixed|void
	 */
	function eem_get_meta( $meta_key = false, $post_id = false, $default = '' ) {

		if ( ! $meta_key ) {
			return '';
		}

		$post_id    = ! $post_id ? get_the_ID() : $post_id;
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		$meta_value = empty( $meta_value ) ? $default : $meta_value;

		return apply_filters( 'eem_filters_get_meta', $meta_value, $meta_key, $post_id, $default );
	}
}


if ( ! function_exists( 'eem' ) ) {
	function eem() {
		global $eem;

		return $eem;
	}
}