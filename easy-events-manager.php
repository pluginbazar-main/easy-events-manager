<?php
/*
	Plugin Name: Easy Events Manager
	Plugin URI: https://wordpress.org/plugins/easy-events-manager/
	Description: Manage Events super Easily on WordPress
	Version: 1.0.0
	Language: language/
	Text Domain: easy-events-manager
	Author: Pluginbazar
	Author URI: https://pluginbazar.com/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

global $wpdb;

define( 'EEM_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'EEM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EEM_TEMPLATE_DIR', EEM_PLUGIN_DIR . 'templates/' );
define( 'EEM_PLUGIN_FILE', plugin_basename( __FILE__ ) );
define( 'EEM_TD', 'easy-events-manager' );

define( 'EEM_TABLE_ATTENDEES', $wpdb->prefix . 'eem_attendees' );


class EasyEventsManager {


	/**
	 * EasyEventsManager constructor.
	 */
	function __construct() {

		$this->define_scripts();
		$this->define_classes_functions();

		register_activation_hook( __FILE__, array( $this, 'activation' ) );

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}


	/**
	 * Load Plugin Textdomain
	 */
	function load_textdomain() {
		load_plugin_textdomain( 'eem-events-manager', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * On Activation Create the Custom Data Table
	 */
	public function activation() {

		global $wpdb;

		$sql = "CREATE TABLE IF NOT EXISTS " . EEM_TABLE_ATTENDEES . " (
			id int(100) NOT NULL AUTO_INCREMENT,
			email VARCHAR(255) NOT NULL,
			order_id int(100),
			event_id int(100),
			status VARCHAR(50),
			datetime DATETIME NOT NULL,
			UNIQUE KEY id (id)
		) {$wpdb->get_charset_collate()};";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}


	/**
	 * Define classes and functions
	 */
	function define_classes_functions() {

		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-pb-settings.php' );
//		$settings_path = str_replace( array( 'Pluginbazar/free/', 'Pluginbazar\free/' ), '', ABSPATH );
//		include $settings_path . "PB-Settings/class-pb-settings.php";

		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-page-templates.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-functions.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-item-data.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-hooks.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-event.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-meta-event.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-meta-template.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/classes/class-admin-attendees.php' );

		require_once( EEM_PLUGIN_DIR . 'includes/functions.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/template-hooks.php' );
		require_once( EEM_PLUGIN_DIR . 'includes/template-hook-functions.php' );
	}


	function localize_script() {
		return array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);
	}


	/**
	 * Load scripts on Front
	 */
	function load_front_scripts() {

		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'niceselect', plugins_url( '/assets/nice-select.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'magnific-popup-js', plugins_url( '/assets/front/js/jquery.magnific-popup.min.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'eem_front_js', plugins_url( '/assets/front/js/scripts.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script( 'eem_front_js', 'eem_object', $this->localize_script() );

		wp_enqueue_style( 'niceselect', EEM_PLUGIN_URL . 'assets/nice-select.css' );
		wp_enqueue_style( 'icofont', EEM_PLUGIN_URL . 'assets/fonts/icofont.min.css' );
		wp_enqueue_style( 'eem_tool_tip', EEM_PLUGIN_URL . 'assets/tool-tip.min.css' );
		wp_enqueue_style( 'magnific-popup', EEM_PLUGIN_URL . 'assets/front/css/magnific-popup.css' );
		wp_enqueue_style( 'pb-core-style', EEM_PLUGIN_URL . 'assets/front/css/pb-core-styles.css' );
		wp_enqueue_style( 'eem_common_style', EEM_PLUGIN_URL . 'assets/common-style.css' );
		wp_enqueue_style( 'eem_style', EEM_PLUGIN_URL . 'assets/front/css/style.css' );
	}


	/**
	 * Load scripts on Admin
	 */
	function load_admin_scripts() {

		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'eem_admin_js', plugins_url( '/assets/admin/js/scripts.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script( 'eem_admin_js', 'eem_object', $this->localize_script() );
		wp_enqueue_script( 'niceselect', plugins_url( '/assets/nice-select.min.js', __FILE__ ), array( 'jquery' ) );

		wp_enqueue_style( 'niceselect', EEM_PLUGIN_URL . 'assets/nice-select.css' );
		wp_enqueue_style( 'icofont', EEM_PLUGIN_URL . 'assets/fonts/icofont.min.css' );
		wp_enqueue_style( 'eem_tool_tip', EEM_PLUGIN_URL . 'assets/tool-tip.min.css' );
		wp_enqueue_style( 'eem_common_style', EEM_PLUGIN_URL . 'assets/common-style.css' );
		wp_enqueue_style( 'eem_admin_style', EEM_PLUGIN_URL . 'assets/admin/css/style.css' );
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