<?php

class SensationRed_Banner_Customize {
  
   public static function register ( $wp_customize ) {

      // 1. DEFINE SECTIONS
      $wp_customize->add_section( 'banner_section', 
         array(
            'title' => 'Achtergrond', //Visible title of section
            'priority' => 25, //Determines what order this appears in
         ) 
      );

      //2. REGISTER SETTINGS      
      $wp_customize->add_setting( 'banner_image', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => get_template_directory_uri().'/images/banner.jpg', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );  

	  $wp_customize->add_setting( 'banner_position', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => 'center', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );   
	        
      //3. DEFINE CONTROLS          
	  // BANNER
      $wp_customize->add_control( new WP_Customize_Image_Control( 
         $wp_customize, //Pass the $wp_customize object (required)
         'banner_image', //Set a unique ID for the control
         array(
            'label' => 'Banner afbeelding', //Admin-visible name of the control
            'section' => 'banner_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'banner_image', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      
      $wp_customize->add_control(
      		'banner_position',
      		array(
      				'label'    => 'Afbeelding Positie',
      				'section'  => 'banner_section',
      				'settings' => 'banner_position',
      				'type'     => 'select',
      				'choices'  => array(
      						'top'  => 'top',
      						'center'  => 'center',
      						'bottom' => 'bottom'
      				),
      		)
      );

   } // main register function

 
   //This will output the custom WordPress settings to the live theme's WP head. 
   public static function header_output() {  ?>
      <style id="background-styles" type="text/css">
           <?php self::generate_css('.banner-bg', 'background-image', 'banner_image','url(',')'); ?> 
           <?php self::generate_css('.banner-bg', 'background-position', 'banner_position'); ?> 
      </style> 
   <?php }

   //This outputs the javascript needed to automate the live settings preview. 
   public static function live_preview() {
      wp_enqueue_script( 'theme-themecustomizer', get_template_directory_uri().'/js/banner-customizer.js', array('jquery','customize-preview'),'',true);
   }
	
    //This will generate a line of CSS for use in header output. If the setting
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
    
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'SensationRed_Banner_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'SensationRed_Banner_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'SensationRed_Banner_Customize' , 'live_preview' ) );