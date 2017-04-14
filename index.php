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
			 <?php rewind_posts(); ?>
			<?php 
					while ( have_posts() ) {
						?><article><?php
						the_post(); 
						//
						?>
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title=" <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php the_content(); ?>
						</article>
						<?php
						//
					} // end while
		
			?>
			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->
	<?php get_footer(); ?>