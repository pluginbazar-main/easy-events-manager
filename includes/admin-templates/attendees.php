<?php
/**
 * EEM - Admin Templates - Attendees
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

$attendees_list = new EEM_Attendees_list();
$user_events    = array();
$event_id       = isset( $_GET['event'] ) ? sanitize_text_field( $_GET['event'] ) : 0;
$_user_events   = eem()->get_user_event( false, array( 'fields' => 'ids' ) );

foreach ( $_user_events as $_event_id ) {
	$user_events[ $_event_id ] = get_the_title( $_event_id );
}

if ( $event_id && $event_id != 0 ) : ?>

    <div id="poststuff">
        <div id="post-body" class="metabox-holder">
            <div id="post-body-content">

				<?php
				eem_print_button( sprintf( '<i class="icofont-history"></i> %s', esc_html__( 'Back to Event selection', EEM_TD ) ),
					'a', 'eem-admin-btn', menu_page_url( 'attendees', false )
				);

				eem_print_button( get_the_title( $event_id ), 'a', 'event-title', get_edit_post_link( $event_id ) );
				?>

                <div class="meta-box-sortables ui-sortable">
                    <form method="post">
						<?php
						$attendees_list->prepare_items();
						$attendees_list->display();
						?>
                    </form>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>

<?php else : ?>

    <form action="<?php menu_page_url( 'attendees' ); ?>" method="get" class="eem-attendees-wrap">

        <div class="event-count"><?php printf( esc_html__( 'You have created %s events. Please select one to see attendees list', EEM_TD ), count( $_user_events ) ); ?></div>

		<?php
		eem()->PB()->generate_fields( array(
			array(
				'options' => array(
					array(
						'id'    => 'event',
						'title' => esc_html__( 'Select Event', EEM_TD ),
						'type'  => 'select',
						'args'  => $user_events,
					),
				),
			),
		) );

		foreach ( $_GET as $key => $value ) {
			if ( $key !== 'event' ) {
				printf( '<input type="hidden" name="%s" value="%s">', sanitize_key( $key ), sanitize_text_field( $value ) );
			}
		}
		?>

    </form>

<?php endif;

