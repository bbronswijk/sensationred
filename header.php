<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no">
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
                   
        <?php wp_head(); ?>
        
        
    </head>
    <body  <?php body_class( $class ); ?>>    	
		
    	<!-- header image --> 
    	<?php $header_image = get_header_image(); 
		if ( ! empty( $header_image ) ) : ?>
    		<div class="custom-bg">		
	    		<div class="header_gradient">Gradient</div>
    		</div> <!-- header image --> 
    	<?php endif; ?> 
    	
    	<header>
	    	<div class="container">
	    		<?php 
	    			if( function_exists(qtranxf_generateLanguageSelectCode) ){
	    				echo qtranxf_generateLanguageSelectCode('image'); 
					}
				?>
				<div class="nav_overlay">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'mobile_nav', 'container' => 'div' )); ?>
				</div>	
				<div class="navicon">
					<a id="trigger-overlay" class="nav_slide_button nav-toggle" href="#"><span></span></a>
				</div>
		    	
		    	<!-- banner logo-->			   
		        	<a class="header_logo" href="<?php echo home_url(); ?>">
						<?php 
							if( is_front_page() && has_post_thumbnail() ) {
									the_post_thumbnail();
							}
							else{
								?><img class="header_logo" src="<?php header_image(); ?>" alt="" /><?php
							}
						?>
					</a>
		    	<!-- navigation bar --> 
		    	<div class="default_nav"><?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'main_nav', 'container' => 'nav' )); ?> </div>  		
		    </div><!-- container --> 
	   </header><!-- bg nav --> 	
	
    	
    		

    		
	    		
	    		
	    		
	    		
    	
