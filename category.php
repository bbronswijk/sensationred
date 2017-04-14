

	<?php get_header(); ?>
	<div class="container main">	
		<div class="wrapper">
						
			<div class="content">		
			<h1 style="margin-left: 1.4%;">Nieuwsarchief</h1>
			<?php 
			if ( have_posts() ) {
					echo '<div id="blog-container">';
					
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
								<?php the_excerpt();?>
								<a href="<?php the_permalink() ?>"><?php _e( 'Read more','sensationred'); ?></a>							
							</div>
							
						</article>
						<?php
						//
					
					} // end while
					?>	
					</div>
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