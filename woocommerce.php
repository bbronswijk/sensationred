	<?php get_header(); ?>
	<div class="container main">	
		<div class="wrapper">
				
			<!-- If there is an active sidebar show it --> 	
			<?php
				if ( is_active_sidebar('default') ) {
					get_sidebar('default');
				}
			?>	
			
			<div class="content">	
				
				<?php woocommerce_content(); ?>
			
			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->
	<?php get_footer(); ?>