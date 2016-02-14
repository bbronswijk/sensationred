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
						?><article><?php
						the_post(); 
						//
						
						?>
						<h1><?php the_title(); ?></h1>
						<?php 
						the_content();
						?>
						</article>
						<?php
						//
					} // end while
				} // end if
			?>
			</div> <!-- content -->
		</div> <!-- wrapper -->
	</div><!-- container --> 
	<?php get_footer(); ?>