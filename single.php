	<?php get_header(); ?>
	
	<div class="container main">	
		<div class="wrapper">
		
			<?php if ( is_active_sidebar('default') ) get_sidebar('default'); ?>	
						
			<div class="content blog-content">	
			
			<?php 
				if ( have_posts() ) :
					while ( have_posts() ) { the_post(); ?>
						
						<div class="blog_title"><h1><?php the_title(); ?></h1></div>
						<p class="blog_date">  <?php _e( 'Published on: ','sensationred'); the_date('j F, Y'); ?></p>
						
						<?php if ( has_post_thumbnail() ) echo '<div class="blog_post_thumb">'.get_the_post_thumbnail().'</div>'; ?>
												
						<?php the_content(); ?>						
						
						<?php get_template_part( 'template-parts/post-navigation'); ?>
						
					<?php } // end while
					
				endif; // end if
			?>
			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->
	
	<?php get_footer(); ?>
	
	
	
	