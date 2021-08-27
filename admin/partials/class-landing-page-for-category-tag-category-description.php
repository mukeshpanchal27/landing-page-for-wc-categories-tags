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

 class category_description{
 
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
	
		add_action( 'product_cat_add_form_fields', [$this,'top_bottom_categories_wp_editor_add'], 10, 2 );		
		add_action( 'product_cat_edit_form_fields', [$this,'top_bottom_wp_editor_edit'], 10, 2 );
		add_action( 'edit_term', [$this,'top_bottom_categories_save_wp_editor'], 10, 3 );
		add_action( 'created_term', [$this,'top_bottom_categories_save_wp_editor'], 10, 3 );
		
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

		$top_description = htmlspecialchars_decode(get_term_meta ( $term->term_id, 'top_description', true ) );

		$bottom_description = htmlspecialchars_decode(get_term_meta ( $term->term_id, 'bottom_description', true ) );

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

 }