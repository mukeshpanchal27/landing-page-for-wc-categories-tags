<?php

/**
 * Fired during plugin activation
 *
 * @link       https://mukeshpanchal.com/
 * @since      1.0.0
 *
 * @package    Landing_Page_For_Category_Tag
 * @subpackage Landing_Page_For_Category_Tag/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Landing_Page_For_Category_Tag
 * @subpackage Landing_Page_For_Category_Tag/includes
 * @author     Mukesh Panchal <mukeshpanchal27@gmail.com>
 */
class Landing_Page_For_Category_Tag_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( !class_exists( 'WooCommerce' ) ) {

			$message = sprintf( 
				esc_html__( 'Sorry, but this plugin requires the WooCommerce Parent Plugin to be installed and active. %1$s&raquo; Return to Plugins.%2$s', 'my-text-domain' ),
				'<a href="' . admin_url( 'plugins.php' ) . '">',
				'</a>'
			);
			
			wp_die( $message );
		}
	}

}
