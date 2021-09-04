<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mukeshpanchal.com/
 * @since      1.0.0
 *
 * @package    Landing_Page_For_Category_Tag
 * @subpackage Landing_Page_For_Category_Tag/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Landing_Page_For_Category_Tag
 * @subpackage Landing_Page_For_Category_Tag/admin
 * @author     Mukesh Panchal <mukeshpanchal27@gmail.com>
 */
class Landing_Page_For_Category_Tag_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/landing-page-for-category-tag-admin.css', array(), $this->version, 'all' );
	}

	public function landing_page_for_category_tag_option_register() {
		register_setting( 'landing_page_for_category_tag_settings', 'landing_page_for_category_tag_option' ) ;
		
		require_once plugin_dir_path( __FILE__ ).'partials/class-landing-page-for-category-tag-description.php';		
		require_once plugin_dir_path( __FILE__ ).'partials/class-landing-page-for-category-tag-category-description.php';
	
		$category_description = new category_description();
		$tagclass = new tag_description();
	}

	/**
	 * Register plugin config page.
	 *
	 * @since    1.0.0
	 */
	public function wc_lp_categories_tags_admin_menu_page() {
		add_menu_page( 
			__( 'WooCommerce Landing Page for Categories and Tags Settings', 'Landing_Page_For_Category_Tag' ),
			__( 'WC Landing Page for Categories and Tags', 'Landing_Page_For_Category_Tag' ),
			'manage_options',
			'wc_lp_categories_tags',
			array( $this, 'wc_lp_categories_tags_callback' )
		); 
	}

	public function wc_lp_categories_tags_callback() { ?>
		<div class="wrap wc-lp-wrapper">
			<h1><?php _e( 'WooCommerce Landing Page for Categories and Tags Settings', 'Landing_Page_For_Category_Tag' ); ?></h1>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'landing_page_for_category_tag_settings' );
					$landing_page_for_category_tag_option = get_option( 'landing_page_for_category_tag_option' );
				?>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<td colspan="2"><h2><?php _e( 'Product Categories', 'Landing_Page_For_Category_Tag' ); ?></h2></td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_top_categories" name="landing_page_for_category_tag_option[wc_lp_top_categories]" value="1"<?php echo ( isset( $landing_page_for_category_tag_option['wc_lp_top_categories'] ) && ( 1 == $landing_page_for_category_tag_option['wc_lp_top_categories'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_top_categories" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_top_categories" class="wc_ld_label"><?php _e( 'Top Description', 'Landing_Page_For_Category_Tag' ); ?></label>
							</td>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_bottom_categories" name="landing_page_for_category_tag_option[wc_lp_bottom_categories]" value="1"<?php echo ( isset( $landing_page_for_category_tag_option['wc_lp_bottom_categories'] ) && ( 1 == $landing_page_for_category_tag_option['wc_lp_bottom_categories'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_bottom_categories" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_bottom_categories" class="wc_ld_label"><?php _e( 'Bottom Description', 'Landing_Page_For_Category_Tag' ); ?></label>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<td colspan="2"><h2><?php _e( 'Product Tags', 'Landing_Page_For_Category_Tag' ); ?></h2></td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_top_tags" name="landing_page_for_category_tag_option[wc_lp_top_tags]" value="1"<?php echo ( isset( $landing_page_for_category_tag_option['wc_lp_top_tags'] ) && ( 1 == $landing_page_for_category_tag_option['wc_lp_top_tags'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_top_tags" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_top_tags" class="wc_ld_label"><?php _e( 'Top Description', 'Landing_Page_For_Category_Tag' ); ?></label>
							</td>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_bottom_tags" name="landing_page_for_category_tag_option[wc_lp_bottom_tags]" value="1"<?php echo ( isset( $landing_page_for_category_tag_option['wc_lp_bottom_tags'] ) && ( 1 == $landing_page_for_category_tag_option['wc_lp_bottom_tags'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_bottom_tags" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_bottom_tags" class="wc_ld_label"><?php _e( 'Bottom Description', 'Landing_Page_For_Category_Tag' ); ?></label>
							</td>
						</tr>
					</tbody>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php	
	}

}
