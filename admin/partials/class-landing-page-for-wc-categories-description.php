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

 class WC_Landing_Page_For_Category_Description {
 
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
	public function __construct() {
	
		add_action( 'product_cat_add_form_fields', [ $this, 'wc_lp_categories_tags_add_category_page' ] );
		add_action( 'product_cat_edit_form_fields', [ $this, 'wc_lp_categories_tags_edit_category_page' ] );
		add_action( 'edit_term', [ $this, 'wc_lp_categories_tags_save_category' ], 10, 3 );
		add_action( 'created_term', [ $this, 'wc_lp_categories_tags_save_category' ], 10, 3 );
	}

	public function wc_lp_categories_tags_add_category_page() {

		$wc_landing_page_for_category_tag_option = get_option( 'wc_landing_page_for_category_tag_option' );
		$wc_lp_top_categories = isset( $wc_landing_page_for_category_tag_option['wc_lp_top_categories'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_top_categories'] : '' ;
		$wc_lp_bottom_categories = isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_categories'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_bottom_categories'] : '' ;

		if( $wc_lp_top_categories ) {
		?>
			<div class="form-field">
				<label for="wc_lp_top_categories">
					<?php echo __( 'Top Description', 'landing-page-for-wc-categories-tags' ); ?>
				</label>
				<?php wp_editor( '', 'wc_lp_categories_top_description', array( 'editor_height' => '200px' ) ); ?>
			</div>
		<?php }

		if( $wc_lp_bottom_categories ) { ?>
			<div class="form-field">
				<label for="wc_lp_bottom_categories">
					<?php echo __( 'Bottom Description', 'landing-page-for-wc-categories-tags' ); ?>
				</label>       
				<?php wp_editor( '', 'wc_lp_categories_bottom_description', array( 'editor_height' => '200px' ) ); ?>
			</div>
		<?php
		}
	}

	public function wc_lp_categories_tags_edit_category_page( $term ) {
		
		$wc_landing_page_for_category_tag_option = get_option( 'wc_landing_page_for_category_tag_option' );	

		$wc_lp_top_categories = isset( $wc_landing_page_for_category_tag_option['wc_lp_top_categories'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_top_categories'] : '' ;
		$wc_lp_bottom_categories = isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_categories'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_bottom_categories'] : '' ;		
		$wc_lp_categories_top_description = wp_kses_post( get_term_meta( $term->term_id, 'wc_lp_categories_top_description', true ) );
		$wc_lp_categories_bottom_description = wp_kses_post( get_term_meta( $term->term_id, 'wc_lp_categories_bottom_description', true ) );

		if( $wc_lp_top_categories ) {
		?>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="wc_lp_categories_top_description"><?php echo __( 'Top Description', 'landing-page-for-wc-categories-tags' ); ?></label></th>
			<td>
				<?php wp_editor( $wc_lp_categories_top_description, 'wc_lp_categories_top_description' ); ?>
			</td>
		</tr>
		<?php
		}

		if( $wc_lp_bottom_categories ) {
		?>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="wc_lp_categories_bottom_description"><?php echo __( 'Bottom Description', 'landing-page-for-wc-categories-tags' ); ?></label></th>
			<td>
				<?php wp_editor( $wc_lp_categories_bottom_description, 'wc_lp_categories_bottom_description' ); ?>       
			</td>
		</tr>
		<?php
		}
	}

	public function wc_lp_categories_tags_save_category( $term_id, $tt_id = '', $taxonomy = '' ) {

		if ( 'product_cat' === $taxonomy ) {

			if ( isset( $_POST['wc_lp_categories_top_description'] ) ) {
				update_woocommerce_term_meta( $term_id, 'wc_lp_categories_top_description', wp_kses_post( $_POST['wc_lp_categories_top_description'] ) );
			}
			
			if ( isset( $_POST['wc_lp_categories_bottom_description'] ) ) {
				update_woocommerce_term_meta( $term_id, 'wc_lp_categories_bottom_description', wp_kses_post( $_POST['wc_lp_categories_bottom_description'] ) );
			}
		}
	}

 }