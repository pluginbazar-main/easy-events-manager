<?php
/**
 * Attendees Table
 */

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}


class EEM_Attendees_list extends WP_List_Table {

	public function __construct() {

		parent::__construct( array(
			'singular' => esc_html__( 'Attendee', EEM_TD ),
			'plural'   => esc_html__( 'Attendees', EEM_TD ),
			'ajax'     => false,
		) );
	}


	public static function get_attendees( $per_page = 5, $page_number = 1 ) {

		global $wpdb;

		$sql = 'SELECT * FROM ' . EEM_TABLE_ATTENDEES;

		if ( ! empty( $_REQUEST['event'] ) ) {
			$sql .= ' WHERE event_id = ' . esc_sql( $_REQUEST['event'] );
		}

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}


	public static function record_count() {

		global $wpdb;

		$event_id = isset( $_REQUEST['event'] ) ? $_REQUEST['event'] : '';

		if ( empty( $event_id ) ) {
			return 0;
		}

		$query = sprintf( 'SELECT count(*) FROM %s WHERE event_id = %s', EEM_TABLE_ATTENDEES, $event_id );

		return $wpdb->get_var( $query );
	}


	public function no_items() {
		esc_html_e( 'No attendee found for this event.', EEM_TD );
	}


	public function column_default( $item, $column_name ) {

		$event_id = isset( $item['event_id'] ) ? $item['event_id'] : '';
		$status   = isset( $item['status'] ) ? $item['status'] : '';
		$row_id   = isset( $item['id'] ) ? $item['id'] : '';
		$datetime = isset( $item['datetime'] ) ? $item['datetime'] : '';

		if ( $column_name === 'event' && ! empty( $event_id ) ) {

			$row_actions[] = sprintf( '<a class="edit" target="_blank" href="post.php?post=%s&action=edit">%s</a>', $event_id, esc_html__( 'Edit', EEM_TD ) );
			$row_actions[] = sprintf( '<a class="view" href="%s">%s</a>', get_the_permalink( $event_id ), esc_html__( 'View', EEM_TD ) );

			return sprintf( '<a href="post.php?post=%s&action=edit">%s</a><div class="row-actions eem-attendees-event">%s</div>',
				$event_id, get_the_title( $event_id ),
				implode( '', $row_actions )
			);
		}

		if ( $column_name === 'status' ) {
			return sprintf( '<span class="eem-attendee-status status-%s">%s</span>', $status, ucfirst( $status ) );
		}

		if ( $column_name === 'actions' ) {

			$approve_url = sprintf( '%s&event=%s&id=%s&action=approve', menu_page_url( 'attendees', false ), $event_id, $row_id );
			$decline_url = sprintf( '%s&event=%s&id=%s&action=decline', menu_page_url( 'attendees', false ), $event_id, $row_id );

			if( $status != 'approved' ) {
				$buttons[] = sprintf( '<a href="%s" class="attendee-action action-approve tt--top tt--success" aria-label="%s">%s</a>',
					$approve_url, esc_html__( 'Approve Attendee', EEM_TD ), '<i class="icofont-check-alt"></i>'
				);
			}

			if( $status != 'declined' ) {
				$buttons[] = sprintf( '<a href="%s" class="attendee-action action-decline tt--top tt--error" aria-label="%s">%s</a>',
					$decline_url, esc_html__( 'Decline Attendee', EEM_TD ), '<i class="icofont-close"></i>'
				);
			}

			return implode( '', $buttons );
		}

		if ( $column_name === 'time' ) {


			$time_ago = human_time_diff( strtotime( $datetime ), current_time( 'timestamp' ) );
			echo "<i>Submitted $time_ago " . __( 'ago', 'wp-poll' ) . "</i>";

			echo '<div class="row-actions af-submission-time">';
			printf( '<span>%s</span>', date( 'jS M, Y - g:i a', strtotime( $datetime ) ) );
			echo '</div>';
		}

		return '';
	}


	function column_name( $item ) {

		$email    = isset( $item['email'] ) ? $item['email'] : '';
		$event_id = isset( $item['event_id'] ) ? $item['event_id'] : '';
		$row_id   = isset( $item['id'] ) ? $item['id'] : '';

		if ( empty( $email ) ) {
			return '';
		}

		$attendee = get_user_by( 'email', $email );

		return sprintf( '<strong><a class="row-title" href="%s?user_id=%s">%s</a></strong><div class="row-actions eem-attendees-event">%s</div>',
			admin_url( 'user-edit.php' ), $attendee->ID, $attendee->display_name,
			sprintf( '<a class="remove" href="%s&id=%s&action=remove&event=%s">%s</a>', menu_page_url( 'attendees', false ), $row_id, $event_id, esc_html__( 'Remove', EEM_TD ) )
		);
	}


	function get_columns() {
		return array(
			'name'    => esc_html__( 'Attendee Name', EEM_TD ),
			'event'   => esc_html__( 'Event Details', EEM_TD ),
			'status'  => esc_html__( 'Status', EEM_TD ),
			'actions' => esc_html__( 'Actions', EEM_TD ),
			'time'    => esc_html__( 'Joined time', EEM_TD ),
		);
	}

	function get_column_info() {

		return array( $this->get_columns(), array(), array(), $this->get_primary_column_name() );
	}


	function process_actions() {

		global $wpdb;

		$action = isset( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : '';
		$row_id = isset( $_GET['id'] ) ? sanitize_text_field( $_GET['id'] ) : '';

		if ( ! empty( $row_id ) && $action == 'remove' ) {
			eem_remove_attendee( $row_id );
		}

		if ( ! empty( $row_id ) && $action == 'approve' ) {
			$wpdb->update( EEM_TABLE_ATTENDEES, array( 'status' => 'approved' ), array( 'id' => $row_id ) );
		}

		if ( ! empty( $row_id ) && $action == 'decline' ) {
			$wpdb->update( EEM_TABLE_ATTENDEES, array( 'status' => 'declined' ), array( 'id' => $row_id ) );
		}
	}


	public function prepare_items() {

		$this->process_actions();

		$this->_column_headers = $this->get_column_info();

		$per_page     = $this->get_items_per_page( 'attendees_per_page', 20 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $per_page,
		) );

		$this->items = self::get_attendees( $per_page, $current_page );
	}
}