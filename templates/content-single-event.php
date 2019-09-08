<?php
/**
 * Single event content template
 *
 * @package content-single-event.php
 */


do_action( 'eem_before_single_event' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

?>
    <div id="event-<?php the_ID(); ?>" <?php // eem_single_post_class(); ?>>
		<?php

		global $event;

		$event = eem_get_event();

		/**
		 * Hook: eem_single_poll_main
		 *
		 * @hooked eem_single_poll_title
		 */
		do_action( 'eem_single_event_main' );
		?>
    </div>

<?php
do_action( 'eem_after_single_event' );