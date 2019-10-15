<?php
/**
 * Admin Template: Publish Box
 */

$sidebar_data = array(
	'publish_date' => array(
		'label' => esc_html__( 'Publish Date', EEM_TD ),
		'hint'  => esc_html__( 'Event Publish Date', EEM_TD ),
		'data'  => sprintf( '<span>%s</span>', get_the_date( 'jS M, Y' ) ),
	),
);

eem_print_sidebar_data( apply_filters( 'eem_filters_event_sidebar_data', $sidebar_data ) );

?>

<style>
    #misc-publishing-actions {
        padding: 0;
    }

    #minor-publishing-actions, .misc-pub-post-status, .misc-pub-curtime, .misc-pub-visibility {
        display: none !important;
    }

    #major-publishing-actions {
        border: none !important;
        background: #fff !important;
    }

    input#publish,
    input#publish:focus,
    input#publish:active {
        color: #fff !important;
        text-decoration: none;
        background: #4f7d79;
        border-radius: 4px;
        padding: 0px 20px !important;
        outline: none;
        box-shadow: none;
        user-select: none;
        border: none;
        text-shadow: none !important;
    }
</style>
