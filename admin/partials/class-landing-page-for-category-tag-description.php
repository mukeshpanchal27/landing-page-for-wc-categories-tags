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

 class tag_description{
 
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
	public function __construct(  ) {
	
		add_action( 'product_tag_add_form_fields', [$this,'top_bottom_tags_wp_editor_add'], 10, 5 );		
		add_action( 'product_tag_edit_form_fields', [$this,'top_bottom_tags_wp_editor_edit'], 10, 2 );		
		add_action( 'edit_term', [$this,'top_bottom_tags_save_wp_editor'], 10, 3 );
		add_action( 'created_term', [$this,'top_bottom_tags_save_wp_editor'], 10, 3 );		
		
	}

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

		$top_description = htmlspecialchars_decode(get_term_meta ( $term->term_id, 'top_tags', true ) );

		$bottom_description = htmlspecialchars_decode(get_term_meta ( $term->term_id, 'bottom_tags', true ) );

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

 }