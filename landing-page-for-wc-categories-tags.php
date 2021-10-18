<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * Plugin Name:       Landing page for WC Categories & Tags
 * Description:       This plugin allows you to add extra Rich text to product categories and tags page.
 * Version:           1.0.1
 * Author:            Mukesh Panchal
 * Author URI:        https://mukeshpanchal.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       landing-page-for-wc-categories-tags
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'LANDING_PAGE_FOR_WC_CATEGORIES_TAGS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-landing-page-for-wc-categories-tags-activator.php
 */
function wc_lp_categories_tags_activate_callback() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-landing-page-for-wc-categories-tags-activator.php';
	WC_Landing_Page_For_Category_Tag_Activator::activate();
}

register_activation_hook( __FILE__, 'wc_lp_categories_tags_activate_callback' );
register_deactivation_hook( __FILE__, 'wc_lp_categories_tags_deactivate_callback' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-landing-page-for-wc-categories-tags.php';

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
