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

 class WC_Landing_Page_For_Tag_Description {
 
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
	
		add_action( 'product_tag_add_form_fields', [ $this, 'wc_lp_categories_tags_add_tag_page'] );
		add_action( 'product_tag_edit_form_fields', [ $this, 'wc_lp_categories_tags_edit_tag_page' ] );
		add_action( 'edit_term', [ $this, 'wc_lp_categories_tags_save_tag' ], 10, 3 );
		add_action( 'created_term', [ $this, 'wc_lp_categories_tags_save_tag' ], 10, 3 );
		
	}

	public function wc_lp_categories_tags_add_tag_page() {

		$wc_landing_page_for_category_tag_option = get_option( 'wc_landing_page_for_category_tag_option' );	
		$wc_lp_top_tags = isset( $wc_landing_page_for_category_tag_option['wc_lp_top_tags'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_top_tags'] : '' ;
		$wc_lp_bottom_tags = isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_tags'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_bottom_tags'] : '' ;

		if( $wc_lp_top_tags ) {
		?>
		<div class="form-field">
			<label for="wc_lp_top_tags"><?php echo __( 'Top Description', 'wc-landing-page-for-category-tag' ); ?></label>       
			<?php wp_editor( '', 'wc_lp_tags_top_description', array( 'editor_height' => '200px' ) ); ?>
		</div>
		<?php
		}

		if( $wc_lp_bottom_tags ) {
		?>
			<div class="form-field">
				<label for="wc_lp_bottom_tags"><?php echo __( 'Bottom Description', 'wc-landing-page-for-category-tag' ); ?></label>
				<?php wp_editor( '', 'wc_lp_tags_bottom_description', array( 'editor_height' => '200px' ) ); ?>
			</div>
		<?php
		}
	}
	
	public function wc_lp_categories_tags_edit_tag_page( $term ) {

		$wc_landing_page_for_category_tag_option = get_option( 'wc_landing_page_for_category_tag_option' );	

		$wc_lp_top_tags = isset( $wc_landing_page_for_category_tag_option['wc_lp_top_tags'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_top_tags'] : '' ;
		$wc_lp_bottom_tags = isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_tags'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_bottom_tags'] : '' ;		
		$wc_lp_tags_top_description = htmlspecialchars_decode( get_term_meta( $term->term_id, 'wc_lp_tags_top_description', true ) );
		$wc_lp_tags_bottom_description = htmlspecialchars_decode( get_term_meta( $term->term_id, 'wc_lp_tags_bottom_description', true ) );

		if( $wc_lp_top_tags ) {
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="wc_lp_tags_top_description"><?php echo __( 'Top Description', 'wc-landing-page-for-category-tag' ); ?></label>
			</th>
			<td>
				<?php wp_editor( $wc_lp_tags_top_description, 'wc_lp_tags_top_description' ); ?>
			</td>
		</tr>

		<?php
		}

		if( $wc_lp_bottom_tags ) {
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="wc_lp_tags_bottom_description"><?php echo __( 'bottom Description', 'wc-landing-page-for-category-tag' ); ?></label>
			</th>
			<td>
				<?php wp_editor( $wc_lp_tags_bottom_description, 'wc_lp_tags_bottom_description' ); ?>       
			</td>
		</tr>
		<?php
		}
	}

	public function wc_lp_categories_tags_save_tag( $term_id, $tt_id = '', $taxonomy = '' ) {
		
		if ( 'product_tag' === $taxonomy ) {
			if ( isset( $_POST['wc_lp_tags_top_description'] ) ) {
				update_woocommerce_term_meta( $term_id, 'wc_lp_tags_top_description', esc_attr( $_POST['wc_lp_tags_top_description'] ) );
			}

			if ( isset( $_POST['wc_lp_tags_bottom_description'] ) ) {
				update_woocommerce_term_meta( $term_id, 'wc_lp_tags_bottom_description', esc_attr( $_POST['wc_lp_tags_bottom_description'] ) );
			}
		}
	}

 }