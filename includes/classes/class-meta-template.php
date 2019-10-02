<?php
/**
 * EEM - Class Template Meta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


if ( ! class_exists( 'EEM_Template_meta' ) ) {
	/**
	 * Class EEM_Template_meta
	 */
	class EEM_Template_meta {


		/**
		 * EEM_Post_meta constructor.
		 */
		function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			add_action( 'save_post', array( $this, 'save_event_meta' ) );

			add_action( 'manage_event_template_posts_columns', array( $this, 'add_columns' ), 16, 1 );
			add_action( 'manage_event_template_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );
			add_filter( 'post_row_actions', array( $this, 'remove_row_actions' ), 10, 1 );
		}

		/**
		 * Remove Post row actions
		 *
		 * @param $actions
		 *
		 * @return mixed
		 */
		public function remove_row_actions( $actions ) {
			global $post;

			if ( $post->post_type === 'event_template' ) {

				$actions['view'] = str_replace( 'Edit', 'View', $actions['edit'] );

				unset( $actions['inline hide-if-no-js'] );
				unset( $actions['edit'] );
			}

			return $actions;
		}


		/**
		 * Content of custom column
		 *
		 * @param $column
		 * @param $post_id
		 */
		function columns_content( $column, $post_id ) {

			if ( $column == 'sections' ) {
				$sections = sprintf( esc_html__( '%s out of %s sections are using', EEM_TD ),
					count( eem()->get_meta( '_sections', $post_id, array() ) ),
					count( eem()->get_template_sections() )
				);
				printf( '<i class="template-sections"><strong>%s</strong></i>', $sections );
			}

			if ( $column == 'usages' ) {

				$args  = array(
					'fields'     => 'ids',
					'meta_query' => array(
						array(
							'key'     => '_event_template',
							'value'   => $post_id,
							'compare' => '=',
						)
					),
				);
				$usage = sprintf( esc_html__( '%s events are using this template !', EEM_TD ), count( eem()->get_events( $args ) ) );

				printf( '<i class="template-usages"><strong>%s</strong></i>', $usage );
			}


			if ( $column == 'created' ) {
				printf( '<i class="template-created">%s</i>', sprintf( esc_html__( 'Created %s ago', EEM_TD ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ) );
			}
		}


		/**
		 * Add Custom column
		 *
		 * @param $columns
		 *
		 * @return array
		 */
		function add_columns( $columns ) {

			$columns['title']    = esc_html__( 'Template Name', EEM_TD );
			$columns['sections'] = esc_html__( 'Sections', EEM_TD );
			$columns['usages']   = esc_html__( 'Usages', EEM_TD );
			$columns['created']  = esc_html__( 'Created', EEM_TD );

			unset( $columns['date'] );

			return $columns;
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