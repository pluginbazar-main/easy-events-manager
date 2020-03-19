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

global $event, $template_section, $inside_endpoint;

$count  = $template_section && isset( $template_section['count'] ) && ! empty( $template_section['count'] ) ? $template_section['count'] : 4;
$button = $template_section && isset( $template_section['button'] ) && is_array( $template_section['button'] ) ? reset( $template_section['button'] ) : '';

if( $inside_endpoint && $inside_endpoint == 'gallery' ) {
	$count = 999;
	$button = 'yes';
}

$images = $event->get_gallery_images( 'event_gallery', $count );


?>
<div <?php eem_print_event_section_classes( 'eem-event-section eem-spacer eem-gallery-style-1 bg-white eem-force-full-width' ); ?>>

	<?php eem_print_event_section_heading(
		array(
			'heading'     => esc_html__( 'Some Memories', EEM_TD ),
			'sub_heading' => esc_html__( 'Moments from past', EEM_TD ),
			'short_desc'  => esc_html__( 'See some great moments from our previous events', EEM_TD ),
		)
	); ?>

	<?php
	if ( empty( $images ) ) {
		eem_print_event_notice( apply_filters( 'eem_filters_gallery_not_found_text',
			esc_html__( 'No images/memories shared yet. We will announce latter. Stay close !', EEM_TD ) ), 'warning',
			'div', '<div class="pb-container">%</div>'
		);
	}
	?>

    <div class="eem-gallery-wrap pb-grid pb-grid-4 pb-no-gutters pb-justify-content-center">

		<?php foreach ( $images as $image_id => $image_url ) {
			printf( '<div class="pb-grid-col"><div class="gallery-single"><img src="%1$s" alt="%2$s"><a href="%1$s" class="gallery-zoom-icon" data-effect="mfp-3d-unfold"><i class="icofont-search"></i></a></div></div>',
				$image_url, eem()->get_meta( '_wp_attachment_image_alt', $image_id )
			);
		} ?>

    </div>

	<?php if ( ! empty( $images ) && $button !== 'yes' ) {
		eem_print_button( esc_html__( 'All Photos', EEM_TD ), 'a', 'eem-btn eem-btn-large',
			$event->get_endpoint_url( 'gallery' ), '<div class="view-more text-center">%</div>' );
	} ?>

</div>
