<?php
/**
 * Single Event - Gallery
 *
 * @package single-event/gallery.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event;


?>
<div <?php eem_print_event_section_classes( 'eem-event-section eem-spacer eem-gallery-style-1 bg-white eem-force-full-width' ); ?>>

	<?php eem_print_event_section_heading(
		array(
			'heading'     => esc_html__( 'Some Memories', EEM_TD ),
			'sub_heading' => esc_html__( 'Moments from past', EEM_TD ),
			'short_desc'  => esc_html__( 'See some great moments from our previous events', EEM_TD ),
		)
	); ?>

    <div class="eem-gallery-wrap pb-grid pb-grid-4 pb-no-gutters">

		<?php foreach ( $event->get_gallery_images( 'full' ) as $image_id => $image_url ) {
			printf( '<div class="pb-grid-col"><div class="gallery-single"><img src="%1$s" alt="%2$s"><a href="%1$s" class="gallery-zoon-icon" data-effect="mfp-3d-unfold"><i class="icofont-search"></i></a></div></div>',
				$image_url, eem()->get_meta( '_wp_attachment_image_alt', $image_id )
			);
		} ?>

    </div>
</div>
