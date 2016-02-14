	<?php
	/*
	* Template Name: sponsoren
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

				wp_reset_query();
						
						$args = array(
							'post_type' => 'sponsoren',
							'tax_query' => array(
								array(
									'taxonomy' => 'sponsor_type',
									'field'    => 'slug',
									'terms'    => 'hoofdsponsor',
								),
							),
							'posts_per_page' => 100
						);
						$query = new WP_Query( $args );
					
						if ( $query->have_posts() ){ ?>
						
							<div class="sponsoren_title"><?php _e('Head sponsor','sensationred');?></div>
					
							<?php 					
							while ( $query->have_posts() ) { $query->the_post();
								if ( has_post_thumbnail() ) {
									?>
										<span class="sponsor_posts">
											<?php the_post_thumbnail('medium'); ?>					

												<div class="sponsor_post_content"> 
													<span class="box"></span>	
													<?php the_post_thumbnail('medium'); ?>	
													<div class="sponsor_text">
														<h1><?php the_title(); ?></h1>
														<h3>Hoofdsponsor</h3>
														<?php the_content('<p>Read more &rarr;</p>');?>		
													</div>				
												</div>
										</span>
									<?php
								} // end if
								
							} // end while
						} // end if have posts
				?>
				
				<div class="sponsoren_title"><?php _e('bussiness partners','sensationred');?></div>
				
				<?php 
				wp_reset_query();
						
						$args = array(
							'post_type' => 'sponsoren',
							'tax_query' => array(
								array(
									'taxonomy' => 'sponsor_type',
									'field'    => 'slug',
									'terms'    => 'partner',
								),
							),
							'posts_per_page' => 100
						);
						$query = new WP_Query( $args );
					
						if ( $query->have_posts() ){							
							while ( $query->have_posts() ) { $query->the_post();
									if ( has_post_thumbnail() ) { 					
										?>
										<span class="sponsor_posts">
											<?php the_post_thumbnail('medium'); ?>	
												
											<div class="sponsor_post_content" >
												<span class="box"></span>
												<?php the_post_thumbnail('medium'); ?>	
												<div class="sponsor_text">
													<h1><?php the_title(); ?></h1>
													<h3>Partner</h3>
													<?php the_content('<p>Read more &rarr;</p>');?>	
												</div>				
											</div>
										</span>
									
										<?php
									} // end if
							} // end while
						} // end if
				?>
			</div><!-- SUBSPONSORen -->
			
			
			
			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->	

	<?php get_footer(); ?>