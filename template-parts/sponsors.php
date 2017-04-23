		<?php $query = new WP_Query( array('post_type' => 'sponsoren') ); if ( $query->have_posts() ) :?>
			
			<div class="sponsoren">
						
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
						<div class="hoofd_sponsor">
							<h4><?php _e('Head sponsor','sensationred');?></h4>
							<?php
							
							while ( $query->have_posts() ) : $query->the_post();
								if ( has_post_thumbnail() ): ?>
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium');?></a>								
								<?php endif;	
							endwhile;
							?>
						</div> <!-- hoofdsponsor --> 
					<?php endif; ?>	



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
					
					if ( $query->have_posts() ): ?>
						<div class="sub_sponsor">
							<h4>partners</h4>
							<?php
							while ( $query->have_posts() ) : $query->the_post();
								if ( has_post_thumbnail() ): ?>
									<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium');?></a>
								<?php endif;
	
							endwhile; ?>
						</div>	
					<?php endif; ?>		
					
					
					
				</div> <!-- sponsoren --> 
	<?php endif; ?>	