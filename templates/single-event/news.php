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

$event_posts = $event->get_posts();

?>
<div <?php eem_print_event_section_classes( 'eem-event-section eem-blog-style-1 eem-force-full-width eem-spacer' ); ?>>
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

        <div class="pb-row">
			<?php foreach ( $event_posts as $post_id ) {
				printf( '<div class="pb-col-lg-4 pb-col-md-6">%s</div>', eem_print_blog_post( $post_id, 'event_post', false ) );
			} ?>
        </div>
    </div>

</div>
