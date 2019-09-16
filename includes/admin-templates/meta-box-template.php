<?php
/**
 * EEM - Admin Templates - Template Meta Box
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

$_sections = eem()->get_meta( '_sections', get_the_ID(), array() );

?>

<div class="eem-templates-builder">

    <div class="eem-sections-available">

        <h3><?php esc_html_e( 'Available sections', EEM_TD ); ?></h3>

		<?php foreach ( eem()->get_template_sections() as $section_id => $section ) :

			$section_label = isset( $section['label'] ) ? $section['label'] : '';
			?>
            <div class="eem-section eem-section-<?php echo esc_attr( $section_id ); ?> tt--top"
                 aria-label="<?php echo esc_attr( 'Click to Add', EEM_TD ); ?>"
                 data-section-id="<?php echo esc_attr( $section_id ); ?>">
                <span><?php echo esc_html( $section_label ); ?></span>
            </div>

		<?php endforeach; ?>
    </div>

    <div class="eem-repeat-container eem-sections-selected">

        <h3><?php esc_html_e( 'Selected sections', EEM_TD ); ?></h3>

		<?php
		foreach ( $_sections as $section_id => $section ) :

			eem_print_template_section( array( 'section_id' => $section_id, 'value' => $section ) );

		endforeach;
		?>

    </div>

</div>


