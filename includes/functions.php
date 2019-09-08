<?php
/**
 * EEM - Functions
 */


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
		$time_start     = isset( $schedule['time_start'] ) ? $schedule['time_start'] : '';
		$time_end       = isset( $schedule['time_end'] ) ? $schedule['time_end'] : '';

		$schedules_fields = array(
			array(
				'options' => array(
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

					array(
						'id'            => "_event_schedules[$schedule_id][time_start]",
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
						'id'            => "_event_schedules[$schedule_id][time_end]",
						'details'       => esc_html__( 'End time for this day. You can leave this empty to bypass and enter into each section.', EEM_TD ),
						'type'          => 'timepicker',
						'placeholder'   => date( 'H:s A' ),
						'field_options' => array(
							'interval' => 15,
							'dynamic'  => true,
						),
						'value'         => $time_end,
					),

				),
			)
		);

		ob_start();

		?>
        <div class="eem-side-nav-item-content <?php echo esc_attr( $active_class ); ?> schedule-<?php echo esc_attr( $schedule_id ); ?>">

			<?php eem()->PB()->generate_fields( $schedules_fields ); ?>

            <div class="button eem-add-schedule"><?php esc_html_e( 'Add Schedule', EEM_TD ); ?></div>
            <div class="eem-repeat-container">

                <div class="eem-repeat-single">
                    <div class="eem-repeat-head">
                        <input type="text" name=""
                               placeholder="<?php esc_html_e( 'Schedule name here', EEM_TD ); ?>">
                        <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i>
                        </div>
                        <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                        <div class="eem-head-button eem-repeat-toggle"><i
                                    class="icofont-curved-down"></i>
                        </div>
                    </div>
                    <div class="eem-repeat-content">
						<?php eem()->PB()->generate_fields( $schedules_fields ); ?>
                    </div>
                </div>

                <div class="eem-repeat-single">
                    <div class="eem-repeat-head">
                        <input type="text" name=""
                               placeholder="<?php esc_html_e( 'Schedule name here', EEM_TD ); ?>">
                        <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i>
                        </div>
                        <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                        <div class="eem-head-button eem-repeat-toggle"><i
                                    class="icofont-curved-down"></i>
                        </div>
                    </div>
                    <div class="eem-repeat-content">
						<?php eem()->PB()->generate_fields( $schedules_fields ); ?>
                    </div>
                </div>

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