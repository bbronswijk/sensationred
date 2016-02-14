

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

			<?php 
			if ( have_posts() ) {
					while ( have_posts() ) {
						?>
						<article class="blog_post">
							<?php
								the_post(); 
								
								global $more;
								$more = 0;
							
								if ( has_post_thumbnail() ) {
									?> <div class="blog_post_thumb"> <?php
									the_post_thumbnail();
									?> </div> <?php
								} 
								?>								
							
							<div class="blog_post_content"> 
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<p class="blog_date"><?php _e( 'Published on: ','sensationred'); echo get_the_date(); ?></p>
								<?php the_content('<p>Read more &rarr;</p>');?>
															
							</div>
							
						</article>
						<?php
						//
					
					} // end while
					?>	
					<div class="page_navigation">
						<?php
						if ( get_previous_posts_link()){
							?><div class="nav_button nav_button_left"><?php previous_posts_link('&laquo; Next posts'); ?></div><?php
						}
						if ( get_next_posts_link()){
							?><div class="nav_button nav_button_right"><?php next_posts_link('Previous posts &raquo;'); ?></div><?php
						}
						?>
						
						 
					</div> 
					<?php

				} // end if
			?>
			
			
			
			
			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->	

	<?php get_footer(); ?>