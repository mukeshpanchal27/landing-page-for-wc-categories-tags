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
 * Plugin Name:       Advanced WooCommerce Landing page for Categories & Tags
 * Plugin URI:        https://mukeshpanchal.com/
 * Description:       A simple and smart companion that allows you to insert Rich text into any product categories and tags.
 * Version:           1.0.0
 * Author:            Mukesh Panchal
 * Author URI:        https://mukeshpanchal.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-landing-page-for-category-tag
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WC_LANDING_PAGE_FOR_CATEGORY_TAG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-landing-page-for-category-tag-activator.php
 */
function wc_lp_categories_tags_activate_callback() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-landing-page-for-category-tag-activator.php';
	WC_Landing_Page_For_Category_Tag_Activator::activate();
}

register_activation_hook( __FILE__, 'wc_lp_categories_tags_activate_callback' );
register_deactivation_hook( __FILE__, 'wc_lp_categories_tags_deactivate_callback' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-landing-page-for-category-tag.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_landing_page_for_category_tag() {

	$plugin = new WC_Landing_Page_For_Category_Tag();
	$plugin->run();

}
run_wc_landing_page_for_category_tag();
