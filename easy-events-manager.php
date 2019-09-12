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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

define( 'EEM_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'EEM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EEM_PLUGIN_FILE', plugin_basename( __FILE__ ) );
define( 'EEM_TD', 'easy-events-manager' );


class EasyEventsManager {


	/**
	 * EasyEventsManager constructor.
	 */
	function __construct() {

		$this->define_scripts();
		$this->define_classes_functions();

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}


	/**
	 * Load Plugin Textdomain
	 */
	function load_textdomain() {
		load_plugin_textdomain( 'eem-events-manager', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
	}


	/**
	 * Define classes and functions
	 */
	function define_classes_functions() {

		//		require_once( WPP_PLUGIN_DIR . 'includes/classes/class-pb-settings.php' );
		$settings_path = str_replace( array( 'Pluginbazar/free/', 'Pluginbazar\free/' ), '', ABSPATH );
		include $settings_path . "PB-Settings/class-pb-settings.php";

		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-functions.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-item-data.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-hooks.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-event.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-event-meta.php' );

		require_once( EEM_PLUGIN_DIR . 'includes/functions.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/template-hooks.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/template-hook-functions.php' );
	}


	/**
	 * Load scripts on Front
	 */
	function load_front_scripts() {

		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'niceselect', plugins_url( '/assets/nice-select.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'magnific-popup-js', plugins_url( '/assets/front/js/jquery.magnific-popup.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'eem_front_js', plugins_url( '/assets/front/js/scripts.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script( 'eem_front_js', 'eem_object', array( 'woc_ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		wp_enqueue_style( 'niceselect', EEM_PLUGIN_URL . 'assets/nice-select.css' );
		wp_enqueue_style( 'icofont', EEM_PLUGIN_URL . 'assets/fonts/icofont.min.css' );
		wp_enqueue_style( 'eem_tool_tip', EEM_PLUGIN_URL . 'assets/tool-tip.min.css' );
		wp_enqueue_style( 'magnific-popup', EEM_PLUGIN_URL . 'assets/front/css/magnific-popup.css' );
		wp_enqueue_style( 'pb-core-style', EEM_PLUGIN_URL . 'assets/front/css/pb-core-styles.css' );
		wp_enqueue_style( 'eem_style', EEM_PLUGIN_URL . 'assets/front/css/style.css' );
	}


	/**
	 * Load scripts on Admin
	 */
	function load_admin_scripts() {

		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'eem_admin_js', plugins_url( '/assets/admin/js/scripts.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script( 'eem_admin_js', 'eem_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script( 'niceselect', plugins_url( '/assets/nice-select.min.js', __FILE__ ), array( 'jquery' ) );

		wp_enqueue_style( 'niceselect', EEM_PLUGIN_URL . 'assets/nice-select.css' );
		wp_enqueue_style( 'icofont', EEM_PLUGIN_URL . 'assets/fonts/icofont.min.css' );
		wp_enqueue_style( 'eem_tool_tip', EEM_PLUGIN_URL . 'assets/tool-tip.min.css' );
		wp_enqueue_style( 'eem_admin_style', EEM_PLUGIN_URL . 'assets/admin/css/style.css', false, time() );
	}


	/**
	 * Define Scripts for frontend and backend
	 */
	function define_scripts() {

		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_front_scripts' ) );
	}
}

new EasyEventsManager();