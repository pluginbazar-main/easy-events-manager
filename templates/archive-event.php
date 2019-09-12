<?php

/**
 * Archive Event
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

?>


    <div class="eem-force-full-width eem-event-search">
        <div class="pb-container">
            <div class="eem-event-search-wrap">
                <h2 class="eem-event-search-title">Find your Event</h2>
                <form class="eem-event-search-form">
                    <div class="form-fields-wrap">
						<?php eem()->PB()->generate_fields( array( array( 'options' => eem()->get_archive_search_fields() ) ) ); ?>
                    </div>

                </form>
            </div>
        </div>
    </div>


<?php
get_footer();