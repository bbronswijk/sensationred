<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no">
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
                   
        <?php wp_head(); ?>       
    </head>
    <body  <?php body_class(); ?>>    	
		
    <div class="banner-bg"><div class="header_gradient"></div></div> 
    	    		
	<?php get_template_part( 'template-parts/header'); ?>
    	    		
	<?php get_template_part( 'template-parts/countdown'); ?>

    		
	    		
	    		
	    		
	    		
    	
