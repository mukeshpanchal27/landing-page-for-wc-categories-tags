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
class Landing_Page_For_Category_Tag_Public {

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

		// cat
		add_action( 'product_cat_add_form_fields', [$this,'top_bottom_categories_wp_editor_add'], 10, 2 );		
		add_action( 'product_cat_edit_form_fields', [$this,'top_bottom_wp_editor_edit'], 10, 2 );
		add_action( 'edit_term', [$this,'top_bottom_categories_save_wp_editor'], 10, 3 );
		add_action( 'created_term', [$this,'top_bottom_categories_save_wp_editor'], 10, 3 );
		add_action( 'woocommerce_before_shop_loop', [$this,'top_categories_display_wp_editor_content'], 5 );
		add_action( 'woocommerce_after_shop_loop', [$this,'bottom_categories_display_wp_editor_content'], 5 );
		// tags
		add_action( 'product_tag_add_form_fields', [$this,'top_bottom_tags_wp_editor_add'], 10, 5 );		
		add_action( 'product_tag_edit_form_fields', [$this,'top_bottom_tags_wp_editor_edit'], 10, 2 );		
		add_action( 'edit_term', [$this,'top_bottom_tags_save_wp_editor'], 10, 3 );
		add_action( 'created_term', [$this,'top_bottom_tags_save_wp_editor'], 10, 3 );
		add_action( 'woocommerce_before_shop_loop', [$this,'top_tags_display_wp_editor_content'], 5 );
		add_action( 'woocommerce_after_shop_loop', [$this,'bottom_tags_display_wp_editor_content'], 5 );
		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Landing_Page_For_Category_Tag_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Landing_Page_For_Category_Tag_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/landing-page-for-category-tag-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Landing_Page_For_Category_Tag_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Landing_Page_For_Category_Tag_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/landing-page-for-category-tag-public.js', array( 'jquery' ), $this->version, false );

	}



	// Display field on category admin page
	public function top_bottom_categories_wp_editor_add() {

		$get_option = get_option( 'landing_page_for_category_tag_option' );	
		// top cat check  
		$top_categories = isset( $get_option['top_categories'] ) ? $get_option['top_categories'] : false ;
		// bottom cat check 
		$bottom_categories = isset( $get_option['bottom_categories'] ) ? $get_option['bottom_categories'] : false ;

		// top cat
		if( $top_categories ){
		?>
		<div class="form-field">
			<label for="top_description"><?php echo __( 'Top Description', 'woocommerce' ); ?></label>       
			<?php       
				wp_editor( '','top_description');
			?>             
		</div>
		<?php }if($bottom_categories){ ?>

		<!-- bottom cat -->
		<div class="form-field">
			<label for="bottom_description"><?php echo __( 'Bottom Description', 'woocommerce' ); ?></label>       
			<?php       
				wp_editor( '','bottom_description');
			?>             
		</div>

		<?php
		}
	}

	// Display field on "Edit product category" admin page
	public function top_bottom_wp_editor_edit( $term ) {
		
		$get_option = get_option( 'landing_page_for_category_tag_option' );	
		// top cat check  
		$top_categories = isset( $get_option['top_categories'] ) ? $get_option['top_categories'] : false ;
		// bottom cat check 
		$bottom_categories = isset( $get_option['bottom_categories'] ) ? $get_option['bottom_categories'] : false ;		

		$top_description = htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'top_description', true ) );

		$bottom_description = htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'bottom_description', true ) );

		if( $top_categories ){
		?>
		<!-- top cat -->
		<tr class="form-field">
			<th scope="row" valign="top"><label for="top_description"><?php echo __( 'Top Description', 'woocommerce' ); ?></label></th>
			<td>
				<?php                    
					wp_editor( $top_description, 'top_description' );
				?>                   
			</td>
		</tr>

		<?php }if( $bottom_categories ){ ?>
		<!-- bottom cat -->
		<tr class="form-field">
			<th scope="row" valign="top"><label for="bottom_description"><?php echo __( 'bottom Description', 'woocommerce' ); ?></label></th>
			<td>
				<?php                    
					wp_editor( $bottom_description, 'bottom_description' );
				?>       
			</td>
		</tr>
		<?php
		}
	}

	// Save field @ admin page 		
	public function top_bottom_categories_save_wp_editor( $term_id, $tt_id = '', $taxonomy = '' ) {

		if ( isset( $_POST['top_description'] ) && 'product_cat' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'top_description', esc_attr( $_POST['top_description'] ) );
		}		
		
		if ( isset( $_POST['bottom_description'] ) && 'product_cat' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'bottom_description', esc_attr( $_POST['bottom_description'] ) );
		}	
	}

	// Display field under products @ Product Category pages  		
	public function top_categories_display_wp_editor_content() {
		if ( is_product_taxonomy() ) {
			$term = get_queried_object();

			if ( $term && ! empty( get_woocommerce_term_meta( $term->term_id, 'top_description', true ) ) ) {
				echo '<p class="term-description_top_description">' . wc_format_content( htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'top_description', true ) ) ) . '</p>';
			}							
			
		}
	}
	// Display field under products @ Product Category pages  		
	public function bottom_categories_display_wp_editor_content() {
		if ( is_product_taxonomy() ) {
			$term = get_queried_object();
		
			if ( $term && ! empty( get_woocommerce_term_meta( $term->term_id, 'bottom_description', true ) ) ) {
				echo '<p class="term-description_bottom_description">' . wc_format_content( htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'bottom_description', true ) ) ) . '</p>';
			}	
			
		}
	}

	/**
	* tags  
	*/ 

	// Display field on tags admin page
	public function top_bottom_tags_wp_editor_add(){

		$get_option = get_option( 'landing_page_for_category_tag_option' );	
		// top cat check  
		$top_tags = isset( $get_option['top_tags'] ) ? $get_option['top_tags'] : false ;
		// bottom cat check 
		$bottom_tags = isset( $get_option['bottom_tags'] ) ? $get_option['bottom_tags'] : false ;

		// top cat
		if( $top_tags ):
		?>
		<div class="form-field">
			<label for="top_tags"><?php echo __( 'Top Description', 'woocommerce' ); ?></label>       
			<?php       
				wp_editor( '','top_tags');
			?>             
		</div>
		<?php endif; if($bottom_tags): ?>

		<!-- bottom cat -->
		<div class="form-field">
			<label for="bottom_tags"><?php echo __( 'Bottom Description', 'woocommerce' ); ?></label>       
			<?php       
				wp_editor( '','bottom_tags');
			?>             
		</div>

		<?php
		
		endif;
	}
	
	// Display field on "Edit product tags" admin page
	public function top_bottom_tags_wp_editor_edit( $term ) {

		$get_option = get_option( 'landing_page_for_category_tag_option' );	
		// top cat check  
		$top_tags = isset( $get_option['top_tags'] ) ? $get_option['top_tags'] : false ;
		// bottom cat check 
		$bottom_tags = isset( $get_option['bottom_tags'] ) ? $get_option['bottom_tags'] : false ;		

		$top_description = htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'top_tags', true ) );

		$bottom_description = htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'bottom_tags', true ) );

		if( $top_tags ){
		?>
		<!-- top cat -->
		<tr class="form-field">
			<th scope="row" valign="top"><label for="top_tags"><?php echo __( 'Top Description', 'woocommerce' ); ?></label></th>
			<td>
				<?php                    
					wp_editor( $top_description, 'top_tags' );
				?>                   
			</td>
		</tr>

		<?php }if( $bottom_tags ){ ?>
		<!-- bottom cat -->
		<tr class="form-field">
			<th scope="row" valign="top"><label for="bottom_tags"><?php echo __( 'bottom Description', 'woocommerce' ); ?></label></th>
			<td>
				<?php                    
					wp_editor( $bottom_description, 'bottom_tags' );
				?>       
			</td>
		</tr>
		<?php
		}
	}

	// Save field @ admin page  
	public function top_bottom_tags_save_wp_editor( $term_id, $tt_id = '', $taxonomy = '' ) {
		
		
		if ( isset( $_POST['top_tags'] ) && 'product_tag' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'top_tags', esc_attr( $_POST['top_tags'] ) );
		}

		if ( isset( $_POST['bottom_tags'] ) && 'product_tag' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'bottom_tags', esc_attr( $_POST['bottom_tags'] ) );
		}
	}

	// Display field under products @ Product Tag pages  		
	public function top_tags_display_wp_editor_content() {
		if ( is_product_taxonomy() ) {
			$term = get_queried_object();

			if ( $term && ! empty( get_woocommerce_term_meta( $term->term_id, 'top_tags', true ) ) ) {
				echo '<p class="term-description">' . wc_format_content( htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'top_tags', true ) ) ) . '</p>';
			}						
		}
	}
	// Display field under products @ Product Tag pages  		
	public function bottom_tags_display_wp_editor_content() {
		if ( is_product_taxonomy() ) {
			$term = get_queried_object();			
			if ( $term && ! empty( get_woocommerce_term_meta( $term->term_id, 'bottom_tags', true ) ) ) {
				echo '<p class="term-description">' . wc_format_content( htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'bottom_tags', true ) ) ) . '</p>';
			}
		}
	}

}
