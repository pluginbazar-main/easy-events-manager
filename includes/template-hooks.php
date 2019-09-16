<?php
/**
 * Template hooks
 */

add_action( 'init', function () {
	echo '<pre>'; print_r( array_keys( eem()->get_template_sections() ) ); echo '</pre>';

	foreach ( eem()->get_template_sections() as $section_id => $section ) {
		if ( isset( $section['priority'] ) && ! empty( $section['priority'] ) ) {
			add_action( 'eem_single_event_main', sprintf( 'eem_single_event_main_%s', $section_id ), $section['priority'] );
		}
	}
} );


add_action( 'eem_single_event_main', 'eem_single_event_main_floating_box', 65 );



