	<?php
	/*
	* Template Name: gallery
	* Aangemaakt om de wrapper de css klass wrapper_gallery toe te voegen
	*/
	?>

	<?php get_header(); ?>
		
	<div class="container main">	
		<div class="wrapper wrapper_gallery">
			<?php if ( have_posts() ) :
					while ( have_posts() ) { ?>
						<article>
							<h1 class="page-title">Foto's</h1>
							<?php the_post(); ?>
							<?php the_content();?>							
						</article>
						<?php } ?>
				<?php endif; ?>
		</div><!-- wrapper -->
	</div> <!-- container -->	

	<?php get_footer(); ?>