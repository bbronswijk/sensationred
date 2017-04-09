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
						the_post(); 
						if ( has_post_thumbnail() ) {
									?> <div class="single_sponsor_post_thumb"> <?php
									the_post_thumbnail('large');
									?> </div> 
							<?php } ?>
						
						<div class="blog_title"><h1><?php the_title(); ?></h1></div>
						
						<?php 
						the_content();
						?>
						 
						<?php 
					} // end while
					
				} // end if
				?>
			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->
	<?php get_footer(); ?>
	
	
	
	