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
									?> <div class="blog_post_thumb"> <?php
									the_post_thumbnail();
									?> </div> 
							<?php } ?>
						
						<div class="blog_title"><h1><?php the_title(); ?></h1></div>
						<p class="blog_date">  <?php _e( 'Published on: ','sensationred'); the_date(); ?></p>
						<?php 
						the_content();
						?>
						<div class="page_navigation">
							<?php if(get_next_post_link('%link', '%title', true)) {?>
								<?php	next_post_link('<div class="next_post_button">%link</div>', __('&larr; to next post','sensationred'), true); ?>
								<div class="next_blog_link"><?php	next_post_link('%link', '%title', true); ?></div>						
							<?php } if(get_previous_post_link('%link', '%title', true)){ ?>
								<?php previous_post_link('<div class="previous_post_button">%link</div>', __('to previous post &rarr;','sensationred'), TRUE); ?> 
								<div class="previous_blog_link"><?php previous_post_link('%link', '%title', TRUE); ?></div>
							<?php }?>
						</div> <!-- page nav --> 
						<?php 
					} // end while
					
				} // end if
			?>
			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->
	<?php get_footer(); ?>
	
	
	
	