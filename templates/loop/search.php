<?php
/**
 * Archive Event - Search
 *
 * @package loop/search.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="eem-force-full-width eem-event-search">
    <div class="pb-container">
        <div class="eem-event-search-wrap">
            <h2 class="eem-event-search-title">Find your Event</h2>
            <form class="eem-event-search-form">
                <div class="form-fields-wrap">
					<?php eem()->PB()->generate_fields( array( array( 'options' => eem()->get_archive_search_fields() ) ) ); ?>
                </div>

                <div class="eem-search-footer">
                    <p class="eem-search-total-count">There are over 143 Events for you.</p>
                    <div class="eem-fields-expand-btn"><i class="icofont-listine-dots"></i> Advanced search</div>
                </div>

                <div class="form-button-wrap">
                    <button class="eem-btn">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
