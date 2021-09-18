<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mukeshpanchal.com/
 * @since      1.0.0
 *
 * @package    Landing_Page_For_Category_Tag
 * @subpackage Landing_Page_For_Category_Tag/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Landing_Page_For_Category_Tag
 * @subpackage Landing_Page_For_Category_Tag/public
 * @author     Mukesh Panchal <mukeshpanchal27@gmail.com>
 */
class WC_Landing_Page_For_Category_Tag_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'woocommerce_before_shop_loop', [ $this, 'top_categories_display_wp_editor_content' ], 5 );
		add_action( 'woocommerce_after_shop_loop', [ $this, 'bottom_categories_display_wp_editor_content' ], 5 );		
	}

	public function top_categories_display_wp_editor_content() {

		$woocommerce_term_id = get_queried_object_id();
		$wc_landing_page_for_category_tag_option = get_option( 'wc_landing_page_for_category_tag_option' );
		$wc_lp_top_categories = isset( $wc_landing_page_for_category_tag_option['wc_lp_top_categories'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_top_categories'] : '' ;
		
		if( is_product_category() && $wc_lp_top_categories && $woocommerce_term_id ) {

			$wc_lp_categories_top_description = get_term_meta( $woocommerce_term_id, 'wc_lp_categories_top_description', true );
			if ( $wc_lp_categories_top_description ) {
				echo '<div class="wc-lp-top-description wc-lp-category-top-description">';
					echo wc_format_content( wp_kses_post( $wc_lp_categories_top_description ) );
				echo '</div>';
			}
		}

		$wc_lp_top_tags = isset( $wc_landing_page_for_category_tag_option['wc_lp_top_tags'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_top_tags'] : '' ;
		
		if( is_product_tag() && $wc_lp_top_tags && $woocommerce_term_id ) {

			$wc_lp_tags_top_description = get_term_meta( $woocommerce_term_id, 'wc_lp_tags_top_description', true );
			if ( $wc_lp_tags_top_description ) {
				echo '<div class="wc-lp-top-description wc-lp-tag-top-description">';
					echo wc_format_content( wp_kses_post( $wc_lp_tags_top_description ) );
				echo '</div>';
			}
		}

	}

	public function bottom_categories_display_wp_editor_content() {

		$woocommerce_term_id = get_queried_object_id();
		$wc_landing_page_for_category_tag_option = get_option( 'wc_landing_page_for_category_tag_option' );
		$wc_lp_bottom_categories = isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_categories'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_bottom_categories'] : '' ;


		if( is_product_category() && $wc_lp_bottom_categories && $woocommerce_term_id ) {

			$wc_lp_categories_bottom_description = get_term_meta( $woocommerce_term_id, 'wc_lp_categories_bottom_description', true );
			if ( $wc_lp_categories_bottom_description ) {
				echo '<div class="wc-lp-bottom-description wc-lp-category-bottom-description">';
					echo wc_format_content( wp_kses_post( $wc_lp_categories_bottom_description ) );
				echo '</div>';
			}
		}

		$wc_lp_bottom_tags = isset( $wc_landing_page_for_category_tag_option['wc_lp_bottom_tags'] ) ? $wc_landing_page_for_category_tag_option['wc_lp_bottom_tags'] : '' ;

		if( is_product_tag() && $wc_lp_bottom_tags && $woocommerce_term_id ) {

			$wc_lp_tags_bottom_description = get_term_meta( $woocommerce_term_id, 'wc_lp_tags_bottom_description', true );
			if ( $wc_lp_tags_bottom_description ) {
				echo '<div class="wc-lp-bottom-description wc-lp-tag-bottom-description">';
					echo wc_format_content( wp_kses_post( $wc_lp_tags_bottom_description ) );
				echo '</div>';
			}
		}
	}

}
