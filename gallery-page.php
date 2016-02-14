	<?php
	/*
	* Template Name: gallery
	*/
	?>

	<?php get_header(); ?>
	<div class="container main">	
		<div class="wrapper wrapper_gallery">
						
					

			<?php 
				if ( have_posts() ) {
					while ( have_posts() ) {
						?><article>
							<h1>Foto's</h1>
							<?php 
								the_post(); 
								the_content();
							?>
						</article>
						<?php
						//
					} // end while
				} // end if
			?>
			
			
			
			
		</div><!-- wrapper -->
	</div> <!-- container -->	

	<?php get_footer(); ?>