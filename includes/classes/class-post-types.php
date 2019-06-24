<?php
/**
 * EEM - Class - Post Types
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

if ( ! class_exists( 'EEM_Post_types' ) ) {
	class EEM_Post_types {

		/**
		 * EEM_Post_types constructor.
		 */
		function __construct() {

			add_action( 'init', array( $this, 'add_post_types' ) );
		}


		/**
		 * Ad Post types
		 */
		function add_post_types() {

			/**
			 * Register Post Type Event
			 */
			$this->register_post_type( 'event', array(
				'singular'      => esc_html__( 'Event', EEM_TD ),
				'plural'        => esc_html__( 'All Events', EEM_TD ),
				'menu_icon'     => 'dashicons-nametag',
				'menu_position' => 15,
				'supports'      => array( 'title', 'thumbnail' ),
			) );

			do_action( 'eem_register_post_types', $this );
		}


		/**
		 * Register Post Types
		 *
		 * @param $post_type
		 * @param $args
		 */
		 function register_post_type( $post_type, $args ) {

			if ( post_type_exists( $post_type ) ) {
				return;
			}

			$singular = isset( $args['singular'] ) ? $args['singular'] : '';
			$plural   = isset( $args['plural'] ) ? $args['plural'] : '';

			$args = array_merge( array(
				'labels'              => array(
					'name'               => sprintf( __( '%s', EEM_TD ), $plural ),
					'singular_name'      => $singular,
					'menu_name'          => __( $singular, EEM_TD ),
					'all_items'          => sprintf( __( '%s', EEM_TD ), $plural ),
					'add_new'            => sprintf( __( 'Add %s', EEM_TD ), $singular ),
					'add_new_item'       => sprintf( __( 'Add %s', EEM_TD ), $singular ),
					'edit'               => __( 'Edit', EEM_TD ),
					'edit_item'          => sprintf( __( 'Edit %s', EEM_TD ), $singular ),
					'new_item'           => sprintf( __( 'New %s', EEM_TD ), $singular ),
					'view'               => sprintf( __( 'View %s', EEM_TD ), $singular ),
					'view_item'          => sprintf( __( 'View %s', EEM_TD ), $singular ),
					'search_items'       => sprintf( __( 'Search %s', EEM_TD ), $plural ),
					'not_found'          => sprintf( __( 'No %s found', EEM_TD ), $plural ),
					'not_found_in_trash' => sprintf( __( 'No %s found in trash', EEM_TD ), $plural ),
					'parent'             => sprintf( __( 'Parent %s', EEM_TD ), $singular )
				),
				'description'         => sprintf( __( 'This is where you can create and manage %s.', EEM_TD ), $plural ),
				'public'              => true,
				'show_ui'             => true,
				'capability_type'     => 'post',
				'map_meta_cap'        => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'hierarchical'        => false,
				'rewrite'             => true,
				'query_var'           => true,
				'supports'            => array( 'title', 'thumbnail', 'editor', 'author' ),
				'show_in_nav_menus'   => true,
				'show_in_menu'        => true,
				'menu_icon'           => '',
			), $args );

			register_post_type( $post_type, apply_filters( "register_post_type_$post_type", $args ) );
		}


		/**
		 * Register Taxonomy
		 *
		 * @param $tax_name
		 * @param $obj_name
		 * @param array $args
		 */
		 function register_taxonomy( $tax_name, $obj_name, $args = array() ) {

			if ( taxonomy_exists( $tax_name ) ) {
				return;
			}

			$singular     = isset( $args['singular'] ) ? $args['singular'] : __( 'Singular', EEM_TD );
			$plural       = isset( $args['plural'] ) ? $args['plural'] : __( 'Plural', EEM_TD );
			$hierarchical = isset( $args['hierarchical'] ) ? $args['hierarchical'] : true;

			register_taxonomy( $tax_name, $obj_name,
				apply_filters( "register_taxonomy_" . $tax_name, array(
					'labels'              => array(
						'name'               => sprintf( __( '%s', EEM_TD ), $plural ),
						'singular_name'      => $singular,
						'menu_name'          => __( $singular, EEM_TD ),
						'all_items'          => sprintf( __( '%s', EEM_TD ), $plural ),
						'add_new'            => sprintf( __( 'Add %s', EEM_TD ), $singular ),
						'add_new_item'       => sprintf( __( 'Add %s', EEM_TD ), $singular ),
						'edit'               => __( 'Edit', EEM_TD ),
						'edit_item'          => sprintf( __( '%s Details', EEM_TD ), $singular ),
						'new_item'           => sprintf( __( 'New %s', EEM_TD ), $singular ),
						'view'               => sprintf( __( 'View %s', EEM_TD ), $singular ),
						'view_item'          => sprintf( __( 'View %s', EEM_TD ), $singular ),
						'search_items'       => sprintf( __( 'Search %s', EEM_TD ), $plural ),
						'not_found'          => sprintf( __( 'No %s found', EEM_TD ), $plural ),
						'not_found_in_trash' => sprintf( __( 'No %s found in trash', EEM_TD ), $plural ),
						'parent'             => sprintf( __( 'Parent %s', EEM_TD ), $singular )
					),
					'description'         => sprintf( __( 'This is where you can create and manage %s.', EEM_TD ), $plural ),
					'public'              => true,
					'show_ui'             => true,
					'capability_type'     => 'post',
					'map_meta_cap'        => true,
					'publicly_queryable'  => true,
					'exclude_from_search' => false,
					'hierarchical'        => $hierarchical,
					'rewrite'             => true,
					'query_var'           => true,
					'show_in_nav_menus'   => true,
					'show_in_menu'        => true,
				) )
			);
		}
	}

	new EEM_Post_types();
}