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
		}


		public function display_user_profile( $atts, $content = null ) {

			ob_start();

			eem_get_template( 'user-profile.php' );

			return ob_get_clean();
		}



	}

	new EEM_Shortcodes();
}