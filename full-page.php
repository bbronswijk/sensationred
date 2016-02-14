	<?php
	/*
	* Template Name: full width
	*/
	?>

	<?php get_header(); ?>
	<div class="container main">	
		<div class="wrapper">
						
			<div class="content content_full">		

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
		</div><!-- wrapper -->
	</div> <!-- container -->	

	<?php get_footer(); ?>