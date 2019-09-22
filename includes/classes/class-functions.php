<?php
/**
 * EEM - Class - Functions
 *
 * @see EEM_Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


if ( ! class_exists( 'EEM_Functions' ) ) {
	class EEM_Functions {


		/**
		 * EEM_Functions constructor.
		 */
		function __construct() {

		}


		/**
		 * Return events in multiple ways
		 *
		 * @param array $args
		 * @param string $return
		 *
		 * @return bool|int[]|WP_Post[]|WP_Query
		 */
		function get_events( $args = array(), $return = 'array' ) {

			$defaults = array(
				'post_type'      => 'event',
				'posts_per_page' => - 1,
			);

			$args = wp_parse_args( $args, $defaults );

			if ( $return == 'array' ) {
				return get_posts( $args );
			}

			if ( $return == 'object' ) {
				return new WP_Query( $args );
			}

			return false;
		}


		function get_event_archive_item_parts() {

			return apply_filters( 'eem_filters_event_archive_item_parts', array(
				'thumb'    => esc_html__( 'Thumbnail', EEM_TD ),
				'title'    => esc_html__( 'Event Title', EEM_TD ),
				'date'     => esc_html__( 'Published Date', EEM_TD ),
				'location' => esc_html__( 'Location', EEM_TD ),
				'excerpt'  => esc_html__( 'Excerpt', EEM_TD ),
				'button'   => esc_html__( 'View details button', EEM_TD ),
			) );
		}

		function get_settings() {

			$pages['archive'] = apply_filters( 'eem_filters_event_settings_page_archive', array(

				'page_nav'      => sprintf( '<i class="icofont-tasks-alt"></i> %s', esc_html__( 'Archive', EEM_TD ) ),
				'page_settings' => array(

					array(
						'title'   => esc_html__( 'Event archive options', EEM_TD ),
						'options' => array(
							array(
								'id'          => 'eem_archive_slug',
								'title'       => esc_html__( 'Archive slug', EEM_TD ),
								'details'     => esc_html__( 'Set archive slug for events. After changing slug you must reset the permalink from WP Settings > Permalink', EEM_TD ),
								'type'        => 'text',
								'placeholder' => esc_html__( 'events', EEM_TD ),
							),
							array(
								'id'          => 'eem_archive_items',
								'title'       => esc_html__( 'Events per Page', EEM_TD ),
								'details'     => esc_html__( 'How many events you want to show on each page.', EEM_TD ),
								'type'        => 'number',
								'placeholder' => '6',
							),
							array(
								'id'          => 'eem_archive_items_per_row',
								'title'       => esc_html__( 'Items per Row', EEM_TD ),
								'details'     => esc_html__( 'How many events you want to display on each row.', EEM_TD ),
								'type'        => 'number',
								'placeholder' => '3',
							),
							array(
								'id'      => 'eem_archive_hide_item_parts',
								'title'   => esc_html__( 'Hide item parts', EEM_TD ),
								'details' => esc_html__( 'Select the parts you want to hide for each event item.', EEM_TD ),
								'type'    => 'checkbox',
								'args'    => $this->get_event_archive_item_parts(),
							),
						)
					),
				),
			) );

			return apply_filters( 'eem_filters_event_settings', $pages );
		}


		function get_user_event( $user_id = false, $args = array() ) {

			$user_id = ! $user_id || empty( $user_id ) || $user_id == 0 ? get_current_user_id() : $user_id;

			$args['post_type'] = 'event';
			$args['author']    = $user_id;

			if ( ! isset( $args['posts_per_page'] ) ) {
				$args['posts_per_page'] = - 1;
			}

			$events = get_posts( $args );

			return apply_filters( 'eem_filters_user_events', $events, $args );
		}

		function get_nearby_facts() {

			$nearby_facts = array(
				'hotels'     => array(
					'label' => esc_html__( 'Nearby Hotels', EEM_TD ),
					'icon'  => '<i class="icofont-hotel"></i>',
				),
				'transports' => array(
					'label' => esc_html__( 'Transport Services', EEM_TD ),
					'icon'  => '<i class="icofont-airplane-alt"></i>',
				),
				'places'     => array(
					'label' => esc_html__( 'Historical Places', EEM_TD ),
					'icon'  => '<i class="icofont-location-pin"></i>',
				),
			);

			return apply_filters( 'eem_filters_nearby_facts', $nearby_facts );
		}

		function get_sponsor_types() {

			$types = array(
				'platinum' => esc_html__( 'Platinum package', EEM_TD ),
				'gold'     => esc_html__( 'Gold package', EEM_TD ),
				'silver'   => esc_html__( 'Silver package', EEM_TD ),
				'bronze'   => esc_html__( 'Bronze package', EEM_TD ),
			);

			return apply_filters( 'eem_filters_sponsor_types', $types );
		}


		/**
		 * Return array of custom endpoints
		 *
		 * @return mixed|void
		 */
		function get_custom_endpoints() {
			return apply_filters( 'eem_filters_endpoints', array(
				'tickets',
				'sponsors',
				'speakers',
				'schedules',
				'register',
				'attendees',
				'gallery',
				'news',
				'profile',
			) );
		}


		/**
		 * Return template sections
		 *
		 * @return mixed|void
		 */
		function get_template_sections() {

			$common_fields = array(
				array(
					'id'      => "heading",
					'title'   => esc_html__( 'Heading', EEM_TD ),
					'details' => esc_html__( 'Set section heading', EEM_TD ),
					'type'    => 'text',
				),
				array(
					'id'      => "sub_heading",
					'title'   => esc_html__( 'Sub heading', EEM_TD ),
					'details' => esc_html__( 'Set section sub heading', EEM_TD ),
					'type'    => 'text',
				),
				array(
					'id'      => "short_desc",
					'title'   => esc_html__( 'Short Description', EEM_TD ),
					'details' => esc_html__( 'Set short description for this section', EEM_TD ),
					'type'    => 'textarea',
					'rows'    => 2,
				),
				array(
					'id'   => 'box_layout',
					'type' => 'checkbox',
					'args' => array(
						'yes' => esc_html__( 'Make this section box layout', EEM_TD ),
					),
				),
			);

			$sections = array(
				'banner'    => array(
					'label'    => esc_html__( 'Banner', EEM_TD ),
					'priority' => 10,
					'fields'   => array(
						array(
							'id'      => "bg_image",
							'title'   => esc_html__( 'Background Image', EEM_TD ),
							'details' => esc_html__( 'Set background image for this section', EEM_TD ),
							'type'    => 'media',
						),
						array(
							'id'   => "button",
							'type' => 'checkbox',
							'args' => array(
								'yes' => esc_html__( 'Disable ticket button', EEM_TD ),
							),
						),
						array(
							'id'   => 'box_layout',
							'type' => 'checkbox',
							'args' => array(
								'yes' => esc_html__( 'Make this section box layout', EEM_TD ),
							),
						),
					),
				),
				'speakers'  => array(
					'label'    => esc_html__( 'Speakers', EEM_TD ),
					'priority' => 15,
					'fields'   => array_merge( $common_fields, array(
						array(
							'id'      => "count",
							'title'   => esc_html__( 'Speaker count', EEM_TD ),
							'details' => esc_html__( 'How many speakers you want to display in this section. Default: 4', EEM_TD ),
							'type'    => 'number',
						),
						array(
							'id'   => "button",
							'type' => 'checkbox',
							'args' => array(
								'yes' => esc_html__( 'Disable all speakers button', EEM_TD ),
							),
						),
					) ),
				),
				'schedules' => array(
					'label'    => esc_html__( 'Schedules', EEM_TD ),
					'priority' => 20,
					'fields'   => $common_fields,
				),
				'tickets'   => array(
					'label'    => esc_html__( 'Pricing', EEM_TD ),
					'priority' => 25,
					'fields'   => $common_fields,
				),
				'register'  => array(
					'label'    => esc_html__( 'Register', EEM_TD ),
					'priority' => 30,
					'fields'   => array_merge( $common_fields, array(
						array(
							'id'   => "button",
							'type' => 'checkbox',
							'args' => array(
								'yes' => esc_html__( 'Disable volunteer join button', EEM_TD ),
							),
						),
						array(
							'id'      => "button_url",
							'title'   => esc_html__( 'Button URL', EEM_TD ),
							'details' => esc_html__( 'Where the users will redirect with this volunteer join button', EEM_TD ),
							'type'    => 'text',
						),
					) ),
				),
				'attendees' => array(
					'label'    => esc_html__( 'Attendees', EEM_TD ),
					'priority' => 35,
					'fields'   => array_merge( $common_fields, array(
						array(
							'id'      => "count",
							'title'   => esc_html__( 'Attendees count', EEM_TD ),
							'details' => esc_html__( 'How many attendees you want to display in this section. Default: 8', EEM_TD ),
							'type'    => 'number',
						),
						array(
							'id'   => "button",
							'type' => 'checkbox',
							'args' => array(
								'yes' => esc_html__( 'Disable all attendees button', EEM_TD ),
							),
						),
					) ),
				),
				'cta'       => array(
					'label'    => esc_html__( 'Call to Action', EEM_TD ),
					'priority' => 40,
					'fields'   => array_merge( $common_fields, array(
						array(
							'id'      => "button_text",
							'title'   => esc_html__( 'Button', EEM_TD ),
							'details' => esc_html__( 'Button Text: Write the button text.', EEM_TD ),
							'type'    => 'text',
						),
						array(
							'id'      => "button_url",
							'details' => esc_html__( 'Button URL: Where the users will redirect with this button', EEM_TD ),
							'type'    => 'text',
						),
					) ),
				),
				'sponsors'  => array(
					'label'    => esc_html__( 'Sponsors', EEM_TD ),
					'priority' => 45,
					'fields'   => $common_fields
				),
				'gallery'   => array(
					'label'    => esc_html__( 'Gallery', EEM_TD ),
					'priority' => 50,
					'fields'   => array_merge( $common_fields, array(
						array(
							'id'      => "count",
							'title'   => esc_html__( 'Photos count', EEM_TD ),
							'details' => esc_html__( 'How many photos you want to display in this section. Default: 8', EEM_TD ),
							'type'    => 'number',
						),
						array(
							'id'   => "button",
							'type' => 'checkbox',
							'args' => array(
								'yes' => esc_html__( 'Disable all photos button', EEM_TD ),
							),
						),
					) ),
				),
				'nearby'    => array(
					'label'    => esc_html__( 'Exploring Nearby', EEM_TD ),
					'priority' => 55,
					'fields'   => $common_fields
				),
				'news'      => array(
					'label'    => esc_html__( 'News/Blog', EEM_TD ),
					'priority' => 60,
					'fields'   => array_merge( $common_fields, array(
						array(
							'id'      => "count",
							'title'   => esc_html__( 'Posts count', EEM_TD ),
							'details' => esc_html__( 'How many posts you want to display in this section. Default: 8', EEM_TD ),
							'type'    => 'number',
						),
						array(
							'id'   => "button",
							'type' => 'checkbox',
							'args' => array(
								'yes' => esc_html__( 'Disable all posts button', EEM_TD ),
							),
						),
					) ),
				),
			);

			return apply_filters( 'eem_filters_eem_template_sections', $sections );
		}


		function get_archive_search_fields() {

			$search_fields = array(
				array(
					'id'          => 'sf_keyword',
					'title'       => esc_html__( 'Keyword', EEM_TD ),
					'placeholder' => esc_html__( 'technology', EEM_TD ),
					'type'        => 'text',
				),
				array(
					'id'          => 'sf_location',
					'title'       => esc_html__( 'Location', EEM_TD ),
					'placeholder' => esc_html__( 'Dhaka, Bangladesh', EEM_TD ),
					'type'        => 'text',
				),
				array(
					'id'    => 'sf_category',
					'title' => esc_html__( 'Category', EEM_TD ),
					'type'  => 'select',
					'args'  => 'TAX_%event_cat%',
				),
				array(
					'id'          => 'sf_date',
					'title'       => esc_html__( 'Date', EEM_TD ),
					'placeholder' => esc_html__( 'Select Date', EEM_TD ),
					'type'        => 'datepicker',
					'class'       => 'advanced-field',
				),
				array(
					'id'    => 'sf_status',
					'title' => esc_html__( 'Status', EEM_TD ),
					'type'  => 'select',
					'args'  => array(
						'upcoming'  => esc_html__( 'Upcoming', EEM_TD ),
						'completed' => esc_html__( 'Completed', EEM_TD ),
					),
					'class' => 'advanced-field',
				),
				array(
					'id'    => 'sf_pricing',
					'title' => esc_html__( 'Pricing', EEM_TD ),
					'type'  => 'select',
					'args'  => array(
						'free'    => esc_html__( 'Free', EEM_TD ),
						'premium' => esc_html__( 'Premium', EEM_TD ),
					),
					'class' => 'advanced-field',
				),
			);

			return apply_filters( 'eem_filters_archive_search_fields', $search_fields );
		}


		function get_social_profile_platforms() {

			$profile_platforms = array(
				'facebook'  => array(
					'label' => esc_html( 'Facebook' ),
					'icon'  => '<i class="icofont-facebook"></i>',
				),
				'twitter'   => array(
					'label' => esc_html( 'Twitter' ),
					'icon'  => '<i class="icofont-twitter"></i>',
				),
				'linkedin'  => array(
					'label' => esc_html( 'Linkedin' ),
					'icon'  => '<i class="icofont-linkedin"></i>',
				),
				'instagram' => array(
					'label' => esc_html( 'Instagram' ),
					'icon'  => '<i class="icofont-instagram"></i>',
				),
				'pinterest' => array(
					'label' => esc_html( 'Pinterest' ),
					'icon'  => '<i class="icofont-pinterest"></i>',
				),
			);

			return apply_filters( 'eem_filters_social_profiles_platforms', $profile_platforms );
		}


		function PB( $args = array() ) {
			return new PB_Settings( $args );
		}


		/**
		 * Return Post Meta Value
		 *
		 * @param bool $meta_key
		 * @param bool $post_id
		 * @param string $default
		 *
		 * @return mixed|string|void
		 */
		function get_meta( $meta_key = false, $post_id = false, $default = '' ) {

			if ( ! $meta_key ) {
				return '';
			}

			$post_id    = ! $post_id ? get_the_ID() : $post_id;
			$meta_value = get_post_meta( $post_id, $meta_key, true );
			$meta_value = empty( $meta_value ) ? $default : $meta_value;

			return apply_filters( 'eem_filters_get_meta', $meta_value, $meta_key, $post_id, $default );
		}


		/**
		 * Return option value
		 *
		 * @param string $option_key
		 * @param string $default_val
		 *
		 * @return mixed|string|void
		 */
		function get_option( $option_key = '', $default_val = '' ) {

			if ( empty( $option_key ) ) {
				return '';
			}

			$option_val = get_option( $option_key, $default_val );
			$option_val = empty( $option_val ) ? $default_val : $option_val;

			return apply_filters( 'wpp_filters_option_' . $option_key, $option_val );
		}


		function get_meta_fields_data( $meta_data = array(), $args = array() ) {

			$_options   = array();
			$id_prefix  = isset( $args['id_prefix'] ) ? $args['id_prefix'] : '';
			$meta_data  = empty( $meta_data ) ? $this->get_meta_data() : $meta_data;
			$fill_value = isset( $args['fill_value'] ) ? $args['fill_value'] : 'no';
			$fill_from  = isset( $args['fill_from'] ) ? $args['fill_from'] : 'post';

			if ( ! empty( $fill_value ) && ! empty( $fill_from ) ) {
				$posted_data = $fill_from == 'get' ? $_GET : $_POST;
			}

			foreach ( $meta_data as $meta__group ) {

				$fields    = isset( $meta__group['fields'] ) ? $meta__group['fields'] : array();
				$__options = array();

				foreach ( $fields as $field ) {

					$field_title         = isset( $field['meta_key'] ) ? explode( '_', $field['meta_key'] ) : array();
					$field_title         = ucwords( implode( ' ', $field_title ) );
					$meta_type_data      = isset( $field['meta_type_data'] ) ? $field['meta_type_data'] : '';
					$meta_type_data_arr  = empty( $meta_type_data ) ? array() : explode( '|', $meta_type_data );
					$meta_type_data_args = array();

					foreach ( $meta_type_data_arr as $type_arg ) {
						$meta_type_data_args[ sanitize_title( $type_arg ) ] = $type_arg;
					}

					$meta_key = isset( $field['meta_key'] ) ? $field['meta_key'] : '';

					if ( empty( $id_prefix ) ) {
						$meta_value = isset( $posted_data[ $meta_key ] ) ? $posted_data[ $meta_key ] : '';
					} else {
						$meta_value = isset( $posted_data[ $id_prefix ][ $meta_key ] ) ? $posted_data[ $id_prefix ][ $meta_key ] : '';
					}

					$meta_key = empty( $id_prefix ) ? $meta_key : sprintf( '%s[%s]', $id_prefix, $meta_key );

					$__options[] = array(
						'id'    => $meta_key,
						'title' => $field_title,
						'type'  => isset( $field['meta_field_type'] ) ? $field['meta_field_type'] : '',
						'args'  => $meta_type_data_args,
						'value' => $meta_value,
					);
				}

				$_options[] = array(
					'title'   => isset( $meta__group['group_name'] ) ? $meta__group['group_name'] : '',
					'options' => $__options,
				);
			}

			return $_options;
		}
	}
}

global $eem;

$eem = new EEM_Functions();