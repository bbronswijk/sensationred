<?php
/*
 * Plugin Name: latest news posts widget
 * Author: Bram Bronswijk
 * Text Domain: sensationred
 */

 add_action('widgets_init',
     create_function('', 'return register_widget("RecentNewsposts");')
);

wp_enqueue_style( 'style_recentposts', get_template_directory_uri().'/includes/recent_newspost/style_recentposts.css' );
 
 class RecentNewsposts extends WP_Widget {

	  function RecentNewsposts()
	  {
	    $widget_ops = array('classname' => 'Recent Newsposts', 'description' => 'Display the latest recent newsposts' );
	    $this->WP_Widget('Recent Newsposts', 'Recent newsposts', $widget_ops);
	  }
	

	public function widget( $args, $instance ) {
		 
				
				
				
				$recent_posts = new WP_Query('showposts=2');	
						if ( $recent_posts -> have_posts() ) {
							
							echo "<div class='recentpost_widget'>";
							echo "<h1>" . __( 'Latest news','sensationred') . "</h1>";
							
								while ( $recent_posts -> have_posts() ) {
									$recent_posts -> the_post(); 
									?>
									
										<article class="RPwidget_recent_post"><?php
											
											
											global $more;
											$more = 0;
											?>
											
												<?php
												if ( has_post_thumbnail() ) {
													
													echo"<div class='post_thumb'><a href="; the_permalink(); echo">";
										
													the_post_thumbnail();
													echo"</a></div> <!-- post thumb -->	";
													
												} 
												?>
																					
											<div class="post_content"> 
												<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
												<?php 
												the_excerpt();
												
												?>
												<a href="<?php the_permalink() ?>" class="readmore"><?php _e( 'Read more','sensationred') ?></a>
												
											</div> <!-- post content -->
											
										</article> <!-- recent_post -->
									
									
									 <?php
									//
								
								} // end while
								echo"</div>";
			
							} // end if
		
	 }

 	public function form( $instance ) {
		// outputs the options form on admin
		 echo "Widget activated! The last two newsposts are visible in the sidebar of your website.";
	}


}
 
?>