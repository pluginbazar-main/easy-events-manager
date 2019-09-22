<?php
/**
 * Class Shortcodes
 *
 * @author Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


if ( ! class_exists( 'EEM_Shortcodes' ) ) {
	class EEM_Shortcodes {

		/**
		 * EEM_Shortcodes constructor.
		 */
		public function __construct() {
			add_shortcode( 'eem_user_profile', array( $this, 'display_user_profile' ) );
			add_shortcode( 'eem_form', array( $this, 'display_eem_form' ) );
		}

		function display_eem_form() {

			$fields = array(

				array(
					'id'            => 'sample_text',
					'title'       => esc_html__( 'Sample Text', EEM_TD ),
					'details'       => esc_html__( 'Sample text field', EEM_TD ),
					'type'          => 'text',
					'placeholder'   => 'This is test',
				),

				array(
					'id'          => 'sample_textarea',
					'title'       => __( 'Countdown timer text', 'woc-open-close' ),
					'details'     => __( 'For: Status Open, This text will visible before the countdown timer when shop is open.', 'woc-open-close' ),
					'type'        => 'textarea',
					'placeholder' => __( 'This shop will be closed within', 'woc-open-close' ),
				),

				array(
					'id'      => 'sample_checkbox',
					'title'   => __( 'Display countdown timer', 'woc-open-close' ),
					'details' => __( 'Select the places where you want to display the countdown timer on your shop. When your shop is closed then it will show how much time left for your shop to open, and vice verse', 'woc-open-close' ),
					'type'    => 'checkbox',
					'args'    => array(
						'before_cart_table'    => __( 'Before cart table on Cart page', 'woc-open-close' ),
						'after_cart_table'     => __( 'After cart table on Cart page', 'woc-open-close' ),
						'before_cart_total'    => __( 'Before cart total on Cart page', 'woc-open-close' ),
						'after_cart_total'     => __( 'After cart total on Cart page', 'woc-open-close' ),
						'before_checkout_form' => __( 'Before checkout form on Checkout Page', 'woc-open-close' ),
						'after_checkout_form'  => __( 'After checkout form on Checkout Page', 'woc-open-close' ),
						'before_order_review'  => __( 'Before order review on Checkout Page', 'woc-open-close' ),
						'after_order_review'   => __( 'After order review on Checkout Page', 'woc-open-close' ),
						'before_cart_single'   => __( 'Before cart button on Single Product Page', 'woc-open-close' ),
						'top_on_myaccount'     => __( 'Top on My-Account Page', 'woc-open-close' ),
					),
					'default' => array(
						'before_cart_table',
						'before_order_review',
						'before_cart_single',
						'top_on_myaccount'
					),
				),


				array(
					'id'      => 'sample_radio',
					'title'   => esc_html__( 'Display Check Icon', 'woc-open-close' ),
					'details' => esc_html__( 'Do you want to show a check/tick icon before the Day names.', 'woc-open-close' ),
					'type'    => 'radio',
					'args'    => array(
						'yes' => esc_html__( 'Yes', 'woc-open-close' ),
						'no'  => esc_html__( 'No', 'woc-open-close' ),
						'ykd'  => esc_html__( 'Maybe', 'woc-open-close' ),
						'nfsd'  => esc_html__( 'I will', 'woc-open-close' ),
						'nofewx'  => esc_html__( 'What?', 'woc-open-close' ),
					),
					'default' => array( 'yes' ),
				),


				array(
					'id'      => 'sample_select',
					'title'   => esc_html__( 'Popup Effect', 'woc-open-close' ),
					'details' => esc_html__( 'Change popup box effect while opening or closing', 'woc-open-close' ),
					'type'    => 'select',
					'args'    => array(
						'mfp-zoom-in'         => esc_html__( 'Zoom', 'woc-open-close' ),
						'mfp-zoom-out'        => esc_html__( 'Zoom Out', 'woc-open-close' ),
						'mfp-newspaper'       => esc_html__( 'Newspaper', 'woc-open-close' ),
						'mfp-move-horizontal' => esc_html__( 'Horizontal move', 'woc-open-close' ),
						'mfp-move-from-top'   => esc_html__( 'Move from top', 'woc-open-close' ),
						'mfp-3d-unfold'       => esc_html__( '3D unfold', 'woc-open-close' ),
					),
				),


				array(
					'id'            => 'sample_time',
					'title'       => esc_html__( 'Sample TimePicker', EEM_TD ),
					'details'       => esc_html__( 'Specify event start time here', EEM_TD ),
					'type'          => 'timepicker',
					'placeholder'   => date( 'H:s A' ),
					'field_options' => array(
						'interval' => 15,
						'dynamic'  => true,
					),
				),

				array(
					'id'            => 'sample_datepicker',
					'title'         => esc_html__( 'Start Date/Time', EEM_TD ),
					'details'       => esc_html__( 'Specify event start date here', EEM_TD ),
					'type'          => 'datepicker',
					'placeholder'   => date( 'Y-m-d' ),
					'field_options' => array(
						'dateFormat' => 'yy-mm-dd',
					),
				),

				array(
					'id'      => 'test_select2',
					'title'   => esc_html__( 'Nearby', EEM_TD ),
					'details' => esc_html__( 'Hotels: Select a post where you wrote about nearby hotels around your event location.', EEM_TD ),
					'type'    => 'select2',
					'args'    => 'POSTS_%post%',
				),

				array(
					'id'            => 'fdsfsd',
					'title'         => esc_html__( 'Event Description', EEM_TD ),
					'details'       => esc_html__( 'Write some details about this Event', EEM_TD ),
					'type'          => 'wp_editor',
					'field_options' => array(
						'media_buttons'    => false,
						'editor_height'    => '120px',
						'drag_drop_upload' => true,
					),
				),


				array(
					'id'      => 'gallery_test',
					'title'   => esc_html__( 'Gallery', EEM_TD ),
					'details' => esc_html__( 'Share some images to your users from this or past events', EEM_TD ),
					'type'    => 'gallery',
				),


			);

			ob_start();

			echo "<div class='pb-form'>";
			eem()->PB()->generate_fields( array( array( 'options' => $fields ) ), false, false );
			echo "</div>";

			return ob_get_clean();
		}


		public function display_user_profile( $atts, $content = null ) {

			ob_start();

			eem_get_template( 'user-profile.php' );

			return ob_get_clean();
		}



	}

	new EEM_Shortcodes();
}
