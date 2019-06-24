<?php
/*
	Plugin Name: Easy Events Manager
	Plugin URI: https://wordpress.org/plugins/easy-events-manager/
	Description: Manage Events super Easily on WordPress
	Version: 1.0.0
	Author: Pluginbazar
	Author URI: https://pluginbazar.com/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access


class EasyEventsManager {


	function __construct() {

		$this->define_constants();
		$this->define_scripts();
	}


	/**
	 * Load scripts on
	 */
	function load_admin_scripts() {

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'woc_admin_js', plugins_url( '/assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ) );
		wp_localize_script( 'woc_admin_js', 'woc_ajax', array( 'woc_ajaxurl' => admin_url( 'admin-ajax.php')) );

		wp_enqueue_style('woc_admin_style', WOC_PLUGIN_URL . 'assets/admin/css/style.css');
		wp_enqueue_style('icofont', WOC_PLUGIN_URL . 'assets/fonts/icofont.min.css');
		wp_enqueue_style('hint.min', WOC_PLUGIN_URL . 'assets/hint.min.css');
		wp_enqueue_style('jquery.timepicker', WOC_PLUGIN_URL . 'assets/jquery-timepicker.css');
	}


	/**
	 * Define Scripts for frontend and backend
	 */
	function define_scripts() {

		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
	}


	/**
	 * Check and define values by keys
	 *
	 * @param bool $key
	 * @param bool $value
	 */
	private function define( $key = false, $value = false ) {

		if( ! defined( $key ) && $key && $value ) {
			define( $key, $value );
		}
	}

	/**
	 * Define All Constants here
	 */
	function define_constants() {

		self::define('EEM_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
		self::define('EEM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		self::define('EEM_PLUGIN_FILE', plugin_basename( __FILE__ ) );
	}
}
new EasyEventsManager();