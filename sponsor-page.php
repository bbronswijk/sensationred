	<?php
	/*
	* Template Name: sponsoren
	*/
	?>

	<?php get_header(); ?>
	<div class="container main">	
		<div class="wrapper">
						
			<div class="content sponsoren_overview">	

			<?php if ( have_posts() ) :
					while ( have_posts() ){ the_post(); ?>						
						<article>
							<h1 class="page-title"><?php the_title(); ?></h1>
							<?php the_content();?>
						</article>
				<?php } ?>
					
			<?php endif; ?>
			
			
			<?php wp_reset_query();
						
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
					
						if ( $query->have_posts() ): ?>						
							<div class="sponsoren_title"><?php _e('Head sponsor','sensationred');?></div>
					
							<?php while ( $query->have_posts() ) { $query->the_post();
								if ( has_post_thumbnail() ) : ?>
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
								endif;							
							} // end while
						endif;

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
					
						if ( $query->have_posts() ):
							
							echo '<div class="sponsoren_title">partners</div>';
							
							while ( $query->have_posts() ) { $query->the_post();
									if ( has_post_thumbnail() ) : ?>
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
									
									<?php endif; // end if
							} // end while
						endif;

				wp_reset_query();
						
						$args = array(
							'post_type' => 'sponsoren',
							'tax_query' => array(
								array(
									'taxonomy' => 'sponsor_type',
									'field'    => 'slug',
									'terms'    => 'leverancier',
								),
							),
							'posts_per_page' => 100
						);
						$query = new WP_Query( $args );
					
						if ( $query->have_posts() ):	
							
							echo '<div class="sponsoren_title">Leveranciers</div>';
							
							while ( $query->have_posts() ) { $query->the_post();
									if ( has_post_thumbnail() ): 					
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
									<?php endif;
							} 
						endif; ?>
				
	
			
			
			
			</div> <!-- content -->
		</div><!-- wrapper -->
	</div> <!-- container -->	

	<?php get_footer(); ?>