<?php
// deze class zorgt voor een social media optie in de customizer


class SensationRed_Social_Customize {
  	
    public static function register ( $wp_customize ) {
	
      // 1. DEFINE SECTIONS
	  $wp_customize->add_section( 'social_section', 
         array(
            'title' => __( 'Social Media Icons', 'sensationred' ), //Visible title of section
            'description' => __('Voer hier de social media urls in', 'mytheme'), //Descriptive tooltip
         	'priority' => 2,
		 ) 
      );
	  	  
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
      
   }

}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'SensationRed_Social_Customize' , 'register' ) );
