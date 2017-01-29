<?php

class MyTheme_Customize {
  
   public static function register ( $wp_customize ) {
	
      // 1. DEFINE SECTIONS
	  $wp_customize->add_section( 'social_section', 
         array(
            'title' => __( 'Social Media Icons', 'sensationred' ), //Visible title of section
            'description' => __('Voer hier de social media urls in', 'mytheme'), //Descriptive tooltip
         	'priority' => 2,
		 ) 
      );
	  
	  //$wp_customize->get_section( 'header_image' )->panel = 'header';
      //$wp_customize->get_section( 'header_image' )->title = 'header logo';
	  
      //2. REGISTER SETTINGS

	  // SOCIAL MEDIA
	  $wp_customize->add_setting( 'facebook-url', 
         array(
            'type' => 'option'
         ) 
      );  
	  
	  $wp_customize->add_setting( 'twitter-url', 
         array(
            'type' => 'option' 
         ) 
      );  
	  
	  $wp_customize->add_setting( 'linkedin-url', 
         array(
            'type' => 'option'
         ) 
      );  
	  
	  $wp_customize->add_setting( 'vimeo-url', 
         array(
            'type' => 'option' 
         ) 
      );  
	  
	  $wp_customize->add_setting( 'instagram-url', 
         array(
            'type' => 'option'
         ) 
      );  
	        
      //3. DEFINE CONTROLS       
   
	  
	  // social media
	  $wp_customize->add_control( new WP_Customize_Control( 
         $wp_customize, 
         'facebook-url',
         array(
            'label' => __( 'Facebook', 'mytheme' ), 
            'section' => 'title_tagline', 
            'settings' => 'facebook-url', 
            'priority' => 10,
            'section' => 'social_section'
         ) 
	  ) );
	  
	   $wp_customize->add_control( new WP_Customize_Control( 
         $wp_customize, 
         'twitter-url',
         array(
            'label' => __( 'Twitter', 'mytheme' ), 
            'section' => 'title_tagline', 
            'settings' => 'twitter-url', 
            'priority' => 11, 
            'section' => 'social_section'
         ) 
	  ) );
	  
	   $wp_customize->add_control( new WP_Customize_Control( 
         $wp_customize, 
         'linkedin-url',
         array(
            'label' => __( 'LinkedIn', 'mytheme' ), 
            'section' => 'title_tagline', 
            'settings' => 'linkedin-url', 
            'priority' => 12, 
            'section' => 'social_section'
         ) 
	  ) );
	  
	   $wp_customize->add_control( new WP_Customize_Control( 
         $wp_customize, 
         'instagram-url',
         array(
            'label' => __( 'Instagram', 'mytheme' ), 
            'section' => 'title_tagline', 
            'settings' => 'instagram-url', 
            'priority' => 13, 
            'section' => 'social_section'
         ) 
	  ) );
		
	  $wp_customize->add_control( new WP_Customize_Control( 
         $wp_customize, 
         'vimeo-url',
         array(
            'label' => __( 'Vimeo', 'mytheme' ), 
            'section' => 'title_tagline', 
            'settings' => 'vimeo-url', 
            'priority' => 14, 
            'section' => 'social_section'
         ) 
	  ) );

	
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      //$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      //$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
      //$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
      //$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
      
   }

}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'MyTheme_Customize' , 'register' ) );

// Output custom CSS to live site
//add_action( 'wp_head' , array( 'MyTheme_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
//add_action( 'customize_preview_init' , array( 'MyTheme_Customize' , 'live_preview' ) );