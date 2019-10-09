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

$sidebar_data = apply_filters( 'eem_filters_event_sidebar_data', $sidebar_data );

foreach ( $sidebar_data as $data_key => $data ) {

	$label = isset( $data['label'] ) ? $data['label'] : '';
	$hint  = isset( $data['hint'] ) ? $data['hint'] : '';
	$hint  = empty( $hint ) ? '' : sprintf( ' <span class="tt--top" aria-label="%s">?</span>', $hint );
	$data  = isset( $data['data'] ) ? $data['data'] : '';

	printf( '<div class="pb-metabox-side"><label>%s%s</label><div class="pb-metabox-side-data">%s</div></div>', $label, $hint, $data );
}


do_action( 'eem_event_publish_box' );

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
