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
		add_action( 'init',[$this,'landing_page_for_category_tag_option']);
		
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/landing-page-for-category-tag-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/landing-page-for-category-tag-admin.js', array( 'jquery' ), $this->version, false );

	}

		/**
	 * Register plugin config page.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu_page(){
		add_menu_page( 
			__( 'Landing Page', 'Landing_Page_For_Category_Tag' ),
			__( 'Landing Page Settings', 'Landing_Page_For_Category_Tag' ),
			'manage_options',
			'landing_page_for_category_tag',
			array( $this, 'admin_menu_page_callback' )
		); 
	}

	public function landing_page_for_category_tag_option(){
	
		require_once plugin_dir_path( __FILE__ ).'partials/class-landing-page-for-category-tag-option.php';
	
		$option = new option_register();			
	
		add_action( 'admin_init', [ $option, 'register' ] );
			
	}
	
	public function admin_menu_page_callback(){
	?>
		<div class="wrap">

			<form method="post" action="options.php">

				<?php
					settings_fields( 'landing_page_for_category_tag_settings' );
					do_settings_sections( 'landing_page_for_category_tag' );
					submit_button('Save');				
				?>

			</form>

		</div>	
	<?php	
	}
	


}
