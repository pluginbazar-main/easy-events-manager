<?php
/**
 * EEM - Class Template Meta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


if ( ! class_exists( 'EEM_Template_meta' ) ) {
	class EEM_Template_meta {

		/**
		 * EEM_Post_meta constructor.
		 */
		function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			add_action( 'save_post', array( $this, 'save_event_meta' ) );
		}


		/**
		 * Save Event Meta Data from Meta Box
		 *
		 * @param $post_id
		 */
		function save_event_meta( $post_id ) {

			if ( ! isset( $_POST['template_nonce_val'] ) || ! wp_verify_nonce( $_POST['template_nonce_val'], 'template_nonce' ) ) {
				return;
			}

			$_sections = isset( $_POST['_sections'] ) ? stripslashes_deep( $_POST['_sections'] ) : array();

			update_post_meta( $post_id, '_sections', $_sections );
		}


		/**
		 * Display content for Event Meta Box
		 *
		 * @param $post
		 */
		function template_meta_box( $post ) {

			wp_nonce_field( 'template_nonce', 'template_nonce_val' );

			require_once( EEM_PLUGIN_DIR . 'includes/admin-templates/meta-box-template.php' );
		}


		/**
		 * Add Meta Boxes for Post type Event
		 *
		 * @param $post_type
		 */
		function add_meta_boxes( $post_type ) {

			if ( in_array( $post_type, array( 'event_template' ) ) ) {
				add_meta_box( 'template_meta_box', esc_html__( 'Template Data Box', EEM_TD ), array(
					$this,
					'template_meta_box'
				), $post_type, 'normal', 'high' );
			}
		}
	}

	new EEM_Template_meta();
}