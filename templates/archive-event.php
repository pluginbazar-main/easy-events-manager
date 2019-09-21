<?php

/**
 * Archive Event
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


get_header();


/**
 * Before Archive Main
 *
 * Initiate global $wp_query; with Main query
 */
do_action( 'eem_before_event_archive_main' );


/**
 * Before Event Archive loop
 *
 * @see eem_archive_event_search()
 * @see eem_archive_event_loop_start()
 */
do_action( 'eem_before_event_archive_loop' );

?>
    <div class="pb-row">

		<?php while ( have_posts() ) : the_post();

			eem_get_template_part( 'content', 'event' );

		endwhile; ?>

    </div>
<?php


/**
 * After Event Archive loop
 *
 * @see eem_archive_event_pagination()
 * @see eem_archive_event_loop_end()
 */
do_action( 'eem_after_event_archive_loop' );


/**
 * After event completed, Restore the global $wp_query;
 */
do_action( 'eem_after_event_archive_main' );


get_footer();