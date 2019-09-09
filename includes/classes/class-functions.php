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


		function get_social_profile_platforms() {

			$profile_platforms = array(
				'facebook' => array(
					'label' => esc_html( 'Facebook' ),
					'icon'  => '<i class="icofont-facebook"></i>',
				),
				'twitter' => array(
					'label' => esc_html( 'Twitter' ),
					'icon'  => '<i class="icofont-twitter"></i>',
				),
				'linkedin' => array(
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


		function PB() {
			return new PB_Settings();
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