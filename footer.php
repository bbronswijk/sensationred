				 
			 
			 <div class="white_gradient">white gradient</div>
			 
			 <!-- BACKGROUND_FOOTER === container of sponsoren  -->
			 <div class="background_footer">
				<div class="container">
					<?php get_template_part( 'template-parts/sponsors'); ?>
					
					<?php get_sidebar ('footer'); ?>
					
				</div> <!-- container --> 
			</div> <!-- background_footer --> 
			
		 <footer>
			 	<div class="container"> 
			 		<div class="links">
			 			<?php if( get_option( 'm_footer_number' ) >= 1):
			 					for ( $counter = 1; $counter <= get_option( 'm_footer_number' ); $counter += 1) {?>
									<a href="<?php echo get_option( 'm_footer_item_link'.$counter ); ?>">
										<?php echo get_option( 'm_footer_item_name'.$counter ); ?>
									</a> 
									<?php 
										if( $counter < get_option( 'm_footer_number' ) ) echo "|";								
						 		}
			 				endif;?>		 					 		
			 		</div>
			 		
			 		<div class="copyright"> <?php if(get_option('m_footer_show_copy')=="show"){ ?> Copyright &copy; <?php echo date("Y"); ?> laga.nl | Delftsche Studenten Roeivereeniging <?php } ?> </div>
			 		
			 	</div> <!-- container --> 			 	
		 </footer>
		 <?php wp_footer(); ?>
	</body>
</html>