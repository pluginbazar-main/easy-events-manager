<?php
/**
 * Single Event - Blog
 *
 * @package single-event/blog.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event;

$nearby_facts = eem()->get_nearby_facts();

?>

<div <?php eem_print_event_section_classes( 'eem-event-section eem-nearby-style-1 eem-blog-style-1 bg-white eem-spacer' ); ?>>
    <div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Exploring Nearby', EEM_TD ),
				'sub_heading' => esc_html__( 'Would like to know more', EEM_TD ),
				'short_desc'  => esc_html__( 'Have some great time at the event location. Here are some detailed information about nearby facts.', EEM_TD ),
			)
		); ?>

        <div class="pb-row eem-tab-panel">
            <div class="pb-col-md-6 tab-nav">

				<?php $index = 0;
				foreach ( $nearby_facts as $fact_id => $nearby ) {

					$index ++;

					$active = $index == 1 ? 'active' : '';
					$label  = isset( $nearby['label'] ) ? $nearby['label'] : '';
					$icon   = isset( $nearby['icon'] ) ? $nearby['icon'] : '';

					printf( '<div class="tab-nav-item %s" data-target="nearby-%s">%s<span>%s</span></div>', $active, $fact_id, $icon, $label );
				} ?>

            </div>

            <div class="pb-col-md-6 tab-content">
				<?php $index = 0;
				foreach ( $nearby_facts as $fact_id => $nearby ) {

					$index ++;

					$active  = $index == 1 ? 'active' : '';
					$label   = isset( $nearby['label'] ) ? $nearby['label'] : '';
					$icon    = isset( $nearby['icon'] ) ? $nearby['icon'] : '';
					$post_id = $event->get_meta( "_event_nearby_{$fact_id}" );

					ob_start();

					if ( empty( $post_id ) || $post_id == 0 ) {
						eem_print_event_notice( apply_filters( 'eem_filters_nearby_not_found_text',
							esc_html__( 'No details shared yet on this topic. We will announce latter. Stay close !', EEM_TD ) ), 'warning', 'div', ''
						);
					} else {
						eem_print_blog_post( $post_id, 'event_nearby' );
					}

					printf( '<div class="tab-item-content %s nearby-%s">%s</div>', $active, $fact_id, ob_get_clean() );
				} ?>
            </div>

        </div>
    </div>
</div>