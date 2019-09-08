<?php
/**
 * EEM - Functions
 */


if ( ! function_exists( 'eem_get_event' ) ) {
	/**
	 * Return Single Event object
	 *
	 * @param bool $event_id
	 *
	 * @return bool | EEM_Event
	 *
	 */
	function eem_get_event( $event_id = false ) {

		if ( get_post_type( $event_id ) != 'event' ) {
			return false;
		}

		return new EEM_Event( $event_id );
	}
}


if ( ! function_exists( 'eem_the_event' ) ) {
	/**
	 * Init $event global variable
	 *
	 * @param bool $event_id
	 */
	function eem_the_event( $event_id = false ) {

		global $event;

		if ( get_post_type( $event_id ) == 'poll' && ! $event instanceof EEM_Event ) {
			$event = new EEM_Event( $event_id );
		}
	}
}


if ( ! function_exists( 'eem_print_event_schedule_day_content' ) ) {
	/**
	 * Print Event Schedule Day Content
	 *
	 * @param array $schedule
	 * @param bool $echo
	 *
	 * @return false|string
	 */
	function eem_print_event_schedule_day_content( $schedule = array(), $echo = true ) {

		$schedule_index = isset( $schedule['index'] ) ? $schedule['index'] : 0;
		$schedule_id    = isset( $schedule['id'] ) ? $schedule['id'] : date( 'U' ) + ( $schedule_index * 193 );
		$schedule_label = isset( $schedule['label'] ) ? $schedule['label'] : sprintf( esc_html__( 'Day %s', EEM_TD ), $schedule_index + 1 );
		$active_class   = $schedule_index == 0 ? 'active' : '';
		$schedule_date  = isset( $schedule['date'] ) ? $schedule['date'] : '';
		$sessions       = isset( $schedule['sessions'] ) ? $schedule['sessions'] : array();
		$sessions       = empty( $sessions ) ? array() : $sessions;

		$day_fields = array(
			array(
				'options' => apply_filters( 'eem_filters_day_fields', array(
					array(
						'id'          => "_event_schedules[$schedule_id][label]",
						'title'       => esc_html__( 'Day label', EEM_TD ),
						'details'     => esc_html__( 'Set custom label for this day. Example: Day 1 or First Day etc', EEM_TD ),
						'placeholder' => esc_html__( 'Day 1', EEM_TD ),
						'type'        => 'text',
						'class'       => 'day_label_change_listener',
						'value'       => $schedule_label,
					),
					array(
						'id'            => "_event_schedules[$schedule_id][date]",
						'title'         => esc_html__( 'Date', EEM_TD ),
						'details'       => esc_html__( 'Select date for this day.', EEM_TD ),
						'type'          => 'datepicker',
						'placeholder'   => date( 'Y-m-d' ),
						'field_options' => array(
							'dateFormat' => 'yy-mm-dd',
						),
						'value'         => $schedule_date,
					),
				), $schedule ),
			)
		);

		ob_start();

		?>
        <div class="eem-side-nav-item-content <?php echo esc_attr( $active_class ); ?> schedule-<?php echo esc_attr( $schedule_id ); ?>">

			<?php eem()->PB()->generate_fields( $day_fields ); ?>

            <div class="button eem-add-session"
                 data-schedule-id="<?php echo esc_attr( $schedule_id ); ?>"><?php esc_html_e( 'Add Session', EEM_TD ); ?></div>
            <div class="eem-repeat-container eem-sessions">
				<?php foreach ( $sessions as $session_id => $session ) {
					eem_print_session_content( $schedule_id, array_merge( array( 'id' => $session_id ), $session ) );
				} ?>
            </div>
        </div>

		<?php
		if ( $echo ) {
			print ob_get_clean();
		} else {
			return ob_get_clean();
		}
	}
}


if ( ! function_exists( 'eem_print_session_content' ) ) {
	/**
	 * Print Day content session
	 *
	 * @param $schedule_id
	 * @param array $session
	 * @param bool $echo
	 *
	 * @return false|string
	 */
	function eem_print_session_content( $schedule_id, $session = array(), $echo = true ) {

		$session_id     = isset( $session['id'] ) ? $session['id'] : current_time( 'timestamp' );
		$session_sd     = isset( $session['sd'] ) ? $session['sd'] : '';
		$s_label        = isset( $session['s_label'] ) ? $session['s_label'] : '';
		$time_start     = isset( $session['time_start'] ) ? $session['time_start'] : '';
		$time_end       = isset( $session['time_end'] ) ? $session['time_end'] : '';
		$session_fields = array(
			array(
				'options' => apply_filters( 'eem_filters_session_fields', array(
					array(
						'id'      => "_event_schedules[$schedule_id][sessions][$session_id][sd]",
						'title'   => esc_html__( 'Short description', EEM_TD ),
						'details' => esc_html__( 'Set a short description for this session.', EEM_TD ),
						'type'    => 'textarea',
						'value'   => $session_sd,
					),
					array(
						'id'            => "_event_schedules[$schedule_id][sessions][$session_id][time_start]",
						'title'         => esc_html__( 'Time', EEM_TD ),
						'details'       => esc_html__( 'Start time for this day. You can leave this empty to bypass and enter into each section.', EEM_TD ),
						'type'          => 'timepicker',
						'placeholder'   => date( 'H:s A' ),
						'field_options' => array(
							'interval' => 15,
							'dynamic'  => true,
						),
						'value'         => $time_start,
					),
					array(
						'id'            => "_event_schedules[$schedule_id][sessions][$session_id][time_end]",
						'details'       => esc_html__( 'End time for this day. You can leave this empty to bypass and enter into each section.', EEM_TD ),
						'type'          => 'timepicker',
						'placeholder'   => date( 'H:s A' ),
						'field_options' => array(
							'interval' => 15,
							'dynamic'  => true,
						),
						'value'         => $time_end,
					),
				), $schedule_id, $session ),
			)
		);

		ob_start();
		?>
        <div class="eem-repeat-single">
            <div class="eem-repeat-head">
                <input type="text"
                       name="_event_schedules[<?php echo esc_attr( $schedule_id ); ?>][sessions][<?php echo esc_attr( $session_id ); ?>][s_label]"
                       value="<?php echo esc_attr( $s_label ); ?>"
                       placeholder="<?php esc_html_e( 'Session label here', EEM_TD ); ?>">
                <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i>
                </div>
                <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                <div class="eem-head-button eem-repeat-toggle"><i
                            class="icofont-curved-down"></i>
                </div>
            </div>
            <div class="eem-repeat-content">
				<?php eem()->PB()->generate_fields( $session_fields ); ?>
            </div>
        </div>
		<?php

		if ( $echo ) {
			print ob_get_clean();
		} else {
			return ob_get_clean();
		}
	}
}


if ( ! function_exists( 'eem_print_event_schedule_day_nav' ) ) {
	/**
	 * Print Event Schedule Day Nav label
	 *
	 * @param array $schedule
	 * @param bool $echo
	 *
	 * @return false|string
	 */
	function eem_print_event_schedule_day_nav( $schedule = array(), $echo = true ) {

		$schedule_index = isset( $schedule['index'] ) ? $schedule['index'] : 0;
		$schedule_id    = isset( $schedule['id'] ) ? $schedule['id'] : date( 'U' ) + ( $schedule_index * 193 );
		$schedule_label = isset( $schedule['label'] ) ? $schedule['label'] : sprintf( esc_html__( 'Day %s', EEM_TD ), $schedule_index + 1 );
		$active_class   = $schedule_index == 0 ? 'active' : '';

		ob_start();

		printf( '<div class="eem-side-nav-item %s" data-target="schedule-%s">%s</div>', $active_class, $schedule_id, $schedule_label );

		if ( $echo ) {
			print ob_get_clean();
		} else {
			return ob_get_clean();
		}
	}
}


if ( ! function_exists( 'eem' ) ) {
	function eem() {
		global $eem;

		return $eem;
	}
}