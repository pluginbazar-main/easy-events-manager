<?php
/**
 * Single Event
 */

get_header();


do_action( 'eem_before_single_event_template' );

while ( have_posts() ) : the_post();

	/**
	 * Single Event Content
	 *
	 * @see eem_single_event_main_banner()
	 * @see eem_single_event_main_speakers()
	 * @see eem_single_event_main_pricing()
	 * @see eem_single_event_main_register()
	 * @see eem_single_event_main_attendees()
	 * @see eem_single_event_main_cta()
	 * @see eem_single_event_main_sponsors()
	 * @see eem_single_event_main_gallery()
	 * @see eem_single_event_main_blog()
	 */
	eem_get_template_part( 'content', 'single-event' );

endwhile;


do_action( 'eem_after_single_event_template' );


get_footer();