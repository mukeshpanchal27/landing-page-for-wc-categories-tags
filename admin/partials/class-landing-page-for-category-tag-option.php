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

 class option_register{

	public function __construct(  ) {
		add_action( 'admin_init', [ $this, 'register' ] );
	}

    public function register(){

		// opton name
		$settings = array(
			array(
				'option_group' => 'landing_page_for_category_tag_settings',
				'option_name' => 'landing_page_for_category_tag_option',
				'callback' => array( $this, 'landing_page_for_category_tagSanitize' )
			),			
		); 
		
		// option sectiion
		$sections = array(
			array(
				"id" =>'landing_page_for_category_tag_id',
				"title" =>'Configution',
				"callback" => array( $this, 'landing_page_for_category_tagSectionManager'),
				"page" => "landing_page_for_category_tag"
			),			
		);


		$fileds = array(
			// top_categories
			array(
				'id' => 'top_categories',
				'title' => 'Top Description Categories',
				'callback' => array( $this, 'enable_disable' ),
				'page' => 'landing_page_for_category_tag',
				'section' => 'landing_page_for_category_tag_id',
				'args' => array(
					'option_name' => 'landing_page_for_category_tag_option',
					'label_for' => 'top_categories',
					'class' => 'top_categories',							
				)	
			),	
            // bottom _categories
			array(
				'id' => 'bottom_categories',
				'title' => 'Bottom  Description Categories',
				'callback' => array( $this, 'enable_disable' ),
				'page' => 'landing_page_for_category_tag',
				'section' => 'landing_page_for_category_tag_id',
				'args' => array(
					'option_name' => 'landing_page_for_category_tag_option',
					'label_for' => 'bottom_categories',
					'class' => 'bottom_categories',							
				)	
			),	
            // top _tags
			array(
				'id' => 'top_tags',
				'title' => 'Top  Description Tags',
				'callback' => array( $this, 'enable_disable' ),
				'page' => 'landing_page_for_category_tag',
				'section' => 'landing_page_for_category_tag_id',
				'args' => array(
					'option_name' => 'landing_page_for_category_tag_option',
					'label_for' => 'top_tags',
					'class' => 'top_tags',							
				)	
			),
            // bottom_tags
			array(
				'id' => 'bottom_tags',
				'title' => 'Bottom  Description Tags',
				'callback' => array( $this, 'enable_disable' ),
				'page' => 'landing_page_for_category_tag',
				'section' => 'landing_page_for_category_tag_id',
				'args' => array(
					'option_name' => 'landing_page_for_category_tag_option',
					'label_for' => 'bottom_tags',
					'class' => 'bottom_tags',							
				)	
			),	

		);

		// register settings
		foreach ( $settings as $setting ) {
			register_setting( $setting['option_group'], $setting['option_name'], ( isset($setting['callback']) ? $setting['callback'] : '' ) ) ;
		}
	
		// add setings section
		foreach ( $sections as $section ) {
			add_settings_section( $section['id'], $section['title'], ( isset( $section['callback'] ) ?  $section['callback'] : '' ) ,  $section['page'] );
		}
		
		// add settings field 
		foreach ( $fileds as $field ) {
            add_settings_field( $field["id"], $field["title"], ( isset( $field["callback"] ) ? $field["callback"] : '' ), $field["page"], $field["section"], ( isset( $field["args"] ) ? $field["args"] : '' ) );
        }

	}

     // wpldl_option
	public function landing_page_for_category_tagSectionManager(){
		
	}
	// wpldl_option
	public function landing_page_for_category_tagSanitize($input){
		return $input;
	}

    // check box 
	public function enable_disable($field){

		$name = $field['label_for'];
		$classes = $field['class'];		
		$option_name = $field['option_name'];
		$checkbox = get_option( $option_name );

		$checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;
				
		echo '					
			<input type="checkbox" style ="display:none;" class="wc_lp_final_checkd" id="_checkbox ' . $name . '"   name="' . $option_name . '[' . $name . ']" value="1" ' . ( $checked ? 'checked' : '') . '>

			<label for="_checkbox ' . $name . '" class="wc_lp_checkbox_lable"><div id="wc_lp_tick_mark"></div></label>			
			
		';
	}
 }