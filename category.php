	<?php get_header(); ?>

	<div class="container main">	
		<div class="wrapper">						
			<div class="content">		
				<h1 class="page-title" style="margin-left: 1.4%;">Nieuwsarchief</h1>
				<?php 
					if ( have_posts() ) :
							echo '<div id="blog-container">';
							
							while ( have_posts() ) { the_post(); ?>
								<article class="blog_post">
										<?php if ( has_post_thumbnail() ) : ?> 
											<div class="blog_post_thumb"> 
												<a href="<?php the_permalink() ?>">
													<?php the_post_thumbnail('medium'); ?> 
												</a>
											</div> 
										<?php endif; ?>								
									
										<div class="blog_post_content"> 
											<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
											<p class="blog_date"><?php _e( 'Published on: ','sensationred'); echo get_the_date('j F, Y'); ?></p>
											<?php the_excerpt();?>
											<a href="<?php the_permalink() ?>"><?php _e( 'Read more','sensationred'); ?></a>							
										</div>								
								</article>
							<?php } ?>	
							
							<?php echo '</div>'; ?>
				<?php  endif;	?>
					
				<?php get_template_part( 'template-parts/page-navigation'); ?>

			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->	

	<?php get_footer(); ?>