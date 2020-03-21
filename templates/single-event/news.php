<?php
/**
 * Single Event - News
 *
 * @package single-event/news.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $template_section, $inside_endpoint;

$count  = $template_section && isset( $template_section['count'] ) && ! empty( $template_section['count'] ) ? $template_section['count'] : 3;
$button = $template_section && isset( $template_section['button'] ) && is_array( $template_section['button'] ) ? reset( $template_section['button'] ) : '';

if( $inside_endpoint && $inside_endpoint == 'news' ) {
	$count = 999;
	$button = 'yes';
}

$event_posts = $event->get_posts( $count );

?>
<div <?php eem_print_event_section_classes( 'eem-event-section eem-blog-style-1 eem-spacer' ); ?>>
    <div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'News', EEM_TD ),
				'sub_heading' => esc_html__( 'Know more about this event', EEM_TD ),
				'short_desc'  => esc_html__( 'Read some informative posts from our blog about this event', EEM_TD ),
			)
		); ?>

	    <?php
	    if ( empty( $event_posts ) ) {
		    eem_print_event_notice( apply_filters( 'eem_filters_posts_not_found_text',
			    esc_html__( 'No posts published yet. We will announce latter. Stay close !', EEM_TD ) ), 'warning'
		    );
	    }
	    ?>

        <div class="pb-row pb-justify-content-center">
			<?php foreach ( $event_posts as $post_id ) {
				printf( '<div class="pb-col-lg-4 pb-col-md-6">%s</div>', eem_print_blog_post( $post_id, 'event_post', false ) );
			} ?>
        </div>

	    <?php if ( ! empty( $event_posts ) && $button !== 'yes' ) {
		    eem_print_button( esc_html__( 'All Posts', EEM_TD ), 'a', 'eem-btn eem-btn-large',
			    $event->get_endpoint_url( 'news' ), '<div class="view-more text-center">%</div>' );
	    } ?>

    </div>

</div>
