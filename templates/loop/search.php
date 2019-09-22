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


$search_fields = array(
	array(
		'id'          => 'sf_keyword',
		'placeholder' => esc_html__( 'technology', EEM_TD ),
		'type'        => 'text',
	),
);
$search_fields = array( array( 'options' => apply_filters( 'eem_filters_archive_search_fields', $search_fields ) ) );

?>

<div class="eem-force-full-width eem-default-search-form">
    <div class="pb-container">
        <div class="eem-event-search-wrap">
            <h2 class="eem-event-search-title">Find your Event</h2>
            <form class="eem-event-search-form">
                <div class="form-fields">
                    <input type="text" name="sf_keyword" placeholder="Keyword to search" autocomplete="off">
                    <button class="eem-btn"><i class="icofont-search"></i></button>
                </div>
                <p class="eem-search-total-count">There are over 143 Events for you.</p>
            </form>
        </div>
    </div>
</div>
