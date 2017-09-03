	<header>
	    	<div class="container">
	    		<?php get_sidebar ('woocommerce'); // sidebar voor de jrk webshop cart van woocommerce?>
	    		<?php if( function_exists('qtranxf_generateLanguageSelectCode') ) echo qtranxf_generateLanguageSelectCode('image'); ?>
				
				<div class="nav_overlay">
					<h2>Navigatie Menu</h2>
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'mobile_nav', 'container' => 'nav' )); ?>
				</div>	
				
				<div class="navicon">
					<a id="trigger-overlay" class="nav_slide_button nav-toggle" href="#"><span></span></a>
				</div>
		    		   
		        <a class="header_logo" href="<?php echo home_url(); ?>">
						<?php if( is_front_page() && has_post_thumbnail() ) : 
								the_post_thumbnail(); 
							else: ?>
								<img class="header_logo" src="<?php header_image(); ?>" alt="" />
						<?php endif; ?>
				</a>
		    	
		    	<?php $walker = new Menu_With_Description; ?>
		   		<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'main_nav', 'container' => 'nav', 'walker' => $walker )); ?> 
		    			
		    </div>
	   </header>