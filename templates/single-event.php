<?php
/**
 * Single Event
 */

get_header();


do_action( 'eem_before_single_event_template' );

while ( have_posts() ) : the_post();

	eem_get_template_part( 'content', 'single-event' );

endwhile;


do_action( 'eem_after_single_event_template' );


get_footer();