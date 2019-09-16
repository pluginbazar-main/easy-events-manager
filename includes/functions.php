<?php
/**
 * EEM - Functions
 */


if ( ! function_exists( 'eem_print_button' ) ) {
	/**
	 * Print button html with multiple options
	 *
	 * @param string $text
	 * @param string $tag
	 * @param bool $classes
	 * @param string $href
	 * @param string $wrapper
	 * @param bool $echo
	 *
	 * @return mixed|string
	 */
	function eem_print_button( $text = '', $tag = 'a', $classes = false, $href = '', $wrapper = '', $echo = true ) {

		if ( empty( $text ) ) {
			return '';
		}

		if ( ! in_array( $tag, array( 'a', 'div', 'p', 'span' ) ) ) {
			return '';
		}

		$classes = eem_get_classes_array( $classes );
		$classes = implode( ' ', $classes );
		$button  = sprintf( '<%1$s class="%2$s" href="%3$s">%4$s</%1$s>', $tag, $classes, esc_url( $href ), esc_html( $text ) );
		$button  = empty( $wrapper ) ? $button : str_replace( '%', $button, $wrapper );

		if ( $echo ) {
			print $button;
		} else {
			return $button;
		}
	}
}


if ( ! function_exists( 'eem_print_event_notice' ) ) {
	/**
	 * Print Event notice
	 *
	 * @param string $message
	 * @param string $type
	 */
	function eem_print_event_notice( $message = '', $type = 'success' ) {

		if ( empty( $message ) ) {
			return;
		}

		printf( '<div class="eem-notice eem-notice-%s">%s</div>', $type, $message );
	}
}


if ( ! function_exists( 'eem_print_event_section_heading' ) ) {
	/**
	 * Print event section heading
	 *
	 * @param array $args
	 */
	function eem_print_event_section_heading( $args = array() ) {

		global $template_section, $template_section_id;

		$html        = array();
		$heading     = $template_section && isset( $template_section['heading'] ) ? $template_section['heading'] : '';
		$sub_heading = $template_section && isset( $template_section['sub_heading'] ) ? $template_section['sub_heading'] : '';
		$short_desc  = $template_section && isset( $template_section['short_desc'] ) ? $template_section['short_desc'] : '';
		$button      = $template_section && isset( $template_section['button'] ) ? $template_section['button'] : array();
		$button_url  = $template_section && isset( $template_section['button_url'] ) ? $template_section['button_url'] : '';

		$heading     = empty( $heading ) && isset( $args['heading'] ) ? $args['heading'] : '';
		$sub_heading = empty( $sub_heading ) && isset( $args['sub_heading'] ) ? $args['sub_heading'] : '';
		$short_desc  = empty( $short_desc ) && isset( $args['short_desc'] ) ? $args['short_desc'] : '';

		if ( ! empty( $sub_heading ) ) {
			$html[] = sprintf( '<h6 class="eem-sh-tagline">%s</h6>', $sub_heading );
		}

		if ( ! empty( $heading ) ) {
			$html[] = sprintf( '<h2 class="eem-sh-title">%s</h2>', $heading );
		}

		if ( ! empty( $short_desc ) ) {
			$html[] = sprintf( '<h5 class="eem-sh-subtitle">%s</h5>', $short_desc );
		}

		/**
		 * Print Button for register section
		 */
		if ( $template_section_id == 'register' && reset( $button ) != 'yes' ) {
			$html[] = sprintf( '<div class="join-as-volunteer"><a href="%s" class="eem-btn eem-btn-large">%s</a></div>', esc_url( $button_url ), apply_filters( 'eem_filters_volunteer_join_button_text', esc_html__( 'Join As volunteer', EEM_TD ) ) );
		}

		/**
		 * All together in $html and print now
		 */
		if ( ! empty( $html ) ) {
			printf( '<div class="eem-section-heading">%s</div>', implode( $html ) );
		}
	}
}


if ( ! function_exists( 'eem_get_classes_array' ) ) {
	/**
	 * Generate array of classes from string in different for of string
	 *
	 * @param bool $classes
	 *
	 * @return array
	 */
	function eem_get_classes_array( $classes = false ) {

		if ( ! is_array( $classes ) ) {
			return explode( '~', str_replace( array( ' ', ',', ', ' ), '~', $classes ) );
		}

		return array();
	}
}


if ( ! function_exists( 'eem_print_event_section_classes' ) ) {
	/**
	 * print event section classes
	 *
	 * @param bool $classes
	 */
	function eem_print_event_section_classes( $classes = false ) {

		$classes = eem_get_classes_array( $classes );

		global $template_section;

		if ( isset( $template_section['box_layout'] ) && reset( $template_section['box_layout'] ) == 'yes' ) {
			if ( ( $key = array_search( 'eem-force-full-width', $classes ) ) !== false ) {
				unset( $classes[ $key ] );
			}
		}

		printf( 'class="%s"', esc_attr( implode( ' ', apply_filters( 'eem_print_event_section_classes', $classes ) ) ) );
	}
}


if ( ! function_exists( 'eem_set_template_section' ) ) {
	/**
	 * Set current template section
	 *
	 * @param string $this_section_id
	 */
	function eem_set_template_section( $this_section_id = '' ) {

		global $event, $template_section, $template_section_id;

		if ( empty( $this_section_id ) || ! $event instanceof EEM_Event ) {
			return;
		}

		if ( empty( $_sections = eem()->get_meta( '_sections', $event->get_template_id(), array() ) ) ) {
			return;
		}

		$template_section_id = $this_section_id;
		$template_section    = isset( $_sections[ $this_section_id ] ) ? $_sections[ $this_section_id ] : array();
	}
}


if ( ! function_exists( 'eem_is_event_endpoint' ) ) {
	function eem_is_event_endpoint() {

		$current_endpoint = eem_get_current_endpoint();

		if ( empty( $current_endpoint ) ) {
			return false;
		}

		return true;
	}
}


if ( ! function_exists( 'eem_get_current_endpoint' ) ) {
	function eem_get_current_endpoint() {

		global $wp_query;

		$current_endpoint = '';
		foreach ( eem()->get_custom_endpoints() as $endpoint ) {
			if ( isset( $wp_query->query_vars[ $endpoint ] ) ) {
				$current_endpoint = $endpoint;
			}
		}

		return $current_endpoint;
	}
}


if ( ! function_exists( 'eem_render_social_profiles' ) ) {
	/**
	 * Render social profiles HTML
	 *
	 * @param array $args
	 * @param bool $echo
	 *
	 * @return string
	 */
	function eem_render_social_profiles( $args = array(), $echo = true ) {

		$user_id       = isset( $args['user_id'] ) ? $args['user_id'] : '';
		$user_id       = empty( $user_id ) || $user_id === 0 ? get_current_user_id() : $user_id;
		$wrapper       = isset( $args['wrapper'] ) ? $args['wrapper'] : '';
		$wrapper_class = isset( $args['wrapper_class'] ) ? $args['wrapper_class'] : '';
		$profiles      = array();

		foreach ( eem()->get_social_profile_platforms() as $platform_id => $platform ) {

			$profile_url   = '';
			$platform_icon = isset( $platform['icon'] ) ? $platform['icon'] : '';
			$profiles[]    = sprintf( '<a href="%s">%s</a>', $profile_url, $platform_icon );
		}

		$profiles_html = sprintf( '<%1$s class="%2$s">%3$s</%1$s>', $wrapper, $wrapper_class, implode( '', $profiles ) );

		if ( $echo ) {
			echo $profiles_html;
		} else {
			return $profiles_html;
		}
	}
}


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

		if ( get_post_type( $event_id ) == 'event' && ! $event instanceof EEM_Event ) {
			$event = new EEM_Event( $event_id );
		}
	}
}


if ( ! function_exists( 'eem_print_template_section' ) ) {
	function eem_print_template_section( $section = array(), $echo = true ) {

		$section_id         = isset( $section['section_id'] ) ? $section['section_id'] : '';
		$section_value      = isset( $section['value'] ) ? $section['value'] : array();
		$template_sections  = eem()->get_template_sections();
		$this_section       = isset( $template_sections[ $section_id ] ) ? $template_sections[ $section_id ] : array();
		$this_section_label = isset( $this_section['label'] ) ? $this_section['label'] : '';

		if ( empty( $this_section ) ) {
			return new WP_Error( 'not_found', esc_html__( 'Section not found !', EEM_TD ) );
		}

		$section_fields = isset( $this_section['fields'] ) ? $this_section['fields'] : array();
		$section_fields = empty( $section_fields ) ? array() : $section_fields;

		foreach ( $section_fields as $index => $field ) {
			if ( isset( $field['id'] ) && ! empty( $field['id'] ) ) {

				$section_fields[ $index ]['id'] = sprintf( '_sections[%s][%s]', $section_id, $field['id'] );

				if ( isset( $section_value[ $field['id'] ] ) ) {
					$section_fields[ $index ]['value'] = $section_value[ $field['id'] ];
				}
			}
		}

		ob_start();

		if ( empty( $section_fields ) ) {
			printf( '<input type="hidden" name="_sections[%s]">', $section_id );
		}

		?>

        <div class="eem-repeat-single eem-section">
            <div class="eem-repeat-head">
                <span class="section-label"><?php echo esc_html( $this_section_label ); ?></span>
                <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
            </div>
            <div class="eem-repeat-content">
				<?php eem()->PB()->generate_fields( array( array( 'options' => $section_fields ) ) ); ?>
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


if ( ! function_exists( 'eem_print_event_speaker' ) ) {
	function eem_print_event_speaker( $speaker = array(), $echo = true ) {

		$speaker_id     = isset( $speaker['id'] ) ? $speaker['id'] : current_time( 'timestamp' );
		$user_id        = isset( $speaker['user_id'] ) ? $speaker['user_id'] : '';
		$topics         = isset( $speaker['topics'] ) ? $speaker['topics'] : '';
		$speaker_fields = array(
			array(
				'options' => apply_filters( 'eem_filters_speaker_fields', array(
					array(
						'id'      => "_event_speakers[$speaker_id][topics]",
						'title'   => esc_html__( 'Topics', EEM_TD ),
						'details' => esc_html__( 'Write topics on which this speaker will continue discussion.', EEM_TD ),
						'type'    => 'textarea',
						'value'   => $topics,
					),
				), $speaker ),
			)
		);

		?>

        <div class="eem-repeat-single">
            <div class="eem-repeat-head">

				<?php eem()->PB()->generate_select(
					array(
						'id'      => "_event_speakers[$speaker_id][user_id]",
						'title'   => esc_html__( 'Topics', EEM_TD ),
						'details' => esc_html__( 'Write topics on which this speaker will continue discussion.', EEM_TD ),
						'type'    => 'select2',
						'args'    => 'USERS',
						'value'   => $user_id,
					)
				); ?>

                <script>
                    (function ($) {
                        $(function () {
                            $('#_event_speakers_<?php echo esc_html( $speaker_id ); ?>__user_id_').niceSelect();
                        });
                    })(jQuery);
                </script>

                <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
            </div>
            <div class="eem-repeat-content">
				<?php eem()->PB()->generate_fields( $speaker_fields ); ?>
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
                <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
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


if ( ! function_exists( 'eem_get_template_part' ) ) {
	/**
	 * Get Template Part
	 *
	 * @param $slug
	 * @param string $name
	 * @param array $args
	 */
	function eem_get_template_part( $slug, $name = '', $args = array() ) {

		$template   = '';
		$plugin_dir = EEM_PLUGIN_DIR;

		/**
		 * Locate template
		 */
		if ( $name ) {
			$template = locate_template( array(
				"{$slug}-{$name}.php",
				"wpp/{$slug}-{$name}.php"
			) );
		}

		/**
		 * Check directory for templates from Addons
		 */
		$backtrace      = debug_backtrace( 2, true );
		$backtrace      = empty( $backtrace ) ? array() : $backtrace;
		$backtrace      = reset( $backtrace );
		$backtrace_file = isset( $backtrace['file'] ) ? $backtrace['file'] : '';

		if ( strpos( $backtrace_file, 'ext-slug' ) !== false && defined( 'EXT_PLUGIN_DIR' ) ) {
			$plugin_dir = EXT_PLUGIN_DIR;
		}

		/**
		 * Search for Template in Plugin
		 *
		 * @in Plugin
		 */
		if ( ! $template && $name && file_exists( untrailingslashit( $plugin_dir ) . "/templates/{$slug}-{$name}.php" ) ) {
			$template = untrailingslashit( $plugin_dir ) . "/templates/{$slug}-{$name}.php";
		}


		/**
		 * Search for Template in Theme
		 *
		 * @in Theme
		 */
		if ( ! $template ) {
			$template = locate_template( array( "{$slug}.php", "eem/{$slug}.php" ) );
		}


		/**
		 * Allow 3rd party plugins to filter template file from their plugin.
		 *
		 * @filter eem_filters_get_template_part
		 */
		$template = apply_filters( 'eem_filters_get_template_part', $template, $slug, $name );


		if ( $template ) {
			load_template( $template, false );
		}
	}
}


if ( ! function_exists( 'eem_get_template' ) ) {
	/**
	 * Get Template
	 *
	 * @param $template_name
	 * @param array $args
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return WP_Error
	 */
	function eem_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args ); // @codingStandardsIgnoreLine
		}

		/**
		 * Check directory for templates from Addons
		 */
		$backtrace      = debug_backtrace( 2, true );
		$backtrace      = empty( $backtrace ) ? array() : $backtrace;
		$backtrace      = reset( $backtrace );
		$backtrace_file = isset( $backtrace['file'] ) ? $backtrace['file'] : '';

		$located = eem_locate_template( $template_name, $template_path, $default_path, $backtrace_file );


		if ( ! file_exists( $located ) ) {
			return new WP_Error( 'invalid_data', __( '%s does not exist.', EEM_TD ), '<code>' . $located . '</code>' );
		}

		$located = apply_filters( 'eem_filters_get_template', $located, $template_name, $args, $template_path, $default_path );

		do_action( 'eem_before_template_part', $template_name, $template_path, $located, $args );

		include $located;

		do_action( 'eem_after_template_part', $template_name, $template_path, $located, $args );
	}
}


if ( ! function_exists( 'eem_locate_template' ) ) {
	/**
	 *  Locate template
	 *
	 * @param $template_name
	 * @param string $template_path
	 * @param string $default_path
	 * @param string $backtrace_file
	 *
	 * @return mixed|void
	 */
	function eem_locate_template( $template_name, $template_path = '', $default_path = '', $backtrace_file = '' ) {

		$plugin_dir = EEM_PLUGIN_DIR;

		/**
		 * Template path in Theme
		 */
		if ( ! $template_path ) {
			$template_path = 'eem/';
		}

		// Check for survey
		if ( ! empty( $backtrace_file ) && strpos( $backtrace_file, 'ext-slug' ) !== false && defined( 'EXT_PLUGIN_DIR' ) ) {
			$plugin_dir = EXT_PLUGIN_DIR;
		}

		/**
		 * Template default path from Plugin
		 */
		if ( ! $default_path ) {
			$default_path = untrailingslashit( $plugin_dir ) . '/templates/';
		}

		/**
		 * Look within passed path within the theme - this is priority.
		 */
		$template = locate_template(
			array(
				trailingslashit( $template_path ) . $template_name,
				$template_name,
			)
		);

		/**
		 * Get default template
		 */
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		/**
		 * Return what we found with allowing 3rd party to override
		 *
		 * @filter eem_filters_locate_template
		 */
		return apply_filters( 'eem_filters_locate_template', $template, $template_name, $template_path );
	}
}


if ( ! function_exists( 'eem' ) ) {
	function eem() {
		global $eem;

		return $eem;
	}
}