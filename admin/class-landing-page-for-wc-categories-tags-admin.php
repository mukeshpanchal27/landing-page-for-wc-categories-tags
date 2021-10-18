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
class WC_Landing_Page_For_Category_Tag_Admin {

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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/landing-page-for-wc-categories-tags-admin.css', array(), $this->version, 'all' );
	}

	public function wc_lp_categories_tags_option_register() {
		register_setting( 'wc_landing_page_for_category_tag_settings', 'wc_landing_page_for_category_tag_option' ) ;
		
		require_once plugin_dir_path( __FILE__ ).'partials/class-landing-page-for-wc-categories-description.php';		
		require_once plugin_dir_path( __FILE__ ).'partials/class-landing-page-for-wc-tags-description.php';
	
		$WC_Landing_Page_For_Category_Description = new WC_Landing_Page_For_Category_Description();
		$WC_Landing_Page_For_Tag_Description = new WC_Landing_Page_For_Tag_Description();
	}

	/**
	 * Register plugin config page.
	 *
	 * @since    1.0.0
	 */
	public function wc_lp_categories_tags_admin_menu_page() {
		add_menu_page( 
			__( 'Landing Page for WooCommerce Categories &amp; Tags Settings', 'landing-page-for-wc-categories-tags' ),
			__( 'Landing Page for WC Categories &amp; Tags', 'landing-page-for-wc-categories-tags' ),
			'manage_options',
			'wc_lp_categories_tags',
			array( $this, 'wc_lp_categories_tags_callback' ),
			'dashicons-edit-page'
		); 
	}

	public function wc_lp_categories_tags_callback() { ?>
		<div class="wrap wc-lp-wrapper">
			<h1><?php _e( 'Landing Page for WooCommerce Categories &amp; Tags Settings', 'landing-page-for-wc-categories-tags' ); ?></h1>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'wc_landing_page_for_category_tag_settings' );
					$wc_landing_page_for_category_tag_option = get_option( 'wc_landing_page_for_category_tag_option' );
				?>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<td colspan="2"><h2><?php _e( 'Product Categories', 'landing-page-for-wc-categories-tags' ); ?></h2></td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_top_categories" name="wc_landing_page_for_category_tag_option[wc_lp_top_categories]" value="1"<?php echo ( isset( $wc_landing_page_for_category_tag_option['wc_lp_top_categories'] ) && ( 1 == $wc_landing_page_for_category_tag_option['wc_lp_top_categories'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_top_categories" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_top_categories" class="wc_ld_label"><?php _e( 'Top Description', 'landing-page-for-wc-categories-tags' ); ?></label>
							</td>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_bottom_categories" name="wc_landing_page_for_category_tag_option[wc_lp_bottom_categories]" value="1"<?php echo ( isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_categories'] ) && ( 1 == $wc_landing_page_for_category_tag_option['wc_lp_bottom_categories'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_bottom_categories" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_bottom_categories" class="wc_ld_label"><?php _e( 'Bottom Description', 'landing-page-for-wc-categories-tags' ); ?></label>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<td colspan="2"><h2><?php _e( 'Product Tags', 'landing-page-for-wc-categories-tags' ); ?></h2></td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_top_tags" name="wc_landing_page_for_category_tag_option[wc_lp_top_tags]" value="1"<?php echo ( isset( $wc_landing_page_for_category_tag_option['wc_lp_top_tags'] ) && ( 1 == $wc_landing_page_for_category_tag_option['wc_lp_top_tags'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_top_tags" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_top_tags" class="wc_ld_label"><?php _e( 'Top Description', 'landing-page-for-wc-categories-tags' ); ?></label>
							</td>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_bottom_tags" name="wc_landing_page_for_category_tag_option[wc_lp_bottom_tags]" value="1"<?php echo ( isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_tags'] ) && ( 1 == $wc_landing_page_for_category_tag_option['wc_lp_bottom_tags'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_bottom_tags" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_bottom_tags" class="wc_ld_label"><?php _e( 'Bottom Description', 'landing-page-for-wc-categories-tags' ); ?></label>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<td colspan="2"><h2><?php _e( 'Shop Page Description', 'landing-page-for-wc-categories-tags'); ?></h2></td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_top_shop_page" name="wc_landing_page_for_category_tag_option[wc_lp_top_shop_page]" value="1"<?php echo ( isset( $wc_landing_page_for_category_tag_option['wc_lp_top_shop_page'] ) && ( 1 == $wc_landing_page_for_category_tag_option['wc_lp_top_shop_page'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_top_shop_page" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_top_shop_page" class="wc_ld_label"><?php _e( 'Top Description', 'landing-page-for-wc-categories-tags' ); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<?php 
									$wc_lp_top_shop_page_description = isset($wc_landing_page_for_category_tag_option['wc_lp_top_shop_page_description']) ? $wc_landing_page_for_category_tag_option['wc_lp_top_shop_page_description'] : '';
									$wc_lp_top_shop_page_description_settings = array(
										'textarea_name' => 'wc_landing_page_for_category_tag_option[wc_lp_top_shop_page_description]',
										'editor_height' => '200px'
									);
									wp_editor( $wc_lp_top_shop_page_description, 'wc_lp_top_shop_page_description', $wc_lp_top_shop_page_description_settings );
								?>
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" style="display:none;" class="wc_lp_final_checkd" id="wc_lp_bottom_shop_page" name="wc_landing_page_for_category_tag_option[wc_lp_bottom_shop_page]" value="1"<?php echo ( isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_shop_page'] ) && ( 1 == $wc_landing_page_for_category_tag_option['wc_lp_bottom_shop_page'] ) ) ? ' checked="checked"' : ''; ?>>
								<label for="wc_lp_bottom_shop_page" class="wc_lp_checkbox_lable"><div class="wc_lp_tick_mark"></div></label>
								<label for="wc_lp_bottom_shop_page" class="wc_ld_label"><?php _e( 'Bottom Description', 'landing-page-for-wc-categories-tags'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<?php 
									$wc_lp_bottom_shop_page_description = isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_shop_page_description'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_bottom_shop_page_description'] : '';
									$wc_lp_bottom_shop_page_description_settings = array(
										'textarea_name' => 'wc_landing_page_for_category_tag_option[wc_lp_bottom_shop_page_description]',
										'editor_height' => '200px'
									);
									wp_editor( $wc_lp_bottom_shop_page_description, 'wc_lp_bottom_shop_page_description', $wc_lp_bottom_shop_page_description_settings );
								?>
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
