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

global $wp_query;

$keyword = isset( $_GET['k'] ) ? sanitize_text_field( $_GET['k'] ) : '';

?>

<div class="eem-default-search-form">
    <div class="pb-container">
        <div class="eem-event-search-wrap">
            <h2 class="eem-event-search-title">Find your Event</h2>
            <form class="eem-event-search-form" method="get">
                <div class="form-fields">
                    <input autocomplete="off" name="k" type="text"
                           value="<?php echo esc_attr( $keyword ); ?>"
                           placeholder="<?php esc_attr_e( 'Keyword to search', EEM_TD ); ?>">
                    <button class="eem-btn"><i class="icofont-search"></i></button>
                </div>
                <p class="eem-search-total-count"><?php printf( _n( 'We have found %s event for you', 'We have found %s events for you', $wp_query->found_posts, EEM_TD ), $wp_query->found_posts ); ?></p>
            </form>
        </div>
    </div>
</div>
