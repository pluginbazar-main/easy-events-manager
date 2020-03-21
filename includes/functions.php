<?php
/**
 * EEM - Functions
 */


if ( ! function_exists( 'eem_pagination' ) ) {
	/**
	 * Return Pagination HTML Content
	 *
	 * @param bool $query_object
	 * @param array $args
	 *
	 * @return array|string|void
	 */
	function eem_pagination( $query_object = false, $args = array() ) {

		global $wp_query;

		$previous_query = $wp_query;

		if ( $query_object ) {
			$wp_query = $query_object;
		}

		if ( get_query_var( 'paged' ) ) {
			$paged = absint( get_query_var( 'paged' ) );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = absint( get_query_var( 'page' ) );
		} else {
			$paged = 1;
		}

		$defaults = array(
			'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, $paged ),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => $wp_query->get( 'prev_text' ),
			'next_text' => $wp_query->get( 'next_text' ),
		);

		$args           = apply_filters( 'eem_filters_pagination', array_merge( $defaults, $args ) );
		$paginate_links = paginate_links( $args );

		$wp_query = $previous_query;

		return $paginate_links;
	}
}


if ( ! function_exists( 'eem_get_user_profile_url' ) ) {
	/**
	 * Return user profile URL
	 *
	 * @param bool $user_id
	 *
	 * @return mixed|void
	 */
	function eem_get_user_profile_url( $user_id = false ) {

		if ( ! $user_id || empty( $user_id ) || $user_id == 0 ) {
			$user_id = get_current_user_id();
		}

		$this_user   = get_user_by( 'ID', $user_id );
		$profile_url = site_url( sprintf( 'profile/%s', $this_user->user_login ) );

		return apply_filters( 'eem_filters_user_profile_url', $profile_url, $this_user );
	}
}


if ( ! function_exists( 'eem_remove_attendee' ) ) {
	function eem_remove_attendee( $row_id_or_email = false, $event_id = 0 ) {

		global $wpdb;

		if ( ! $row_id_or_email ) {
			return false;
		}

		if ( is_email( $row_id_or_email ) ) {
			$row_id_or_email = $wpdb->get_var( sprintf( 'SELECT id FROM %s WHERE event_id = %s AND email = \'%s\'',
					EEM_TABLE_ATTENDEES, $event_id, $row_id_or_email )
			);
		}

		return $wpdb->delete( EEM_TABLE_ATTENDEES, array( 'id' => $row_id_or_email ) );
	}
}


if ( ! function_exists( 'eem_insert_attendee' ) ) {
	/**
	 * Insert attendees to an event
	 *
	 * @param $event_id
	 * @param bool $user_id
	 *
	 * @return false|int|WP_Error
	 */
	function eem_insert_attendee( $event_id, $user_id = false ) {

		if ( empty( $user_id ) || ! $user_id || $user_id == 0 ) {
			return new WP_Error( 'invalid_data', esc_html__( 'Invalid user id provided', EEM_TD ) );
		}

		global $wpdb;

		$user      = get_user_by( 'ID', $user_id );
		$attendees = eem_get_attendees( $event_id, array( 'email' ) );

		if ( $attendees && is_array( $attendees ) && in_array( $user->user_email, $attendees ) ) {
			return new WP_Error( 'duplicate_entry', esc_html__( 'You have already in attendees list !', EEM_TD ) );
		}

		$insert_id = $wpdb->insert( EEM_TABLE_ATTENDEES, array(
			'email'    => $user->user_email,
			'order_id' => 0,
			'event_id' => $event_id,
			'status'   => apply_filters( 'eem_filters_new_attendee_status', 'pending', $event_id, $user_id ),
			'datetime' => current_time( 'mysql' )
		) );

		if ( ! $insert_id ) {
			return new WP_Error( 'invalid_data', esc_html__( 'Something went wrong !', EEM_TD ) );
		}

		return $insert_id;
	}
}


if ( ! function_exists( 'eem_get_attendees' ) ) {
	/**
	 * Return attendees list by giving event ID
	 *
	 * @param bool $event_id
	 * @param string $get_fields
	 * @param string $output
	 * @param int $count
	 *
	 * @return array|mixed|void
	 */
	function eem_get_attendees( $event_id = false, $get_fields = '*', $output = 'OBJECT', $count = 999 ) {

		if ( empty( $event_id ) || ! $event_id || $event_id == 0 ) {
			return array();
		}

		if ( is_array( $get_fields ) ) {
			$_get_fields = implode( ', ', $get_fields );
		}

		global $wpdb;

		$query     = sprintf( 'SELECT %s FROM %s WHERE event_id = %s LIMIT %s', $_get_fields, EEM_TABLE_ATTENDEES, $event_id, $count );
		$attendees = $wpdb->get_results( $query, $output );

		if ( is_array( $get_fields ) && count( $get_fields ) == 1 ) {
			$attendees = array_map( function ( $attendee ) {
				return reset( $attendee );
			}, $attendees );
		}

		return apply_filters( 'eem_filters_eem_attendees', $attendees, $event_id );
	}
}


if ( ! function_exists( 'eem_print_blog_post' ) ) {
	/**
	 * Print blog post
	 *
	 * @param $post_id
	 * @param string $size
	 * @param bool $echo
	 *
	 * @return false|string
	 */
	function eem_print_blog_post( $post_id, $size = 'post-thumbnail', $echo = true ) {

		ob_start();

		if ( empty( $post_id ) || $post_id == 0 ) {
			return ob_get_clean();
		}

		$post        = get_post( $post_id );
		$post_author = get_user_by( 'ID', $post->post_author );

		?>
        <div class="post-item">

			<?php if ( has_post_thumbnail( $post_id ) ) : ?>
                <div class="post-image">
                    <a href="<?php echo esc_url( get_the_permalink( $post_id ) ); ?>">
                        <img src="<?php echo esc_url( get_the_post_thumbnail_url( $post_id, $size ) ); ?>"
                             alt="<?php echo get_the_title( $post_id ); ?>">
                    </a>
                </div>
			<?php endif; ?>

            <div class="post-body">
                <div class="post-meta">
					<?php printf( '<span class="post-author"><i class="icofont-user"></i> <a href="%s">%s</a></span>', get_author_posts_url( $post_author->ID ), $post_author->display_name ); ?>
					<?php printf( '<span class="post-meta-date"><i class="icofont-calendar"></i> %s</span>', get_the_date( 'M jS, Y', $post_id ) ); ?>
                </div>
                <h2 class="post-title">
                    <a href="<?php echo esc_url( get_the_permalink( $post_id ) ); ?>"><?php echo get_the_title( $post_id ); ?></a>
                </h2>
                <div class="post-content">
					<?php echo wpautop( wp_trim_words( get_the_content( null, false, $post_id ), 15 ) ); ?>
                </div>
                <div class="post-footer">
                    <a href="<?php echo esc_url( get_the_permalink( $post_id ) ); ?>"
                       class="eem-btn"><?php esc_html_e( 'Read More', EEM_TD ); ?> <i
                                class="icofont-arrow-right"></i></a>
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
		$button  = sprintf( '<%1$s class="%2$s" href="%3$s">%4$s</%1$s>', $tag, $classes, esc_url( $href ), $text );
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
	 * @param string $tag
	 * @param string $wrapper
	 * @param bool $echo
	 *
	 * @return mixed|string|void
	 */
	function eem_print_event_notice( $message = '', $type = 'success', $tag = 'div', $wrapper = '', $echo = true ) {

		if ( empty( $message ) ) {
			return false;
		}

		if ( ! in_array( $tag, array( 'div', 'p', 'span' ) ) ) {
			return false;
		}

		$notice = sprintf( '<%1$s class="eem-notice eem-notice-%2$s">%3$s</%1$s>', $tag, $type, $message );
		$notice = empty( $wrapper ) ? $notice : str_replace( '%', $notice, $wrapper );

		if ( $echo ) {
			print $notice;
		} else {
			return $notice;
		}
	}
}


if ( ! function_exists( 'eem_print_admin_notice' ) ) {
	/**
	 * Print Admin Notice
	 *
	 * @param string $message
	 * @param string $type
	 * @param bool $is_dismissible
	 */
	function eem_print_admin_notice( $message = '', $type = 'success', $is_dismissible = true ) {

		if ( empty( $message ) ) {
			return;
		}

		printf( '<div class="notice notice-%s is-dismissible"><p>%s</p></div>', $type, $message );
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
		$heading     = empty( $heading ) && isset( $args['heading'] ) ? $args['heading'] : '';
		$sub_heading = empty( $sub_heading ) && isset( $args['sub_heading'] ) ? $args['sub_heading'] : '';
		$short_desc  = empty( $short_desc ) && isset( $args['short_desc'] ) ? $args['short_desc'] : '';
		$heading     = $template_section && isset( $template_section['heading'] ) ? $template_section['heading'] : $heading;
		$sub_heading = $template_section && isset( $template_section['sub_heading'] ) ? $template_section['sub_heading'] : $sub_heading;
		$short_desc  = $template_section && isset( $template_section['short_desc'] ) ? $template_section['short_desc'] : $short_desc;
		$button      = $template_section && isset( $template_section['button'] ) ? $template_section['button'] : array();
		$button_url  = $template_section && isset( $template_section['button_url'] ) ? $template_section['button_url'] : '';


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

		if ( isset( $template_section['fullwidth_layout'] ) && reset( $template_section['fullwidth_layout'] ) == 'yes' ) {
		    $classes[] = 'eem-force-full-width';
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


if ( ! function_exists( 'eem_print_event_sponsor' ) ) {
	function eem_print_event_sponsor( $sponsor = array(), $echo = true ) {

		$sponsor_id = isset( $sponsor['id'] ) ? $sponsor['id'] : current_time( 'timestamp' );
		$type       = isset( $sponsor['type'] ) ? $sponsor['type'] : '';
		$name       = isset( $sponsor['name'] ) ? $sponsor['name'] : '';
		$logo       = isset( $sponsor['logo'] ) ? $sponsor['logo'] : '';

		$sponsor_fields = array(
			array(
				'options' => apply_filters( 'eem_filters_sponsors_fields', array(
					array(
						'id'    => "_event_sponsors[$sponsor_id][type]",
						'title' => esc_html__( 'Type', EEM_TD ),
						'type'  => 'select',
						'args'  => eem()->get_sponsor_types(),
						'value' => $type,
					),
					array(
						'id'      => "_event_sponsors[$sponsor_id][logo]",
						'title'   => esc_html__( 'Logo', EEM_TD ),
						'details' => esc_html__( 'Add company logo for this sponsor', EEM_TD ),
						'type'    => 'media',
						'value'   => $logo,
					),
					array(
						'id'          => "_event_sponsors[$sponsor_id][url]",
						'title'       => esc_html__( 'URL', EEM_TD ),
						'details'     => esc_html__( 'Add URL for this sponsor, you can their website or a blog post link on your website.', EEM_TD ),
						'type'        => 'text',
						'placeholder' => 'https://company.com/',
						'value'       => $logo,
					),
				), $sponsor ),
			)
		);

		ob_start();
		?>

        <div class="eem-repeat-single">
            <div class="eem-repeat-head">

				<?php eem()->PB()->generate_text(
					array(
						'id'          => "_event_sponsors[$sponsor_id][name]",
						'placeholder' => esc_html__( 'Company or Sponsor name', EEM_TD ),
						'type'        => 'text',
						'value'       => $name,
					)
				); ?>

                <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
            </div>
            <div class="eem-repeat-content">
				<?php eem()->PB()->generate_fields( $sponsor_fields ); ?>

                <script>
                    (function ($) {
                        $(function () {
                            $('#_event_sponsors_<?php echo esc_html( $sponsor_id ); ?>__type_').niceSelect();
                        });
                    })(jQuery);
                </script>
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

		ob_start();
		?>

        <div class="eem-repeat-single">
            <div class="eem-repeat-head">

				<?php eem()->PB()->generate_select2(
					array(
						'id'      => "_event_speakers[$speaker_id][user_id]",
						'title'   => esc_html__( 'Topics', EEM_TD ),
						'details' => esc_html__( 'Write topics on which this speaker will continue discussion.', EEM_TD ),
						'type'    => 'select2',
						'args'    => 'USERS',
						'value'   => $user_id,
					)
				); ?>

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
						'load_ui'       => false,
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

		// Check Extension - Advanced search & Filter
		if ( ! empty( $backtrace_file ) && strpos( $backtrace_file, 'eem-advanced-search-filter' ) !== false && defined( 'EEM_ASF_PLUGIN_DIR' ) ) {
			$plugin_dir = EEM_ASF_PLUGIN_DIR;
		}

		// Check Extension - Ticketing with WooCommerce
		if ( ! empty( $backtrace_file ) && strpos( $backtrace_file, 'eem-ticketing' ) !== false && defined( 'EEM_TW_PLUGIN_DIR' ) ) {
			$plugin_dir = EEM_TW_PLUGIN_DIR;
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

		// Check Extension - Advanced search & Filter
		if ( ! empty( $backtrace_file ) && strpos( $backtrace_file, 'eem-advanced-search-filter' ) !== false && defined( 'EEM_ASF_PLUGIN_DIR' ) ) {
			$plugin_dir = EEM_ASF_PLUGIN_DIR;
		}

		// Check Extension - Ticketing with WooCommerce
		if ( ! empty( $backtrace_file ) && strpos( $backtrace_file, 'eem-ticketing' ) !== false && defined( 'EEM_TW_PLUGIN_DIR' ) ) {
			$plugin_dir = EEM_TW_PLUGIN_DIR;
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


if ( ! function_exists( 'eem_create_username' ) ) {
	/**
	 * Create a unique username for a new user.
	 *
	 * @param string $email New customer email address.
	 * @param array $new_user_args Array of new user args, maybe including first and last names.
	 * @param string $suffix Append string to username to make it unique.
	 *
	 * @return string Generated username.
	 */
	function eem_create_username( $email, $new_user_args = array(), $suffix = '' ) {
		$username_parts = array();

		if ( isset( $new_user_args['full_name'] ) ) {
			$username_parts[] = preg_replace( '/[^A-Za-z0-9\-]/', '', sanitize_user( $new_user_args['full_name'], true ) );
		}

		// Remove empty parts.
		$username_parts = array_filter( $username_parts );

		// If there are no parts, e.g. name had unicode chars, or was not provided, fallback to email.
		if ( empty( $username_parts ) ) {
			$email_parts    = explode( '@', $email );
			$email_username = $email_parts[0];

			// Exclude common prefixes.
			if ( in_array(
				$email_username,
				array(
					'sales',
					'hello',
					'mail',
					'contact',
					'info',
				),
				true
			) ) {
				// Get the domain part.
				$email_username = $email_parts[1];
			}

			$username_parts[] = sanitize_user( $email_username, true );
		}

		$username = implode( '.', $username_parts );
		$username = function_exists( 'mb_strtolower' ) ? mb_strtolower( $username ) : strtolower( $username );

		if ( $suffix ) {
			$username .= $suffix;
		}

		/**
		 * WordPress 4.4 - filters the list of blacklisted usernames.
		 *
		 * @param array $usernames Array of blacklisted usernames.
		 *
		 * @since 3.7.0
		 */
		$illegal_logins = (array) apply_filters( 'illegal_user_logins', array() );

		// Stop illegal logins and generate a new random username.
		if ( in_array( strtolower( $username ), array_map( 'strtolower', $illegal_logins ), true ) ) {
			$new_args = array();

			/**
			 * Filter generated username.
			 *
			 * @param string $username Generated username.
			 * @param string $email New customer email address.
			 * @param array $new_user_args Array of new user args, maybe including first and last names.
			 * @param string $suffix Append string to username to make it unique.
			 *
			 * @since 3.7.0
			 */
			$new_args['full_name'] = apply_filters(
				'eem_generated_username',
				'eem_user_' . zeroise( wp_rand( 0, 9999 ), 4 ),
				$email,
				$new_user_args,
				$suffix
			);

			return eem_create_username( $email, $new_args, $suffix );
		}

		if ( username_exists( $username ) ) {
			// Generate something unique to append to the username in case of a conflict with another user.
			$suffix = '-' . zeroise( wp_rand( 0, 9999 ), 4 );

			return eem_create_username( $email, $new_user_args, $suffix );
		}

		/**
		 * Filter new username.
		 *
		 * @param string $username Customer username.
		 * @param string $email New customer email address.
		 * @param array $new_user_args Array of new user args, maybe including first and last names.
		 * @param string $suffix Append string to username to make it unique.
		 *
		 * @since 3.7.0
		 */
		return apply_filters( 'eem_generated_username', $username, $email, $new_user_args, $suffix );
	}
}


if ( ! function_exists( 'eem_print_sidebar_data' ) ) {
	/**
	 * Print sidebar data by giving array sidebar data
	 *
	 * @param array $sidebar_data
	 */
	function eem_print_sidebar_data( $sidebar_data = array() ) {

		$sidebar_data = (array) $sidebar_data;

		foreach ( $sidebar_data as $data_key => $data ) {

			$label = isset( $data['label'] ) ? $data['label'] : '';
			$hint  = isset( $data['hint'] ) ? $data['hint'] : '';
			$hint  = empty( $hint ) ? '' : sprintf( ' <span class="tt--top" aria-label="%s">?</span>', $hint );
			$data  = isset( $data['data'] ) ? $data['data'] : '';

			printf( '<div class="pb-metabox-side"><label>%s%s</label><div class="pb-metabox-side-data">%s</div></div>', $label, $hint, $data );
		}
	}
}
