<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mukeshpanchal.com/
 * @since             1.0.0
 * @package           Landing_Page_For_Category_Tag
 *
 * @wordpress-plugin
 * Plugin Name:       Landing page for Category & Tag
 * Plugin URI:        https://mukeshpanchal.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mukesh Panchal
 * Author URI:        https://mukeshpanchal.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       landing-page-for-category-tag
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LANDING_PAGE_FOR_CATEGORY_TAG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-landing-page-for-category-tag-activator.php
 */
function activate_landing_page_for_category_tag() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-landing-page-for-category-tag-activator.php';
	Landing_Page_For_Category_Tag_Activator::activate();
	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-landing-page-for-category-tag-deactivator.php
 */
function deactivate_landing_page_for_category_tag() {
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-landing-page-for-category-tag-deactivator.php';
	Landing_Page_For_Category_Tag_Deactivator::deactivate();
		
}
if ( class_exists( 'WooCommerce' ) ) {
	register_activation_hook( __FILE__, 'activate_landing_page_for_category_tag' );
}else{
	echo "Plase activate to WooCommerce Plugin";
}
register_deactivation_hook( __FILE__, 'deactivate_landing_page_for_category_tag' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-landing-page-for-category-tag.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_landing_page_for_category_tag() {

	$plugin = new Landing_Page_For_Category_Tag();
	$plugin->run();

}
run_landing_page_for_category_tag();
