<?php
/**
 * Ajax
 */


if ( ! function_exists( 'eem_add_attendees' ) ) {
	/**
	 * Add Attendees
	 *
	 * @ajax eem_add_attendees
	 */
	function eem_add_attendees() {

		if ( ! isset( $_POST['form_data'] ) ) {
			wp_send_json_error();
		}

		parse_str( $_POST['form_data'], $form_data );

		$event_id  = isset( $form_data['event_id'] ) ? sanitize_text_field( $form_data['event_id'] ) : '';
		$full_name = isset( $form_data['full_name'] ) ? sanitize_text_field( $form_data['full_name'] ) : '';
		$email_add = isset( $form_data['email_add'] ) ? sanitize_email( $form_data['email_add'] ) : '';

		if ( empty( $event_id ) || $event_id === 0 ) {
			wp_send_json_error( esc_html__( 'Trying invalid event !', EEM_TD ) );
		}

		if ( empty( $email_add ) ) {
			wp_send_json_error( esc_html__( 'Invalid email address provided !', EEM_TD ) );
		}

		$user_id = email_exists( $email_add );

		if ( ! $user_id ) {

			$user_args = array(
				'user_login'   => eem_create_username( $email_add, array( 'full_name' => $full_name ) ),
				'user_email'   => $email_add,
				'display_name' => $full_name,
			);
			$user_id   = wp_insert_user( $user_args );

			if ( is_wp_error( $user_id ) ) {
				wp_send_json_error( $user_id->get_error_message() );
			}
		}

		$ret = eem_insert_attendee( $event_id, $user_id );

		if ( is_wp_error( $ret ) ) {
			wp_send_json_error( $ret->get_error_message() );
		}

		wp_send_json_success( esc_html__( 'Attendee added successfully', EEM_TD ) );
	}
}
add_action( 'wp_ajax_eem_add_attendees', 'eem_add_attendees' );
add_action( 'wp_ajax_nopriv_eem_add_attendees', 'eem_add_attendees' );