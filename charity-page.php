	<?php
	/*
	* Template Name: Goede doelen
	*/
	?>

	<?php get_header(); ?>
	<div class="container main">	
		<div class="wrapper">			
			<div class="content sponsoren_overview">	

			<?php 
				if ( have_posts() ) {
					while ( have_posts() ) {
						?><article><?php
						the_post(); 
						//
						
						?>
						<h1 class="title"><?php the_title(); ?></h1>
						<?php 
						the_content();
						?>
						
						</article>
						<?php
						//
					} // end while
				} // end if
			?>

				<?php 
						$args = array( 
							'post_type' => 'charity', 
							'posts_per_page' => 100  
						);
						$loop = new wp_query( $args );
						while ( $loop->have_posts() ) { $loop->the_post();
								if ( has_post_thumbnail() ) { ?>
									<span class="sponsor_posts">
										<?php the_post_thumbnail('medium'); ?>	
																	
										<div class="sponsor_post_content">
											<span class="box"></span>	
											<?php the_post_thumbnail('medium'); ?>	
											<div class="sponsor_text">
												<h1><?php the_title(); ?></h1>												
												<?php the_content();?>	
											</div>				
										</div>
									</span>
								
									<?php
								} // end if
						} // end while
				?>

			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->	

	<?php get_footer(); ?>