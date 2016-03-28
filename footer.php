				 
			 
			 <div class="white_gradient">white gradient</div>
			 
			 <!-- BACKGROUND_FOOTER === container of sponsoren  -->
			 <div class="background_footer">
				<div class="container">
					<?php $query = new WP_Query( array('post_type' => 'sponsoren') ); if ( $query->have_posts() ) :?>
					<div class="sponsoren">
						<?php  
						wp_reset_query();
						
						$args = array(
							'post_type' => 'sponsoren',
							'tax_query' => array(
								array(
									'taxonomy' => 'sponsor_type',
									'field'    => 'slug',
									'terms'    => 'hoofdsponsor',
								),
							),
							'posts_per_page' => 100
						);
						$query = new WP_Query( $args );
					
						if ( $query->have_posts() ): ?>
						<div class="hoofd_sponsor">
							<h4><?php _e('Head sponsor','sensationred');?></h4>
							<?php
							
							while ( $query->have_posts() ) : $query->the_post();
								if ( has_post_thumbnail() ){
									?><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium');?></a><?php
								}
	
							endwhile;
							?>
						</div> <!-- hoofdsponsor --> 
						<?php endif; ?>	

						<?php 
						wp_reset_query();
						
						$args = array(
							'post_type' => 'sponsoren',
							'tax_query' => array(
								array(
									'taxonomy' => 'sponsor_type',
									'field'    => 'slug',
									'terms'    => 'partner',
								),
							),
							'posts_per_page' => 100
						);
								
						$query = new WP_Query( $args );
						if ( $query->have_posts() ): ?>
						<div class="sub_sponsor">
							<h4><?php _e('bussiness partners','sensationred');?></h4>
							<?php
							while ( $query->have_posts() ) : $query->the_post();
								if ( has_post_thumbnail() ){
									?><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium');?></a><?php
								}
	
							endwhile;
							?>
						</div>	<!-- sub sponsoren --> 		
						<?php endif; ?>		
					</div> <!-- sponsoren --> 
					<?php endif; ?>	
					<?php get_sidebar ('footer'); ?>
					
				</div> <!-- container --> 
			</div> <!-- background_footer --> 
			
		 <footer>
			 	<div class="container"> 
			 		<div class="links">
			 			<?php if( get_option( 'm_footer_number' ) >= 1){
			 				for ( $counter = 1; $counter <= get_option( 'm_footer_number' ); $counter += 1) {?>
								<a href="<?php echo get_option( 'm_footer_item_link'.$counter ); ?>"><?php echo get_option( 'm_footer_item_name'.$counter ); ?></a> 
							<?php if( $counter < get_option( 'm_footer_number' ) ){
									echo "|";
								}
						 }
			 			} ?>
			 			
			 					 		
			 		</div>
			 		<div class="copyright"> <?php if(get_option('m_footer_show_copy')=="show"){ ?> Copyright &copy; <?php echo date("Y"); ?> laga.nl | Delftsche Studenten Roeivereeniging <?php } ?> </div>
			 		
			 	</div> <!-- container --> 
			 	
			 	
		 </footer>
		 <?php wp_footer(); ?>
	</body>
</html>