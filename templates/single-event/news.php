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

        <div class="pb-row">
			<?php foreach ( $event->get_posts() as $post_id ) {
				printf( '<div class="pb-col-lg-4 pb-col-md-6">%s</div>', eem_print_blog_post( $post_id, 'event_post', false ) );
			} ?>
        </div>
    </div>

</div>
