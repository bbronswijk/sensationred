<?php 
	
	function add_theme_support_scripts() {
		// Theme support --> alleen wanneer de gebruiker is ingelogd
		if( !is_admin() && current_user_can( 'publish_posts' ) && !is_customize_preview() ){
			wp_enqueue_script( 'support-js', get_template_directory_uri().'/includes/support/support.js', array('jquery'), '1.0', true );
			wp_enqueue_style( 'support-css', get_template_directory_uri() . '/includes/support/support.css');
		}
		
	} add_action('wp_enqueue_scripts', 'add_theme_support_scripts');


	// checkbox option goede doelen
	function register_support_fields() {
	        register_setting( 'general', 'support_option', 'esc_attr' );
	        add_settings_field('support_option', '<label for="support_option">Instellingen icoontjes </label>' ,'support_option_html','general' );
	} add_filter( 'admin_init' , 'register_support_fields' );
	
	function support_option_html() {
			if(get_option('support_option')=="show"){
				 $checked =  "checked='checked'"; 
			} else{
				$checked = "";
			}
			echo '<input type="checkbox" name="support_option" value="show"'.$checked.'/> Deze optie laat de icoontjes zien, die doorlinken naar de instellingen van de verschillende elementen';
	}
	
	// geef de body de class 
	function my_body_classes( $classes ) {
		if( get_option('support_option')=="show" )
			$classes[] = 'show-support-buttons';
		 
		return $classes;
		 
	} add_filter( 'body_class','my_body_classes' );