	<?php
	/*
	* Template Name: right sidebar
	*/
	?>
	<?php get_header(); ?>

	<div class="container main">	
		<div class="wrapper">		
			
			<div class="content content_left">	
				<?php if ( have_posts() ) :
					while ( have_posts() ) { the_post(); ?>
						<article>
							<h1 class="page-title"><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</article>
					<?php } ?>
				<?php endif; ?>
			</div> <!-- content -->
			
			<?php if ( is_active_sidebar('default') ) get_sidebar('default'); ?>
				
		</div> <!-- wrapper -->
	</div><!-- container --> 
	
	<?php get_footer(); ?>