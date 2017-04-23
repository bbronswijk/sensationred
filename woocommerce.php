	<?php get_header(); ?>
	<div class="container main">	
		<div class="wrapper">
				
			<?php if ( is_active_sidebar('default') ) get_sidebar('default'); ?>			
			<div class="content"> <?php woocommerce_content(); ?> </div> 
			
		</div><!-- wrapper -->
	</div> <!-- container -->
	<?php get_footer(); ?>